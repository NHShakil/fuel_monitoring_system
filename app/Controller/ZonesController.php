<?php
App::uses('AppController', 'Controller');

class ZonesController extends AppController {


	public $components = array('Paginator', 'Session');


	public function index() {

		$this->paginate = array(
			'order' => array('Zone.name' => 'asc' ),
			'limit' => 10
		);
		$this->Zone->recursive = 0;
		$bts_name = $this->paginate('Zone');
		$this->set('zones', $bts_name);
	}

	public function view($id = null) {
		if (!$this->Zone->exists($id)) {
			throw new NotFoundException(__('Invalid zone'));
		}
		$options = array('conditions' => array('Zone.' . $this->Zone->primaryKey => $id));
		$this->set('zone', $this->Zone->find('first', $options));
	}


	public function search_zone(){
		if($this->request->is('post')){
			$data = $this->request->data;
			$this->paginate = array(
				'conditions'	=> array(
					'Zone.status' => 'active',
					'OR' => array(
						'Zone.name like' => "%".$data['Zone']['keywords']."%",
					)
				),
			);

			$this->set('zones', $this->Paginator->paginate());

			$this->render('index');
			}
			else
			{
				$this->redirect('index');
			}
	}


	public function add() {
		if ($this->request->is('post')) {
			$this->Zone->create();
			if ($this->Zone->save($this->request->data)) {
				$this->Session->setFlash('The zone has been saved.');
				return $this->redirect(array('controller'=>'zones','action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash('The zone could not be saved. Please, try again.');
			}
		}
		$parentZones = $this->Zone->find('list');
		//$statuss = $this->Zone->find('list');
		//$this->set(compact('parentZones','statuss'));
		$this->set(compact('parentZones'));
	}


	public function edit($id = null) {
		if (!$this->Zone->exists($id)) {
			throw new NotFoundException(__('Invalid zone'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Zone->save($this->request->data)) {
				$this->Session->setFlash('The zone has been edited.');
				return $this->redirect(array('controller'=>'zones','action' => 'index'));
			} else {
				$this->Session->setFlash('The zone could not be edited. Please, try again.');
			}
		} else {
			$options = array('conditions' => array('Zone.' . $this->Zone->primaryKey => $id));
			$this->request->data = $this->Zone->find('first', $options);
		}
		$parentZones = $this->Zone->ParentZone->find('list');
		$this->set(compact('parentZones'));
	}


	public function delete($id = null) {
		$this->Zone->id = $id;
		if (!$this->Zone->exists()) {
			throw new NotFoundException(__('Invalid zone'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Zone->delete()) {
			$this->Session->setFlash('The zone has been deleted.');
		} else {
			$this->Session->setFlash('The zone could not be deleted. Please, try again.');
		}
		return $this->redirect(array('controller'=>'zones','action' => 'index'));
	}
}
