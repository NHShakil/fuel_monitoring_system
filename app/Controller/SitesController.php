<?php
App::uses('AppController', 'Controller');

class SitesController extends AppController {
	
	public $uses = array('Site','Zone','Testing','AlarmIdentifier');

	public $components = array('Paginator', 'Session');
	
	public $helpers = array('Html','Form','ZoneTree');


	public function index($zoneId = null) {
		$this->Site->recursive = 0;
		if($zoneId != null){
			$this->paginate = array(
				'conditions' => array(
					'Site.zone_id' => $zoneId		
				)
			);
		}
		$this->set('sites', $this->Paginator->paginate());
		$this->set('zones',$this->Zone->find('list'));
		
		$treeData = $this->Zone->find(
			'threaded',
			array(
				'contain' => false,
			)					
		);
		$this->set(compact('treeData'));
	}

	public function search_bts(){
		if($this->request->is('post')){
			$data = $this->request->data;
			$this->paginate = array(
				'conditions'	=> array(
					'Site.status' => 'active',
					'OR' => array(
						'Site.site_name like' 		=> "%".$data['Site']['keywords']."%",
						'Site.SiteModuleId like'    => "%".$data['Site']['keywords']."%",
					)
				),
			);

			$this->set('sites', $this->Paginator->paginate());
		
			$this->set('zones',$this->Zone->find('list'));
			$treeData = $this->Zone->find(
				'threaded',
				array(
					'contain' => false,
				)					
			);
			$this->set(compact('treeData'));			
			$this->render('index');
		}
		else
		{
			$this->Session->setFlash('The site could not be Found');
			$this->redirect('index');
		}
	}

	public function onSlectQuery($id){
		$this->layout = false;
		
		$hasValue = $this->Site->find('all',
			array(
				'conditions' => array(
					'Site.zone_id' => $id
				)
			)
		);
		//return json_encode($hasValue);
		//pr($hasValue);
		print_r(json_encode($hasValue));	
	}

	public function add() {
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Site->create();
			$this->Testing->create();
			$this->AlarmIdentifier->create();
			if($this->Site->save($this->request->data) && $this->Testing->save($this->request->data) && $this->AlarmIdentifier->save($this->request->data)){
				$this->Session->setFlash('The Site has been saved.');
				return $this->redirect(array('controller'=>'sites','action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash('The site ID already exist. Please, try another.');
			}
		}
		$this->set('zones',$this->Zone->find('list'));
	}

	public function edit($id = null) {
		if (!$this->Site->exists($id)) {
	        throw new NotFoundException(__('Invalid Site ID'));
	    }
	    /////////// Site ////////
		$site_details 		  = $this->Site->find('first',
			array (
				'conditions'  => array(
					'Site.id' => $id
				)
			)
		);
		$site_name    		  = $site_details['Site']['site_name'];


		/////////// Testing ////////
		$testing_details 	  = $this->Testing->find('first',
			array (
				'conditions'  => array(
					'Testing.site_name' => $site_name
				)
			)
		);
		$testing_site_id   	  = $testing_details['Testing']['id']; 


		/////////// Alarm Identifier ////////
		$alarm_identifier_details 	  = $this->AlarmIdentifier->find('first',
			array (
				'conditions'  => array(
					'AlarmIdentifier.site_name' => $site_name
				)
			)
		);
		$alarm_identifier_site_id = $alarm_identifier_details['AlarmIdentifier']['id'];

		

	    $this->Site->id 	 		 = $id;
	    $this->Testing->id 	 		 = $testing_site_id;
	    $this->AlarmIdentifier->id   = $alarm_identifier_site_id;

	    if ($this->request->is('post') || $this->request->is('put')) {
	        if ($this->Site->save($this->request->data)) {
				$data 		   	= $this->request->data;
				//pr($data);
		    	$zone_id 	   	= $data['Site']['id'];
		    	$SiteModuleId  	= $data['Site']['SiteModuleId'];
		    	$site_name     	= $data['Site']['site_name'];
		    	$site_category 	= $data['Site']['site_category'];
				$status        	= $data['Site']['status'];
				$used_frequency	= $data['Site']['used_frequency'];

		    	$this->Testing->saveField('status',        $status);
				$this->Testing->saveField('zone_id',       $zone_id);
		    	$this->Testing->saveField('site_name',     $site_name);
		    	$this->Testing->saveField('SiteModuleId',  $SiteModuleId);
				$this->Testing->saveField('site_category', $site_category);
		    	$this->Testing->saveField('used_frequency',$used_frequency);
		    	
		    	$this->AlarmIdentifier->saveField('zone_id',      $zone_id);
		    	$this->AlarmIdentifier->saveField('site_name',    $site_name);
		    	$this->AlarmIdentifier->saveField('SiteModuleId', $SiteModuleId);
		    	$this->AlarmIdentifier->saveField('site_category', $site_category);
		    	

	            $this->Session->setFlash(__('Site info has been updated'));
	            $this->redirect(array('controller'=>'sites','action' => 'index'));
	        } 
	        else
	        {
	            $this->Session->setFlash(__('The Site info could not be saved. Please, try again.'));
	        }
	    } 
	    else 
	    {
	        $siteinfo       = $this->Site->find('first', array('conditions'=>array('id'=>$id) ,'recursive' => -1));
	        $testingsinfo   = $this->Testing->find('first', array('conditions'=>array('id'=>$testing_site_id) ,'recursive' => -1));
	        $alarminfo      = $this->AlarmIdentifier->find('first', array('conditions'=>array('id'=>$alarm_identifier_site_id) ,'recursive' => -1));
	        $this->request->data['Site'] 				= $siteinfo['Site'];
	        $this->request->data['Testing'] 			= $testingsinfo['Testing'];
	        $this->request->data['AlarmIdentifier'] 	= $alarminfo['AlarmIdentifier'];
	    }
	    $this->set('zoness',$this->Zone->find('list'));
	}

	public function view($id = null) {
		if (!$this->Site->exists($id)) {
			throw new NotFoundException(__('Invalid card reader'));
		}
		$options = array('conditions' => array('Site.' . $this->Site->primaryKey => $id));
		$this->set('Bt', $this->Site->find('first', $options));
	}

	public function delete($id = null) {
		$this->Site->id = $id;
		if (!$this->Site->exists()) {
			throw new NotFoundException(__('Invalid Site Id'));
		}
		$site_details 	    = $this->Site->find('first',array ('conditions' => array('Site.id' => $id)));
		$site_name    	    = $site_details['Site']['site_name'];

		$testings_details   = $this->Testing->find('first',array ('conditions' => array('Testing.site_name' => $site_name)));
		$testing_id    	    = $testings_details['Testing']['id'];

		$alarm_details      = $this->AlarmIdentifier->find('first',array ('conditions' => array('AlarmIdentifier.site_name' => $site_name)));
		$energy_id    	    = $alarm_details['AlarmIdentifier']['id'];

		$this->Testing->id 			   = $testing_id;
		$this->AlarmIdentifier->id     = $alarm_details;

		$this->request->allowMethod('post', 'delete');
		if ($this->Site->delete() && $this->Testing->delete() && $this->AlarmIdentifier->delete()){
			$this->Session->setFlash("Site has been deleted.");
			return $this->redirect(array('controller'=>'sites', 'action' => 'index'));
		} else {
			$this->Session->setFlash('The site could not be deleted. Please, try again.');
		}
		return $this->redirect(array('controller'=>'sites','action' => 'index'));
	}

	public function sitesbyzone($zoneId){	
		$this->render('index');
	}

	public function response(){
		# code...
	}
}
