<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VoucherTransactionReceivedDetails Controller
 *
 * @property \App\Model\Table\VoucherTransactionReceivedDetailsTable $VoucherTransactionReceivedDetails
 *
 * @method \App\Model\Entity\VoucherTransactionReceivedDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VoucherTransactionReceivedDetailsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Realms', 'Profiles'],
        ];
        $voucherTransactionReceivedDetails = $this->paginate($this->VoucherTransactionReceivedDetails);

        $this->set(compact('voucherTransactionReceivedDetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Voucher Transaction Received Detail id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $voucherTransactionReceivedDetail = $this->VoucherTransactionReceivedDetails->get($id, [
            'contain' => ['Users', 'Realms', 'Profiles'],
        ]);

        $this->set('voucherTransactionReceivedDetail', $voucherTransactionReceivedDetail);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $voucherTransactionReceivedDetail = $this->VoucherTransactionReceivedDetails->newEntity();
        if ($this->request->is('post')) {
            $voucherTransactionReceivedDetail = $this->VoucherTransactionReceivedDetails->patchEntity($voucherTransactionReceivedDetail, $this->request->getData());
            if ($this->VoucherTransactionReceivedDetails->save($voucherTransactionReceivedDetail)) {
                $this->Flash->success(__('The voucher transaction received detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The voucher transaction received detail could not be saved. Please, try again.'));
        }
        $receiverUsers = $this->VoucherTransactionReceivedDetails->ReceiverUsers->find('list', ['limit' => 200]);
        $users = $this->VoucherTransactionReceivedDetails->Users->find('list', ['limit' => 200]);
        $realms = $this->VoucherTransactionReceivedDetails->Realms->find('list', ['limit' => 200]);
        $profiles = $this->VoucherTransactionReceivedDetails->Profiles->find('list', ['limit' => 200]);
        $this->set(compact('voucherTransactionReceivedDetail', 'receiverUsers', 'users', 'realms', 'profiles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Voucher Transaction Received Detail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $voucherTransactionReceivedDetail = $this->VoucherTransactionReceivedDetails->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $voucherTransactionReceivedDetail = $this->VoucherTransactionReceivedDetails->patchEntity($voucherTransactionReceivedDetail, $this->request->getData());
            if ($this->VoucherTransactionReceivedDetails->save($voucherTransactionReceivedDetail)) {
                $this->Flash->success(__('The voucher transaction received detail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The voucher transaction received detail could not be saved. Please, try again.'));
        }
        $receiverUsers = $this->VoucherTransactionReceivedDetails->ReceiverUsers->find('list', ['limit' => 200]);
        $users = $this->VoucherTransactionReceivedDetails->Users->find('list', ['limit' => 200]);
        $realms = $this->VoucherTransactionReceivedDetails->Realms->find('list', ['limit' => 200]);
        $profiles = $this->VoucherTransactionReceivedDetails->Profiles->find('list', ['limit' => 200]);
        $this->set(compact('voucherTransactionReceivedDetail', 'receiverUsers', 'users', 'realms', 'profiles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Voucher Transaction Received Detail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $voucherTransactionReceivedDetail = $this->VoucherTransactionReceivedDetails->get($id);
        if ($this->VoucherTransactionReceivedDetails->delete($voucherTransactionReceivedDetail)) {
            $this->Flash->success(__('The voucher transaction received detail has been deleted.'));
        } else {
            $this->Flash->error(__('The voucher transaction received detail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
