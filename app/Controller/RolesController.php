<?php
App::uses('AppController', 'Controller');

class RolesController extends AppController {


	public $components = array('Paginator', 'Session');


	public function index() {
		$this->Role->recursive = 0;
		$this->set('roles', $this->Paginator->paginate());
	}


	public function view($id = null) {
		if (!$this->Role->exists($id)) {
			throw new NotFoundException(__('Invalid role'));
		}
		$options = array('conditions' => array('Role.' . $this->Role->primaryKey => $id));
		$this->set('role', $this->Role->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$data = $this->request->data;
			$permissions = json_encode($data['permission']);
			$data['Role']['accesslist'] = $permissions;  //json_encode($data['permission']);
			unset($data['permission']);
			$this->Role->create();
			if ($this->Role->save($data)) {
				$this->Session->setFlash('The role has been saved.');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The role could not be saved. Please, try again.');
			}
		}
	}

	public function edit($id = null) {
		if (!$this->Role->exists($id)) {
			throw new NotFoundException(__('Invalid role'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$data = $this->request->data;
			$permissions = json_encode($data['permission']);
			$data['Role']['accesslist'] = $permissions;
			
			unset($data['permission']);
			if ($this->Role->save($data)) {
				$this->Session->setFlash('The role has been saved.');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The role could not be saved. Please, try again.');
			}
		} 
		else
		{
			$options = array('conditions' => array('Role.' . $this->Role->primaryKey => $id),'recursive'=> -1);
			$data = $this->Role->find('first', $options);
			$data['Role']['accesslist'] = json_decode($data['Role']['accesslist'],true);
			
			$this->request->data = $data;
		}
	}

	public function delete($id = null) {
		$this->Role->id = $id;
		if (!$this->Role->exists()) {
			throw new NotFoundException(__('Invalid role'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Role->delete()) {
			$this->Session->setFlash('The role has been deleted.');
		} else {
			$this->Session->setFlash('The role could not be deleted. Please, try again.');
		}
		return $this->redirect(array('action' => 'index'));
	}
}
