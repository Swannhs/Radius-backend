<?php
namespace App\Shell\Task;

use Cake\Console\Shell;
use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;

class AutoCleanTask extends Shell {

    public function initialize(){
        parent::initialize();
        $this->loadModel('Radaccts');
    }
  
    public function clean() {
        $this->_show_header();
        $this->_clean();     
    }

    private function _show_header(){
        $this->out('<comment>=======================================</comment>');
        $this->out('<comment>--Invalid Accounting Session Checking--</comment>');
        $this->out('<comment>------------RADIUSdesk 2021------------</comment>');
        $this->out('<comment>_______________________________________</comment>');
    }
    
    private function _clean(){

        $this->out("<info>AutoClean::Delete accounting sessions where framedipaddress is NULL or empty</info>");

        $conn = ConnectionManager::get('default');
                
        $conn->execute("DELETE from radacct where framedipaddress='' OR framedipaddress is NULL");
     
    }
}

?>
