<?php
	App::uses('AppController', 'Controller');
	App::uses('CakeTime', 'Utility');

	class ReportsController extends AppController {
		public $uses = array('Zone','Testing','Site','DeviceCard','ZoneCard','LiveStatus','TestingLogDevice','DoorStatus','User','CardManagement','AssignedCard');
		public $components = array('Paginator', 'Session','RequestHandler');
		public $helpers 	= array('Html','Form','Zoneeetree','Csv');

		public function index(){
			$options = array(
			    'order' 	=> array(
			        'Testing.site_name' => 'ASC'
			    ),
			    'limit' 	=> 20
			);
			$this->Paginator->settings = $options;
			$posts = $this->Paginator->paginate('Testing');
			$this->set('zones', $posts);
		}

		public function create_report(){
			if ($this->request->is('post')) {
				$data 			= 	$this->request->data;
				$site_id        = 	$data['SiteModuleId'];
				$log_ret_val    =   array();
				$log_key		=   array();
				foreach ($data as $key => $value) {
					$log_ret    = $this->create_log_value($key,$site_id);
					array_push($log_ret_val, $log_ret);
					array_push($log_key, $key);
				}
				$implode_val = implode(",", $log_key);
				$log_val = array();
				foreach ($log_ret_val as $key => $value) {
				 	foreach ($value as $key1 => $value1) {
				    	if(isset($log_val[$key1])){
				      		$log_val[$key1] = array_merge_recursive($log_val[$key1],$value1);
				    	}
				    	else{
				      		$log_val[$key1] = array_merge_recursive($value1);
				    	}
				 	}
				}
				$this->set('datas',$log_val);
				$this->set('SiteId',$site_id);
				$this->set('implode_val',$implode_val);
				$this->layout = null;
		    	$this->autoLayout = false;
		    	Configure::write('debug','0');
			} 
			else{
				$this->Session->setFlash('Ip could not be saved. Please, try again.');
			}
		}

		public function select_site($zoneId = null){
			$this->Site->recursive = 0;
			if($zoneId != null){
				$this->paginate = array(
					'order' 	=> array(
				        'Site.Siteid' => 'ASC'
				    ),
					'conditions' => array(
						'Site.zone_id' => $zoneId		
					),
					'limit' 	=> 10
				);
			}
			$this->set('sites', $this->Paginator->paginate('Site'));

			$this->set('zones',$this->Zone->find('list'));
			$treeData = $this->Zone->find(
				'threaded',
				array(
					'contain' => false,
				)					
			);
			$this->set('ZoneTree', $treeData);	
		}

		public function add(){	
		}

		public function access_log_site(){
			$door_status_data		=	array();
			$zone_name				=	null;
			$sub_zone_name			=	null;
			$site_module_id			=	null;
			$site_name_data			=	null;
			$start_time				=	null;
			$end_time				=	null;
			$user_type				=	null;
			$card_number			=	null;
			$zone_name_data			=	null;
			$sub_zone_name_data		=	null;
			$selected_type_data     =   false;


			$this->set('zones',
				$this->Zone->find('all',
					array(
						'fields' => array('id','parent_id','name')
					)
				)
			);

			$this->set('users',
				$this->User->find('all',
					array(
						'fields' => array('User.username','User.id')
					)
				)
			);

			$this->set('sites',
				$this->Site->find('all',
					array(
						'fields' => array('site_name','SiteModuleId')
					)
				)
			);

			$this->set('door_open_by',
				$this->DoorStatus->find('all',
					array(
						'fields' => array( 'DISTINCT  DoorStatus.door_open_by')
					)
				)
			);

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		      		= $this->request->data;
	        	$zone_name        		= $data['zone-name'];
	        	$sub_zone_name    		= $data['sub-zone-name'];
	        	$site_module_id   		= $data['site-name'];
	        	$start_time       		= $data['start-time'];
	        	$end_time         		= $data['end-time'];
	        	$card_number      		= $data['card-number'];
	        	$user_type        		= $data['user-type'];
	        	$open_by          		= $data['door_open_by'];
	        	$flag             		= false;
	        	$selected_type_data     = true;

	        	//pr($data);

	        	if($zone_name!=''){
	        		$zone_data = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name')
						)
					);
					$zone_name_data = $zone_data['Zone']['name'];
	        	}
	        	else{
	        		$site_id = $this->Site->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Site.SiteModuleId' => $site_module_id),
							'fields'    => array('zone_id')
						)
					);
					$site_id = $site_id['Site']['zone_id'];

					$zone_data = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $site_id),
							'fields'    => array('name','parent_id')
						)
					);
					if($zone_data['Zone']['parent_id']!=''){
						$sub_zone_data = $this->Zone->find('first',
							array(
								'recursive' =>-1,
								'conditions'=> array('Zone.id' => $zone_data['Zone']['parent_id']),
								'fields'    => array('name')
							)
						);
						$flag = true;
						$zone_name_data     = $sub_zone_data['Zone']['name'];
						$sub_zone_name_data = $zone_data['Zone']['name'];
					}
					else{
						$zone_name_data     = $zone_data['Zone']['name'];
					}
	        	}
	        	
	        	if($flag==false){
	        		if($sub_zone_name!=null){
		        		$sub_zone_data = $this->Zone->find('first',
							array(
								'recursive' =>-1,
								'conditions'=> array('Zone.id'     => $sub_zone_name),
								'fields'    => array('name')
							)
						);
						$sub_zone_name_data = $sub_zone_data['Zone']['name'];
		        	}
		        	else{
		        		$sub_zone_name_data= null;
		        	}
	        	}
		        	
	        	

	        	if(count($site_module_id)>0){
	        		$site_data = $this->Site->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Site.SiteModuleId' => $site_module_id),
							'fields'    => array('site_name')
						)
					);
					$site_name_data = $site_data['Site']['site_name'];
	        	}
	        	

	        	if($start_time!=null){
					$newDate = date("d-m-Y", strtotime($start_time));
	        		$start_time = $newDate;
	        	}
	        	else{
	        		$start_time = null;
	        	}

	        	if($end_time!=null){
	        		$newDate = date("d-m-Y", strtotime($end_time));
	        		$end_time = $newDate;
	        	}
	        	else{
	        		$end_time = null;
	        	}

	        	if($card_number!=null){
	        		$card_number_data   = $this->CardManagement->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('CardManagement.SiteModuleId' => $site_module_id),
							'fields'    => array('site_name')
						)
					);
	        	}
	        	else{
	        		$card_number = null;
	        	}

	        	if($user_type!=null){
	        		$user_type = $user_type;
	        	}
	        	else{
	        		$user_type = null;
	        	}

	        	if($open_by==1){
        			$open_by='All';
        		}
        		elseif($open_by==2){
        			$open_by='Central';
        		}
        		elseif($open_by==3){
        			$open_by='Mobile';
        		}	
	        	

	        	if($card_number!=''){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.SiteModuleId'   => $site_module_id,
							'DoorStatus.door_open_by'   => array($card_number)
						),
						'fields'    => array('site_name','door_open_by','door_open_time','door_open_user'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}
	        	elseif($user_type!=null AND $open_by=='All'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.SiteModuleId'   => $site_module_id,
							'DoorStatus.door_open_user' => $user_type
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}
	        	elseif($user_type!=null AND $open_by=='Central'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.SiteModuleId'   => $site_module_id,
							'DoorStatus.door_open_user' => $user_type,
							'DoorStatus.door_open_by'   => array($open_by)
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}
	        	elseif($user_type!=null AND $open_by=='Mobile'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.SiteModuleId'   => $site_module_id,
							'DoorStatus.door_open_user' => $user_type,
							'DoorStatus.door_open_by'   => array($open_by)
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}
	        	elseif($open_by=='All'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.SiteModuleId'   => $site_module_id
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}

	        	elseif($open_by=='Central'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.SiteModuleId'   => $site_module_id,
							'DoorStatus.door_open_by'   => array($open_by)
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}

	        	elseif($open_by=='Mobile'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.SiteModuleId'   => $site_module_id,
							'DoorStatus.door_open_by'   => array($open_by)
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}
	        	
	        	if($start_time!=null AND $end_time!=null){
	        	}
	        	//$this->set(compact('door_status_data','zone_name','sub_zone_name','site_module_id','site_name_data','start_time','end_time','user_type','card_number','zone_name_data','sub_zone_name_data'));
			}
			else{
				$door_status_data = array(
				    'recursive' =>-1,
					'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
					'limit'     => 20
				);
				$this->Paginator->settings = $door_status_data;
				$door_status_data = $this->Paginator->paginate('DoorStatus');
			}

			$this->set(compact('door_status_data','zone_name','sub_zone_name','site_module_id','start_time','end_time','user_type','card_number','zone_name_data','sub_zone_name_data','site_name_data','selected_type_data'));
		}

		public function instant_door_status(){
			$zone_name           =  null;
			$sub_zone_name       =  null;
			$site_module_id      =  null;
			$zone_name_data      =  null;
			$sub_zone_name_data  =  null;
			$site_name_data      =  null;
			$flag_zone           =  false;
        	$flag_sub_zone       =  false;
        	$flag_site           =  false;
        	$flag_all            =  false;
			$zone_data           =  array();
			$sub_zone_data       =  array();
			$door_status_data    =  array();
			$testing_site_data   =  array();

			$this->set('zones',
				$this->Zone->find('all',
					array(
						'fields' => array('id','parent_id','name')
					)
				)
			);


			$this->set('sites',
				$this->Site->find('all',
					array(
						'fields' => array('site_name','SiteModuleId')
					)
				)
			);

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		      = $this->request->data;
	        	$zone_name        = $data['zone-name'];
	        	$sub_zone_name    = $data['sub-zone-name'];
	        	$site_module_id   = $data['site-name'];
	        	$open_by          = $data['door_open_by'];
	        	$flag_zone        = false;
	        	$flag_sub_zone    = false;
	        	$flag_site        = false;
	        	$flag_all         = false;
	        	//pr($data);

	        	if($zone_name!='' AND $sub_zone_name!=''){
	        		if($site_module_id!=''){
	        			$site_data = $this->Site->find('first',
							array(
								'recursive' =>-1,
								'conditions'=> array('Site.SiteModuleId' => $site_module_id)
							)
						);
						$site_name_data = $site_data['Site']['site_name'];
	        		}
	        		$zone_data_vall = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_vall['Zone']['name'];

	        		$zone_data_val = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $sub_zone_name),
							'fields'    => array('name','id')
						)
					);
					$sub_zone_name_data = $zone_data_val['Zone']['name'];
					$zone_id_data       = $zone_data_val['Zone']['id'];

					$site_data = $this->Site->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array('Site.zone_id' => $zone_id_data),
							'fields'    => array('site_name','id','SiteModuleId')
						)
					);
					$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);

					if($open_by==1){
						foreach ($site_data as $key => $value) {
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array('Testing.SiteModuleId' => $value['Site']['SiteModuleId'])
								)
							);
						}
					}
					elseif($open_by==2){
						foreach ($site_data as $key => $value) {
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array(
										'Testing.SiteModuleId' => $value['Site']['SiteModuleId'],
										'Testing.door_status' =>  2
									)
								)
							);
						}
					}
					elseif($open_by==3){
						foreach ($site_data as $key => $value) {
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array(
										'Testing.SiteModuleId' => $value['Site']['SiteModuleId'],
										'Testing.door_status' =>  1
									)
								)
							);
						}
					}
					elseif($open_by==4){
						foreach ($site_data as $key => $value) {
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array(
										'Testing.SiteModuleId' => $value['Site']['SiteModuleId'],
										'Testing.door_status' =>  3
									)
								)
							);
						}
					}
					$flag_sub_zone = true;
	        	}
	        	elseif($zone_name!='' AND $site_module_id!=''){
	        		$zone_data_vall = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_vall['Zone']['name'];

					$site_data = $this->Site->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'Site.SiteModuleId' => $site_module_id,
							)
						)
					);
					$site_name_data = $site_data['Site']['site_name'];



	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);


	        		if($open_by==1){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array('Testing.SiteModuleId' => $site_module_id)
							)
						);
					}
					elseif($open_by==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'Testing.door_status' =>  2
								)
							)
						);	
					}
					elseif($open_by==3){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'Testing.door_status' =>  1
								)
							)
						);	
					}
					elseif($open_by==4){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'Testing.door_status' =>  3
								)
							)
						);
					}
					$flag_site = true;
	        	}
	        	elseif($zone_name!=''){
	        		$zone_data_val = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_val['Zone']['name'];
					$zone_id_data   = $zone_data_val['Zone']['id'];

					$site_data = $this->Site->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array('Site.zone_id' => $zone_id_data),
							'fields'    => array('site_name','id','SiteModuleId')
						)
					);

					$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);


					if($open_by==1){
						foreach ($site_data as $key => $value) {
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array('Testing.SiteModuleId' => $value['Site']['SiteModuleId'])
								)
							);
						}
					}
					elseif($open_by==2){
						foreach ($site_data as $key => $value) {
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array(
										'Testing.SiteModuleId' => $value['Site']['SiteModuleId'],
										'Testing.door_status' =>  2
									)
								)
							);
						}
					}
					elseif($open_by==3){
						foreach ($site_data as $key => $value) {
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array(
										'Testing.SiteModuleId' => $value['Site']['SiteModuleId'],
										'Testing.door_status' =>  1
									)
								)
							);
						}
					}
					elseif($open_by==4){
						foreach ($site_data as $key => $value) {
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array(
										'Testing.SiteModuleId' => $value['Site']['SiteModuleId'],
										'Testing.door_status' =>  3
									)
								)
							);
						}
					}

					$flag_zone = true;
	        	}
	        	elseif($site_module_id!=''){
	        		$site_data = $this->Site->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'Site.SiteModuleId' => $site_module_id,
							)
						)
					);
					$site_name_data = $site_data['Site']['site_name'];

	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);


	        		if($open_by==1){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array('Testing.SiteModuleId' => $site_module_id)
							)
						);
						
					}
					elseif($open_by==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'Testing.door_status' =>  2
								)
							)
						);
						
					}
					elseif($open_by==3){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'Testing.door_status' =>  1
								)
							)
						);
						
					}
					elseif($open_by==4){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'Testing.door_status' =>  3
								)
							)
						);
					}
					$flag_site = true;
					//pr($testing_site_data);
	        	}
	        	else{
	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);

	        		if($open_by==1){
						$testing_site_data = $this->Testing->find('all');		
					}
					elseif($open_by==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.door_status' =>  2
								)
							)
						);
					}
					elseif($open_by==3){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.door_status' =>  1
								)
							)
						);
					}
					elseif($open_by==4){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.door_status' =>  3
								)
							)
						);
					}
					$flag_all = true;
					//pr($testing_site_data);
	        	}
			}
			else{
				$zone_data = $this->Zone->find('all',
					array(
						'recursive' =>-1,
						'fields'    => array('name','parent_id','id')
					)
				);
				$testing_site_data = $this->Testing->find('all',
					array(
						'recursive' =>-1,
						'conditions'=> array(
							'Testing.door_status' =>  2
						)
					)
				);		
			}
			//$this->set(compact('zone_data','door_status_data','zone_name','sub_zone_name','site_module_id','site_name_data','start_time','end_time','user_type','card_number','zone_name_data','sub_zone_name_data','testing_site_data','flag_zone','flag_site','flag_all','flag_sub_zone'));

			$this->set(compact('zone_data','testing_site_data','flag_zone','flag_site','flag_all','flag_sub_zone','zone_name_data','sub_zone_name_data','site_name_data'));
		}

		public function instant_site_status(){
			$zone_name           =  null;
			$sub_zone_name       =  null;
			$site_module_id      =  null;
			$zone_name_data      =  null;
			$sub_zone_name_data  =  null;
			$site_name_data      =  null;
			$flag_zone           = false;
        	$flag_sub_zone       = false;
        	$flag_site           = false;
        	$flag_all            = false;
			$zone_data           =  array();
			$sub_zone_data       =  array();
			$door_status_data    =  array();
			$testing_site_data   =  array();

			$this->set('zones',
				$this->Zone->find('all',
					array(
						'fields' => array('id','parent_id','name')
					)
				)
			);


			$this->set('sites',
				$this->Site->find('all',
					array(
						'fields' => array('site_name','SiteModuleId')
					)
				)
			);

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		      = $this->request->data;
	        	$zone_name        = $data['zone-name'];
	        	$sub_zone_name    = $data['sub-zone-name'];
	        	$site_module_id   = $data['site-name'];
	        	$live_status      = $data['status'];
	        	$flag_zone        = false;
	        	$flag_sub_zone    = false;
	        	$flag_site        = false;
	        	$flag_all         = false;
	        	//pr($data);

	        	if($zone_name!='' AND $sub_zone_name!=''){
	        		if($site_module_id!=''){
	        			$site_data = $this->Site->find('first',
							array(
								'recursive' =>-1,
								'conditions'=> array('Site.SiteModuleId' => $site_module_id)
							)
						);
						$site_name_data = $site_data['Site']['site_name'];
	        		}
	        		$zone_data_vall = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_vall['Zone']['name'];

	        		$zone_data_val = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $sub_zone_name),
							'fields'    => array('name','id')
						)
					);
					$sub_zone_name_data = $zone_data_val['Zone']['name'];
					$zone_id_data       = $zone_data_val['Zone']['id'];

					$site_data = $this->Site->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array('Site.zone_id' => $zone_id_data),
							'fields'    => array('site_name','id','SiteModuleId')
						)
					);
					$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);

					if($live_status==0){
						foreach ($site_data as $key => $value) {
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array(
										'Testing.SiteModuleId' => $value['Site']['SiteModuleId'],
										'Testing.status' =>  0
									)
								)
							);
						}
					}
					elseif($live_status==1){
						foreach ($site_data as $key => $value) {
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array(
										'Testing.SiteModuleId' => $value['Site']['SiteModuleId'],
										'Testing.status' =>  1
									)
								)
							);
						}
					}
					elseif($live_status==2){
						foreach ($site_data as $key => $value) {
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array(
										'Testing.SiteModuleId' => $value['Site']['SiteModuleId'],
										'Testing.status' =>  2
									)
								)
							);
						}
					}
					elseif($live_status==3){
						foreach ($site_data as $key => $value) {
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array('Testing.SiteModuleId' => $value['Site']['SiteModuleId'])
								)
							);
						}
					}
					$flag_sub_zone = true;
	        	}
	        	elseif($zone_name!='' AND $site_module_id!=''){
	        		$zone_data_vall = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_vall['Zone']['name'];

					$site_data = $this->Site->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'Site.SiteModuleId' => $site_module_id,
							)
						)
					);
					$site_name_data = $site_data['Site']['site_name'];

	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);

	        		if($live_status==0){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'Testing.status' =>  0
								)
							)
						);	
					}
					elseif($live_status==1){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'Testing.status' =>  1
								)
							)
						);
					}
					elseif($live_status==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'Testing.status' =>  2
								)
							)
						);
					}
					elseif($live_status==3){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array('Testing.SiteModuleId' => $site_module_id)
							)
						);
					}
					$flag_site = true;
	        	}
	        	elseif($zone_name!=''){
	        		$zone_data_val = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_val['Zone']['name'];
					$zone_id_data   = $zone_data_val['Zone']['id'];

					$site_data = $this->Site->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array('Site.zone_id' => $zone_id_data),
							'fields'    => array('site_name','id','SiteModuleId')
						)
					);

					$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
					
					if($live_status==0){
						foreach ($site_data as $key => $value) {
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array(
										'Testing.SiteModuleId' => $value['Site']['SiteModuleId'],
										'Testing.status' =>  0
									)
								)
							);
						}
					}
					elseif($live_status==1){
						foreach ($site_data as $key => $value) {
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array(
										'Testing.SiteModuleId' => $value['Site']['SiteModuleId'],
										'Testing.status' =>  1
									)
								)
							);
						}
					}
					elseif($live_status==2){
						foreach ($site_data as $key => $value) {
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array(
										'Testing.SiteModuleId' => $value['Site']['SiteModuleId'],
										'Testing.status' =>  2
									)
								)
							);
						}
					}
					elseif($live_status==3){
						foreach ($site_data as $key => $value) {
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array('Testing.SiteModuleId' => $value['Site']['SiteModuleId'])
								)
							);
						}
					}
					$flag_zone = true;
	        	}
	        	elseif($site_module_id!=''){
	        		$site_data = $this->Site->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'Site.SiteModuleId' => $site_module_id,
							)
						)
					);
					$site_name_data = $site_data['Site']['site_name'];

	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);

	        		if($live_status==0){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'Testing.status' =>  0
								)
							)
						);	
					}
					elseif($live_status==1){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'Testing.status' =>  1
								)
							)
						);
					}
					elseif($live_status==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'Testing.status' =>  2
								)
							)
						);
					}
					elseif($live_status==3){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array('Testing.SiteModuleId' => $site_module_id)
							)
						);
					}
					$flag_site = true;
	        	}
	        	else{
	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
	        		if($live_status==0){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.status' =>  0
								)
							)
						);
					}
					elseif($live_status==1){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.status' =>  1
								)
							)
						);
					}
					elseif($live_status==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.status' =>  2
								)
							)
						);
					}
	        		elseif($live_status==3){
						$testing_site_data = $this->Testing->find('all');		
					}
					$flag_all = true;
	        	}
	        	//pr($testing_site_data);
			}
			else{
				$zone_data = $this->Zone->find('all',
					array(
						'recursive' =>-1,
						'fields'    => array('name','parent_id','id')
					)
				);
				$testing_site_data = $this->Testing->find('all',
					array(
						'recursive' =>-1,
						'conditions'=> array(
							'Testing.status' =>  0
						)
					)
				);
			}
			$this->set(compact('zone_data','testing_site_data','flag_zone','flag_site','flag_all','flag_sub_zone','zone_name_data','sub_zone_name_data','site_name_data'));
		}

		public function instant_voltage_status(){
			$zone_name           =  null;
			$sub_zone_name       =  null;
			$site_module_id      =  null;
			$zone_name_data      =  null;
			$sub_zone_name_data  =  null;
			$site_name_data      =  null;
			$zone_data           =  array();
			$sub_zone_data       =  array();
			$door_status_data    =  array();
			$testing_site_data   =  array();
			$flag_zone           = false;
	        $flag_sub_zone       = false;
	        $flag_site           = false;
	        $flag_all            = false;

			$this->set('zones',
				$this->Zone->find('all',
					array(
						'fields' => array('id','parent_id','name')
					)
				)
			);


			$this->set('sites',
				$this->Site->find('all',
					array(
						'fields' => array('site_name','SiteModuleId')
					)
				)
			);

			$testing_site_data = $this->Testing->find('all',
				array(
					'recursive' =>-1,
					'conditions'=> array(
						'Testing.voltage <='     => 40
					)
				)
			);

			$zone_data = $this->Zone->find('all',
				array(
					'recursive' =>-1,
					'fields'    => array('name','parent_id','id')
				)
			);

			//pr($testing_site_data);

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		      = $this->request->data;
	        	$zone_name        = $data['zone-name'];
	        	$sub_zone_name    = $data['sub-zone-name'];
	        	$low_voltage      = $data['low_voltage'];
	        	$flag_zone        = false;
	        	$flag_sub_zone    = false;
	        	$flag_site        = false;
	        	$flag_all         = false;
	        	//pr($data);

	        	if($zone_name!='' AND $sub_zone_name!=''){
	        		$zone_data_vall = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_vall['Zone']['name'];

	        		$zone_data_val = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $sub_zone_name),
							'fields'    => array('name','id')
						)
					);
					$sub_zone_name_data = $zone_data_val['Zone']['name'];
					$zone_id_data       = $zone_data_val['Zone']['id'];

					
					$testing_site_data = $this->Testing->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'Testing.zone_id'   => $zone_id_data,
								'Testing.voltage <=' => $low_voltage
							)
						)
					);
					$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
					$flag_sub_zone = true;
	        	}
	        	elseif($zone_name!=''){
	        		$zone_data_vall = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_vall['Zone']['name'];
					$zone_id        = $zone_data_vall['Zone']['id'];

					
					$testing_site_data = $this->Testing->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'Testing.zone_id'        => $zone_id,
								'Testing.voltage <='     => $low_voltage
							)
						)
					);	
					if(count($testing_site_data)>0){
						$site_name_data = $testing_site_data[0]['Testing']['site_name'];
					}
	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
	        		
					$flag_site = true;
	        	}
	        	else{
					$testing_site_data = $this->Testing->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'Testing.voltage <='     => $low_voltage
							)
						)
					);

	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
					$flag_all = true;
	        	}
			}
			$this->set(compact('zone_data','testing_site_data','flag_zone','flag_site','flag_all','flag_sub_zone','zone_name_data','sub_zone_name_data','site_name_data'));
		}

		public function instant_reader_status(){
			$zone_name           =  null;
			$sub_zone_name       =  null;
			$site_module_id      =  null;
			$zone_name_data      =  null;
			$sub_zone_name_data  =  null;
			$site_name_data      =  null;
			$zone_data           =  array();
			$sub_zone_data       =  array();
			$door_status_data    =  array();
			$testing_site_data   =  array();
			$flag_zone        = false;
        	$flag_sub_zone    = false;
        	$flag_site        = false;
        	$flag_all         = false;

			$this->set('zones',
				$this->Zone->find('all',
					array(
						'fields' => array('id','parent_id','name')
					)
				)
			);


			$this->set('sites',
				$this->Site->find('all',
					array(
						'fields' => array('site_name','SiteModuleId')
					)
				)
			);

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		      = $this->request->data;
	        	$zone_name        = $data['zone-name'];
	        	$sub_zone_name    = $data['sub-zone-name'];
	        	$site_module_id   = $data['site-name'];
	        	$card_reader      = $data['card_reader'];
	        	$flag_zone        = false;
	        	$flag_sub_zone    = false;
	        	$flag_site        = false;
	        	$flag_all         = false;
	        	//pr($data);

	        	if($zone_name!='' AND $sub_zone_name!=''){
	        		if($site_module_id!=''){
	        			$site_data = $this->Site->find('first',
							array(
								'recursive' =>-1,
								'conditions'=> array('Site.SiteModuleId' => $site_module_id)
							)
						);
						$site_name_data = $site_data['Site']['site_name'];
	        		}

	        		$zone_data_vall = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_vall['Zone']['name'];

	        		$zone_data_val = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $sub_zone_name),
							'fields'    => array('name','id')
						)
					);
					$sub_zone_name_data = $zone_data_val['Zone']['name'];
					$zone_id_data       = $zone_data_val['Zone']['id'];

					if($card_reader==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.zone_id'   => $zone_id_data
								)
							)
						);
					}
					else{
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.zone_id'   => $zone_id_data,
									'Testing.card_reader' => $card_reader
								)
							)
						);
					}

					$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
					$flag_sub_zone = true;
	        	}
	        	elseif($zone_name!='' AND $site_module_id!=''){
	        		$zone_data_vall = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_vall['Zone']['name'];

					if($card_reader==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId'   => $site_module_id
								)
							)
						);
					}
					else{
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId'   => $site_module_id,
									'Testing.card_reader'    => $card_reader
								)
							)
						);
					}
					if(count($testing_site_data)>0){
						$site_name_data = $testing_site_data[0]['Testing']['site_name'];
					}

	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
	        		
					$flag_site = true;
	        	}
	        	elseif($zone_name!=''){
	        		$zone_data_val = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_val['Zone']['name'];
					$zone_id_data   = $zone_data_val['Zone']['id'];

					$site_data = $this->Site->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array('Site.zone_id' => $zone_id_data),
							'fields'    => array('site_name','id','SiteModuleId')
						)
					);

					$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);

					foreach ($site_data as $key => $value) {
						if($card_reader==2){
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array(
										'Testing.SiteModuleId'   => $value['Site']['SiteModuleId']
									)
								)
							);
						}
						else{
							$testing_site_data[$key] = $this->Testing->find('all',
								array(
									'recursive' =>-1,
									'conditions'=> array(
										'Testing.SiteModuleId'   => $value['Site']['SiteModuleId'],
										'Testing.card_reader'    => $card_reader
									)
								)
							);
						}
					}
					$flag_zone = true;
	        	}
	        	elseif($site_module_id!=''){
	        		if($card_reader==2){
	        			$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId'   => $site_module_id
								)
							)
						);
					}
					else{
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId'   => $site_module_id,
									'Testing.card_reader'    => $card_reader
								)
							)
						);
					}

					if(count($testing_site_data)){
						$site_name_data = $testing_site_data[0]['Testing']['site_name'];
					}
					
	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
					$flag_site = true;
	        	}
	        	else{
	        		if($card_reader==2){
	        			$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
							)
						);
					}
					else{
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.card_reader'    => $card_reader
								)
							)
						);
					}

	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);

					$flag_all = true;
	        	}
	        	//pr($testing_site_data);
			}
			else{
				$testing_site_data = $this->Testing->find('all',
					array(
						'recursive' =>-1,
					)
				);
				$zone_data = $this->Zone->find('all',
					array(
						'recursive' =>-1,
						'fields'    => array('name','parent_id','id')
					)
				);
				//pr($testing_site_data);
			}
			$this->set(compact('zone_data','testing_site_data','flag_zone','flag_site','flag_all','flag_sub_zone','zone_name_data','sub_zone_name_data','site_name_data'));
		}

		public function instant_lock_status(){
			$zone_name           =  null;
			$sub_zone_name       =  null;
			$site_module_id      =  null;
			$zone_name_data      =  null;
			$sub_zone_name_data  =  null;
			$site_name_data      =  null;
			$zone_data           =  array();
			$sub_zone_data       =  array();
			$door_status_data    =  array();
			$testing_site_data   =  array();
			$flag_zone           = false;
        	$flag_sub_zone       = false;
        	$flag_site           = false;
        	$flag_all            = false;

			$this->set('zones',
				$this->Zone->find('all',
					array(
						'fields' => array('id','parent_id','name')
					)
				)
			);


			$this->set('sites',
				$this->Site->find('all',
					array(
						'fields' => array('site_name','SiteModuleId')
					)
				)
			);

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		      = $this->request->data;
	        	$zone_name        = $data['zone-name'];
	        	$sub_zone_name    = $data['sub-zone-name'];
	        	$site_module_id   = $data['site-name'];
	        	$lock_status      = $data['lock_status'];
	        	$flag_zone        = false;
	        	$flag_sub_zone    = false;
	        	$flag_site        = false;
	        	$flag_all         = false;
	        	//pr($data);

	        	if($zone_name!='' AND $sub_zone_name!=''){
	        		if($site_module_id!=''){
	        			$site_data = $this->Site->find('first',
							array(
								'recursive' =>-1,
								'conditions'=> array('Site.SiteModuleId' => $site_module_id)
							)
						);
						$site_name_data = $site_data['Site']['site_name'];
	        		}
	        		$zone_data_vall = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_vall['Zone']['name'];

	        		$zone_data_val = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $sub_zone_name),
							'fields'    => array('name','id')
						)
					);
					$sub_zone_name_data = $zone_data_val['Zone']['name'];
					$zone_id_data       = $zone_data_val['Zone']['id'];

					$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);

					if($lock_status==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.zone_id' => $sub_zone_name
								)
							)
						);	
					}
					else{
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.zone_id'     => $sub_zone_name,
									'Testing.card_reader' => $lock_status
								)
							)
						);
					}
					$flag_sub_zone = true;
	        	}
	        	elseif($zone_name!='' AND $site_module_id!=''){
	        		$zone_data_vall = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_vall['Zone']['name'];

					$site_data = $this->Site->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'Site.SiteModuleId' => $site_module_id,
							)
						)
					);
					$site_name_data = $site_data['Site']['site_name'];

	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);

	        		if($lock_status==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id
								)
							)
						);	
					}
					else{
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'Testing.card_reader' =>  $lock_status
								)
							)
						);
					}
					$flag_site = true;
	        	}
	        	elseif($zone_name!=''){
	        		$zone_data_val = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_val['Zone']['name'];
					$zone_id_data   = $zone_data_val['Zone']['id'];

					$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
					
					if($lock_status==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.zone_id' => $zone_name
								)
							)
						);	
					}
					else{
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.zone_id'     => $zone_name,
									'Testing.card_reader' => $lock_status
								)
							)
						);
					}
					$flag_zone = true;
	        	}
	        	elseif($site_module_id!=''){
	        		$site_data = $this->Site->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'Site.SiteModuleId' => $site_module_id,
							)
						)
					);
					$site_name_data = $site_data['Site']['site_name'];

	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);

	        		if($lock_status==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id
								),
								'order'     => array('Testing.site_name' =>'ASC')
							)
						);	
					}
					else{
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'Testing.card_reader' =>  $lock_status
								),
								'order'     =>array('Testing.site_name' =>'ASC')
							)
						);
					}
					$flag_site = true;
	        	}
	        	else{
	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
					if($lock_status==2){
						$testing_site_data = $this->Testing->find('all');		
					}
	        		else{
	        			$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.card_reader' =>  $lock_status
								)
							)
						);
	        		}
					$flag_all = true;
	        	}
	        	//pr($testing_site_data);
			}
			else{
				$zone_data = $this->Zone->find('all',
					array(
						'recursive' =>-1,
						'fields'    => array('name','parent_id','id')
					)
				);

				$testing_site_data = $this->Testing->find('all',
					array(
						'recursive' =>-1,
					)
				);
			}
			$this->set(compact('zone_data','testing_site_data','flag_zone','flag_site','flag_all','flag_sub_zone','zone_name_data','sub_zone_name_data','site_name_data'));
		}

		public function instant_active_alarm(){
			$zone_name           =  null;
			$sub_zone_name       =  null;
			$site_module_id      =  null;
			$zone_name_data      =  null;
			$sub_zone_name_data  =  null;
			$site_name_data      =  null;
			$zone_data           =  array();
			$sub_zone_data       =  array();
			$door_status_data    =  array();
			$testing_site_data   =  array();

			$flag_zone           = false;
	        $flag_sub_zone       = false;
	        $flag_site           = false;
	        $flag_all            = false;
	        $flag_alarm_1        = false;
	        $flag_alarm_2        = false;
	        $flag_alarm_3        = false;
	        $flag_alarm_4        = false;
	        $flag_alarm_all      = false;

			$this->set('zones',
				$this->Zone->find('all',
					array(
						'fields' => array('id','parent_id','name')
					)
				)
			);


			$this->set('sites',
				$this->Site->find('all',
					array(
						'fields' => array('site_name','SiteModuleId')
					)
				)
			);

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		      = $this->request->data;
	        	$zone_name        = $data['zone-name'];
	        	$sub_zone_name    = $data['sub-zone-name'];
	        	$site_module_id   = $data['site-name'];
	        	$alarm_name       = $data['alarm_name'];
	        	$flag_zone        = false;
	        	$flag_sub_zone    = false;
	        	$flag_site        = false;
	        	$flag_all         = false;
	        	$flag_alarm_1     = false;
	        	$flag_alarm_2     = false;
	        	$flag_alarm_3     = false;
	        	$flag_alarm_4     = false;
	        	$flag_alarm_all   = false;

	        	//pr($data);

	        	if($zone_name!='' AND $sub_zone_name!=''){
	        		if($site_module_id!=''){
	        			$site_data = $this->Site->find('first',
							array(
								'recursive' =>-1,
								'conditions'=> array('Site.SiteModuleId' => $site_module_id)
							)
						);
						$site_name_data = $site_data['Site']['site_name'];
	        		}
	        		$zone_data_vall = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_vall['Zone']['name'];

	        		$zone_data_val = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $sub_zone_name),
							'fields'    => array('name','id')
						)
					);
					$sub_zone_name_data = $zone_data_val['Zone']['name'];
					$zone_id_data       = $zone_data_val['Zone']['id'];

					$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);

					if($alarm_name==1){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.zone_id' => $zone_id_data
								)
							)
						);
						$flag_alarm_all     = true;
					}
					elseif($alarm_name==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.zone_id' => $zone_id_data,
									'OR' => array(
							            array('Testing.alarm_1' => '1'),
							            array('Testing.alarm_1' => '0')
							        )
								)
							)
						);
						$flag_alarm_1     = true;
					}
					elseif($alarm_name==3){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.zone_id' => $zone_id_data,
									'OR' => array(
							            array('Testing.alarm_2' => '1'),
							            array('Testing.alarm_2' => '0')
							        )
								)
							)
						);
						$flag_alarm_2     = true;
					}
					elseif($alarm_name==4){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.zone_id' => $zone_id_data,
									'OR' => array(
							            array('Testing.alarm_3' => '1'),
							            array('Testing.alarm_3' => '0')
							        )
								)
							)
						);
						$flag_alarm_3     = true;
					}
					elseif($alarm_name==5){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.zone_id' => $zone_id_data,
									'OR' => array(
							            array('Testing.alarm_4' => '1'),
							            array('Testing.alarm_4' => '0')
							        )
								)
							)
						);
						$flag_alarm_4     = true;
					}
					$flag_sub_zone = true;
	        	}
	        	elseif($zone_name!='' AND $site_module_id!=''){
	        		$zone_data_vall = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_vall['Zone']['name'];

					$site_data = $this->Site->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'Site.SiteModuleId' => $site_module_id,
							)
						)
					);
					$site_name_data = $site_data['Site']['site_name'];

	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
					if($alarm_name==1){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id
								)
							)
						);
						$flag_alarm_all     = true;
					}
					elseif($alarm_name==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'OR' => array(
							            array('Testing.alarm_1' => '1'),
							            array('Testing.alarm_1' => '0')
							        )
								)
							)
						);
						$flag_alarm_1     = true;
					}
					elseif($alarm_name==3){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'OR' => array(
							            array('Testing.alarm_2' => '1'),
							            array('Testing.alarm_2' => '0')
							        )
								)
							)
						);
						$flag_alarm_2     = true;
					}
					elseif($alarm_name==4){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'OR' => array(
							            array('Testing.alarm_3' => '1'),
							            array('Testing.alarm_3' => '0')
							        )
								)
							)
						);
						$flag_alarm_3     = true;
					}
					elseif($alarm_name==5){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'OR' => array(
							            array('Testing.alarm_4' => '1'),
							            array('Testing.alarm_4' => '0')
							        )
								)
							)
						);
						$flag_alarm_4     = true;
					}
					$flag_site = true;
	        	}
	        	elseif($zone_name!=''){
	        		$zone_data_val = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_val['Zone']['name'];
					$zone_id_data   = $zone_data_val['Zone']['id'];

					$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);

					if($alarm_name==1){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.zone_id' => $zone_id_data
								)
							)
						);
						$flag_alarm_all     = true;
					}
					elseif($alarm_name==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.zone_id' => $zone_id_data,
									'OR' => array(
							            array('Testing.alarm_1' => '1'),
							            array('Testing.alarm_1' => '0')
							        )
								)
							)
						);
						$flag_alarm_1     = true;
					}
					elseif($alarm_name==3){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.zone_id' => $zone_id_data,
									'OR' => array(
							            array('Testing.alarm_2' => '1'),
							            array('Testing.alarm_2' => '0')
							        )
								)
							)
						);
						$flag_alarm_2     = true;
					}
					elseif($alarm_name==4){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.zone_id' => $zone_id_data,
									'OR' => array(
							            array('Testing.alarm_3' => '1'),
							            array('Testing.alarm_3' => '0')
							        )
								)
							)
						);
						$flag_alarm_3     = true;
					}
					elseif($alarm_name==5){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.zone_id' => $zone_id_data,
									'OR' => array(
							            array('Testing.alarm_4' => '1'),
							            array('Testing.alarm_4' => '0')
							        )
								)
							)
						);
						$flag_alarm_4     = true;
					}
					$flag_zone = true;
	        	}
	        	elseif($site_module_id!=''){
	        		$site_data = $this->Site->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'Site.SiteModuleId' => $site_module_id,
							)
						)
					);
					$site_name_data = $site_data['Site']['site_name'];

	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);

					if($alarm_name==1){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id
								)
							)
						);
						$flag_alarm_all     = true;
					}
					elseif($alarm_name==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'OR' => array(
							            array('Testing.alarm_1' => '1'),
							            array('Testing.alarm_1' => '0')
							        )
								)
							)
						);
						$flag_alarm_1     = true;
					}
					elseif($alarm_name==3){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'OR' => array(
							            array('Testing.alarm_2' => '1'),
							            array('Testing.alarm_2' => '0')
							        )
								)
							)
						);
						$flag_alarm_2     = true;
					}
					elseif($alarm_name==4){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'OR' => array(
							            array('Testing.alarm_3' => '1'),
							            array('Testing.alarm_3' => '0')
							        )
								)
							)
						);
						$flag_alarm_3     = true;
					}
					elseif($alarm_name==5){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'Testing.SiteModuleId' => $site_module_id,
									'OR' => array(
							            array('Testing.alarm_4' => '1'),
							            array('Testing.alarm_4' => '0')
							        )
								)
							)
						);
						$flag_alarm_4     = true;
					}
					$flag_site = true;
	        	}
	        	else{
	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
					if($alarm_name==1){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1
							)
						);
						$flag_alarm_all     = true;
					}
					elseif($alarm_name==2){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'OR' => array(
							            array('Testing.alarm_1' => '1'),
							            array('Testing.alarm_1' => '0')
							        )
								)
							)
						);
						$flag_alarm_1     = true;
					}
					elseif($alarm_name==3){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'OR' => array(
							            array('Testing.alarm_2' => '1'),
							            array('Testing.alarm_2' => '0')
							        )
								)
							)
						);
						$flag_alarm_2     = true;
					}
					elseif($alarm_name==4){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'OR' => array(
							            array('Testing.alarm_3' => '1'),
							            array('Testing.alarm_3' => '0')
							        )
								)
							)
						);
						$flag_alarm_3     = true;
					}
					elseif($alarm_name==5){
						$testing_site_data = $this->Testing->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'OR' => array(
							            array('Testing.alarm_4' => '1'),
							            array('Testing.alarm_4' => '0')
							        )
								)
							)
						);
						$flag_alarm_4     = true;
					}
					$flag_all = true;
	        	}
	        	//pr($testing_site_data);
			}
			else{
				$zone_data = $this->Zone->find('all',
					array(
						'recursive' =>-1,
						'fields'    => array('name','parent_id','id')
					)
				);
				$testing_site_data = $this->Testing->find('all',
					array(
						'recursive' =>-1
					)
				);
				$flag_all           = true;
				$flag_alarm_all     = true;	

			}
			$this->set(compact('zone_data','testing_site_data','flag_zone','flag_site','flag_all','flag_sub_zone','flag_alarm_1','flag_alarm_2','flag_alarm_3','flag_alarm_4','flag_alarm_all','zone_name_data','sub_zone_name_data','site_name_data'));
		}

		public function alert_log_report(){	
			$door_status_data=array();
			$zone_name=null;
			$sub_zone_name=null;
			$site_module_id=null;
			$site_name_data=null;
			$start_time=null;
			$end_time=null;
			$user_type=null;
			$card_number=null;
			$zone_name_data=null;
			$sub_zone_name_data=null;

			$this->set('zones',
				$this->Zone->find('all',
					array(
						'fields' => array('id','parent_id','name')
					)
				)
			);

			$this->set('users',
				$this->User->find('all',
					array(
						'fields' => array('User.username','User.id')
					)
				)
			);

			$this->set('sites',
				$this->Site->find('all',
					array(
						'fields' => array('site_name','SiteModuleId')
					)
				)
			);

			$this->set('door_open_by',
				$this->DoorStatus->find('all',
					array(
						'fields' => array( 'DISTINCT  DoorStatus.door_open_by')
					)
				)
			);

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		      = $this->request->data;
	        	$zone_name        = $data['zone-name'];
	        	$sub_zone_name    = $data['sub-zone-name'];
	        	$site_module_id   = $data['site-name'];
	        	$start_time       = $data['start-time'];
	        	$end_time         = $data['end-time'];
	        	$card_number      = $data['card-number'];
	        	$user_type        = $data['user-type'];
	        	$open_by          = $data['door_open_by'];
	        	$flag             = false;

	        	//pr($data);

	        	if($zone_name!=''){
	        		$zone_data = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name')
						)
					);
					$zone_name_data = $zone_data['Zone']['name'];
	        	}
	        	else{
	        		$site_id = $this->Site->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Site.SiteModuleId' => $site_module_id),
							'fields'    => array('zone_id')
						)
					);
					$site_id = $site_id['Site']['zone_id'];

					$zone_data = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $site_id),
							'fields'    => array('name','parent_id')
						)
					);
					if($zone_data['Zone']['parent_id']!=''){
						$sub_zone_data = $this->Zone->find('first',
							array(
								'recursive' =>-1,
								'conditions'=> array('Zone.id' => $zone_data['Zone']['parent_id']),
								'fields'    => array('name')
							)
						);
						$flag = true;
						$zone_name_data     = $sub_zone_data['Zone']['name'];
						$sub_zone_name_data = $zone_data['Zone']['name'];
					}
					else{
						$zone_name_data = $zone_data['Zone']['name'];
					}
	        	}
	        	
	        	if($flag==false){
	        		if($sub_zone_name!=null){
		        		$sub_zone_data = $this->Zone->find('first',
							array(
								'recursive' =>-1,
								'conditions'=> array('Zone.id'     => $sub_zone_name),
								'fields'    => array('name')
							)
						);
						$sub_zone_name_data = $sub_zone_data['Zone']['name'];
		        	}
		        	else{
		        		$sub_zone_name_data= null;
		        	}
	        	}
		        	
	        	

	        	if(count($site_module_id)>0){
	        		$site_data = $this->Site->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Site.SiteModuleId' => $site_module_id),
							'fields'    => array('site_name')
						)
					);
					$site_name_data = $site_data['Site']['site_name'];
	        	}
	        	

	        	if($start_time!=null){
					$newDate = date("d-m-Y", strtotime($start_time));
	        		$start_time = $newDate;
	        	}
	        	else{
	        		$start_time = null;
	        	}

	        	if($end_time!=null){
	        		$newDate = date("d-m-Y", strtotime($end_time));
	        		$end_time = $newDate;
	        	}
	        	else{
	        		$end_time = null;
	        	}

	        	if($card_number!=null){
	        		$card_number_data   = $this->CardManagement->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('CardManagement.SiteModuleId' => $site_module_id),
							'fields'    => array('site_name')
						)
					);
	        	}
	        	else{
	        		$card_number = null;
	        	}

	        	if($user_type!=null){
	        		$user_type = $user_type;
	        	}
	        	else{
	        		$user_type = null;
	        	}

	        	if($open_by==1){
        			$open_by='All';
        		}
        		elseif($open_by==2){
        			$open_by='Central';
        		}
        		elseif($open_by==3){
        			$open_by='Mobile';
        		}	
	        	

	        	if($card_number!=''){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.SiteModuleId'   => $site_module_id,
							'DoorStatus.door_open_by'   => array($card_number)
						),
						'fields'    => array('site_name','door_open_by','door_open_time','door_open_user'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}
	        	elseif($user_type!=null AND $open_by=='All'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.SiteModuleId'   => $site_module_id,
							'DoorStatus.door_open_user' => $user_type
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}
	        	elseif($user_type!=null AND $open_by=='Central'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.SiteModuleId'   => $site_module_id,
							'DoorStatus.door_open_user' => $user_type,
							'DoorStatus.door_open_by'   => array($open_by)
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}
	        	elseif($user_type!=null AND $open_by=='Mobile'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.SiteModuleId'   => $site_module_id,
							'DoorStatus.door_open_user' => $user_type,
							'DoorStatus.door_open_by'   => array($open_by)
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}
	        	elseif($open_by=='All'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.SiteModuleId'   => $site_module_id
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}

	        	elseif($open_by=='Central'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.SiteModuleId'   => $site_module_id,
							'DoorStatus.door_open_by'   => array($open_by)
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}

	        	elseif($open_by=='Mobile'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.SiteModuleId'   => $site_module_id,
							'DoorStatus.door_open_by'   => array($open_by)
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}
	        	
	        	if($start_time!=null AND $end_time!=null){
	        	}
	        	//$this->set(compact('door_status_data','zone_name','sub_zone_name','site_module_id','site_name_data','start_time','end_time','user_type','card_number','zone_name_data','sub_zone_name_data'));
			}
			//$this->Paginator->settings = $door_status_data;
			//$door_status_data = $this->Paginator->paginate('DoorStatus');

			$this->set(compact('door_status_data','zone_name','sub_zone_name','site_module_id','start_time','end_time','user_type','card_number','zone_name_data','sub_zone_name_data','site_name_data'));
		}

		public function report_download(){
			if ($this->request->is('post') || $this->request->is('put')) {
				$data = $this->request->data;
				pr($data);
			}
		}

		public function get_subzone(){	
		}

		public function get_parent_zone(){	
		}

		public function select_site_value(){
		}

		public function card_number(){
		}

		public function get_site(){	
		}

		public function voltage_graph(){
			$zone_name           =  null;
			$sub_zone_name       =  null;
			$site_module_id      =  null;
			$zone_name_data      =  null;
			$sub_zone_name_data  =  null;
			$site_name_data      =  null;
			$zone_data           =  array();
			$sub_zone_data       =  array();
			$door_status_data    =  array();
			$testing_site_data   =  array();

			$this->set('zones',
				$this->Zone->find('all',
					array(
						'fields' => array('id','parent_id','name')
					)
				)
			);


			$this->set('sites',
				$this->Site->find('all',
					array(
						'fields' => array('site_name','SiteModuleId')
					)
				)
			);

			$this->set('datas',
				$this->TestingLogDevice->find('all',
					array (
						'recursive'     => -1,
						'conditions' 	=> array('TestingLogDevice.SiteModuleId' => '1238'),
						'fields'		=> array('voltage','modified'),
						'order'			=> array('id' => 'desc'),
						'limit'			=> 50
					)
				)
			);

			$voltage_flag_ini          = true;

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		           = $this->request->data;
	        	$zone_name             = $data['zone-name'];
	        	$sub_zone_name         = $data['sub-zone-name'];
	        	$site_module_id        = $data['site-name'];
	        	$status_level          = $data['status_level'];
	        	$voltage_flag          = false;
	        	$signal_strenght_flag  = false;
	        	$flag_site             = false;
	        	$flag_all              = false;

	        	if($status_level==='voltage'){
	        		$site_details 	= $this->Testing->find('first',array ('conditions' => array('Testing.SiteModuleId' =>$site_module_id)));
					$SiteModuleId 	= $site_details['Testing']['SiteModuleId'];
					$specific_site_name = $this->TestingLogDevice->findBySitemoduleid($SiteModuleId);
			 
					if (!$specific_site_name){
						$this->Session->setFlash('Invalid Site Name Provided');
						$this->redirect(array('controller'=>'testings','action'=>'dashboard'));
					}
					
					$this->set('datas',
						$this->TestingLogDevice->find('all',
							array (
								'recursive'     => -1,
								'conditions' 	=> array('TestingLogDevice.SiteModuleId' => $SiteModuleId),
								'fields'		=> array('voltage','modified'),
								'order'			=> array('id' => 'desc'),
								'limit'			=> 50
							)
						)
					);
						
					$voltage_flag       = true;
					$voltage_flag_ini   = false;	
	        	}
	        	else{
	        		$site_details 	= $this->Testing->find('first',array ('conditions' => array('Testing.SiteModuleId' => $site_module_id)));
					$SiteModuleId 	= $site_details['Testing']['SiteModuleId'];
					
					$specific_site_name = $this->TestingLogDevice->findBySitemoduleid($SiteModuleId);
			 
					if (!$specific_site_name){
						$this->Session->setFlash('Invalid Site Name Provided');
						$this->redirect(array('controller'=>'testings','action'=>'dashboard'));
					}
					
					$this->set('datas',
						$this->TestingLogDevice->find('all',
							array (
								'conditions' 	=> array('TestingLogDevice.SiteModuleId' => $SiteModuleId),
								'fields'		=> array('signal_strenght','modified'),
								'order'			=> array('id' => 'desc'),
								'limit'			=> 50
							)
						)
					);
					$signal_strenght_flag  = true;
					$voltage_flag_ini      = false;
	        	}
			}
			$this->set(compact('zone_data','testing_site_data','signal_strenght','voltage','voltage_flag','signal_strenght_flag','voltage_flag_ini','zone_name_data','sub_zone_name_data','site_name_data'));		
		}

		public function signal_graph(){
			$zone_name           =  null;
			$sub_zone_name       =  null;
			$site_module_id      =  null;
			$zone_name_data      =  null;
			$sub_zone_name_data  =  null;
			$site_name_data      =  null;
			$zone_data           =  array();
			$sub_zone_data       =  array();
			$door_status_data    =  array();
			$testing_site_data   =  array();

			$this->set('zones',
				$this->Zone->find('all',
					array(
						'recursive'=> -1,
						'fields'   => array('id','parent_id','name')
					)
				)
			);


			$this->set('sites',
				$this->Site->find('all',
					array(
						'recursive'=> -1,
						'fields' => array('site_name','SiteModuleId')
					)
				)
			);

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		           = $this->request->data;
	        	$zone_name             = $data['zone-name'];
	        	$sub_zone_name         = $data['sub-zone-name'];
	        	$site_module_id        = $data['site-name'];
	        	$voltage_flag          = false;
	        	$signal_strenght_flag  = false;
	        	$flag_site             = false;
	        	$flag_all              = false;

	        	
        		$site_details 	       = $this->Testing->find('first',array ('conditions' => array('Testing.SiteModuleId' => $site_module_id)));
				$SiteModuleId 	       = $site_details['Testing']['SiteModuleId'];
				$site_name_graph       = $site_details['Testing']['site_name'];
				
				$specific_site_name    = $this->TestingLogDevice->findBySitemoduleid($SiteModuleId);
		 
				if (!$specific_site_name){
					$this->Session->setFlash('Invalid Site Name Provided');
					$this->redirect(array('controller'=>'testings','action'=>'dashboard'));
				}
				
				$this->set('datas',
					$this->TestingLogDevice->find('all',
						array (
							'conditions' 	=> array('TestingLogDevice.SiteModuleId' => $SiteModuleId),
							'fields'		=> array('signal_strenght','modified'),
							'order'			=> array('id' => 'desc'),
							'limit'			=> 50
						)
					)
				);
				$signal_strenght_flag  = true;
				$voltage_flag_ini      = false;	
			}
			else{
				$site_details 	   = $this->Testing->find('first',array ('conditions' => array('Testing.SiteModuleId' => '1238')));
				$SiteModuleId 	   = $site_details['Testing']['SiteModuleId'];
				$site_name_graph   = $site_details['Testing']['site_name'];

				
				$specific_site_name = $this->TestingLogDevice->findBySitemoduleid($SiteModuleId);

		 
				if (!$specific_site_name){
					$this->Session->setFlash('Invalid Site Name Provided');
					$this->redirect(array('controller'=>'testings','action'=>'dashboard'));
				}
				
				$this->set('datas',
					$this->TestingLogDevice->find('all',
						array (
							'conditions' 	=> array('TestingLogDevice.SiteModuleId' => $SiteModuleId),
							'fields'		=> array('signal_strenght','modified'),
							'order'			=> array('id' => 'desc'),
							'limit'			=> 50
						)
					)
				);
			}
			$this->set(compact('zone_data','testing_site_data','signal_strenght','voltage','voltage_flag','signal_strenght_flag','voltage_flag_ini','zone_name_data','sub_zone_name_data','site_name_data','site_name_graph'));	
		}

		public function voltage_graph_2(){
			$zone_name           =  null;
			$sub_zone_name       =  null;
			$site_module_id      =  null;
			$zone_name_data      =  null;
			$sub_zone_name_data  =  null;
			$site_name_data      =  null;
			$zone_data           =  array();
			$sub_zone_data       =  array();
			$door_status_data    =  array();
			$testing_site_data   =  array();

			$this->set('zones',
				$this->Zone->find('all',
					array(
						'recursive'=> -1,
						'fields' => array('id','parent_id','name')
					)
				)
			);


			$this->set('sites',
				$this->Site->find('all',
					array(
						'recursive'=> -1,
						'fields' => array('site_name','SiteModuleId')
					)
				)
			);

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		           = $this->request->data;
	        	$zone_name             = $data['zone-name'];
	        	$sub_zone_name         = $data['sub-zone-name'];
	        	$site_module_id        = $data['site-name'];
	        	$voltage_flag          = false;
	        	$signal_strenght_flag  = false;
	        	$flag_site             = false;
	        	$flag_all              = false;

	        	
        		$site_details 	= $this->Testing->find('first',array ('conditions' => array('Testing.SiteModuleId' => $site_module_id)));
				$SiteModuleId 	= $site_details['Testing']['SiteModuleId'];
				$site_name_graph       = $site_details['Testing']['site_name'];
				
				$specific_site_name = $this->TestingLogDevice->findBySitemoduleid($SiteModuleId);
		 
				if (!$specific_site_name){
					$this->Session->setFlash('Invalid Site Name Provided');
					$this->redirect(array('controller'=>'testings','action'=>'dashboard'));
				}
				
				$this->set('datas',
					$this->TestingLogDevice->find('all',
						array (
							'conditions' 	=> array('TestingLogDevice.SiteModuleId' => $SiteModuleId),
							'fields'		=> array('voltage','modified'),
							'order'			=> array('id' => 'desc'),
							'limit'			=> 50
						)
					)
				);
				$signal_strenght_flag  = true;
				$voltage_flag_ini      = false;	
			}
			else{
				$site_details 	= $this->Testing->find('first',array ('conditions' => array('Testing.SiteModuleId' => '1238')));
				$SiteModuleId 	= $site_details['Testing']['SiteModuleId'];
				$site_name_graph       = $site_details['Testing']['site_name'];
				
				$specific_site_name = $this->TestingLogDevice->findBySitemoduleid($SiteModuleId);
		 
				if (!$specific_site_name){
					$this->Session->setFlash('Invalid Site Name Provided');
					$this->redirect(array('controller'=>'testings','action'=>'dashboard'));
				}
				
				$this->set('datas',
					$this->TestingLogDevice->find('all',
						array (
							'conditions' 	=> array('TestingLogDevice.SiteModuleId' => $SiteModuleId),
							'fields'		=> array('voltage','modified'),
							'order'			=> array('id' => 'desc'),
							'limit'			=> 50
						)
					)
				);
			}
			$this->set(compact('zone_data','testing_site_data','signal_strenght','voltage','voltage_flag','signal_strenght_flag','voltage_flag_ini','zone_name_data','sub_zone_name_data','site_name_data','site_name_graph'));	
		}

		public function signal_report(){
			$zone_name           =  null;
			$sub_zone_name       =  null;
			$site_module_id      =  null;
			$zone_name_data      =  null;
			$sub_zone_name_data  =  null;
			$site_name_data      =  null;
			$zone_data           =  array();
			$sub_zone_data       =  array();
			$door_status_data    =  array();
			$testing_site_data   =  array();
			$flag_zone           =  false;
	        $flag_sub_zone       =  false;
	        $flag_site           =  false;
	        $flag_all            =  false;

			$this->set('zones',
				$this->Zone->find('all',
					array(
						'fields' => array('id','parent_id','name')
					)
				)
			);


			$this->set('sites',
				$this->Site->find('all',
					array(
						'fields' => array('site_name','SiteModuleId')
					)
				)
			);

			$testing_site_data = $this->Testing->find('all',
				array(
					'recursive' =>-1,
					'conditions'=> array(
						'Testing.signal_strenght <='     => 20
					)
				)
			);

			$zone_data = $this->Zone->find('all',
				array(
					'recursive' =>-1,
					'fields'    => array('name','parent_id','id')
				)
			);


			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		      = $this->request->data;
	        	$zone_name        = $data['zone-name'];
	        	$sub_zone_name    = $data['sub-zone-name'];
	        	$site_signal      = $data['signal_strenght'];
	        	$flag_zone        = false;
	        	$flag_sub_zone    = false;
	        	$flag_site        = false;
	        	$flag_all         = false;
	        	//pr($data);

	        	if($zone_name!='' AND $sub_zone_name!=''){
	        		$zone_data_vall = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_vall['Zone']['name'];

	        		$zone_data_val = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $sub_zone_name),
							'fields'    => array('name','id')
						)
					);
					$sub_zone_name_data = $zone_data_val['Zone']['name'];
					$zone_id_data       = $zone_data_val['Zone']['id'];

					
					$testing_site_data = $this->Testing->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'Testing.zone_id'            => $zone_id_data,
								'Testing.signal_strenght <=' => $site_signal
							)
						)
					);
					$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
					$flag_sub_zone = true;
	        	}
	        	elseif($zone_name!=''){
	        		$zone_data_vall = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_vall['Zone']['name'];
					$zone_id        = $zone_data_vall['Zone']['id'];

					
					$testing_site_data = $this->Testing->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'Testing.zone_id'                => $zone_id,
								'Testing.signal_strenght <='     => $site_signal
							)
						)
					);	
					if(count($testing_site_data)>0){
						$site_name_data = $testing_site_data[0]['Testing']['site_name'];
					}
	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
	        		
					$flag_site = true;
	        	}
	        	else{
					$testing_site_data = $this->Testing->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'Testing.signal_strenght <='     => $site_signal
							)
						)
					);

	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
					$flag_all = true;
	        	}
			}
			$this->set(compact('zone_data','testing_site_data','flag_zone','flag_site','flag_all','flag_sub_zone','zone_name_data','sub_zone_name_data','site_name_data'));
		}

		public function live_status(){
			$this->paginate = array(
				'order' => array('Testing.site_name' => 'asc' ),
				'limit' => 20
			);
			$this->Testing->recursive = 0;
			$testing_site_info 		= $this->paginate('Testing');
			
			$active 		= $this->Testing->find('count', array('conditions' => array('Testing.status' => 1)));
			$inactive 		= $this->Testing->find('count', array('conditions' => array('Testing.status' => 0)));
			$draft 			= $this->Testing->find('count', array('conditions' => array('Testing.status' => '')));
			$this->set(compact('active','inactive','draft'));
			$this->set('sites_info', $testing_site_info);
		}

		public function door_status(){
			$this->paginate = array(
				'order' => array('Testing.site_name' => 'asc' ),
				'limit' => 13
			);
			$this->Testing->recursive = 0;
			$testing_site_info 		= $this->paginate('Testing');

			$door_close 	= $this->Testing->find('count', array('conditions' => array('Testing.door_status' => 1)));
			$door_open 		= $this->Testing->find('count', array('conditions' => array('Testing.door_status' => 2)));
			$unautorized 	= $this->Testing->find('count', array('conditions' => array('Testing.door_status' => 3)));
			$this->set(compact('door_close','door_open','unautorized'));
			$this->set('sites_info', $testing_site_info);
		}

		public function site_graphical_view(){
			$active 		= $this->Testing->find('count', array('conditions' => array('Testing.status' => 1)));
			$inactive 		= $this->Testing->find('count', array('conditions' => array('Testing.status' => 0)));
			$draft 			= $this->Testing->find('count', array('conditions' => array('Testing.status' => '')));
			$this->set(compact('active','inactive','draft'));
		}

		public function door_graphical_view(){
			$door_close 	= $this->Testing->find('count', array('conditions' => array('Testing.door_status' => 1)));
			$door_open 		= $this->Testing->find('count', array('conditions' => array('Testing.door_status' => 2)));
			$unautorized 	= $this->Testing->find('count', array('conditions' => array('Testing.door_status' => 3)));
			$this->set(compact('door_close','door_open','unautorized'));
		}

		public function site_report($con){
			if($con==1){
				$this->paginate = array(
					'order' => array('Testing.site_name' => 'asc' ),
					'limit' => 13
				);
				$this->Testing->recursive = 0;
				$device_ip 		= $this->paginate('Testing');
				$live_status 	= $this->Testing->find('all', array('conditions' => array('Testing.status' => 1)));
				$this->set(compact('live_status'));
				$this->set('zones', $device_ip);
			}
			elseif($con==2){
				$this->paginate = array(
					'order' => array('Testing.site_name' => 'asc' ),
					'limit' => 13
				);
				$this->Testing->recursive = 0;
				$device_ip 		= $this->paginate('Testing');
				$live_status 	= $this->Testing->find('all', array('conditions' => array('Testing.status' => 0)));
				$this->set(compact('live_status'));
				$this->set('zones', $device_ip);
			}
			elseif($con==3){
				$this->paginate = array(
					'order' => array('Testing.site_name' => 'asc' ),
					'limit' => 13
				);
				$this->Testing->recursive = 0;
				$device_ip 		= $this->paginate('Testing');
				$live_status 	= $this->Testing->find('all', array('conditions' => array('Testing.status' => '')));
				$this->set(compact('live_status'));
				$this->set('zones', $device_ip);
			}
			elseif($con==4){
				$this->paginate = array(
					'order' => array('Testing.site_name' => 'asc' ),
					'limit' => 13
				);
				$this->Testing->recursive = 0;
				$device_ip 		= $this->paginate('Testing');
				$live_status 	= $this->Testing->find('all', array('conditions' => array('Testing.door_status' => '1')));
				$this->set(compact('live_status'));
				$this->set('zones', $device_ip);
			}
			elseif($con==5){
				$this->paginate = array(
					'order' => array('Testing.site_name' => 'asc' ),
					'limit' => 13
				);
				$this->Testing->recursive = 0;
				$device_ip 		= $this->paginate('Testing');
				$live_status 	= $this->Testing->find('all', array('conditions' => array('Testing.door_status' => '2')));
				$this->set(compact('live_status'));
				$this->set('zones', $device_ip);
			}
			elseif($con==6){
				$this->paginate = array(
					'order' => array('Testing.site_name' => 'asc' ),
					'limit' => 13
				);
				$this->Testing->recursive = 0;
				$device_ip 		= $this->paginate('Testing');
				$live_status 	= $this->Testing->find('all', array('conditions' => array('Testing.door_status' => '3')));
				$this->set(compact('live_status'));
				$this->set('zones', $device_ip);
			}
		}

		public function download_log($id){
			if (!$id){
				$this->Session->setFlash('Please provide a valid Site name');
				$this->redirect(array('controller'=>'testings','action'=>'dashboard'));
			}

			$detailss = $this->Testing->find(
				'first',
				array(
					'recursive' => -1,
					'conditions' => array(
						'id' => $id		
					)		
				)	
			);
			$site_name = $detailss['Testing']['SiteModuleId'];
			$results = $this->DoorStatus->find('all',array ('conditions' => array('SiteModuleId' => $site_name)));
            $filename = "myfile.xsl";
            //$start_date = '2012-10-08 00:00:00';
            //$end_date = '2012-10-08 23:59:59';
            //$results = $this->Member->find('all', array('conditions' => array('Member.created >=' => $start_date,'Member.created <=' => $end_date)));
            $csv_file = fopen('php://output', 'w');
            header('Content-type: application/xls');
            header('Content-Disposition: attachment; filename="'.$filename.'"');
            $header_row = array("site_name","SiteModuleId","door_open_by");
            fputcsv($csv_file,$header_row,',','"');
            foreach($results AS $result) {
                $row = array(
                $result['DoorStatus']['site_name'],
                $result['DoorStatus']['SiteModuleId'],
                $result['DoorStatus']['door_open_by']
                );
                fputcsv($csv_file,$row,',','"');
            }
            fclose($csv_file);
	        $this->layout = false;
	        $this->render(false);
	        return false;
		}

		public function user_report(){
			$door_status_data  = array();
			$user_type		   = null;
			$open_by		   = null;
			$user_report_flag  = false; 
			$this->set('users',
				$this->User->find('all',
					array(
						'fields' => array('User.username','User.id')
					)
				)
			);

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		      = $this->request->data;
	        	//pr($data);
	        	$user_type        = $data['user-type'];
	        	$open_by          = $data['door_open_by'];
	        	$flag             = false;

	        	if($open_by==1){
        			$open_by='All';
        		}
        		elseif($open_by==2){
        			$open_by='Central';
        		}
        		elseif($open_by==3){
        			$open_by='Mobile';
        		}

	        	if($user_type!=null AND $open_by=='All'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.door_open_user' => $user_type
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}
	        	elseif($user_type!=null AND $open_by=='Central'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.door_open_user' => $user_type,
							'DoorStatus.door_open_by'   => array($open_by)
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}
	        	elseif($user_type!=null AND $open_by=='Mobile'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.door_open_user' => $user_type,
							'DoorStatus.door_open_by'   => array($open_by)
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}
	        	$user_report_flag  = true;
			}
			else{
				$door_status_data = array(
				    'recursive' =>-1,
					'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
					'limit'     => 20
				);
				$this->Paginator->settings = $door_status_data;
				$door_status_data = $this->Paginator->paginate('DoorStatus');
			}
			//pr($door_status_data);

			$this->set(compact('door_status_data','user_type','open_by', 'card_number','user_report_flag'));
		}

		public function group_report(){
		}

		public function door_report(){
		}

		public function site_report_2(){
		}

		public function regional_report(){
			$door_status_data     = array();
			$zone_name            = null;
			$sub_zone_name        = null;
			$site_module_id       = null;
			$site_name_data       = null;
			$start_time           = null;
			$end_time 			  = null;
			$user_type			  = null;
			$card_number		  = null;
			$zone_name_data		  = null;
			$sub_zone_name_data	  = null;
			$regional_report_flag = false;

			$this->set('zones',
				$this->Zone->find('all',
					array(
						'fields' => array('id','parent_id','name')
					)
				)
			);

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		      = $this->request->data;
	        	$zone_name        = $data['zone-name'];
	        	$sub_zone_name    = $data['sub-zone-name'];
	        	$flag             = false;

	        	if($zone_name!='' && $sub_zone_name!=''){
	        		$zone_data = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data['Zone']['name'];


	        		$sub_zone_data = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $sub_zone_name),
							'fields'    => array('name','id')
						)
					);
					$sub_zone_name_data = $sub_zone_data['Zone']['name'];	

					$site_name_data = $this->Site->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array('Site.zone_id' => $sub_zone_data['Zone']['id'])
						)
					);
	        	}
	        	elseif($zone_name!=''){
	        		$zone_data = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data['Zone']['name'];

					$site_name_data = $this->Site->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array('Site.zone_id' => $zone_data['Zone']['id'])
						)
					);
	        	}

	        	if(count($site_name_data)>0){
	        		foreach ($site_name_data as $key => $value) {
		        		$door_status_data[$key] = $this->DoorStatus->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array('DoorStatus.site_name' => $value['Site']['site_name'])
							)
						);
		        	}
	        	}
	        	$regional_report_flag = true;	
			}
			else{
				$door_status_data = $this->DoorStatus->find('all',
					array(
						'recursive' =>-1,
					)
				);
			}
			//pr($door_status_data);

			$this->set(compact('door_status_data','zone_name','sub_zone_name','site_module_id','start_time','end_time','user_type','card_number','zone_name_data','sub_zone_name_data','site_name_data','regional_report_flag'));
		}

		public function vendor_report(){	
			$door_status_data	= array();
			$user_type			= null;
			$open_by			= null;
			$vendor_report_flag = false;
			$this->set('vendorType',
				$this->CardManagement->find('all',
					array(
						'fields' => array( 'DISTINCT  CardManagement.vendor_name')
					)
				)
			);

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		      = $this->request->data;
	        	//pr($data);
	        	$user_type        = $data['user-type'];
	        	$open_by          = $data['door_open_by'];
	        	$flag             = false;

	        	if($open_by==1){
        			$open_by='All';
        		}
        		elseif($open_by==2){
        			$open_by='Central';
        		}
        		elseif($open_by==3){
        			$open_by='Mobile';
        		}

	        	if($user_type!=null AND $open_by=='All'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.door_open_user' => $user_type
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}
	        	elseif($user_type!=null AND $open_by=='Central'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.door_open_user' => $user_type,
							'DoorStatus.door_open_by'   => array($open_by)
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}
	        	elseif($user_type!=null AND $open_by=='Mobile'){
	        		$door_status_data = array(
					    'recursive' =>-1,
						'conditions'=> array(
							'DoorStatus.door_open_user' => $user_type,
							'DoorStatus.door_open_by'   => array($open_by)
						),
						'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
						'limit'     => 20
					);
					$this->Paginator->settings = $door_status_data;
					$door_status_data = $this->Paginator->paginate('DoorStatus');
	        	}
	        	$vendor_report_flag = true;
			}
			else{
				$door_status_data = array(
				    'recursive' =>-1,
					'fields'    => array('site_name','door_open_user','door_open_by','door_open_time'),
					'limit'     => 20
				);
				$this->Paginator->settings = $door_status_data;
				$door_status_data = $this->Paginator->paginate('DoorStatus');
			}
			//pr($door_status_data);

			$this->set(compact('door_status_data','user_type','open_by', 'card_number','vendor_report_flag'));
		}

		public function job_report(){	
		}

		public function attend_report(){	
			$zone_name           =  null;
			$sub_zone_name       =  null;
			$site_module_id      =  null;
			$zone_name_data      =  null;
			$sub_zone_name_data  =  null;
			$site_name_data      =  null;
			$zone_data           =  array();
			$sub_zone_data       =  array();
			$door_status_data    =  array();
			$assignedCardList    =  array();
			$flag_zone        	 =  false;
        	$flag_sub_zone    	 =  false;
        	$flag_site        	 =  false;
        	$flag_all         	 =  false;

			$this->set('zones',
				$this->Zone->find('all',
					array(
						'fields' => array('id','parent_id','name')
					)
				)
			);


			$this->set('sites',
				$this->Site->find('all',
					array(
						'fields' => array('site_name','SiteModuleId')
					)
				)
			);

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		      = $this->request->data;
	        	$zone_name        = $data['zone-name'];
	        	$sub_zone_name    = $data['sub-zone-name'];
	        	$site_module_id   = $data['site-name'];
	        	$flag_zone        = false;
	        	$flag_sub_zone    = false;
	        	$flag_site        = false;
	        	$flag_all         = false;
	        	//pr($data);

	        	if($zone_name!='' AND $sub_zone_name!=''){
	        		if($site_module_id!=''){
	        			$site_data = $this->Site->find('first',
							array(
								'recursive' =>-1,
								'conditions'=> array('Site.SiteModuleId' => $site_module_id)
							)
						);
						$site_name_data = $site_data['Site']['site_name'];
	        		}

	        		$zone_data_vall = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_vall['Zone']['name'];

	        		$zone_data_val = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $sub_zone_name),
							'fields'    => array('name','id')
						)
					);
					$sub_zone_name_data = $zone_data_val['Zone']['name'];
					$zone_id_data       = $zone_data_val['Zone']['id'];

					$assignedCardList = $this->AssignedCard->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'AssignedCard.zone_id'   => $zone_id_data
							)
						)
					);

					$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
					$flag_sub_zone = true;
	        	}
	        	elseif($zone_name!='' AND $site_module_id!=''){
	        		$zone_data_vall = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_vall['Zone']['name'];

					$assignedCardList = $this->AssignedCard->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'AssignedCard.SiteModuleId'   => $site_module_id
							)
						)
					);

					if(count($assignedCardList)>0){
						$site_name_data = $assignedCardList[0]['AssignedCard']['site_name'];
					}

	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
	        		
					$flag_site = true;
	        	}
	        	elseif($zone_name!=''){
	        		$zone_data_val = $this->Zone->find('first',
						array(
							'recursive' =>-1,
							'conditions'=> array('Zone.id' => $zone_name),
							'fields'    => array('name','id')
						)
					);
					$zone_name_data = $zone_data_val['Zone']['name'];
					$zone_id_data   = $zone_data_val['Zone']['id'];

					$site_data = $this->Site->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array('Site.zone_id' => $zone_id_data),
							'fields'    => array('site_name','id','SiteModuleId')
						)
					);

					$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);

					foreach ($site_data as $key => $value) {
						$assignedCardList[$key] = $this->AssignedCard->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array(
									'AssignedCard.SiteModuleId'   => $value['Site']['SiteModuleId']
								)
							)
						);
					}
					$flag_zone = true;
					//pr($assignedCardList);
	        	}
	        	elseif($site_module_id!=''){
        			$assignedCardList = $this->AssignedCard->find('all',
						array(
							'recursive' =>-1,
							'conditions'=> array(
								'AssignedCard.SiteModuleId'   => $site_module_id
							)
						)
					);
        			//pr($assignedCardList);
					
					if(count($assignedCardList)>0){
						$site_name_data = $assignedCardList[0]['AssignedCard']['site_name'];
					}
					
	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);
					$flag_site = true;
	        	}
	        	//pr($testing_site_data);
			}
			else{
				$zone_data = $this->Zone->find('all',
					array(
						'recursive' =>-1,
						'fields'    => array('name','parent_id','id')
					)
				);

				$assignedCardList = $this->AssignedCard->find('all',
					array(
						'recursive' =>-1
					)
				);
				//pr($assignedCardList);
			}

			$this->set(compact('zone_data','assignedCardList','flag_zone','flag_site','flag_all','flag_sub_zone','zone_name_data','sub_zone_name_data','site_name_data'));
		}

		private function create_log_value($value,$site_id){
			if($value ==  'SiteModuleId'){
				$site_id_data = $this->TestingLogDevice->find('all',
					array (
						'conditions' 	=> array('SiteModuleId' => $site_id),
						'fields'		=> array('SiteModuleId'),
						'order'			=> array('id' => 'desc'),
						'limit'			=> 200
					)
				);				
				return $site_id_data;
			}

			elseif($value  ==  'status'){
				$status = $this->TestingLogDevice->find('all',
					array (
						'conditions' 	=> array('SiteModuleId' => $site_id),
						'fields'		=> array('status'),
						'order'			=> array('id' => 'desc'),
						'limit'			=> 200
					)
				);				
				return $status;
			}

			elseif($value  ==  'signal_strenght'){
				$tempin_data = $this->TestingLogDevice->find('all',
					array (
						'conditions' 	=> array('SiteModuleId' => $site_id),
						'fields'		=> array('signal_strenght'),
						'order'			=> array('id' => 'desc'),
						'limit'			=> 200
					)
				);				
				return $tempin_data;
			}
 
			elseif($value ==  'voltage'){
				$tempout_data = $this->TestingLogDevice->find('all',
					array (
						'conditions' 	=> array('SiteModuleId' => $site_id),
						'fields'		=> array('voltage'),
						'order'			=> array('id' => 'desc'),
						'limit'			=> 200
					)
				);				
				return $tempout_data;
			}

			elseif($value ==  'door_open_by'){
				$water_data = $this->TestingLogDevice->find('all',
					array (
						'conditions' 	=> array('SiteModuleId' => $site_id),
						'fields'		=> array('door_open_by'),
						'order'			=> array('id' => 'desc'),
						'limit'			=> 200
					)
				);				
				return $water_data;
			}

			elseif($value ==   'door_status'){
				$humidity_data = $this->TestingLogDevice->find('all',
					array (
						'conditions' 	=> array('SiteModuleId' => $site_id),
						'fields'		=> array('door_status'),
						'order'			=> array('id' => 'desc'),
						'limit'			=> 200
					)
				);				
				return $humidity_data;
			}

			elseif($value ==   'card_reader'){
				$door_data = $this->TestingLogDevice->find('all',
					array (
						'conditions' 	=> array('SiteModuleId' => $site_id),
						'fields'		=> array('card_reader'),
						'order'			=> array('id' => 'desc'),
						'limit'			=> 200
					)
				);	
				return $door_data;
			}

			elseif($value ==   'alarm_1'){
				$ac1_data = $this->TestingLogDevice->find('all',
					array (
						'conditions' 	=> array('SiteModuleId' => $site_id),
						'fields'		=> array('alarm_1'),
						'order'			=> array('id' => 'desc'),
						'limit'			=> 200
					)
				);
				return $ac1_data;	
			}

			elseif($value ==   'alarm_2'){
				$ac2_data = $this->TestingLogDevice->find('all',
					array (
						'conditions' 	=> array('SiteModuleId' => $site_id),
						'fields'		=> array('alarm_2'),
						'order'			=> array('id' => 'desc'),
						'limit'			=> 200
					)
				);
				return $ac2_data;
			}

			elseif($value ==   'alarm_3'){
				$ac3_data = $this->TestingLogDevice->find('all',
					array (
						'conditions' 	=> array('SiteModuleId' => $site_id),
						'fields'		=> array('alarm_3'),
						'order'			=> array('id' => 'desc'),
						'limit'			=> 200
					)
				);
				return $ac3_data;
			}

			elseif($value ==   'alarm_4'){
				$ac4_data = $this->TestingLogDevice->find('all',
					array (
						'conditions' 	=> array('SiteModuleId' => $site_id),
						'fields'		=> array('alarm_4'),
						'order'			=> array('id' => 'desc'),
						'limit'			=> 200
					)
				);
				return $ac4_data;
			}

			elseif($value ==   'alarm_5'){
				$ac5_data = $this->TestingLogDevice->find('all',
					array (
						'conditions' 	=> array('SiteModuleId' => $site_id),
						'fields'		=> array('alarm_5'),
						'order'			=> array('id' => 'desc'),
						'limit'			=> 200
					)
				);
				return $ac5_data;
			}

			elseif($value ==   'alarm_6'){
				$dvs_1_data = $this->TestingLogDevice->find('all',
					array (
						'conditions' 	=> array('SiteModuleId' => $site_id),
						'fields'		=> array('alarm_6'),
						'order'			=> array('id' => 'desc'),
						'limit'			=> 200
					)
				);
				return $dvs_1_data;
			}

			elseif($value ==   'modified'){
				$time_data = $this->TestingLogDevice->find('all',
					array (
						'conditions' 	=> array('SiteModuleId' => $site_id),
						'fields'		=> array('modified'),
						'order'			=> array('id' => 'desc'),
						'limit'			=> 200
					)
				);				
				return $time_data;
			}
		}
	}