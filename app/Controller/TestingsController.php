<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');

class TestingsController extends AppController {


	public $uses = array('Zonee','Testing','Site','LiveStatus','TestingLogDevice','DeadList','UsedFuel','MonthlyReports','MonthlyReports');

	public $components = array('Paginator', 'Session','Zonetree');

	var $helpers = array('Html', 'Form','Csv');

	public function dashboard(){
		$this->paginate = array(
			'order' => array('Testing.site_name' => 'asc' ),
			'limit' => 13
		);
		$this->Testing->recursive = 0;
		$device_ip 		= $this->paginate('Testing');

		$active 		= $this->Testing->find('count', array('conditions' => array('Testing.status' => 1)));
		$inactive 		= $this->Testing->find('count', array('conditions' => array('Testing.status' => 0)));
		$draft 			= $this->Testing->find('count', array('conditions' => array('Testing.status' => '')));

		$live_statuss 	= $this->Testing->find('all', 
			array(
				'fields'     =>   array('site_name','status','modified','full_date_time')
			)
		);


		$this->set(compact('active','inactive','draft','live_statuss'));
		$this->set('zones', $device_ip);
	}

	public function index() {
		$this->layout = "dashboard_test";
		$this->paginate = array(
			'order' => array('Testing.site_name' => 'asc' ),
			'limit' => 13
		);
		$this->Testing->recursive = 0;
		$device_ip = $this->paginate('Testing');
		$this->set('zones', $device_ip);
		$active 		= $this->Testing->find('count', array('conditions' => array('Testing.status' => 1)));
		$live_statuss 	= $this->Testing->find('all', array('conditions' =>   array('Testing.status' => 1)));
		$inactive 		= $this->Testing->find('count', array('conditions' => array('Testing.status' => 0)));
		$draft 			= $this->Testing->find('count', array('conditions' => array('Testing.status' => '')));
		$this->set(compact('active','inactive','draft','live_statuss'));
	}

	public function fixed_device($id){
		if (!$this->Testing->exists($id)) {
			throw new NotFoundException(__('Invaild Configuration'));
		}
		$details_val = $this->Testing->find(
			'first',
			array(
				'recursive' => -1,
				'conditions' => array(
					'id' => $id		
				)		
			)	
		);
		//pr($details_val);

		$site_name = $details_val['Testing']['site_name'];

		$this->paginate = array(
			'conditions' => array(
				'TestingLogDevice.SiteModuleId' => $details_val['Testing']['SiteModuleId']		
			),
			'order' => array('TestingLogDevice.id' => 'desc' ),
			'limit' => 15
		);
		$this->TestingLogDevice->recursive = 0;
		$details = $this->paginate('TestingLogDevice');
		//pr($details);
		$this->set(compact('details','site_name'));
	}

	public function dead_list($id=null){

		$testingId = $this->Testing->find('first',
			array(
				'conditions' =>array(
					'Testing.id' => $id
				)
				
			)
		);

		//pr($testingId);

		$options 	= 	$this->DeadList->find('all',
			array(
				'conditions' => array(
			        'DeadList.Siteid' => $testingId['Testing']['SiteModuleId']
			    ),
				'order' => array(
					'DeadList.id' => 'DESC'
				),
				'fields'	=> array(
			    	'site_name','start_time','end_time','time_duration','active_one'
			    ),
			)
		);
		
		$this->set('datas', $options);
	}

