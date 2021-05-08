<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\Log\Log;


/**
 * VoucherTransactionDetails Controller
 *
 * @property \App\Model\Table\VouchersTable $Vouchers
 * @property \App\Model\Table\VoucherTransactionsTable $VoucherTransactions
 * @property \App\Model\Table\ServerRealmsTable $ServerRealms
 * @property \App\Model\Table\TweakRealmsTable $TweakRealms
 * @method \App\Model\Entity\VoucherTransactionDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VpnsController extends AppController
{
    public $base = "Access Providers/Controllers/Vpns/";

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('Vouchers');
        $this->loadModel('ServerRealms');
        $this->loadModel('TweakRealms');
        $this->loadModel('VoucherTransactions');

        $this->loadComponent('Aa');
        $this->loadComponent('RealmAcl');
    }

    public function login()
    {
        $this->request->allowMethod('post');
        Log::write('debug', $this->request->data());
        $user = $this->Aa->user_for_token($this);
        if (!$user) {
            $this->set([
                'message' => 'Unauthorized application!',
                'success' => false,
                '_serialize' => ['success', 'message']
            ]);
            return;
        }

        $user_id = $user['id'];

        if(isset($this->request->data['name']) && isset($this->request->data['password']) && isset($this->request->data['device_owner'])){
            $voucher = $this->Vouchers->find()
                ->where([
                    'name' => $this->request->data('name'),
                    'password' => $this->request->data('password')
                ])
                ->first();

            
            if($voucher){
                //check the read capabilities to the realm for the user
                try {
                    $read = $this->Acl->check(
                        array('model' => 'Users', 'foreign_key' => $user_id),
                        array('model' => 'Realms', 'foreign_key' => $voucher->realm_id), 'read'); //Only if they have create right
                } catch (\Exception $e) {
                    $read = false;
                }

                if($read){
                    //check device owner
                    if($voucher->extra_value == ''){
                        //update device owner to extra_value
                        $voucher->extra_value = $this->request->data['device_owner'];
                        if ($this->Vouchers->save($voucher)) {
                            return $this->_getAppSettings($voucher->realm_id);
                        } else {
                            $this->set([
                                'message' => 'Could not attach your device id to your voucher this time',
                                'success' => false,
                                '_serialize' => ['success', 'message']
                            ]);
                        }
                    } else if($voucher->extra_value != $this->request->data['device_owner']){
                        $this->set([
                            'message' => 'Unauthorized device, ask your agent to reset your voucher.',
                            'success' => false,
                            '_serialize' => ['success', 'message']
                        ]);
                    } else {
                        return $this->_getAppSettings($voucher->realm_id);
                    }
                } else{
                    $this->set([
                        'message' => 'Invalid user & password.',
                        'success' => false,
                        '_serialize' => ['success', 'message']
                    ]);
                }

            } else{
                $this->set([
                    'message' => 'Invalid user & password.',
                    'success' => false,
                    '_serialize' => ['success', 'message']
                ]);
            }
                
        } else{
            $this->set([
                'message' => 'Missing required parameters.',
                'success' => false,
                '_serialize' => ['success', 'message']
            ]);
        }

    }


    private function _getAppSettings($realm_id){
        $responseStr = '{"version":0,"servers":[],"tweaks":[]}';
        $responseObject = json_decode($responseStr);

        $responseObject->servers = $this->_getServers($realm_id);
        $responseObject->tweaks = $this->_getTweaks($realm_id);

        Log::write('debug', json_encode($responseObject));

        $this->set(array(
            'message' => $responseObject,
            'success' => true,
            '_serialize' => ['success', 'message']
        ));
    }

    private function _getServers($realm_id) {
        $servers = array();
        $result = $this->ServerRealms->find()
            ->where([
                'realm_id' => $realm_id
            ])
            ->contain('Servers')
            ->all();
        foreach($result as $server_realm){
            array_push($servers, $server_realm->server);
        }
        return $servers;
    }

    private function _getTweaks($realm_id) {
        $tweaks = array();
        $result = $this->TweakRealms->find()
            ->where([
                'realm_id' => $realm_id
            ])
            ->contain('Tweaks')
            ->all();
        foreach($result as $tweak_realm){
            array_push($tweaks, $tweak_realm->tweak);
        }
        return $tweaks;
    }
}
