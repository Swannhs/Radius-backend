<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * BalanceSenderDetails Controller
 *
 * @property \App\Model\Table\BalanceSenderDetailsTable $BalanceSenderDetails
 *
 * @method \App\Model\Entity\BalanceSenderDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BalanceSenderDetailsController extends AppController
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
        $balanceSenderDetails = $this->paginate($this->BalanceSenderDetails);

        $this->set(compact('balanceSenderDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Balance Sender Detail id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $balanceSenderDetail = $this->BalanceSenderDetails->get($id, [
            'contain' => ['SenderUsers', 'Users', 'Realms', 'Profiles'],
        ]);

        $this->set('balanceSenderDetail', $balanceSenderDetail);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $balanceSenderDetail = $this->BalanceSenderDetails->newEntity();
        if ($this->request->is('post')) {
            $balanceSenderDetail = $this->BalanceSenderDetails->patchEntity($balanceSenderDetail, $this->request->getData());
            if ($this->BalanceSenderDetails->save($balanceSenderDetail)) {
                $this->Flash->success(__('The balance sender detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The balance sender detail could not be saved. Please, try again.'));
        }
        $senderUsers = $this->BalanceSenderDetails->SenderUsers->find('list', ['limit' => 200]);
        $users = $this->BalanceSenderDetails->Users->find('list', ['limit' => 200]);
        $realms = $this->BalanceSenderDetails->Realms->find('list', ['limit' => 200]);
        $profiles = $this->BalanceSenderDetails->Profiles->find('list', ['limit' => 200]);
        $this->set(compact('balanceSenderDetail', 'senderUsers', 'users', 'realms', 'profiles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Balance Sender Detail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $balanceSenderDetail = $this->BalanceSenderDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $balanceSenderDetail = $this->BalanceSenderDetails->patchEntity($balanceSenderDetail, $this->request->getData());
            if ($this->BalanceSenderDetails->save($balanceSenderDetail)) {
                $this->Flash->success(__('The balance sender detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The balance sender detail could not be saved. Please, try again.'));
        }
        $senderUsers = $this->BalanceSenderDetails->SenderUsers->find('list', ['limit' => 200]);
        $users = $this->BalanceSenderDetails->Users->find('list', ['limit' => 200]);
        $realms = $this->BalanceSenderDetails->Realms->find('list', ['limit' => 200]);
        $profiles = $this->BalanceSenderDetails->Profiles->find('list', ['limit' => 200]);
        $this->set(compact('balanceSenderDetail', 'senderUsers', 'users', 'realms', 'profiles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Balance Sender Detail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $balanceSenderDetail = $this->BalanceSenderDetails->get($id);
        if ($this->BalanceSenderDetails->delete($balanceSenderDetail)) {
            $this->Flash->success(__('The balance sender detail has been deleted.'));
        } else {
            $this->Flash->error(__('The balance sender detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
