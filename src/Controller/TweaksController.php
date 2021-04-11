<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Tweaks Controller
 *
 * @property \App\Model\Table\TweaksTable $Tweaks
 *
 * @method \App\Model\Entity\Tweak[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TweaksController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Tweaks');
        $this->loadModel('TweakRealms');
        $this->loadModel('Users');
        $this->loadComponent('Aa');
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
        if ($this->checkToken() == 44) {
            $tweaks = $this->Tweaks->find();

            $this->set([
                'tweaks' => $tweaks,
                'status' => true,
                '_serialize' => ['status', 'tweaks']
            ]);
        } else {
            $this->set([
                'message' => 'Invalid user account',
                'status' => false,
                '_serialize' => ['status', 'message']
            ]);
        }
    }


    public function add()
    {
        $this->request->allowMethod('post');
        if ($this->checkToken()) {
            $tweak = $this->Tweaks->newEntity();
            $tweak->set([
                'vendor' => $this->request->getData('vendor'),
                'name' => $this->request->getData('name'),
                'protocols' => $this->request->getData('protocol'),
                'injection_type' => $this->request->getData('injectionType'),
                'payload' => $this->request->getData('payload'),
                'note' => $this->request->getData('note')
            ]);

            if ($this->Tweaks->save($tweak)) {
                $this->set([
                    'message' => 'Tweak generated successful',
                    'status' => true,
                    '_serialize' => ['status', 'message']
                ]);
            } else {
                $this->set([
                    'message' => 'Invalid user account',
                    'status' => false,
                    '_serialize' => ['status', 'message']
                ]);
            }
        }
    }
}
