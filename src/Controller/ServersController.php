<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Servers Controller
 *
 * @property \App\Model\Table\ServersTable $Servers
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\Server[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ServersController extends AppController
{
    public function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadModel('Servers');
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
        $user = $this->Users->get($this->checkToken());
        if (!$user->get('parent_id')) {
            $server = $this->Servers->find();

            $this->set([
                'server' => $server,
                'success' => true,
                '_serialize' => ['success', 'server']
            ]);
        }else{
            $this->set([
                'message' => 'Invalid user account',
                'success' => false,
                '_serialize' => ['success', 'message']
            ]);
        }
    }


    public function add()
    {
        $this->request->allowMethod('post');
        $user = $this->Users->get($this->checkToken());
        if (!$user->get('parent_id')) {
        $server = $this->Servers->newEntity();
            $server->set([
                'type'=> $this->request->getData('type'),
                'ssl_port'=> $this->request->getData('sslPort'),
                'note'=> $this->request->getData('note'),
                'name'=> $this->request->getData('name'),
                'ip'=> $this->request->getData('ip'),
                'cc'=> $this->request->getData('cc'),
                'api_server_port'=> $this->request->getData('apiServerPort'),
                'proxy_port'=> $this->request->getData('proxyPort'),
            ]);

            if ($this->Servers->save($server)) {
                $this->set([
                    'message' => 'Server generated successful',
                    'success' => true,
                    '_serialize' => ['success', 'message']
                ]);
            }else{
                $this->set([
                    'message' => 'Failed to generate server',
                    'success' => false,
                    '_serialize' => ['success', 'message']
                ]);
            }
        }else{
            $this->set([
                'message' => 'Invalid user account',
                'success' => false,
                '_serialize' => ['success', 'message']
            ]);
        }
    }

    public function view(){
        $this->request->allowMethod('get');
        $user = $this->Users->get($this->checkToken());
        if (!$user->get('parent_id')) {
            $data = $this->Servers->get($this->request->query('id'));
            $this->set([
                'data' => $data,
                'success' => true,
                '_serialize' => ['data', 'message']
            ]);
        }else{
            $this->set([
                'message' => 'Invalid user account',
                'success' => false,
                '_serialize' => ['success', 'message']
            ]);
        }
    }

    public function update()
    {
        $this->request->allowMethod('post');
        $user = $this->Users->get($this->checkToken());
        if (!$user->get('parent_id')) {
            $server = $this->request->data();
            $prepare = $this->Servers->get($server['id'], ['contain' => []]);
            $update = $this->Servers->patchEntity($prepare, $server);

            if ($this->Servers->save($update)) {
                $this->set([
                    'message' => 'Server is update successfully',
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
