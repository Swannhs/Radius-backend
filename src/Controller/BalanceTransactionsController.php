<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BalanceTransactionDetails Controller
 *
 * @property \App\Model\Table\BalanceTransactionsTable $BalanceTransactions
 * @property \App\Model\Table\BalanceTransactionDetailsTable $BalanceTransactionDetails
 * @property \App\Model\Table\UsersTable $Users
 * @property \App\Model\Table\BalanceSenderDetailsTable $BalanceSenderDetails
 * @property \App\Model\Table\BalanceReceiverDetailsTable $BalanceReceiverDetails
 *
 * @method \App\Model\Entity\BalanceTransactionDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BalanceTransactionsController extends AppController
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadModel('Users');
        $this->loadModel('BalanceTransactions');
        $this->loadModel('BalanceSenderDetails');
        $this->loadModel('BalanceReceiverDetails');

        $this->loadComponent('Aa');
    }

    public function index()
    {
        $this->request->allowMethod('get');
        if ($this->checkToken()) {
            if ($this->checkToken() == 44) {
                $items = $this->BalanceSenderDetails
                    ->find()
                    ->contain(['Users', 'Realms', 'Profiles']);
                $this->set([
                    'items' => $items,
                    '_serialize' => ['items']
                ]);
            } else {
                $send_items = $this->BalanceSenderDetails
                    ->find()
                    ->where(['sender_user_id'=> $this->checkToken()])
                    ->contain(['Users', 'Realms', 'Profiles']);
                $received_items = $this->BalanceReceiverDetails
                    ->find()
                    ->where(['receiver_user_id'=>$this->checkToken()])
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

    function checkToken()
    {
        $user = $this->Aa->user_for_token($this);
        return $user['id'];
    }

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



    public function test()
    {
        $data = $this->Users->get($this->checkToken())->get('username');

        $this->set([
            'data' => $data,
            '_serialize' => 'data'
        ]);
    }

    private function balanceTransactionDetails(){
        $tnx_id = bin2hex(random_bytes(5));


        $balanceTransactionSender = $this->BalanceTransactions->get($this->checkSenderBalance());
        $balanceSenderDetails = $this->BalanceSenderDetails->newEntity();
        $balanceSenderDetails->set([
            'transaction' => $tnx_id,
            'user_id' => $this->request->getData('partner_user_id'),
            'sender_user_id' => $this->checkToken(),
            'profile_id' => $this->request->getData('profile_id'),
            'realm_id' => $this->request->getData('realm_id'),
            'sent' => $this->request->getData('paid'),
            'received' => 0,
            'payable' => $balanceTransactionSender->get('payable'),
            'receivable' => $balanceTransactionSender->get('receivable'),
            'status' => false
        ]);

        $balanceTransactionReceiver = $this->BalanceTransactions->get($this->checkReceiverBalance());
        $balanceReceiverDetails = $this->BalanceReceiverDetails->newEntity();
        $balanceReceiverDetails->set([
            'transaction' => $tnx_id,
            'receiver_user_id' => $this->request->getData('partner_user_id'),
            'user_id' => $this->checkToken(),
            'profile_id' => $this->request->getData('profile_id'),
            'realm_id' => $this->request->getData('realm_id'),
            'sent' => 0,
            'received' => $this->request->getData('paid'),
            'payable' => $balanceTransactionReceiver->get('payable'),
            'receivable' => $balanceTransactionReceiver->get('receivable'),
            'status' => false
        ]);
        return
            $this->BalanceSenderDetails
                ->save($balanceSenderDetails) &&
            $this->BalanceReceiverDetails
                ->save($balanceReceiverDetails);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->request->allowMethod('post');
        if ($this->checkReceiverBalance()){
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
            }
            else {
                $this->set([
                    'message' => 'Invalid user account',
                    'status' => false,
                    '_serialize' => ['message', 'status']
                ]);
            }
        } else{
            $this->set([
                'message' => 'Invalid partner account',
                'status' => false,
                '_serialize' => ['message', 'status']
            ]);
        }
    }


    public function confirm(){

    }
}
