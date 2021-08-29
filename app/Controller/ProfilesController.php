<?php
App::uses('AppController', 'Controller');
class ProfilesController extends AppController{

	public $uses = array('User','Role','Testing');
	
	public function index(){
		//$this->User->find('all');
		$this->User->id = $this->Auth->user('id'); // target correct record
		//$users = $this->Auth->user('username');
		$users = $this->User->find('all');
		$this->set(compact('users'));
		//$this->set('user',$this->User->find('all'));
		//$userss = $this->User->find('first', array(
        //'conditions' => array('User.username' =>'users')));
        //echo $userss;
        //$user = $this->User->query("SELECT * FROM users WHERE username = 'admin'");
        //$this->set(compact('user'));
        //$users = $this->User->find('first', array('conditions' => ' SELECT * FROM users WHERE username = "admin"'));
        //$this->set('users', $this->User->find('users'));
        //$this->set(compact('users'));

        //$user = $this->User->find('first',
        	//array('conditions' => array('User.username' => $this->Auth->user('username'))));
        //$this->set(compact('user'));

	}

	public function edit($id = null){

		if (!$id) {
				$this->Session->setFlash('Please provide a user id');
				$this->redirect(array('action'=>'index'));
			}

			$user = $this->User->findById($id);
			if (!$user) {
				$this->Session->setFlash('Invalid User ID Provided');
				$this->redirect(array('action'=>'index'));
			}

			if ($this->request->is('post') || $this->request->is('put')) {
				$this->User->id = $id;
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been updated'));
					$this->redirect(array('controller'=> 'testings','action' => 'dashboard'));
				}
				else
				{
					$this->Session->setFlash(__('Unable to update your user.'));
				}
			}

			if (!$this->request->data) {
				$this->request->data = $user;
			}

			/*$roles = $this->User->Role->find('list',array('conditions'=>array('status'=>'active')));
		$this->set(compact('roles'));*/

	}
}

?>