	public function daily_used_fuel($id=null,$date_time=null){

		if($date_time!=null){
			$mnthName = explode('-',$date_time);

			$testingId = $this->Testing->find('first',
				array(
					'conditions' =>array(
						'Testing.id' => $id
					)
					
				)
			);

			if($mnthName[0]=='January'){
				$daily_used_fuel = $this->UsedFuel->query("SELECT * FROM used_fuels WHERE site_id = ".$testingId['Testing']['SiteModuleId']." AND MONTH(todays_date_time) = 1 ORDER BY id DESC" );
			}
			elseif($mnthName[0]=='February'){
				$daily_used_fuel = $this->UsedFuel->query("SELECT * FROM used_fuels WHERE site_id = ".$testingId['Testing']['SiteModuleId']." AND MONTH(todays_date_time) = 2 ORDER BY id DESC");
			}
			elseif($mnthName[0]=='March'){
				$daily_used_fuel = $this->UsedFuel->query("SELECT * FROM used_fuels WHERE site_id = ".$testingId['Testing']['SiteModuleId']." AND MONTH(todays_date_time) = 3 ORDER BY id DESC");
			}
			elseif($mnthName[0]=='April'){
				$daily_used_fuel = $this->UsedFuel->query("SELECT * FROM used_fuels WHERE site_id = ".$testingId['Testing']['SiteModuleId']." AND MONTH(todays_date_time) = 4 ORDER BY id DESC");
			}
			elseif($mnthName[0]=='May'){
				$daily_used_fuel = $this->UsedFuel->query("SELECT * FROM used_fuels WHERE site_id = ".$testingId['Testing']['SiteModuleId']." AND MONTH(todays_date_time) = 5 ORDER BY id DESC");
			}
			elseif($mnthName[0]=='June'){
				$daily_used_fuel = $this->UsedFuel->query("SELECT * FROM used_fuels WHERE site_id = ".$testingId['Testing']['SiteModuleId']." AND MONTH(todays_date_time) = 6 ORDER BY id DESC");
			}
			elseif($mnthName[0]=='July'){
				$daily_used_fuel = $this->UsedFuel->query("SELECT * FROM used_fuels WHERE site_id = ".$testingId['Testing']['SiteModuleId']." AND MONTH(todays_date_time) = 7 ORDER BY id DESC");
			}
			elseif($mnthName[0]=='August'){
				$daily_used_fuel = $this->UsedFuel->query("SELECT * FROM used_fuels WHERE site_id = ".$testingId['Testing']['SiteModuleId']." AND MONTH(todays_date_time) = 8 ORDER BY id DESC");
			}
			elseif($mnthName[0]=='September'){
				$daily_used_fuel = $this->UsedFuel->query("SELECT * FROM used_fuels WHERE site_id = ".$testingId['Testing']['SiteModuleId']." AND MONTH(todays_date_time) = 9 ORDER BY id DESC");
			}
			elseif($mnthName[0]=='October'){
				$daily_used_fuel = $this->UsedFuel->query("SELECT * FROM used_fuels WHERE site_id = ".$testingId['Testing']['SiteModuleId']." AND MONTH(todays_date_time) = 10 ORDER BY id DESC");
			}
			elseif($mnthName[0]=='November'){
				$daily_used_fuel = $this->UsedFuel->query("SELECT * FROM used_fuels WHERE site_id = ".$testingId['Testing']['SiteModuleId']." AND MONTH(todays_date_time) = 11 ORDER BY id DESC");
			}
			elseif($mnthName[0]=='December'){
				$daily_used_fuel = $this->UsedFuel->query("SELECT * FROM used_fuels WHERE site_id = ".$testingId['Testing']['SiteModuleId']." AND MONTH(todays_date_time) = 12 ORDER BY id DESC");
			}

			$monthly_used_fuels = array();
			foreach ($daily_used_fuel as $key => $value) {
				foreach ($value as $key => $value2) {
					$monthly_used_fuels[] = $value2;
				}
			}
			$this->set(compact('monthly_used_fuels','testingId'));
		}
		else{
			$testingId = $this->Testing->find('first',
				array(
					'conditions' =>array(
						'Testing.id' => $id
					)
					
				)
			);

			$daily_used_fuel 	= 	$this->UsedFuel->find('all',
				array(
					'conditions' => array(
				        'UsedFuel.site_id' => $testingId['Testing']['SiteModuleId']
				    ),
					'order' => array(
						'UsedFuel.id' => 'DESC'
					),
					'fields'	=> array(
				    	'site_id','site_name','used_fuel_perday','todays_date','fuel_flag','current_fuel_litre'
				    ),
				)
			);

			$monthly_used_fuels = array();
			foreach ($daily_used_fuel as $key => $value) {
				foreach ($value as $key => $value2) {
					$monthly_used_fuels[] = $value2;
				}
			}

			$this->set(compact('monthly_used_fuels','testingId'));
		}
	}

	public function monthly_used_fuel($id=null){

		$month = $this->MonthlyReports->find('all');
		pr($month);

		$testingId = $this->Testing->find('first',
			array(
				'conditions' =>array(
					'Testing.id' => $id
				)
				
			)
		);

		$daily_used_fuel 	= 	$this->UsedFuel->find('all',
			array(
				'conditions' => array(
			        'UsedFuel.site_id' => $testingId['Testing']['SiteModuleId']
			    ),
				'order' => array(
					'UsedFuel.id' => 'DESC'
				),
				'fields'	=> array(
			    	'site_id','used_fuel_perday','todays_date'
			    ),
			)
		);

		$used_fuel_per_month_sql = $this->UsedFuel->query("SELECT SUM(`used_fuel_perday`) AS total_used_fuel_per_month, DATE_FORMAT(`todays_date_time`,'%M') AS month FROM used_fuels WHERE site_id=".$testingId['Testing']['SiteModuleId']." GROUP BY DATE_FORMAT(`todays_date_time`, '%Y-%m')");

		//pr($used_fuel_per_month_sql);

		$previous_six_months    = array();
  		$monthly_used_fuelsVal  = array();
  		$monthly_used_fuels     = array();
  		
		$previous_six_months[] = date('F');

        $dateTime = new DateTime('first day of this month');
		$database_month_name = array();
		for ($i = 1; $i <= 6; $i++) {
            $dateTime->modify('-1 month');
		    $previous_six_months[] = $dateTime->format('F');
		}
		

		foreach ($previous_six_months as $key => $monthName) {

			foreach ($used_fuel_per_month_sql as $key => $value) {
			    
				if($monthName === $value[0]['month']){
				    array_push($monthly_used_fuelsVal,$value);
				    
				}
				else{
				}	
			}	
		}
		
		foreach ($monthly_used_fuelsVal as $key => $usedFuelData) {
		    
		    foreach ($usedFuelData as $key => $usedFuelVal) {
		        
		        array_push($monthly_used_fuels,$usedFuelVal);
		    
		    }
		    
		}
		
		//pr($monthly_used_fuels);

		if(count($monthly_used_fuels)>0){
			$this->set(compact('monthly_used_fuels','id','daily_used_fuel'));
		}
		else{
			$this->Session->setFlash('The site could not be Found');
			$this->redirect(['action' => 'dashboard']);
		}	
	}

