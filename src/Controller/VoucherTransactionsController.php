<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Database\Exception;

/**
 * VoucherTransactions Controller
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\BalanceTransactionsTable $BalanceTransactions
 * @property \App\Model\Table\BalanceSenderDetailsTable $BalanceSenderDetails
 * @property \App\Model\Table\BalanceReceiverDetailsTable $BalanceReceiverDetails
 *  * @property \App\Model\Table\BalanceTransactionDetailsTable $BalanceTransactionDetails
 * @property \App\Model\Table\VoucherTransactionsTable $VoucherTransactions
 * @property \App\Model\Table\VoucherTransactionSendDetailsTable $VoucherTransactionSendDetails
 * @property \App\Model\Table\VoucherTransactionReceivedDetailsTable $VoucherTransactionReceivedDetails
 * @method \App\Model\Entity\VoucherTransaction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VoucherTransactionsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadModel('Users');
        $this->loadModel('Realms');
        $this->loadModel('Profile');
        $this->loadModel('BalanceTransactions');
        $this->loadModel('BalanceSenderDetails');
        $this->loadModel('BalanceReceiverDetails');
        $this->loadModel('BalanceTransactionDetails');
        $this->loadModel('BalanceTransactionDetails');
        $this->loadModel('VoucherTransactions');
        $this->loadModel('VoucherTransactionSendDetails');
        $this->loadModel('VoucherTransactionReceivedDetails');
        $this->loadComponent('Aa');
    }

//------------------------------ Only for valid token----------------------------------
    function checkToken()
    {
        $user = $this->Aa->user_for_token($this);
        return $user['id'];
    }
//------------------------------ Only for valid token----------------------------------


//    ------------------------------ Checking for all validation voucher sender Start----------------------------------
    function checkSenderVoucher()
    {
        $idA = $this->VoucherTransactions
            ->find()
            ->where([
                'user_id' => $this->checkToken(),
                'profile_id' => $this->request->data('profile_id'),
                'realm_id' => $this->request->data('realm_id')
            ]);
        $id = 0;
        foreach ($idA as $row) {
            $id = $row->id;
        }
        return $id;
    }
//    ------------------------------ Checking for all validation voucher sender End----------------------------------


//    ------------------------------ Checking for exact voucher receiver Start----------------------------------


    function checkReceiverVoucher()
    {
        $idA = $this->VoucherTransactions
            ->find()
            ->where([
                'user_id' => $this->request->data('partner_user_id'),
                'profile_id' => $this->request->data('profile_id'),
                'realm_id' => $this->request->data('realm_id')
            ]);
        $id = 0;
        foreach ($idA as $row) {
            $id = $row->id;
        }
        return $id;
    }
//    ------------------------------ Checking for exact voucher receiver End----------------------------------


//-------------------------------Not needed any more---------------------------
    public function getUsers()
    {
        $this->request->allowMethod('get');

        $users = $this->Users->find()
            ->where(function ($exp) {
                return $exp->notEq('id', $this->checkToken());
            });

        $this->set([
            'users' => $users,
            '_serialize' => 'users'
        ]);
    }

// ----------------------------------Check for valid user Start---------------------------------
    function checkTransaction()
    {
        $idA = $this->Users->find()->select('id')
            ->where([
                'id' => $this->request->getData('partner_user_id')
            ]);

        $id = 0;
        foreach ($idA as $row) {
            $id = $row->id;
        }
        return $id;
    }
// ----------------------------------Check for valid user End---------------------------------


//    ---------------------------Is not necessary at this moment------------------------------
    function getUsername($user_id)
    {
        $user = $this->Users->find()->select('username')
            ->where(['id' => $user_id]);
        $username = null;

        foreach ($user as $row) {
            $username = $row->username;
        }
        return $username;
    }

//  -----------------------------------Getting id for sender balanceTransactions Start-------------------------------
    function checkSenderBalance(): int
    {
        $user = $this->Aa->user_for_token($this);
        if ($user) {
            $idA = $this->BalanceTransactions->find()->select('id')
                ->where([
                    'user_id' => $user['id']
                ]);
            $id = 0;
            foreach ($idA as $row) {
                $id = $row->id;
            }
            return $id;
        }
        return 0;
    }
//  -----------------------------------Getting id for sender balanceTransactions End-------------------------------

//  -----------------------------------Getting id for receiver balanceTransactions Start-------------------------------
    function checkReceiverBalance(): int
    {
        $idA = $this->BalanceTransactions->find()->select('id')
            ->where([
                'user_id' => $this->request->getData('partner_user_id')
            ]);
        $id = 0;
        foreach ($idA as $row) {
            $id = $row->id;
        }
        return $id;
    }
//  -----------------------------------Getting id for receiver balanceTransactions End-------------------------------


//    -------------------------------Configuring For voucher transaction Start----------------------------------------------
    private function generateDetails()
    {
        $tnx_id = bin2hex(random_bytes(5));
        $send = $this->VoucherTransactionSendDetails->newEntity();
        $send->set([
            'transaction' => $tnx_id,
            'user_id' => $this->request->getData('partner_user_id'),
            'sender_user_id' => $this->checkToken(),
            'profile_id' => $this->request->getData('profile_id'),
            'realm_id' => $this->request->getData('realm_id'),
            'credit' => 0,
            'balance' => $this->request->data('quantity_rate') * $this->request->getData('transfer_amount'),
            'debit' => $this->request->getData('transfer_amount'),
            'quantity_rate' => $this->request->data('quantity_rate')
        ]);

        $received = $this->VoucherTransactionReceivedDetails->newEntity();
        $received->set([
            'transaction' => $tnx_id,
            'receiver_user_id' => $this->request->getData('partner_user_id'),
            'user_id' => $this->checkToken(),
            'profile_id' => $this->request->getData('profile_id'),
            'realm_id' => $this->request->getData('realm_id'),
            'credit' => $this->request->getData('transfer_amount'),
            'balance' => $this->request->data('quantity_rate') * $this->request->getData('transfer_amount'),
            'debit' => 0,
            'quantity_rate' => $this->request->data('quantity_rate')
        ]);
        return $this->VoucherTransactionReceivedDetails->save($received) && $this->VoucherTransactionSendDetails->save($send);
    }

    private function generateDetailsAdmin()
    {
        $tnx_id = bin2hex(random_bytes(5));

        $received = $this->VoucherTransactionReceivedDetails->newEntity();
        $received->set([
            'transaction' => $tnx_id,
            'receiver_user_id' => $this->request->getData('partner_user_id'),
            'user_id' => $this->checkToken(),
            'profile_id' => $this->request->getData('profile_id'),
            'realm_id' => $this->request->getData('realm_id'),
            'credit' => $this->request->getData('transfer_amount'),
            'balance' => $this->request->data('quantity_rate') * $this->request->getData('transfer_amount'),
            'debit' => 0,
            'quantity_rate' => $this->request->data('quantity_rate')
        ]);
        return $this->VoucherTransactionReceivedDetails->save($received);
    }

    private function updateTransfer()
    {

        $send = $this->VoucherTransactions->get($this->checkSenderVoucher());
        $send_amount = $this->VoucherTransactions->patchEntity($send, $this->request->getData());
        $send_amount->set([
            'user_id' => $this->checkToken(),
            'realm_id' => $this->request->getData('realm_id'),
            'profile_id' => $this->request->getData('profile_id'),
            'debit' => $send_amount->get('debit') + $this->request->getData('transfer_amount'),
            'balance' => $send_amount->get('balance') - $this->request->getData('transfer_amount'),
            'quantity_rate' => $this->request->getData('quantity_rate')
        ]);

        $receive = $this->VoucherTransactions->get($this->checkReceiverVoucher());
        $receive_amount = $this->VoucherTransactions->patchEntity($receive, $this->request->getData());
        $receive_amount->set([
            'user_id' => $this->request->getData('partner_user_id'),
            'realm_id' => $this->request->getData('realm_id'),
            'profile_id' => $this->request->getData('profile_id'),
            'credit' => $receive_amount->get('credit') + $this->request->getData('transfer_amount'),
            'balance' => $receive_amount->get('balance') + $this->request->getData('transfer_amount'),
            'quantity_rate' => $this->request->getData('quantity_rate')
        ]);

//            ------------------------Balance should be greater tha 50 for activating the user----------------------
        if ($receive_amount->get('balance') >= 50) {
            $this->active($this->request->getData('partner_user_id'));
        }

        return $this->VoucherTransactions->save($send_amount) && $this->VoucherTransactions->save($receive_amount);
    }

//            --------------------------------------- Active User First-------------------------------

    /**
     * Activate user
     * @param $user_id
     * @return
     */
    private function active($user_id)
    {
        $active_user = $this->Users->get($user_id);
        $active_user->set([
            'active' => true
        ]);
        $this->Users->save($active_user);
    }

    private function insertTransfer()
    {
        if ($this->insertBalanceDetails()) {
//                        ---------------------------Creating new voucher transactions---------------------
//                        ------------------------------Preparing entity for receiver-----------------
            $receive_amount = $this->VoucherTransactions->newEntity();
            $receive_amount->set([
                'user_id' => $this->request->getData('partner_user_id'),
                'debit' => 0,
                'credit' => $receive_amount->get('credit') + $this->request->getData('transfer_amount'),
                'balance' => $this->request->getData('transfer_amount'),
                'realm_id' => $this->request->getData('realm_id'),
                'profile_id' => $this->request->getData('profile_id'),
                'quantity_rate' => $this->request->getData('quantity_rate')
            ]);

//          --------------------------Checking for new user for activate---------------------------
//            ------------------------Balance should be greater tha 50 for activating the user----------------------
            if ($receive_amount->get('balance') >= 50) {
                $this->active($this->request->getData('partner_user_id'));
            }


            //                        ---------------Update entity for Sender-----------------
            $send = $this->VoucherTransactions->get($this->checkSenderVoucher());
            $send_amount = $this->VoucherTransactions->patchEntity($send, $this->request->getData());
            $send_amount->set([
                'user_id' => $this->checkToken(),
                'debit' => $send_amount->get('debit') + $this->request->getData('transfer_amount'),
                'balance' => $send_amount->get('balance') - $this->request->getData('transfer_amount'),
                'realm_id' => $this->request->getData('realm_id'),
                'profile_id' => $this->request->getData('profile_id'),
                'quantity_rate' => $this->request->getData('quantity_rate')
            ]);

            return $this->VoucherTransactions->save($receive_amount) && $this->VoucherTransactions->save($send_amount);
        } else {
            return false;
        }

    }

    //-----------------------------------BalanceTransactionDetails---------------------------------------
    private function defineBalanceDetails()
    {
        $tnx_id = bin2hex(random_bytes(5));

        $balance = $this->BalanceTransactionDetails->newEntity();
        $balance->set([
            'transaction' => $tnx_id,
            'user_id' => $this->checkToken(),
            'receiver_user_id' => $this->request->getData('partner_user_id'),
            'profile_id' => $this->request->getData('profile_id'),
            'realm_id' => $this->request->getData('realm_id'),
            'vouchers' => $this->request->getData('transfer_amount'),
            'quantity_rate' => $this->request->getData('quantity_rate'),
            'total' => $this->request->getData('transfer_amount') * $this->request->getData('quantity_rate')
        ]);

        return $this->BalanceTransactionDetails->save($balance);
    }

    private function insertBalanceDetails()
    {
        if ($this->insertBalance() && $this->defineBalanceDetails()) {
            return true;
        } else {
            return false;
        }
    }
