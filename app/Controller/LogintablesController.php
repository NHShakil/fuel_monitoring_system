<?php
App::uses('AppController', 'Controller');

class LogintablesController extends AppController {
    
     public $uses = array('LoginTable');
    	public function index() {
            $this->paginate = array(
                'limit' => 25,
                'order' => array('LoginTable.username' => 'asc' )
            );
            $users = $this->paginate('LoginTable');
            $this->set(compact('users'));
        }
    
    
        public function delete(){
            if ($this->request->is('post')) {
                $this->LoginTable->deleteAll(
                    array(
                        'LoginTable.login_status'   => 'Inactive'
                    ), 
                    false
                ); 
    
                $count = $this->LoginTable->find('count', 
                    array('conditions' => 
                        array(
                            'LoginTable.username' => $this->Auth->user('username'),
                            'LoginTable.login_status'   => 'Active',
                        )
                    )
                );
    
                if($count == 1){
                    $this->LoginTable->updateAll(
                        array(
                            'LoginTable.login_count'            => $count
                        ),                    
                        array(
                            'LoginTable.username' => $this->Auth->user('username')
                        )
                    );
                }  
                $this->redirect(array('action' => 'index'));
            }           
        }

    }

?>