	public function ajaxRequest($id){

		header('Content-Type: application/json');
		$this->autoRender = false; // We don't render a view in this example
		$this->request->onlyAllow('ajax'); // No direct access via browser URL - Note for Cake2.5: allowMethod()

		$testingId = $this->Testing->find('first',
			array(
				'conditions' =>array(
					'Testing.id' => $id
				)	
			)
		);

		$daily_used_fuel 	= 	$this->UsedFuel->find('all',
			array(
				'conditions' => array(
			        'UsedFuel.site_id' => $testingId['Testing']['SiteModuleId']
			    ),
				'order' => array(
					'UsedFuel.id' => 'DESC'
				),
				'fields'	=> array(
			    	'site_id','site_name','used_fuel_perday','todays_date','fuel_flag','current_fuel_litre'
			    ),
			)
		);

		$data = array();

		foreach ($daily_used_fuel as $key => $value) {
		    if($value['UsedFuel']['used_fuel_perday']<1){
		        $data[] = array(
    		        'title' => '0.00',
    		        'start' => date('Y,m,d', strtotime($value['UsedFuel']['todays_date']))
    		    );  
		    }
		    else{
    			$data[] = array(
    		        'title' => number_format($value['UsedFuel']['used_fuel_perday'],0),
    		        'start' => date('Y,m,d', strtotime($value['UsedFuel']['todays_date']))
    		    );
		    }
		}

	    return json_encode($data);
	}

	public function action_controller(){
		$this->paginate = array(
			'order' => array('Testing.site_name' => 'asc' ),
			'limit' => 13
		);
		$this->Testing->recursive = 0;
		$device_ip = $this->paginate('Testing');
		$active = $this->Testing->find('count', array('conditions' => array('Testing.status' => 1)));
		$inactive = $this->Testing->find('count', array('conditions' => array('Testing.status' => 0)));
		$draft = $this->Testing->find('count', array('conditions' => array('Testing.status' => '')));
		$this->set(compact('active','inactive','draft'));
		$this->set('zones', $device_ip);
	}

	public function search_bts(){
		if($this->request->is('post')){
			$data = $this->request->data;
			//pr($data);
			$search_data = $this->paginate = array(
				'conditions'	=> array(
					'OR' => array(
						'Testing.site_name like' 		=> "%".$data['Testing']['keywords']."%",
					)
				)
			);
			$this->Testing->recursive = 0;
			$zones = $this->paginate('Testing');

			
			$active 		= $this->Testing->find('count', array('conditions' => array('Testing.status' => 1)));
			$inactive 		= $this->Testing->find('count', array('conditions' => array('Testing.status' => 0)));
			$draft 			= $this->Testing->find('count', array('conditions' => array('Testing.status' => '')));

			$live_statuss 	= $this->Testing->find('all', 
				array(
					'fields'     =>   array('site_name','status','modified','full_date_time')
				)
			);

			$this->set(compact('zones','active','inactive','draft','live_statuss'));
			$this->render('dashboard');
			
		}
		else
		{
			$this->Session->setFlash('The site could not be Found');
			$this->redirect('dashboard');
		}
	}

