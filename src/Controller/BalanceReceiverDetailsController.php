<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BalanceReceiverDetails Controller
 *
 * @property \App\Model\Table\BalanceReceiverDetailsTable $BalanceReceiverDetails
 *
 * @method \App\Model\Entity\BalanceReceiverDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BalanceReceiverDetailsController extends AppController
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
        $balanceReceiverDetails = $this->paginate($this->BalanceReceiverDetails);

        $this->set(compact('balanceReceiverDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Balance Receiver Detail id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $balanceReceiverDetail = $this->BalanceReceiverDetails->get($id, [
            'contain' => ['SenderUsers', 'Users', 'Realms', 'Profiles'],
        ]);

        $this->set('balanceReceiverDetail', $balanceReceiverDetail);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $balanceReceiverDetail = $this->BalanceReceiverDetails->newEntity();
        if ($this->request->is('post')) {
            $balanceReceiverDetail = $this->BalanceReceiverDetails->patchEntity($balanceReceiverDetail, $this->request->getData());
            if ($this->BalanceReceiverDetails->save($balanceReceiverDetail)) {
                $this->Flash->success(__('The balance receiver detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The balance receiver detail could not be saved. Please, try again.'));
        }
        $senderUsers = $this->BalanceReceiverDetails->SenderUsers->find('list', ['limit' => 200]);
        $users = $this->BalanceReceiverDetails->Users->find('list', ['limit' => 200]);
        $realms = $this->BalanceReceiverDetails->Realms->find('list', ['limit' => 200]);
        $profiles = $this->BalanceReceiverDetails->Profiles->find('list', ['limit' => 200]);
        $this->set(compact('balanceReceiverDetail', 'senderUsers', 'users', 'realms', 'profiles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Balance Receiver Detail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $balanceReceiverDetail = $this->BalanceReceiverDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $balanceReceiverDetail = $this->BalanceReceiverDetails->patchEntity($balanceReceiverDetail, $this->request->getData());
            if ($this->BalanceReceiverDetails->save($balanceReceiverDetail)) {
                $this->Flash->success(__('The balance receiver detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The balance receiver detail could not be saved. Please, try again.'));
        }
        $senderUsers = $this->BalanceReceiverDetails->SenderUsers->find('list', ['limit' => 200]);
        $users = $this->BalanceReceiverDetails->Users->find('list', ['limit' => 200]);
        $realms = $this->BalanceReceiverDetails->Realms->find('list', ['limit' => 200]);
        $profiles = $this->BalanceReceiverDetails->Profiles->find('list', ['limit' => 200]);
        $this->set(compact('balanceReceiverDetail', 'senderUsers', 'users', 'realms', 'profiles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Balance Receiver Detail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $balanceReceiverDetail = $this->BalanceReceiverDetails->get($id);
        if ($this->BalanceReceiverDetails->delete($balanceReceiverDetail)) {
            $this->Flash->success(__('The balance receiver detail has been deleted.'));
        } else {
            $this->Flash->error(__('The balance receiver detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
