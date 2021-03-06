<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * BalanceTransactionDetails Controller
 *
 * @property \App\Model\Table\BalanceTransactionsTable $BalanceTransactions
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\BalanceSenderDetailsTable $BalanceSenderDetails
 * @property \App\Model\Table\BalanceReceiverDetailsTable $BalanceReceiverDetails
 *
 * @method \App\Model\Entity\BalanceTransactionDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BalanceTransactionsController extends AppController
{
    private $symbol = ' ৳';

    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadModel('Users');
        $this->loadModel('BalanceTransactions');
        $this->loadModel('BalanceSenderDetails');
        $this->loadModel('BalanceReceiverDetails');

        $this->loadComponent('Aa');
        $this->loadComponent('Formatter');
    }

    function checkToken()
    {
        $user = $this->Aa->user_for_token($this);
        return $user['id'];
    }


    public function index()
    {

        $this->request->allowMethod('get');
        $user_id = $this->checkToken();
        if ($user_id) {
//            -----------------------------------------------Check for admin only-----------------------------
            $user = $this->Users->get($user_id);
            if (!$user->get('parent_id')) {
                $query = $this->BalanceTransactions
                    ->find()
                    ->contain('Users');

                $total = $query->count();

                $query_pg = $this->Formatter->pagination($query);

                $item = $this->_format_amount_with_currency($query_pg);

                $this->set([
                    'item' => $item,
                    'totalCount' => $total,
                    'status' => true,
                    '_serialize' => ['item', 'totalCount', 'status']
                ]);
            } else {
                $query = $this->BalanceTransactions
                    ->find()
                    ->where(['user_id' => $user_id])
                    ->contain('Users');

                $total = $query->count();

                $query_pg = $this->Formatter->pagination($query);

                $item = $this->_format_amount_with_currency($query_pg);

                $this->set([
                    'item' => $item,
                    'totalCount' => $total,
                    'status' => true,
                    '_serialize' => ['item', 'totalCount', 'status']
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

    public function view()
    {
        $this->request->allowMethod('get');
        $user_id = $this->checkToken();
        if ($user_id) {
            $user = $this->Users->get($user_id);
            if (!$user->get('parent_id')) {
                $key = $this->BalanceTransactions->get($this->request->query('key'));
                $send_items = $this->BalanceSenderDetails
                    ->find()
                    ->where(['sender_user_id' => $key->get('user_id')])
                    ->contain(['Users']);

                $send_total = $send_items->count();

                $query_send = $this->Formatter->pagination($send_items);

                $send_item = $this->_format_amount_with_currency($query_send);




                $received_items = $this->BalanceReceiverDetails
                    ->find()
                    ->where(['receiver_user_id' => $key->get('user_id')])
                    ->contain(['Users']);

                $received_total = $received_items->count();

                $query_received = $this->Formatter->pagination($received_items);

                $received_item = $this->_format_amount_with_currency($query_received);


                $this->set([
                    'send' => $send_item,
                    'send_total' => $send_total,
                    'received' => $received_item,
                    'received_total' => $received_total,
                    '_serialize' => ['send', 'send_total', 'received', 'received_total']
                ]);
            } else {
                $send_items = $this->BalanceSenderDetails
                    ->find()
                    ->where(['sender_user_id' => $user_id])
                    ->contain(['Users']);

                $send_total = $send_items->count();

                $query_send = $this->Formatter->pagination($send_items);

                $send_item = $this->_format_amount_with_currency($query_send);

                $received_items = $this->BalanceReceiverDetails
                    ->find()
                    ->where(['receiver_user_id' => $user_id])
                    ->contain(['Users']);

                $received_total = $received_items->count();

                $query_received = $this->Formatter->pagination($received_items);

                $received_item = $this->_format_amount_with_currency($query_received);

                $this->set([
                    'send' => $send_item,
                    'send_total' => $send_total,
                    'received' => $received_item,
                    'received_total' => $received_total,
                    '_serialize' => ['send', 'send_total', 'received', 'received_total']
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

    private function _format_amount_with_currency($items)
    {
        $currency = Configure::read('currency');
        $formatted_items = array();
        foreach ($items as $row) {
            $row['payable'] = $this->Formatter->add_currency($row->payable, $currency);
            $row['paid'] = $this->Formatter->add_currency($row->paid, $currency);
            $row['receivable'] = $this->Formatter->add_currency($row->receivable, $currency);
            $row['received'] = $this->Formatter->add_currency($row->received, $currency);
            $row['user'] = $row->user->username;
            array_push($formatted_items, $row);
        }
        return $formatted_items;
    }


    function checkSenderBalance()
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

    function checkReceiverBalance()
    {
        $receiver = $this->BalanceTransactions->find()->select('id')
            ->where([
                'user_id' => $this->request->getData('partner_user_id')
            ])
            ->first();

        return $receiver ? $receiver->id : false;
    }

    public function parent()
    {
        $id = $this->Aa->user_for_token($this);
        $user = $this->Users->get($id['id']);
        $parent_user = $this->Users->get($user['parent_id']);
        $this->set([
            'id' => $parent_user['id'],
            'username' => $parent_user['username'],
            '_serialize' => ['id', 'username']
        ]);
    }


    public function ConfirmBalance()
    {
        $confirmSender = $this->BalanceTransactions->get($this->checkSenderBalance());
        $confirmSender->set([
            'payable' => $confirmSender->get('payable') - $this->request->getData('paid'),
            'paid' => $confirmSender->get('paid') + $this->request->getData('paid'),
        ]);

        $confirmReceiver = $this->BalanceTransactions->get($this->checkReceiverBalance());
        $confirmReceiver->set([
            'receivable' => $confirmReceiver->get('receivable') - $this->request->getData('paid'),
            'received' => $confirmReceiver->get('received') + $this->request->getData('paid')
        ]);
        return $this->BalanceTransactions->save($confirmSender) && $this->BalanceTransactions->save($confirmReceiver);
    }

    private function balanceTransactionDetails()
    {
        $tnx_id = $this->Formatter->random_alpha_numeric(10);
        $user_id = $this->checkToken();

        $balanceTransactionSender = $this->BalanceTransactions->get($this->checkSenderBalance());
        $balanceSenderDetails = $this->BalanceSenderDetails->newEntity();
        $balanceSenderDetails->set([
            'transaction' => $tnx_id,
            'user_id' => $this->request->getData('partner_user_id'),
            'sender_user_id' => $user_id,
            'sent' => $this->request->getData('paid'),
            'payable' => $balanceTransactionSender->get('payable'),
            'receivable' => $balanceTransactionSender->get('receivable'),
            'status' => true
        ]);

        $balanceTransactionReceiver = $this->BalanceTransactions->get($this->checkReceiverBalance());
        $balanceReceiverDetails = $this->BalanceReceiverDetails->newEntity();
        $balanceReceiverDetails->set([
            'transaction' => $tnx_id,
            'receiver_user_id' => $this->request->getData('partner_user_id'),
            'user_id' => $user_id,
            'received' => $this->request->getData('paid'),
            'payable' => $balanceTransactionReceiver->get('payable'),
            'receivable' => $balanceTransactionReceiver->get('receivable'),
            'status' => true
        ]);
        if ($this->ConfirmBalance()) {
            return
                $this->BalanceSenderDetails
                    ->save($balanceSenderDetails) &&
                $this->BalanceReceiverDetails
                    ->save($balanceReceiverDetails);
        } else {
            return 0;
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod('post');
        if ($this->checkReceiverBalance()) {
            if ($this->checkSenderBalance()) {

                if ($this->balanceTransactionDetails()) {
                    $this->set([
                        'message' => 'Send transactions request successful',
                        'status' => true,
                        '_serialize' => ['message', 'status']
                    ]);
                } else {
                    $this->set([
                        'message' => 'Send transactions request unsuccessful',
                        'status' => false,
                        '_serialize' => ['message', 'status']
                    ]);
                }
            } else {
                $this->set([
                    'message' => 'Invalid user account',
                    'status' => false,
                    '_serialize' => ['message', 'status']
                ]);
            }
        } else {
            $this->set([
                'message' => 'Invalid partner account',
                'status' => false,
                '_serialize' => ['message', 'status']
            ]);
        }
    }


    public function confirm()
    {

    }
}
