<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BalanceTransactionDetails Controller
 *
 * @property \App\Model\Table\BalanceTransactionDetailsTable $BalanceTransactionDetails
 *
 * @method \App\Model\Entity\BalanceTransactionDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BalanceTransactionDetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['SenderUsers', 'Users', 'Realms', 'Profiles'],
        ];
        $balanceTransactionDetails = $this->paginate($this->BalanceTransactionDetails);

        $this->set(compact('balanceTransactionDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Balance Transaction Detail id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $balanceTransactionDetail = $this->BalanceTransactionDetails->get($id, [
            'contain' => ['SenderUsers', 'Users', 'Realms', 'Profiles'],
        ]);

        $this->set('balanceTransactionDetail', $balanceTransactionDetail);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $balanceTransactionDetail = $this->BalanceTransactionDetails->newEntity();
        if ($this->request->is('post')) {
            $balanceTransactionDetail = $this->BalanceTransactionDetails->patchEntity($balanceTransactionDetail, $this->request->getData());
            if ($this->BalanceTransactionDetails->save($balanceTransactionDetail)) {
                $this->Flash->success(__('The balance transaction detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The balance transaction detail could not be saved. Please, try again.'));
        }
        $senderUsers = $this->BalanceTransactionDetails->SenderUsers->find('list', ['limit' => 200]);
        $users = $this->BalanceTransactionDetails->Users->find('list', ['limit' => 200]);
        $realms = $this->BalanceTransactionDetails->Realms->find('list', ['limit' => 200]);
        $profiles = $this->BalanceTransactionDetails->Profiles->find('list', ['limit' => 200]);
        $this->set(compact('balanceTransactionDetail', 'senderUsers', 'users', 'realms', 'profiles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Balance Transaction Detail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $balanceTransactionDetail = $this->BalanceTransactionDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $balanceTransactionDetail = $this->BalanceTransactionDetails->patchEntity($balanceTransactionDetail, $this->request->getData());
            if ($this->BalanceTransactionDetails->save($balanceTransactionDetail)) {
                $this->Flash->success(__('The balance transaction detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The balance transaction detail could not be saved. Please, try again.'));
        }
        $senderUsers = $this->BalanceTransactionDetails->SenderUsers->find('list', ['limit' => 200]);
        $users = $this->BalanceTransactionDetails->Users->find('list', ['limit' => 200]);
        $realms = $this->BalanceTransactionDetails->Realms->find('list', ['limit' => 200]);
        $profiles = $this->BalanceTransactionDetails->Profiles->find('list', ['limit' => 200]);
        $this->set(compact('balanceTransactionDetail', 'senderUsers', 'users', 'realms', 'profiles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Balance Transaction Detail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $balanceTransactionDetail = $this->BalanceTransactionDetails->get($id);
        if ($this->BalanceTransactionDetails->delete($balanceTransactionDetail)) {
            $this->Flash->success(__('The balance transaction detail has been deleted.'));
        } else {
            $this->Flash->error(__('The balance transaction detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
