<?php
	App::uses('AppController', 'Controller');
	App::uses('CakeTime', 'Utility');

	class AlarmsController extends AppController {
		public $uses = array('Zone','Testing','Site','DeviceCard','ZoneCard','LiveStatus','TestingLogDevice','DoorStatus','User','CardManagement','AlarmOne','AlarmTwo','AlarmThree','AlarmFour','AlarmFive','AlarmSix');
		//public $uses = array('BaseStation','CardReader','CardManagement','Card','Zone','Testing','Site','DeviceCard','ZoneCard','LiveStatus','TestingLogDevice');
		public $components = array('Paginator', 'Session','RequestHandler');
		public $helpers 	= array('Html','Form','Zoneeetree','Csv');

		public function index(){
		}

		public function active_alarm(){
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

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		      = $this->request->data;
	        	$zone_name        = $data['zone-name'];
	        	$sub_zone_name    = $data['sub-zone-name'];
	        	$site_module_id   = $data['site-name'];
	        	$flag_zone        = false;
	        	$flag_sub_zone    = false;
	        	$flag_site        = false;
	        	$flag_all         = false;

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

					/*if($open_by==1){
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
					$flag_sub_zone = true;*/
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

	        		/*if($open_by==1){
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
					$flag_site = true;*/
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
						$testing_site_data[$key] = $this->AlarmOne->find('all',
							array(
								'recursive' =>-1,
								'conditions'=> array('AlarmOne.SiteModuleId' => $value['Site']['SiteModuleId'])
							)
						);
					}






					/*if($open_by==1){
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
					$flag_zone = true;*/
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

	        		/*if($open_by==1){
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
					$flag_site = true;*/
	        	}
	        	else{
	        		$zone_data = $this->Zone->find('all',
						array(
							'recursive' =>-1,
							'fields'    => array('name','parent_id','id')
						)
					);

	        		/*if($open_by==1){
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
					$flag_all = true;*/
	        	}
			}
			//$this->set(compact('zone_data','door_status_data','zone_name','sub_zone_name','site_module_id','site_name_data','start_time','end_time','user_type','card_number','zone_name_data','sub_zone_name_data','testing_site_data','flag_zone','flag_site','flag_all','flag_sub_zone'));

			$this->set(compact('zone_data','testing_site_data','flag_zone','flag_site','flag_all','flag_sub_zone','zone_name_data','sub_zone_name_data','site_name_data'));
		}

		public function release_alarm(){
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

			if ($this->request->is('post') || $this->request->is('put')) {
	        	$data 		      = $this->request->data;
	        	$zone_name        = $data['zone-name'];
	        	$sub_zone_name    = $data['sub-zone-name'];
	        	$site_module_id   = $data['site-name'];
	        	$open_by          = $data['door_open_by'];
	        	$start_time       = $data['start-time'];
	        	$end_time         = $data['end-time'];
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
			//$this->set(compact('zone_data','door_status_data','zone_name','sub_zone_name','site_module_id','site_name_data','start_time','end_time','user_type','card_number','zone_name_data','sub_zone_name_data','testing_site_data','flag_zone','flag_site','flag_all','flag_sub_zone'));

			$this->set(compact('zone_data','testing_site_data','flag_zone','flag_site','flag_all','flag_sub_zone','zone_name_data','sub_zone_name_data','site_name_data'));
		}		
	}
?>