<?php
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');

class ClientsController extends AppController{
	public function dashboard(){
		$this->loadModel('Client');
		$this->loadModel('User');
		$this->loadModel('ClientsUser');
		$this->loadModel('DevicesData');

		$dir = new Folder('/webroot');


		$req = $this->Clients->find('all');
		$this->set('noman',$req);
	}
}

?>