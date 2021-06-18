<?php
//----------------------------------------------------------
//---- Author: Dirk van der Walt
//---- License: GPL v3
//---- Description: A component that is used to genarate intuative voucher values
//---- Date: 08-05-2017
//------------------------------------------------------------

namespace App\Controller\Component;
use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\Database\Expression\QueryExpression;
use Cake\ORM\Query;
use Cake\Log\Log;

use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;

class TransactionComponent extends Component {

    public $components = ['Acl', 'Aa', 'Formatter'];
    
    public function initialize(array $config){
        $this->controller   					= $this->_registry->getController();
        $this->Users        					= TableRegistry::get('Users');
        $this->Realms       					= TableRegistry::get('Realms');
		$this->VoucherTransactions				= TableRegistry::get('VoucherTransactions');
		$this->VoucherTransactionSendDetails 	= TableRegistry::get('VoucherTransactionSendDetails');
		$this->VoucherTransactionReceivedDetails = TableRegistry::get('VoucherTransactionReceivedDetails');
    }
    
    //This is only called if the user is an AP - we then check if the action they try to do is allowed for the realm (is he assigned to the realm)
    public function get_app_id_for_realm($realm_id){
		$apps = $this->Users->find()
        ->select(['Users.id', 'Users.username'])
		->where(function (QueryExpression $exp, Query $q) {
			return $exp->like('username', 'app-%');
		});

        //Alternatively we need to check if this realm has been assigned to the use since it belongs to a parent...
        $read       = false;
        $temp_debug = Configure::read('debug');
        Configure::write('debug', 0); // turn off debugging

		if($apps){
			foreach($apps as $app){   
				try{
					$read = $this->Acl->check(
						array('model' => 'Users', 'foreign_key' => $app->id), 
						array('model' => 'Realms','foreign_key' => $realm_id), 'read'); //Only if they have create right             
				}catch(\Exception $e){               
					$read = false;  
				}
				if($read) {
					return $app->id;
				}
			}
		}
		
        Configure::write('debug', $temp_debug); // return previous setting 
        //return root user id if no app id found
        return null;        
    }

	public function transfer($sender_id, $receiver_id)
    {
        // check balace for requested realm and profile
        $sender_transaction = $this->checkBalance($sender_id);

        if ($sender_transaction) {
            if($this->request->data['transfer_amount'] <= 0){
                return [
                    'message' => 'Invalid amount!',
                    'success' => false,
                    '_serialize' => ['success', 'message']
                ];
            }
            //Check available blance
            if ($sender_transaction->get('balance') >= $this->request->data['transfer_amount']) {
                // Checking existing credits for same realm & profile
				$receiver_transaction = $this->checkBalance($receiver_id);
				if ($receiver_transaction) {
					if ($this->updateTransfer($sender_transaction, $receiver_transaction)) {
						//todo: need to add balance details later
						return [
							'message' => 'Transaction successful',
							'success' => true,
                            'type' => 'update',
							'_serialize' => ['success', 'message']
						];

					} else {
						return [
							'message' => 'Transfer failed',
							'success' => false,
							'_serialize' => ['success', 'message']
						];
					}
				} else {
					if ($this->insertTransfer($sender_transaction, $receiver_id)) {
						return [
							'message' => 'Transaction successful',
							'success' => true,
                            'type' => 'insert',
							'_serialize' => ['success', 'message']
						];

					} else {
						return [
							'message' => 'Transfer failed',
							'success' => false,
							'_serialize' => ['success', 'message']
						];
					}
				}
            } else {
                return [
                        'message' => 'You do not have enough credits!',
                        'success' => false,
                        '_serialize' => ['success', 'message']
                ];
            }
        } else {
            return [
                    'message' => 'You do not have credits!',
                    'success' => false,
                    '_serialize' => ['success', 'message']
            ];
        }
    }



	private function insertTransfer($sender_transaction, $receiver_id)
    {

        //Update entity for Sender
        $sender_transaction->set([
            'debit' => sprintf('%0.2f', ($sender_transaction->get('debit') + $this->request->getData('transfer_amount'))),
            'balance' => sprintf('%0.2f', ($sender_transaction->get('balance') - $this->request->getData('transfer_amount'))),
            'quantity_rate' => sprintf('%0.2f', $this->request->getData('quantity_rate'))
        ]);

        //Create new entity for Receiver
        $receiver_transaction = $this->VoucherTransactions->newEntity();
        $receiver_transaction->set([
            'user_id' => $receiver_id,
            'realm_id' => $this->request->getData('realm_id'),
            'profile_id' => $this->request->getData('profile_id'),
            'credit' => sprintf('%0.2f', $this->request->getData('transfer_amount')),
            'balance' => sprintf('%0.2f', $this->request->getData('transfer_amount')),
            'quantity_rate' => sprintf('%0.2f', $this->request->getData('quantity_rate'))
        ]);

        //save details transactions
        $this->saveDetailsTransactions($sender_transaction->user_id, $receiver_transaction->user_id);

        return $this->VoucherTransactions->save($sender_transaction) && $this->VoucherTransactions->save($receiver_transaction);
    }

	private function updateTransfer($sender_transaction, $receiver_transaction)
    {

        $this->saveDetailsTransactions($sender_transaction->user_id, $receiver_transaction->user_id);

        $sender_transaction->set([
            'debit' => sprintf('%0.2f', ($sender_transaction->get('debit') + $this->request->getData('transfer_amount'))),
            'balance' => sprintf('%0.2f', ($sender_transaction->get('balance') - $this->request->getData('transfer_amount'))),
            'quantity_rate' => sprintf('%0.2f', $this->request->getData('quantity_rate'))
        ]);

        $receiver_transaction->set([
            'credit' => sprintf('%0.2f', ($receiver_transaction->get('credit') + $this->request->getData('transfer_amount'))),
            'balance' => sprintf('%0.2f', ($receiver_transaction->get('balance') + $this->request->getData('transfer_amount'))),
            'quantity_rate' => sprintf('%0.2f', $this->request->getData('quantity_rate'))
        ]);

        return $this->VoucherTransactions->save($sender_transaction) && $this->VoucherTransactions->save($receiver_transaction);
    }


	private function saveDetailsTransactions($sender_id, $receiver_id)
    {

        $data = $this->request->data();

        $tnx_id = $this->Formatter->random_alpha_numeric(10);
        $send = $this->VoucherTransactionSendDetails->newEntity();
        $send->set([
            'transaction' => $tnx_id,
            'user_id' => $receiver_id,
            'sender_user_id' => $sender_id,
            'profile_id' => $data['profile_id'],
            'realm_id' => $data['realm_id'],
            'debit' => $data['transfer_amount'],
            'credit' => 0
        ]);

        $received = $this->VoucherTransactionReceivedDetails->newEntity();
        $received->set([
            'transaction' => $tnx_id,
            'receiver_user_id' => $receiver_id,
            'user_id' => $sender_id,
            'profile_id' => $data['profile_id'],
            'realm_id' => $data['realm_id'],
            'credit' => $data['transfer_amount'],
            'debit' => 0
        ]);

        return $this->VoucherTransactionReceivedDetails->save($received) && $this->VoucherTransactionSendDetails->save($send);
    }

    public function checkBalance($user_id)
    {
        return $this->VoucherTransactions
            ->find()
            ->where([
                'user_id' => $user_id,
                'profile_id' => $this->request->data('profile_id'),
                'realm_id' => $this->request->data('realm_id')
            ])->first();
    }

}