//    -------------------------------Configuring For balance transaction End----------------------------------------------


//    -------------------------------Configuring For balance transaction Start----------------------------------------------
    private function insertBalance()
    {
        $balanceTransactionSender = $this->BalanceTransactions->get($this->checkSenderBalance());

        $balanceTransactionSender->set([
            'receivable' => $this->request->getData('transfer_amount') * $this->request->getData('quantity_rate')
                + $balanceTransactionSender->get('receivable'),
            'payable' => $balanceTransactionSender->get('payable'),
        ]);

        $balanceTransactionReceiver = $this->BalanceTransactions->get($this->checkReceiverBalance());

        $balanceTransactionReceiver->set([
            'payable' => $this->request->getData('transfer_amount') * $this->request->getData('quantity_rate')
                + $balanceTransactionReceiver->get('payable'),
            'receivable' => $balanceTransactionReceiver->get('receivable')
        ]);


        return $this->BalanceTransactions->save($balanceTransactionSender) && $this->BalanceTransactions->save($balanceTransactionReceiver);
    }

    public function index()
    {
        $this->request->allowMethod('get');

        if ($this->checkToken()) {
            if ($this->checkToken() == 44) {
                $item = $this->VoucherTransactions
                    ->find()
                    ->contain(['Users', 'Profiles', 'Realms']);

                $this->set([
                    'item' => $item,
                    'success' => true,
                    '_serialize' => ['item', 'success']
                ]);
            } else {
                $item = $this->VoucherTransactions
                    ->find()
                    ->where(['Users.id' => $this->checkToken()])
                    ->contain(['Users', 'Profiles', 'Realms']);


                $this->set([
                    'item' => $item,
                    'success' => true,
                    '_serialize' => ['item', 'success']
                ]);
            }
        } else {
            $this->set([
                'message' => 'Invalid user account',
                'status' => false,
                '_serialize' => ['message', 'status']
            ]);
        }
    }

    //    -------------------------------Configuring For balance transaction End----------------------------------------------

    public function view()
    {
        $this->request->allowMethod('get');
        if ($this->checkToken()) {
            if ($this->checkToken() == 44) {
                $key = $this->VoucherTransactions->get($this->request->query('key'));

                $send_items = $this->VoucherTransactionSendDetails
                    ->find()
                    ->where([
                        'sender_user_id' => $key->get('user_id'),
                        'realm_id' => $key->get('realm_id'),
                        'profile_id' => $key->get('profile_id')
                    ])
                    ->contain(['Users', 'Realms', 'Profiles']);

                $received_items = $this->VoucherTransactionReceivedDetails
                    ->find()
                    ->where([
                        'receiver_user_id' => $key->get('user_id'),
                        'realm_id' => $key->get('realm_id'),
                        'profile_id' => $key->get('profile_id')
                    ])
                    ->contain(['Users', 'Realms', 'Profiles']);

                $this->set([
                    'send' => $send_items,
                    'received' => $received_items,
                    'success' => true,
                    '_serialize' => ['send', 'received', 'success']
                ]);
            } else {
                $send_items = $this->VoucherTransactionSendDetails
                    ->find()
                    ->where(['sender_user_id' => $this->checkToken()])
                    ->contain(['Users', 'Realms', 'Profiles']);
                $received_items = $this->VoucherTransactionReceivedDetails
                    ->find()
                    ->where(['receiver_user_id' => $this->checkToken()])
                    ->contain(['Users', 'Realms', 'Profiles']);

                $this->set([
                    'send' => $send_items,
                    'received' => $received_items,
                    '_serialize' => ['send', 'received']
                ]);
            }
        } else {
            $this->set([
                'message' => 'Invalid token',
                'status' => false,
                '_serialize' => ['status', 'message']
            ]);
        }
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     * @throws \Exception
     */
    public function add()
    {
        $this->request->allowMethod('post');

//        -------------------Check Valid token----------------
        if ($this->request->query('token') && $this->checkToken()) {
            if ($this->checkSenderVoucher()) {
                $transfer_amount = $this->VoucherTransactions->get($this->checkSenderVoucher());
//            ---------------------------- Check Amount --------------------
                if ($transfer_amount->get('balance') >= $this->request->getData('transfer_amount')) {
//                ------------------------ Check Partner ------------------------------
                    if ($this->checkTransaction()) {
//                    --------------------- Checking for realm & profile ----------------
                        if ($this->checkReceiverVoucher()) {
//                        ---------------Preparing entity for receiver-----------------

                            if ($this->updateTransfer() && $this->generateDetails()) {

                                if ($this->insertBalanceDetails()) {
                                    $this->set([
                                        'message' => 'Transaction successful',
                                        'success' => true,
                                        '_serialize' => ['success', 'message']
                                    ]);
                                } else {
                                    $this->set([
                                        'message' => 'Failed to generate balance contact with admin',
                                        'success' => false,
                                        '_serialize' => ['success', 'message']
                                    ]);
                                }

                            } else {
                                $this->set([
                                    'message' => 'Transfer failed',
                                    'success' => false,
                                    '_serialize' => ['success', 'message']
                                ]);
                            }
                        } else {
                            if ($this->insertTransfer() && $this->generateDetails()) {
                                $this->set([
                                    'message' => 'Transaction successful',
                                    'success' => true,
                                    '_serialize' => ['success', 'message']
                                ]);

                            } else {
                                $this->set([
                                    'message' => 'Transfer failed',
                                    'success' => false,
                                    '_serialize' => ['success', 'message']
                                ]);
                            }
                        }
                    } else {
                        $this->set([
                            'message' => 'Invalid partner account',
                            'success' => false,
                            '_serialize' => ['success', 'message']
                        ]);
                    }
                } else {
                    $this->set([
                            'message' => 'You do not have enough balance',
                            'success' => false,
                            '_serialize' => ['success', 'message']]
                    );
                }
            } else {
                $this->set([
                        'message' => 'You do not have this profile balance',
                        'success' => false,
                        '_serialize' => ['success', 'message']]
                );
            }
        } else {
            $this->set([
                    'token' => 'Missing token',
                    'success' => false,
                    '_serialize' => ['success', 'token']]
            );
        }
    }

    public function test(){
        $admin = $this->Users->get($this->checkToken());
    }

//-----------------------------------Generate voucher for admin only Start-------------------------------------------
    public function generate()
    {
        $this->request->allowMethod('post');
        $admin = $this->Users->get($this->checkToken());
        if ($admin->get('parent_id') == null) {
            if ($this->checkSenderVoucher()) {
                $updateVoucher = $this->VoucherTransactions->get($this->checkSenderVoucher());
                $updateVoucher = $this->VoucherTransactions->patchEntity($updateVoucher, $this->request->getData());

                $newBalance = $updateVoucher->set([
                    'user_id' => $this->checkToken(),
                    'profile_id' => $this->request->data('profile_id'),
                    'realm_id' => $this->request->data('realm_id'),
                    'credit' => $this->request->data('transfer_amount') + $updateVoucher->get('credit'),
                    'debit' => 0,
                    'balance' => $this->request->data('transfer_amount') + $updateVoucher->get('balance'),
                    'quantity_rate' => $this->request->data('quantity_rate')
                ]);
                if ($this->VoucherTransactions->save($newBalance) && $this->generateDetailsAdmin()) {
                    $this->set([
                        'message' => 'Generate balance successful',
                        'success' => true,
                        '_serialize' => ['success', 'message']
                    ]);
                } else {
                    $this->set([
                        'message' => 'Failed to update balance',
                        'success' => false,
                        '_serialize' => ['success', 'message']
                    ]);
                }


            } else {
                $updateVoucher = $this->VoucherTransactions->newEntity();

                $newBalance = $updateVoucher->set([
                    'user_id' => $this->checkToken(),
                    'profile_id' => $this->request->data('profile_id'),
                    'realm_id' => $this->request->data('realm_id'),
                    'credit' => $this->request->data('transfer_amount') + $updateVoucher->get('credit'),
                    'debit' => 0,
                    'balance' => $this->request->data('transfer_amount') + $updateVoucher->get('balance'),
                    'quantity_rate' => $this->request->data('quantity_rate')
                ]);
                if ($this->VoucherTransactions->save($newBalance) && $this->generateDetailsAdmin()) {
                    $this->set([
                        'message' => 'Balance generate successful',
                        'success' => true,
                        '_serialize' => ['success', 'message']
                    ]);
                } else {
                    $this->set([
                        'message' => 'Failed to generate balance',
                        'success' => false,
                        '_serialize' => ['success', 'message']
                    ]);
                }

            }
        } else {
            $this->set([
                'message' => 'Invalid token',
                'success' => false,
                '_serialize' => ['success', 'message']
            ]);
        }
    }
//-----------------------------------Generate voucher for admin only End-------------------------------------------

}