	public function used_fuel_by_date(){

		if($this->request->is('post')){

			$data = $this->request->data;
			
			$start_date_format =  str_replace("/","-",$data['start_date']);
			
			$end_date_format   =  str_replace("/","-",$data['end_date']);

			if(strtotime($start_date_format)>strtotime($end_date_format)){

				$testingId = $this->Testing->find('first',
					array(
						'conditions' =>array(
							'Testing.SiteModuleId' =>$data['site_id']
						)
						
					)
				);

				$this->Session->setFlash('Start date must  be less than End date, Please again try');
				$this->redirect(['action' => 'daily_used_fuel', $testingId['Testing']['id']]);
				//$this->redirect($this->referer());
			}
			else{

				$testingId = $this->Testing->find('first',
					array(
						'conditions' =>array(
							'Testing.SiteModuleId' =>$data['site_id']
						)
						
					)
				);


				$start_date = date("Y-m-d", strtotime($start_date_format));
				$end_date 	= date("Y-m-d", strtotime($end_date_format));
				
				$conditions = array('UsedFuel.todays_date_time BETWEEN ? and ?' => array($start_date, $end_date));


				$daily_used_fuel = $this->UsedFuel->find('all', 
					array(
						
						'conditions'=>array($conditions, 'UsedFuel.site_id'=>$data['site_id']),
						'order' => array(
							'UsedFuel.id' => 'DESC'
						),
						'fields'	=> array(
							'site_id','site_name','used_fuel_perday','todays_date','fuel_flag','current_fuel_litre'
						),
						
					)
				);

				$monthly_used_fuels = array();
				foreach ($daily_used_fuel as $key => $value) {
					foreach ($value as $key => $value2) {
						$monthly_used_fuels[] = $value2;
					}
				}


				if($start_date==$end_date){

					$end_date_id = $this->UsedFuel->find('first',
						array(
							'conditions' =>array(
								'UsedFuel.site_id' 		    => $data['site_id'],
								'UsedFuel.todays_date_time' => $end_date,
								
								
							)
							
						)
					);

					if(count($end_date_id)>0){

						if($end_date_id['UsedFuel']['fuel_flag']==1){ 
						
							$total_used_fuel = $end_date_id['UsedFuel']['used_fuel_perday'];
						}
						else{
							$total_used_fuel = $end_date_id['UsedFuel']['used_fuel_perday'];
						}
					}
					else{
					    
						$total_used_fuel=0;
						
					}	
				}
				else{

					$conditions = array('UsedFuel.todays_date_time BETWEEN ? and ?' => array($start_date, $end_date));

					$total = $this->UsedFuel->find('all', 
						array(
							
							'fields' => array('sum(UsedFuel.used_fuel_perday)  AS totalused'), 
							'conditions'=>array($conditions, 'UsedFuel.site_id'=>$data['site_id'])
							
						)
					);
					
					$total_used_fuel = $total[0][0]['totalused'];
				}
				
				$this->set(compact('monthly_used_fuels','testingId','total_used_fuel'));
				$this->render('daily_used_fuel');
			}
		}
	}

	public function index_2(){
		$this->paginate = array(
			'order' => array('Testing.created' => 'desc' ),
			'limit' => 7
		);
		$this->Testing->recursive = 0;
		$device_ip = $this->paginate('Testing');
		$this->set('zones', $device_ip);
	}

	public function bts_configs( $btsId=null ){
		if (!$this->Testing->exists($btsId)) {
			throw new NotFoundException(__('Invaild Configuration'));
		}
		$details = $this->Testing->find(
			'first',
			array(
				'recursive' => -1,
				'conditions' => array(
					'id' => $btsId		
				)		
			)	
		);
		$this->set('backButton', $this->getPageId($btsId));
		$this->set('btsId',$btsId);
		$this->set('btsDetails',$details);
	}

	public function add() {
		$date = new DateTime();
		$date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
		$get_datetime = $date->format('d.m.Y H:i:s');

        if ($this->request->is('post')) {
			$this->Testing->create();
			if ($this->Testing->save($this->request->data)) {
				$this->Testing->saveField('modified', $get_datetime);
				$this->Session->setFlash('The data has been saved');
				$this->redirect(array('action' => 'dashboard'));
			} 
			else 
			{
				$this->Session->setFlash('The user could not be created. Please, try again.');		
			}	
        }
        else
        {
        	//$this->Session->setFlash('Developed By Massive');
        }
    }

