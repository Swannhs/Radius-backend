<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * TweakRealms Controller
 *
 * @property \App\Model\Table\TweakRealmsTable $TweakRealms
 *
 * @method \App\Model\Entity\TweakRealm[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TweakRealmsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Tweaks', 'Realms'],
        ];
        $tweakRealms = $this->paginate($this->TweakRealms);

        $this->set(compact('tweakRealms'));
    }

    /**
     * View method
     *
     * @param string|null $id Tweak Realm id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tweakRealm = $this->TweakRealms->get($id, [
            'contain' => ['Tweaks', 'Realms'],
        ]);

        $this->set('tweakRealm', $tweakRealm);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tweakRealm = $this->TweakRealms->newEntity();
        if ($this->request->is('post')) {
            $tweakRealm = $this->TweakRealms->patchEntity($tweakRealm, $this->request->getData());
            if ($this->TweakRealms->save($tweakRealm)) {
                $this->Flash->success(__('The tweak realm has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tweak realm could not be saved. Please, try again.'));
        }
        $tweaks = $this->TweakRealms->Tweaks->find('list', ['limit' => 200]);
        $realms = $this->TweakRealms->Realms->find('list', ['limit' => 200]);
        $this->set(compact('tweakRealm', 'tweaks', 'realms'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tweak Realm id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tweakRealm = $this->TweakRealms->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tweakRealm = $this->TweakRealms->patchEntity($tweakRealm, $this->request->getData());
            if ($this->TweakRealms->save($tweakRealm)) {
                $this->Flash->success(__('The tweak realm has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tweak realm could not be saved. Please, try again.'));
        }
        $tweaks = $this->TweakRealms->Tweaks->find('list', ['limit' => 200]);
        $realms = $this->TweakRealms->Realms->find('list', ['limit' => 200]);
        $this->set(compact('tweakRealm', 'tweaks', 'realms'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tweak Realm id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tweakRealm = $this->TweakRealms->get($id);
        if ($this->TweakRealms->delete($tweakRealm)) {
            $this->Flash->success(__('The tweak realm has been deleted.'));
        } else {
            $this->Flash->error(__('The tweak realm could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
