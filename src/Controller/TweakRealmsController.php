<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * TweakRealms Controller
 *
 * @property \App\Model\Table\TweakRealmsTable $TweakRealms
 * @property \App\Model\Table\TweaksTable $Tweaks
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\TweakRealm[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TweakRealmsController extends AppController
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadModel('Tweaks');
        $this->loadModel('Users');
        $this->loadModel('TweakRealms');

        $this->loadComponent('Aa');
        $this->loadComponent('Formatter');
    }


    function checkToken()
    {
        $user = $this->Aa->user_for_token($this);
        return $user['id'];
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->request->allowMethod('get');
        if ($this->Aa->admin_check($this)) {
            $tweakRealms = $this->TweakRealms->find()
                ->contain(['Tweaks', 'Realms']);

            $total = $tweakRealms->count();

            $item = $this->Formatter->pagination($tweakRealms);

            $this->set([
                'tweakRealms' => $item,
                'totalCount' => $total,
                'success' => true,
                '_serialize' => ['tweakRealms', 'success', 'totalCount']
            ]);
        } else {
            $this->set([
                'message' => 'Invalid account',
                'success' => false,
                '_serialize' => ['success', 'message']
            ]);
        }
    }

    public function tweaks()
    {
        $tweaks = $this->Tweaks->find();

        $this->set([
            'tweaks' => $tweaks,
            '_serialize' => ['tweaks']
        ]);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $this->request->allowMethod('post');

        if ($this->Aa->admin_check($this)) {
            $serverRealm = $this->TweakRealms->newEntity();

            $serverRealm->set([
                'tweak_id' => $this->request->getData('tweak'),
                'realm_id' => $this->request->getData('realm')
            ]);

            if ($this->TweakRealms->save($serverRealm)) {
                $this->set([
                    'message' => 'Generated successful',
                    'success' => true,
                    '_serialize' => ['success', 'message']
                ]);
            } else {
                $this->set([
                    'message' => 'failed to generate',
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

    public function delete()
    {
        $this->request->allowMethod('post');
        if ($this->Aa->admin_check($this)) {
            $delete = $this->TweakRealms->get($this->request->data('id'));

            if ($this->TweakRealms->delete($delete)) {
                $this->set([
                    'message' => 'Tweak Realms is removed successfully',
                    'success' => true,
                    '_serialize' => ['success', 'message']
                ]);
            } else {
                $this->set([
                    'message' => 'Something is went wrong with database',
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
