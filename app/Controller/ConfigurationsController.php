<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');

class ConfigurationsController extends AppController {
	public $uses = array('BaseStation','CardReader','CardManagement','Card','Zonee','Testing','Site','DeviceCard','ZoneCard','LiveStatus','TestingLogDevice','DoorStatus');
	public $components = array('Paginator', 'Session','Zonetree');
	var $helpers = array('Html', 'Form','Csv');

	public function index(){
		$this->paginate = array(
			'order' => array('Testing.site_name' => 'ASC' ),
			'limit' => 20
		);
		$this->Testing->recursive = 0;
		$device_ip 		= $this->paginate('Testing');
		//pr($device_ip);
		$this->set(compact('device_ip'));
	}

	public function device_configuration($id){
		$readerData = $this->Testing->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$id)));
		$this->set(compact('readerData'));
	}

	public function card_management($id){
		$readerData = $this->Testing->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$id)));
		$this->set(compact('readerData'));
	}

	public function door_alarm($id=null){	
		if(!$this->Site->exists($id)){
			throw new NotFoundException(__("Invalid Site Id"));
		}
		$siteData 	= $this->Site->find('first',
			array(
				'recursive'=>-1, 
				'conditions'=>array(
					'Site.id'=>$id
				)
			)
		);
		$SiteModuleIdVal 	 = $siteData['Site']['SiteModuleId'];

		$readerDataa = $this->DoorStatus->find('all',array('recursive'=>-1, 'conditions'=>array('DoorStatus.SiteModuleId'=>$SiteModuleIdVal)));
		$this->set(compact('readerDataa'));
	}

	public function site_attendence_time($id){
		$readerData = $this->Testing->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$id)));
		if($this->request->is('post') AND $this->request->is('post')) {
			$this->set(compact('readerData'));
		}
		$this->set(compact('readerData'));
	}

	public function function_details($id=null, $conditional_value=null){
		$readerData = $this->Testing->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$id)));
		if($conditional_value==1){
			$options = array(
			    'conditions' => array(
			        'DoorStatus.SiteModuleId' => $readerData['Testing']['SiteModuleId']
			    ),

			    'fields'	=> array(
			    	'site_name','SiteModuleId','user_os_name','user_pc_name','user_pc_ip','user_browser_name','door_open_user','door_open_by','door_open_time','door_open_date'
			    ),
			    
			    'order' 	=> array(
			        'DoorStatus.id' => 'DESC'
			    ),

			    'limit' 	=> 100
			);

			$this->Paginator->settings = $options;
			$TestingLogDeviceReaderData = $this->Paginator->paginate('DoorStatus');
			$this->set(compact('TestingLogDeviceReaderData','conditional_value'));
		}
		elseif($conditional_value==2){
			$options = array(
			    'conditions' => array(
			        'TestingLogDevice.SiteModuleId' => $readerData['Testing']['SiteModuleId']
			    ),

			    'fields'	=> array(
			    	'SiteModuleId','card_reader','modified'
			    ),
			    
			    'order' 	=> array(
			        'TestingLogDevice.id' => 'DESC'
			    ),

			    'limit' 	=> 100
			);

			$this->Paginator->settings = $options;
			$TestingLogDeviceReaderData = $this->Paginator->paginate('TestingLogDevice');
			$this->set(compact('TestingLogDeviceReaderData','conditional_value'));
		}
		elseif($conditional_value==3){
			$options = array(
			    'conditions' => array(
			        'TestingLogDevice.SiteModuleId' => $readerData['Testing']['SiteModuleId']
			    ),

			    'fields'	=> array(
			    	'SiteModuleId','alarm_1','modified'
			    ),
			    
			    'order' 	=> array(
			        'TestingLogDevice.id' => 'DESC'
			    ),

			    'limit' 	=> 100
			);

			$this->Paginator->settings = $options;
			$TestingLogDeviceReaderData = $this->Paginator->paginate('TestingLogDevice');
			$this->set(compact('TestingLogDeviceReaderData','conditional_value'));
		}
		elseif($conditional_value==4){
			$options = array(
			    'conditions' => array(
			        'TestingLogDevice.SiteModuleId' => $readerData['Testing']['SiteModuleId']
			    ),

			    'fields'	=> array(
			    	'SiteModuleId','alarm_2','modified'
			    ),
			    
			    'order' 	=> array(
			        'TestingLogDevice.id' => 'DESC'
			    ),

			    'limit' 	=> 100
			);

			$this->Paginator->settings = $options;
			$TestingLogDeviceReaderData = $this->Paginator->paginate('TestingLogDevice');
			$this->set(compact('TestingLogDeviceReaderData','conditional_value'));
		}
		elseif($conditional_value==5){
			$options = array(
			    'conditions' => array(
			        'TestingLogDevice.SiteModuleId' => $readerData['Testing']['SiteModuleId']
			    ),

			    'fields'	=> array(
			    	'SiteModuleId','alarm_3','modified'
			    ),
			    
			    'order' 	=> array(
			        'TestingLogDevice.id' => 'DESC'
			    ),

			    'limit' 	=> 100
			);

			$this->Paginator->settings = $options;
			$TestingLogDeviceReaderData = $this->Paginator->paginate('TestingLogDevice');
			$this->set(compact('TestingLogDeviceReaderData','conditional_value'));
		}
		elseif($conditional_value==6){
			$options = array(
			    'conditions' => array(
			        'TestingLogDevice.SiteModuleId' => $readerData['Testing']['SiteModuleId']
			    ),

			    'fields'	=> array(
			    	'SiteModuleId','alarm_4','modified'
			    ),
			    
			    'order' 	=> array(
			        'TestingLogDevice.id' => 'DESC'
			    ),

			    'limit' 	=> 100
			);

			$this->Paginator->settings = $options;
			$TestingLogDeviceReaderData = $this->Paginator->paginate('TestingLogDevice');
			$this->set(compact('TestingLogDeviceReaderData','conditional_value'));
		}
		elseif($conditional_value==7){
			$options = array(
			    'conditions' => array(
			        'TestingLogDevice.SiteModuleId' => $readerData['Testing']['SiteModuleId']
			    ),

			    'fields'	=> array(
			    	'SiteModuleId','alarm_5','modified'
			    ),
			    
			    'order' 	=> array(
			        'TestingLogDevice.id' => 'DESC'
			    ),

			    'limit' 	=> 100
			);

			$this->Paginator->settings = $options;
			$TestingLogDeviceReaderData = $this->Paginator->paginate('TestingLogDevice');
			$this->set(compact('TestingLogDeviceReaderData','conditional_value'));
		}
		elseif($conditional_value==8){
			$options = array(
			    'conditions' => array(
			        'TestingLogDevice.SiteModuleId' => $readerData['Testing']['SiteModuleId']
			    ),

			    'fields'	=> array(
			    	'SiteModuleId','alarm_6','modified'
			    ),
			    
			    'order' 	=> array(
			        'TestingLogDevice.id' => 'DESC'
			    ),

			    'limit' 	=> 100
			);

			$this->Paginator->settings = $options;
			$TestingLogDeviceReaderData = $this->Paginator->paginate('TestingLogDevice');
			$this->set(compact('TestingLogDeviceReaderData','conditional_value'));
		}
	}
}