    public function user_edit($id = null) {
	    if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'dashboard'));
		}

		$user = $this->Testing->findById($id);
		if (!$user) {
			$this->Session->setFlash('Invalid User ID Provided');
			$this->redirect(array('action'=>'dashboard'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->Testing->id = $id;
			if ($this->Testing->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been updated nice'));
				$this->redirect(array('action' => 'dashboard', $id));
			}
			else
			{
				$this->Session->setFlash(__('Unable to update your user.'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $user;
		}
    }

    public function door_open($btsId = null){
		if (!$this->Testing->exists($btsId)) {
			throw new NotFoundException(__('Invaild BTS'));
		}

		$readerData = $this->Testing->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$btsId)));
		$site_name = "{$readerData['Testing']['SiteModuleId']}";
		
		////////// Door Open Command Send /////////////
		$door_open ="cmd{123(11,1)}"."\r\n";
		$filename = "C:/datatemp/{$readerData['Testing']['SiteModuleId']}_DataSendToDev.txt";
		$handle = fopen ($filename, "w+");
		fputs($handle, $door_open);
		fclose($handle);
		///////// End Door Open Command Send /////////

		///////// User Identification /////////////
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		    $ip = $_SERVER['HTTP_CLIENT_IP'];
		    
		} 
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else {
		    $ip = $_SERVER['REMOTE_ADDR'];
		}

		if($ip=='::1'){
			$ip = "Root";
		}
		else{
			$ip = $ip;
		}
		
		
		$user = $this->Auth->user('username');
		$date = new DateTime();
		$date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
		$get_datetime = $date->format('d.m.Y H:i:s');
		$get_date     = $date->format('d-m-Y');

		$user_os 		=  $this->getOS();
		$user_browser 	=  $this->getBrowser();

		$user_details_with_time = "Web_User ".$user.','."PC_User ".gethostbyaddr($_SERVER['REMOTE_ADDR']).','.$ip.','.$site_name.','.'Central'.','.$user_os.','.$user_browser.','.$get_datetime.','.$get_date."\r\n";

		$filename = "C:/datatemp/User_Name/{$readerData['Testing']['SiteModuleId']}_DataSendToDev.txt";
		$handle = fopen ($filename, "w+");
		fputs($handle, $user_details_with_time);
		fclose($handle);
		///////// End User Identification /////////////
		
		$this->redirect($this->referer());
	}

	public function refresh_value($btsId = null){
		if (!$this->Testing->exists($btsId)) {
			throw new NotFoundException(__('Invaild BTS'));
		}
		$readerData = $this->Testing->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$btsId)));
		$site_name = "{$readerData['Testing']['SiteModuleId']}";
		////////// Get Last Status Value /////////////
		$recent_value ="cmd{123(15,1)}"."\r\n";
		$filename = "C:/datatemp/{$readerData['Testing']['SiteModuleId']}_DataSendToDev.txt";
		$handle = fopen ($filename, "w+");
		fputs($handle, $recent_value);
		fclose($handle);
		$this->redirect($this->referer());
	}

	public function door_open_form(){
		$this->layout = "dashboard_test";
		if ($this->request->is('post')) {
			$this->Testing->create();
			if ($this->Testing->save($this->request->data)) {
				$this->redirect($this->referer());
			} 
			else 
			{		
			}	
        }   
	}

	public function add_card($btsId = null){
		if (!$btsId) {
			$this->Session->setFlash('Please provide a valid site');
			$this->redirect(array('action'=>'dashboard'));
		}
		$id = $this->Testing->findById($btsId);
		if (!$id) {
			$this->Session->setFlash('Invalid site');
			$this->redirect(array('action'=>'dashboard'));
		}
		$readerDataa  = $this->Testing->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$btsId)));
		$SiteModuleId = $readerDataa['Testing']['SiteModuleId'];
		$site_name    = $readerDataa['Testing']['site_name'];
		//pr($readerDataa);
		//pr($site_name);
		
		$form_value  = $this->CardManagement->findBySiteName($site_name);
		$readerData  = $this->CardManagement->find('list',
        	array(
            	'conditions' => array('CardManagement.site_name' => $site_name),
            	'fields'     => array('card_number'),
        	)
    	);
		$this->set('readCard', $readerData);

		if ($this->request->is('post') || $this->request->is('put')) {

			$data = $this->request->data;

			$this->CardManagement->create();
			if ($this->CardManagement->save($this->request->data)) {
				$this->Session->setFlash('The data has been saved');
				$card_number = $data['CardManagement']['card_number'];
				$add_card ="cmd{123(12,$card_number,)}"."\r\n";
				$filename = "C:/datatemp/{$SiteModuleId}_DataSendToDev.txt";
				$handle = fopen ($filename, "w+");
				fputs($handle, $add_card);
				fclose($handle);
				$this->redirect(array('action' => 'dashboard'));
			} 
			else 
			{
				$this->Session->setFlash('The data could not be saved. Please, try again.');	
				$this->redirect(array('action' => 'dashboard'));	
			}
		}

		if (!$this->request->data) {
			$this->request->data = $form_value;
		}

		$details = $this->DeviceCard->find(
			'first',
			array(
				'recursive' => -1,
				'conditions' => array(
					'site_name' => $site_name		
				)		
			)	
		);
		$this->set('site_details',$details);

		$detailss = $this->ZoneCard->find(
			'first',
			array(
				'recursive' => -1,
				'conditions' => array(
					'zone_name' => 'dhaka'		
				)		
			)	
		);
		$this->set('site_detailss',$detailss);
	}

	public function delete_card($btsId = null){
		if (!$btsId) {
			$this->Session->setFlash('Please provide a Correct Id');
			$this->redirect(array('action'=>'index'));
		}

		$id = $this->Testing->findById($btsId);
		if (!$id) {
			$this->Session->setFlash('Invalid IP Provided');
			$this->redirect(array('action'=>'index'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$card_number = $this->request->data;
			$card_number = $card_number['Testing']['card_list'];

			$readerData  = $this->Testing->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$btsId)));
			$SiteModuleId   = $readerData['Testing']['SiteModuleId'];
			
			$del_card    = "cmd{123(13,$card_number,)}"."\r\n";
			$filename    = "C:/datatemp/{$readerData['Testing']['SiteModuleId']}_DataSendToDev.txt";
			$handle      = fopen ($filename, "w+");
			fputs($handle, $del_card);
			fclose($handle);
			$this->redirect($this->referer());
		}

		if (!$this->request->data) {
			$this->request->data = $id;
		}
	}

	public function download_card($btsId = null){
		if (!$this->Testing->exists($btsId)) {
			throw new NotFoundException(__('Invaild BTS'));
		}
		$readerData = $this->Testing->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$btsId)));
		$site_name = "{$readerData['Testing']['site_name']}";
		$download_card ="cmd{123(19,9999999)}"."\r\n";
		$filename = "C:/datatemp/{$readerData['Testing']['site_name']}_DataSendToDev.txt";
		$handle = fopen ($filename, "w+");
		fputs($handle, $download_card);
		fclose($handle);
		sleep(5);
		///////////
		$details = $this->DeviceCard->find(
			'first',
			array(
				'recursive' => -1,
				'conditions' => array(
					'site_name' => $site_name		
				)		
			)	
		);
		$this->set('site_details',$details);
		//$this->redirect($this->referer());
		//$this->redirect(array('controller'=>'testings','action'=>'show_card'));
	}

	public function show_card($site_name = null){
		/*if (!$this->Testing->CardTable->exists($site_name)) {
			throw new NotFoundException(__('Invaild Configuration'));
		}*/
		$details = $this->DeviceCard->find(
			'first',
			array(
				'recursive' => -1,
				'conditions' => array(
					'site_name' => $site_name		
				)		
			)	
		);
		$this->set('site_details',$details);
		//pr($details);
	}

	public function download_log($site_name = null){
		if (!$site_name){
			$this->Session->setFlash('Please provide a valid Site name');
			$this->redirect(array('action'=>'dashboard'));
		}
		$date = new DateTime();
		$date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
		$get_date = $date->format('d-m-Y');
		//$get_date = '05-01-2017';
		$this->set('datas',$this->LiveStatus->
			find('all',
				array (
					'conditions' => array('	SiteModuleId' => $site_name, 'datee' =>$get_date),
					'fields'=> array('SiteModuleId','live_status','date_time')
				)
			)
		);
		$this->set('site_namee', $site_name);
		$this->layout = null;
    	$this->autoLayout = false;
    	Configure::write('debug','0');
	}

	public function write_ip($ip_address = null) {
		if (!$ip_address) {
			$this->Session->setFlash('Please provide a Correct IP');
			$this->redirect(array('action'=>'index'));
		}

		$ip = $this->Testing->findByIpAddress($ip_address);
		if (!$ip) {
			$this->Session->setFlash('Invalid IP Provided');
			$this->redirect(array('action'=>'index'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {

			$new_ip = $this->request->data;
			$new_ipp = $new_ip['Testing']['ip_address'];

			$retunr_ip = $this->formatIp($new_ipp);

			
			$avrUrl = "http://$ip_address/?Command=dip:$retunr_ip";

			
			$avrResponse = $this->requestToAvr($avrUrl);
			if($avrResponse == 'OK'){
				if ($this->Testing->save($new_ip)){
					$this->Session->setFlash('Device Ip Changed','default',array('class'=>'alert alert-success'));
					$this->redirect(array('action' => 'index', $new_ip));
				}
				else
				{
					$this->Session->setFlash('Device is busy.Please try again.','default',array('class'=>'alert alert-warning'));
				}
			}
			else
			{
				$this->Session->setFlash(__('Unable to update Device IP.'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $ip;
		}
    }

    public function date_time($btsId = null) {
		if (!$btsId) {
			$this->Session->setFlash('Please provide a Correct Id');
			$this->redirect(array('action'=>'index'));
		}

		$id = $this->Testing->findById($btsId);
		if (!$id) {
			$this->Session->setFlash('Invalid IP Provided');
			$this->redirect(array('action'=>'index'));
		}

		$date = new DateTime();
		$date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
		$get_datetime = $date->format('dmYHis');
		$date = substr($get_datetime, 0, 4);
		$time = substr($get_datetime,6,8);
		$date_time= $date.$time;

		$readerData = $this->Testing->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$btsId)));

		$ip_address = $readerData['Testing']['ip_address'];
			
		$avrUrl = "http://$ip_address/?Command=datetime:$date_time";
			
		$avrResponse = $this->requestToAvr($avrUrl);
		if($avrResponse == 'OK'){
			$this->Session->setFlash('Date Time has been Changed','default',array('class'=>'alert alert-success'));
			$this->redirect(array('action' => 'index', $id));
		}
		else
		{
			$this->Session->setFlash('Device is busy.Please try again.','default',array('class'=>'alert alert-warning'));
		}
		$this->redirect($this->referer());
	}

	public function edit($btsId = null){
		//exceptions
		//print_r($btsId);
		if (!$this->Testing->exists($btsId)) {
			throw new NotFoundException(__('Invaild BTS'));
		}
		//print_r($btsId);

		if($this->request->is(array('post', 'put'))){
			$data = $this->request->data;

			$formattedData = $this->formatIpAddress($data['dip']['bts_ip']);

			$btsDestails = $this->btsDetailsById($btsId);

			$avrUrl = "http://{$btsDestails['Testing']['ip_address']}:/?Command=dip:{$formattedData}";
			//sleep(10);10);
			$avrResponse = $this->requestToAvr($avrUrl);
			if($avrResponse == 'OK'){
				$this->Testing->id = $btsId;
				if($this->Testing->saveField('ip_address',$data['dip']['bts_ip'],true)){
					$this->Session->setFlash('Ip is updated','default',array('class'=>'alert alert-success'));
				}else{
					$this->Session->setFlash('Please Try again','default',array('class'=>'alert alert-warning'));
				}
				
			}
			else
			{
				$this->Session->setFlash('Device is busy,Please try again.','default',array('class'=>'alert alert-warning'));
			}
		}
	
		$this->redirect($this->referer());
		//return $this->redirect(array('action' => 'add'));
	}

	public function write_ipp($btsId = null) {
		if (!$this->Testing->exists($btsId)) {
			throw new NotFoundException(__('Invalid Ip Address'));
		}

		$readerData = $this->Testing->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$btsId)));

		$prev_ip_address = $readerData['Testing']['ip_address'];

		//print_r($prev_ip_address);

		if ($this->request->is(array('post', 'put'))) {

			if ($this->Testing->save($this->request->data)) {

				$readerDataa = $this->Testing->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$btsId)));

				$avrUrl = "http://{$prev_ip_address}:/?Command=dip:{$readerDataa['Testing']['ip_address']},";

				$avrResponse = $this->requestToAvr($avrUrl);
				
				if($avrResponse == 'OK'){

					$this->Session->setFlash("The IP has been Changed.",'default',array('class'=>'alert alert-success'));
				
				}
				else
				{
					$this->Session->setFlash('Device is busy for Another Work. Please, try again.','default',array('class'=>'alert alert-warning'));
				}

				//return $this->redirect(array('action' => 'index'));
				$this->redirect($this->referer());
			} 
			else 
			{
				$this->Session->setFlash('The Ip could not be Changed. Please, try again.');
			}
		}
		else
		{
			$options = array('conditions' => array('Testing.' . $this->Testing->primaryKey => $btsId));
			$this->request->data = $this->Testing->find('first', $options);
		}	
	}

	public function add_ip(){
		if (!$this->Testing->exists($btsId)) {
			throw new NotFoundException(__('Invaild BTS'));
		}
		
		$readerData = $this->Testing->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$btsId)));

		$avrUrl = "http://{$readerData['CardReader']['ip_address']}:/?Command=dip:{$readerData['CardReader']['ip_address']},";
		
		//sleep(10);10);
		$avrResponse = $this->requestToAvr($avrUrl);
				
		if($avrResponse == 'OK'){

			$this->Session->setFlash("{$readerData['Testing']['card_number']} card has been saved.",'default',array('class'=>'alert alert-success'));
				
		}
		else
		{
			$this->Session->setFlash('Device is busy for Add Card. Please, try again.','default',array('class'=>'alert alert-warning'));
		}
		
		$this->redirect($this->referer());
	}

	public function delete($id = null) {
		$this->Testing->id = $id;
		if (!$this->Testing->exists()) {
			throw new NotFoundException(__('Invalid card reader'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Testing->delete()) {
			$this->Session->setFlash('The site has been deleted.');
		} else {
			$this->Session->setFlash('The site could not be deleted. Please, try again.');
		}
		return $this->redirect(array('action' => 'dashboard'));
	}

	private function getFreeCardForAssigning($btsId,$zoneID){
		$cardList = $this->Card->find(
			'list',
			array(
				'fields'=>array('id','number'),
				'conditions'=>array(
					'Card.status'	=>'active',
					'Card.zone_id'	=> $zoneID
				)
			)
		);
		$alreadyAssignedCard = $this->AssignedCard->find(
			'list',
			array(
				'fields' => array('card_id','card_reader_id'),
				'conditions' => array(
					'card_reader_id' => $btsId
				)
			)
		
		);
		
		
		$assignedCardsList = array();
		//free cards
		foreach($alreadyAssignedCard as $k=>$v){
			
			if(array_key_exists($k, $cardList)){
				$assignedCardsList[$k] = $cardList[$k];
				unset($cardList[$k]);
			}
		}
		$reurtnValue['assignedCards'] = $assignedCardsList;
		$reurtnValue['freeCards'] = $cardList;
		
		return $reurtnValue;
	}
	
	private function btsDetailsById($btsId){
		return $this->Testing->find('first',array('recursive'=>-1,'conditions'=>array('id'=>$btsId)));
		echo "abc";
	}
	
	private function formatBLCVoltage($data){	
		$data = explode('.',$data);
		if(!isset($data[1])){
			return substr($data[0],0,2).'.0';
		}
		return substr($data[0],0,2).'.'. substr($data[1],0,1);
	}

	private function formatIp($data){
		$thisIp = explode('.', $data);
		//print_r($thisIp);
		$formattedIp = '';
		foreach($thisIp as $k=>$v){
			$formattedIp .= str_pad(substr($v,0,3),3, '0', STR_PAD_LEFT).".";
		}
		return substr($formattedIp,0,15);
	}
	 
	private function formatIpAddress($data){
		$thisIp = explode('.', $data);
		$formattedIp = '';
		foreach($thisIp as $k=>$v){
			$formattedIp .= str_pad(substr($v,0,3),3, '0', STR_PAD_LEFT).".";
		}
		return substr($formattedIp,0,15);
	}
	
	private function checkIpAddress($data){
		$no = $this->CardReader->find(
			'count',
			array(
					
			)	
		);
	}

	private function getChildren($data,$conditions=null,$level = 0,$thisChildren = array()){
		foreach($data as $k=>$v){
			if($v['Zonee']['id'] == $conditions){
				$thisChildren =  $v;
			} elseif(sizeof($v['children'])>0){
				$thisChildren = $this->getChildren($v['children'],$conditions,$level++,$thisChildren);
			}
		}
		
		return $thisChildren;
	}
	
	private function childList($data,$level = 0,$listArray = array()){
		foreach($data as $k=>$v){
			$listArray[$v['Zonee']['id']] =  $v['Zonee']['title'];
			if(sizeof($v['children']) > 0){
				$listArray = $this->childList($v['children'],$level++,$listArray);
			}
		}
		return $listArray;	
	}
	
	private function getPageId($btsId =  null){
		$zoneId = array_values($this->CardReader->find(
				'list',
				array(
					'fields' => array('id','zone_id'),
					'conditions'	=> array(
						'id' => $btsId
					),
					'order'			=> array(
						'CardReader.created' => 'desc'
					)
				)
			)
		);
		
		$threadedData = $this->Zonee->find(
			'threaded',
			array(
				'contain' => array(),
			)
		);
		$thisChilds = $this->getChildren($threadedData,$zoneId[0]);
		$childLists = $this->childList(array($thisChilds));
		
		$btsList = $this->CardReader->find(
			'list',
			array(
				'fields' => array('id','name'),
				'conditions'	=> array(
					'AND' => array('CardReader.status' => 'active'),
					'OR'=>array(
						'zone_id' => array_keys($childLists)
					)
				),
				'order'			=> array(
					'CardReader.created' => 'desc'
				)
					
			)
		);
		
		$btsPositionArray = array_flip(array_keys($btsList));
	
		$pagePosistion = $btsPositionArray[$btsId]+1;
		
		
		$pageReminder = $pagePosistion%15;
		
		$pageNumber = ($pagePosistion - $pageReminder)/15;
		if($pageReminder > 0){
			$realPageNumber = $pageNumber+1;
		}else{
			$realPageNumber = $pageNumber;
		}
		return array($zoneId[0],$realPageNumber);
	}

	private function getOS(){
		global $user_agent;
		$user_agent   = $_SERVER['HTTP_USER_AGENT'];
	    $os_platform  = "Unknown OS Platform";
	    $os_array     = array(
            '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );

	    foreach ($os_array as $regex => $value)
	        if (preg_match($regex, $user_agent))
	            $os_platform = $value;
	    return $os_platform;
	}

	private function getBrowser(){
		global $user_agent;
		$user_agent     = $_SERVER['HTTP_USER_AGENT'];
	    $browser        = "Unknown Browser";
	    $browser_array  = array(
	        '/msie/i'      => 'Internet Explorer',
	        '/firefox/i'   => 'Firefox',
	        '/safari/i'    => 'Safari',
	        '/chrome/i'    => 'Chrome',
	        '/edge/i'      => 'Edge',
	        '/opera/i'     => 'Opera',
	        '/netscape/i'  => 'Netscape',
	        '/maxthon/i'   => 'Maxthon',
	        '/konqueror/i' => 'Konqueror',
	        '/mobile/i'    => 'Handheld Browser'
		);

	    foreach ($browser_array as $regex => $value)
	        if (preg_match($regex, $user_agent))
	            $browser = $value;

	    return $browser;
	}
}