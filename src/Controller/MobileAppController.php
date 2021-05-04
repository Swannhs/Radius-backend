<?php
namespace App\Controller;

use App\Controller\AppController;

class MobileAppController extends AppController{
    public function home(){
        $this->request->allowMethod('post');
        $this->set([
            'message' => $this->request->data('id'),
            '_serialize' => 'message'
        ]);
    }
}
