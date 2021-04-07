<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ServerRealms Controller
 *
 * @property \App\Model\Table\ServerRealmsTable $ServerRealms
 *
 * @method \App\Model\Entity\ServerRealm[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ServerRealmsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Servers', 'Realms'],
        ];
        $serverRealms = $this->paginate($this->ServerRealms);

        $this->set(compact('serverRealms'));
    }

    /**
     * View method
     *
     * @param string|null $id Server Realm id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $serverRealm = $this->ServerRealms->get($id, [
            'contain' => ['Servers', 'Realms'],
        ]);

        $this->set('serverRealm', $serverRealm);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $serverRealm = $this->ServerRealms->newEntity();
        if ($this->request->is('post')) {
            $serverRealm = $this->ServerRealms->patchEntity($serverRealm, $this->request->getData());
            if ($this->ServerRealms->save($serverRealm)) {
                $this->Flash->success(__('The server realm has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The server realm could not be saved. Please, try again.'));
        }
        $servers = $this->ServerRealms->Servers->find('list', ['limit' => 200]);
        $realms = $this->ServerRealms->Realms->find('list', ['limit' => 200]);
        $this->set(compact('serverRealm', 'servers', 'realms'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Server Realm id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $serverRealm = $this->ServerRealms->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $serverRealm = $this->ServerRealms->patchEntity($serverRealm, $this->request->getData());
            if ($this->ServerRealms->save($serverRealm)) {
                $this->Flash->success(__('The server realm has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The server realm could not be saved. Please, try again.'));
        }
        $servers = $this->ServerRealms->Servers->find('list', ['limit' => 200]);
        $realms = $this->ServerRealms->Realms->find('list', ['limit' => 200]);
        $this->set(compact('serverRealm', 'servers', 'realms'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Server Realm id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $serverRealm = $this->ServerRealms->get($id);
        if ($this->ServerRealms->delete($serverRealm)) {
            $this->Flash->success(__('The server realm has been deleted.'));
        } else {
            $this->Flash->error(__('The server realm could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
