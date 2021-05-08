<?php

namespace App\Controller;

use App\Controller\AppController;


/**
 * VoucherTransactionDetails Controller
 *
 * @property \App\Model\Table\VouchersTable $Vouchers
 * @property \App\Model\Table\VoucherTransactionsTable $VoucherTransactions
 * @property \App\Model\Table\ServerRealmsTable $ServerRealms
 * @property \App\Model\Table\TweakRealmsTable $TweakRealms
 * @method \App\Model\Entity\VoucherTransactionDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ApplicationController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Users');
        $this->loadModel('Vouchers');
        $this->loadModel('ServerRealms');
        $this->loadModel('TweakRealms');
        $this->loadModel('VoucherTransactions');

        $this->loadComponent('Aa');
    }

    function checkToken()
    {
        $user = $this->Aa->user_for_token($this);
        return $user['id'];
    }


    public function validity()
    {
        $this->request->allowMethod('post');
        $user_id = $this->checkToken();

//        --------------------------Checking User-----------------------
        if ($user_id) {
            $voucher = $this->Vouchers->find()
                ->where([
                    'user_id' => $user_id,
                    'name' => $this->request->data('name'),
                    'password' => $this->request->data('password')
                ])
                ->first();
            if ($voucher) {
                $transaction = $this->VoucherTransactions->find()
                    ->where([
                        'user_id' => $user_id,
                        'realm_id' => $voucher->realm_id,
                        'profile_id' => $voucher->profile_id
                    ])
                    ->first();
                if ($transaction) {
                    $server = $this->ServerRealms->find()
                        ->where([
                            'realm_id' => $transaction->realm_id
                        ])
                        ->contain('Servers');

//                    foreach ($server as $row)

                    $tweak = $this->TweakRealms->find()
                        ->where([
                            'realm_id' => $transaction->realm_id
                        ])
                        ->contain('Tweaks');

                    $item = array();
                    $row = array();

                    $row['version'] = 1.00;
                    $row['servers'] = $server;
                    $row['tweaks'] = $tweak;

                    array_push($item, $row);

                        $this->set([
                            'item' => $item[0],
                            'success' => true,
                            '_serialize' => ['success','item']
                        ]);
                } else {
                    $this->set([
                        'message' => 'Invalid server configuration',
                        'success' => false,
                        '_serialize' => ['success', 'message']
                    ]);
                }

            } else {
                $this->set([
                    'message' => 'Invalid username or password',
                    'success' => false,
                    '_serialize' => ['success', 'message']
                ]);
            }

        } else {
            $this->set([
                'message' => 'Invalid account',
                'success' => false,
                '_serialize' => ['success', 'message']
            ]);
        }

    }
}
