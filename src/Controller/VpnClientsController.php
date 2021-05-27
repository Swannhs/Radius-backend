<?php

namespace App\Controller;

use App\Controller\AppController;

use Cake\Log\Log;

use Cake\I18n\Time;

/**
 * VoucherTransactionDetails Controller
 *
 * @property \App\Model\Table\VouchersTable $Vouchers
 * @property \App\Model\Table\VoucherTransactionsTable $VoucherTransactions
 * @property \App\Model\Table\ServerRealmsTable $ServerRealms
 * @property \App\Model\Table\TweakRealmsTable $TweakRealms
 * @method \App\Model\Entity\VoucherTransactionDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VpnClientsController extends AppController
{
    public $base = "Access Providers/Controllers/VpnClients/";

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
        Log::info("login > {\"headers\": ".json_encode($this->request->getHeaders())."\n,\"body\": ".json_encode($this->request->data())."}", 'api');

        $user = $this->_ap_right_check();
        if (!$user) {
            $this->set([
                'message' => 'Unauthorized application!',
                'success' => false,
                '_serialize' => ['success', 'message']
            ]);
            return;
        }

        $user_id = $user['id'];

        if (isset($this->request->data['name']) && isset($this->request->data['password']) && isset($this->request->data['deviceId'])) {
            $voucher = $this->Vouchers->find()
                ->where([
                    'name' => $this->request->data('name'),
                    'password' => $this->request->data('password')
                ])
                ->first();

            if ($voucher) {
                if ($voucher->status == 'new' || $voucher->status == 'used') {
                    //check the read capabilities to the realm for the user
                    try {
                        $read = $this->Acl->check(
                            array('model' => 'Users', 'foreign_key' => $user_id),
                            array('model' => 'Realms', 'foreign_key' => $voucher->realm_id),
                            'read'
                        ); //Only if they have create right
                    } catch (\Exception $e) {
                        $read = false;
                    }

                    if ($read) {
                        //check device id
                        if ($voucher->extra_value == '') {
                            //update activated_on to current date time for calculating validity 
                            if ($voucher->activated_on == NULL) {
                                $voucher->activated_on = Time::now();
                            }

                            //update device id to extra_value
                            $voucher->extra_value = $this->request->data['deviceId'];
                            if ($this->Vouchers->save($voucher)) {
                                return $this->_getAppSettings($voucher);
                            } else {
                                $this->set([
                                    'message' => 'Could not attach your device id to your voucher this time',
                                    'success' => false,
                                    '_serialize' => ['success', 'message']
                                ]);
                            }
                        } else if ($voucher->extra_value != $this->request->data['deviceId']) {
                            $this->set([
                                'message' => 'Unauthorized device, ask your agent to reset your voucher.',
                                'success' => false,
                                '_serialize' => ['success', 'message']
                            ]);
                        } else {
                            return $this->_getAppSettings($voucher);
                        }
                    } else {
                        $this->set([
                            'message' => 'Wrong user & password.',
                            'success' => false,
                            '_serialize' => ['success', 'message']
                        ]);
                    }
                } else {
                    $this->set([
                        'message' => 'Your voucher is expired!',
                        'success' => false,
                        '_serialize' => ['success', 'message']
                    ]);
                }
            } else {
                $this->set([
                    'message' => 'Wrong user & password.',
                    'success' => false,
                    '_serialize' => ['success', 'message']
                ]);
            }
        } else {
            $this->set([
                'message' => 'Missing required parameters.',
                'success' => false,
                '_serialize' => ['success', 'message']
            ]);
        }
    }


    public function validity()
    {
        $this->request->allowMethod('post');
        Log::info("validity > {\"headers\": ".json_encode($this->request->getHeaders())."\n,\"body\": ".json_encode($this->request->data())."}", 'api');

        $user = $this->_ap_right_check();
        if (!$user) {
            $this->set([
                'message' => 'Unauthorized application!',
                'success' => false,
                '_serialize' => ['success', 'message']
            ]);
            return;
        }

        $user_id = $user['id'];

        if (isset($this->request->data['name']) && isset($this->request->data['password'])) {
            $voucher = $this->Vouchers->find()
                ->where([
                    'name' => $this->request->data('name'),
                    'password' => $this->request->data('password')
                ])
                ->first();

            if ($voucher) {
                if ($voucher->status == 'new' || $voucher->status == 'used') {
                    $responseStr = '{"validity":"expired"}';
                    $responseObject = json_decode($responseStr);

                    $responseObject->validity = $this->_getValidity($voucher);

                    $this->set(array(
                        'data' => $responseObject,
                        'success' => true,
                        '_serialize' => ['success', 'data']
                    ));
                } else {
                    $this->set([
                        'message' => 'Your voucher is expired!',
                        'success' => false,
                        '_serialize' => ['success', 'message']
                    ]);
                }
            } else {
                $this->set([
                    'message' => 'Wrong user & password.',
                    'success' => false,
                    '_serialize' => ['success', 'message']
                ]);
            }
        } else {
            $this->set([
                'message' => 'Missing required parameters.',
                'success' => false,
                '_serialize' => ['success', 'message']
            ]);
        }

    }


    private function _getAppSettings($voucher)
    {
        $responseStr = '{"version":0,"validity":"expired","servers":[],"tweaks":[]}';
        $responseObject = json_decode($responseStr);

        $responseObject->validity = $this->_getValidity($voucher);
        $responseObject->servers = $this->_getServers($voucher->realm_id);
        $responseObject->tweaks = $this->_getTweaks($voucher->realm_id);

        Log::write('debug', json_encode($responseObject));

        $this->set(array(
            'data' => $responseObject,
            'success' => true,
            '_serialize' => ['success', 'data']
        ));
    }

    private function _getValidity($voucher)
    {
        $activated = new Time($voucher->activated_on);
        $pieces = explode("-", $voucher->time_valid);
        $valid_to = $activated->modify($pieces[0] . ' days')->modify($pieces[1] . ' hours')->modify($pieces[2] . ' minutes')->modify($pieces[3] . ' seconds');
        $now = Time::now();
        if ($now > $valid_to)
            return 'expired';

        $diff = $now->diff($valid_to);
        $formatted = sprintf('%d-%02d-%02d-%02d', $diff->days, $diff->h, $diff->i, $diff->s);
        return $this->_getValidityInWords($formatted);
    }

    private function _getValidityInWords($time_valid)
    {
        $pieces = explode("-", $time_valid);

        if ($pieces[0] !== '0') {
            $days = 'Days';
            if ($pieces[0] == 1) {
                $days = 'Day';
            }
            return ltrim($pieces[0], '0') . " $days";
        }
        if ($pieces[1] !== '00') {
            $hours = 'Hours';
            if ($pieces[1] == '01') {
                $hours = 'Hour';
            }
            return ltrim($pieces[1], '0') . " $hours";
        }
        if ($pieces[2] !== '00') {
            $minutes = 'Minutes';
            if ($pieces[2] == '01') {
                $minutes = 'Minute';
            }
            return ltrim($pieces[2], '0') . " $minutes";
        }

        return 'Few seconds left!';
    }

    private function _getServers($realm_id)
    {
        $servers = array();
        $result = $this->ServerRealms->find()
            ->where([
                'realm_id' => $realm_id
            ])
            ->contain('Servers')
            ->all();
        foreach ($result as $server_realm) {
            array_push($servers, $server_realm->server);
        }
        return $servers;
    }

    private function _getTweaks($realm_id)
    {
        $tweaks = array();
        $result = $this->TweakRealms->find()
            ->where([
                'realm_id' => $realm_id
            ])
            ->contain('Tweaks')
            ->all();
        foreach ($result as $tweak_realm) {
            array_push($tweaks, $tweak_realm->tweak);
        }
        return $tweaks;
    }
}
