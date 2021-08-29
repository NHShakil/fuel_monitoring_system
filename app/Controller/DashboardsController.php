<?php

App::uses('AppController', 'Controller');

class DashboardsController extends AppController {

	public $components = array('Paginator', 'Session');
	public $helpers = array('Html','Form','ZoneeTree');
	public $uses = array('Site','FuelSensor','ThreePhase','CellBattery','IpRelay','GridReport','AddTime', 'AcDc','DeviceLog','Zone');

	
	public function index($zoneId = null){

		$this->paginate = array(
			'order' => array('Site.serial_num' => 'asc' ),
			'limit' => 7
		);

		$parent_idd = $this->Zone->find('all', array('recursive'=>-1, 'conditions' => array('Zone.parent_id' => $zoneId)));

		if($parent_idd != null){
			foreach ($parent_idd as $key => $value) {
				
				$id = $value['Zone']['id'];
				$parent_id = $value['Zone']['parent_id'];

				$site_idd = $this->Site->find('first', array('recursive'=>-1, 'conditions' => array('Site.zone_id' => $id)));

				//print_r($site_idd['Site']['zone_id'].";");
			
				if($zoneId == $parent_id){
					$this->paginate = array(
						'conditions' => array(
							'zone_id' => $id		
						)	
					);
				}
			}	
		}

		elseif($zoneId != null){
			$this->paginate = array(
				'conditions' => array(
					'zone_id' => $zoneId		
				)	
			);
		}
		
		
		$this->Site->recursive = 0;
		$bts_name = $this->paginate('Site');
		$active = $this->Site->find('count', array('conditions' => array('Site.status' => 'Active')));
		$inactive = $this->Site->find('count', array('conditions' => array('Site.status' => 'Inactive')));
		$draft = $this->Site->find('count', array('conditions' => array('Site.status' => 'Draft')));
		$this->set(compact('bts_name','active','inactive','draft'));


		$treeData = $this->Zone->find(
			'threaded',
			array(
				'contain' => false,
			)					
		);
		$this->set('zoneTree', $treeData);
	}


	public function search_bts(){
		if($this->request->is('post')){
			$data = $this->request->data;
			$this->paginate = array(
				'conditions'	=> array(
					'Site.status' => 'active',
					'OR' => array(
						'Site.name like' => "%".$data['Site']['keywords']."%",
						'Site.ip_address like' => "%".$data['Site']['keywords']."%",
					)
				),
				'limit' => 6,
				'order'	=> array('Site.name' => 'asc') 
			);

			$bts_name= $this->paginate('Site');

			$active = $this->Site->find('count', array('conditions' => array('Site.status' => 'Active')));
			$inactive = $this->Site->find('count', array('conditions' => array('Site.status' => 'Inactive')));
			$draft = $this->Site->find('count', array('conditions' => array('Site.status' => 'Draft')));
			$this->set(compact('bts_name','active','inactive','draft'));

			$this->set('zones',$this->Zone->find('list'));
			$treeData = $this->Zone->find(
				'threaded',
				array(
					'contain' => false,
				)					
			);
			$this->set('zoneTree', $treeData);			
			$this->render('index');
		}
		else
		{
			$this->Session->setFlash('The site could not be Found');
			$this->redirect('index');
		}
	}

	public function search_tree(){

	}


 
	public function dac_index($zoneId = null){

		if (!$this->Site->exists($zoneId)) {
			throw new NotFoundException(__('Invaild BTS'));
		}
		
		$readerData = $this->Site->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$zoneId)));


		session_start();
		if(empty($_SESSION['zoneId'])){
    		$_SESSION['zoneId'] = 0; 
		}

		$_SESSION['zoneId']++;
		if($_SESSION['zoneId']>1){
			$_SESSION['zoneId'] = 0;
		}



		if($_SESSION['zoneId']===0){
			$avrUrl = "http://{$readerData['Site']['ip_address']}/?command=3:a1";

			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$avrUrl);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Massive Electronics');
			$get_url_value = curl_exec($curl_handle);

			function multiexplodee ($delimiters, $string) {
			$ready = str_replace($delimiters, $delimiters[0], $string);
    		$launch = explode($delimiters[0], $ready);
    		return  $launch;
			}	

			$pieces = multiexplodee(array(",",":"), $get_url_value);
			$volt   = $pieces[8]/10;

			$this->Site->id = $this->Site->field('id', array('id' => $zoneId));
			if ($this->Site->id) {

				$this->Site->set(array(
	        		'temp'   => $pieces[7],
	        		'volt'   => $volt
				));
				$this->Site->save();
			}

			$date = new DateTime();
			$date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
			$get_datetime = $date->format('Y.m.d H.i.s');

        	$this->DeviceLog->saveField('name', "{$readerData['Site']['name']}");
        	$this->DeviceLog->saveField('ip_address', "{$readerData['Site']['ip_address']}");
        	$this->DeviceLog->saveField('temp', $pieces[7]);
        	$this->DeviceLog->saveField('volt', $volt);
        	$this->DeviceLog->saveField('port', "{$readerData['Site']['port']}");
        	$this->DeviceLog->saveField('server_ip', "{$readerData['Site']['server_ip']}");
        	$this->DeviceLog->saveField('status', "{$readerData['Site']['status']}");
        	$this->DeviceLog->saveField('log_details', "{$readerData['Site']['log_details']}");
        	$this->DeviceLog->saveField('date_time', $get_datetime);		
		}
		elseif($_SESSION['zoneId']===1){
			$avrUrl = "http://{$readerData['Site']['ip_address']}/?command=3:a0";

			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$avrUrl);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Massive Electronics');
			$get_url_value = curl_exec($curl_handle);	
			

			function multiexplode ($delimiters, $string) {
			$ready = str_replace($delimiters, $delimiters[0], $string);
    		$launch = explode($delimiters[0], $ready);
    		return  $launch;
			}	

			$pieces = multiexplode(array(",",":"), $get_url_value);
			$volt   = $pieces[8]/10;

			$this->Site->id = $this->Site->field('id', array('id' => $zoneId));
			if ($this->Site->id) {

				$this->Site->set(array(
	        		'temp'   => $pieces[7],
	        		'volt'   => $volt
				));
				$this->Site->save();
			}

			$date = new DateTime();
			$date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
			$get_datetime = $date->format('Y.m.d H.i.s');

        	$this->DeviceLog->saveField('name', "{$readerData['Site']['name']}");
        	$this->DeviceLog->saveField('ip_address', "{$readerData['Site']['ip_address']}");
        	$this->DeviceLog->saveField('temp', $pieces[7]);
        	$this->DeviceLog->saveField('volt', $volt);
        	$this->DeviceLog->saveField('port', "{$readerData['Site']['port']}");
        	$this->DeviceLog->saveField('server_ip', "{$readerData['Site']['server_ip']}");
        	$this->DeviceLog->saveField('status', "{$readerData['Site']['status']}");
        	$this->DeviceLog->saveField('log_details', "{$readerData['Site']['log_details']}");
        	$this->DeviceLog->saveField('date_time', $get_datetime);		
		}

		$this->redirect($this->referer());
	}




	public function avl_index($zoneId){
		if (!$this->Site->exists($zoneId)) {
			throw new NotFoundException(__('Invaild BTS'));
		}

		$readerData = $this->Site->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$zoneId)));


		session_start();
		if(empty($_SESSION['zoneId'])){
    		$_SESSION['zoneId'] = 0; 
		}

		$_SESSION['zoneId']++;
		if($_SESSION['zoneId']>1){
			$_SESSION['zoneId']=0;
		}

		if($_SESSION['zoneId']===0){
			$avrUrl = "http://{$readerData['Site']['ip_address']}/?command=3:b1";

			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$avrUrl);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Massive Electronics');
			$get_url_value = curl_exec($curl_handle);		
		}

		elseif($_SESSION['zoneId']===1){

			$avrUrl = "http://{$readerData['Site']['ip_address']}/?command=3:b0";

			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$avrUrl);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Massive Electronics');
			$get_url_value = curl_exec($curl_handle);			
		}

		$this->redirect($this->referer());
	}



	public function gen_index($zoneId){
		if (!$this->Site->exists($zoneId)) {
			throw new NotFoundException(__('Invaild BTS'));
		}

		$readerData = $this->Site->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$zoneId)));


		session_start();
		if(empty($_SESSION['zoneId'])){
    		$_SESSION['zoneId'] = 0; 
		}

		$_SESSION['zoneId']++;
		if($_SESSION['zoneId']>1){
			$_SESSION['zoneId']=0;
		}

		if($_SESSION['zoneId']===0){
			$avrUrl = "http://{$readerData['Site']['ip_address']}/?command=3:c1";

			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$avrUrl);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Massive Electronics');
			$get_url_value = curl_exec($curl_handle);	
		}

		elseif($_SESSION['zoneId']===1){

			$avrUrl = "http://{$readerData['Site']['ip_address']}/?command=3:c0";

			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$avrUrl);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Massive Electronics');
			$get_url_value = curl_exec($curl_handle);				
		}

		$this->redirect($this->referer());
	}




	public function esc_index($zoneId){
		if (!$this->Site->exists($zoneId)) {
			throw new NotFoundException(__('Invaild BTS'));
		}

		$readerData = $this->Site->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$zoneId)));


		session_start();
		if(empty($_SESSION['zoneId'])){
    		$_SESSION['zoneId'] = 0; 
		}

		$_SESSION['zoneId']++;
		if($_SESSION['zoneId']>1){
			$_SESSION['zoneId']=0;
		}

		if($_SESSION['zoneId']===0){
			$avrUrl = "http://{$readerData['Site']['ip_address']}/?command=3:d1";

			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$avrUrl);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Massive Electronics');
			$get_url_value = curl_exec($curl_handle);		
		}

		elseif($_SESSION['zoneId']===1){

			$avrUrl = "http://{$readerData['Site']['ip_address']}/?command=3:d0";

			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$avrUrl);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Massive Electronics');
			$get_url_value = curl_exec($curl_handle);		
		}

		$this->redirect($this->referer());
	}




	public function dvs_index($zoneId){
		if (!$this->Site->exists($zoneId)) {
			throw new NotFoundException(__('Invaild BTS'));
		}


		$readerData = $this->Site->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$zoneId)));


		session_start();
		if(empty($_SESSION['zoneId'])){
    		$_SESSION['zoneId'] = 0; 
		}

		$_SESSION['zoneId']++;
		if($_SESSION['zoneId']>1){
			$_SESSION['zoneId']=0;
		}

		if($_SESSION['zoneId']===0){
			$avrUrl = "http://{$readerData['Site']['ip_address']}/?command=3:e1";

			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$avrUrl);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Massive Electronics');
			$get_url_value = curl_exec($curl_handle);
		
		}

		elseif($_SESSION['zoneId']===1){

			$avrUrl = "http://{$readerData['Site']['ip_address']}/?command=3:e0";

			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$avrUrl);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Massive Electronics');
			$get_url_value = curl_exec($curl_handle);		
		}

		$this->redirect($this->referer());
	}


	public function hbt_index($zoneId){
		if (!$this->Site->exists($zoneId)) {
			throw new NotFoundException(__('Invaild BTS'));
		}


		$readerData = $this->Site->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$zoneId)));


		session_start();
		if(empty($_SESSION['zoneId'])){
    		$_SESSION['zoneId'] = 0; 
		}

		$_SESSION['zoneId']++;
		if($_SESSION['zoneId']>1){
			$_SESSION['zoneId']=0;
		}

		if($_SESSION['zoneId']===0){
			$avrUrl = "http://{$readerData['Site']['ip_address']}/?command=3:f1";

			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$avrUrl);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Massive Electronics');
			$get_url_value = curl_exec($curl_handle);
		
		}

		elseif($_SESSION['zoneId']===1){

			$avrUrl = "http://{$readerData['Site']['ip_address']}/?command=3:f0";

			$curl_handle=curl_init();
			curl_setopt($curl_handle, CURLOPT_URL,$avrUrl);
			curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
			curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Massive Electronics');
			$get_url_value = curl_exec($curl_handle);		
		}

		$this->redirect($this->referer());
	}


	public function pi_chart($zoneId){

		if (!$this->Site->exists($zoneId)) {
			throw new NotFoundException(__('Invaild BTS'));
		}

		$readerDataa = $this->Site->find('first',array('recursive'=>-1, 'conditions'=>array('id'=>$zoneId)));
		$ip_addresss = $readerDataa['Site']['ip_address'];

		$readerData = $this->DeviceLog->find('all',array('recursive'=>-1, 'conditions'=>array('ip_address'=>$ip_addresss)));


		

		$save_value = WWW_ROOT . "graph" . DS . $ip_addresss.'.txt';
		$file = new File($save_value, true);

		foreach ($readerData as $key => $value) {
			$temp = $value['DeviceLog']['temp'];
			$date_time = $value['DeviceLog']['date_time'];
			$value = $temp.','.$date_time.';';
			$file->write($value);
		}

		//if(!file_exists($save_value))
    	//file_put_contents($save_value, $value);
		
		$this->set(compact('readerData'));

	}





	public function grid_report(){

		$this->paginate = array(
			'limit' => 20,
			'order' => array('GridReport.site_name' => 'asc' )
		);
		
		$this->set('color', 'pink');

		$this->GridReport->recursive = 0;
		$grid_reports = $this->paginate('GridReport');

		$sum = $this->GridReport->query("SELECT current + voltage AS ItemSum from grid_reports where site_name='CML'");

		$time_zone = $this->GridReport-> query('SELECT @@system_time_zone as time_zonee');

		//SELECT ADD(time_zone) from IpRelay where temparature_status = 'low';

		$this->set(compact('grid_reports','sum','time_zone'));
	}
	


	public function devices_data(){

		// Data Retrieve From FuelSensor Table

		$this->paginate = array(
			'limit' => 20,
			'order' => array('FuelSensor.site_name' => 'asc')	
		);

		$this->FuelSensor->recursive = 0;
		$fuels = $this->paginate('FuelSensor');

		////////////////////////////////// Specific ID ///////////////////////////////////

		$this->set('fuelss', $this->FuelSensor->find('all', array('limit' => 1,'order' => 'FuelSensor.id DESC','recursive' => 1)));

    	////////////////////////////////// Specific ID End /////////////////////////////// 

		$fuel_site_name = $this->FuelSensor->find('all', 
        array(
            'fields' => array('DISTINCT(FuelSensor.site_name)'),
            'order' => array('FuelSensor.site_name' => 'asc' )
            )
        );

        $min_remain_fuel = $this->FuelSensor->find('all', 
        array(
            //'fields' => array("MIN(FuelSensor.remain_fuel) AS min_valuee"),
            'order' => array('FuelSensor.remain_fuel' => 'desc' ),
            'conditions' => array('FuelSensor.site_name' => 'CTG')
            )
        );

        $this->set(compact('fuels','fuel_site_name','last_id_fuel','last_id','abcd','min_remain_fuel'));


		// Data Retrieve From ThreePhase Table

		$this->paginate = array(
			'limit' => 20,
			'order' => array('ThreePhase.site_name' => 'asc')			
		);
		$this->ThreePhase->recursive = 0;
		$phases = $this->paginate('ThreePhase');

		$three_phase_site_name = $this->ThreePhase->find('all', 
        array(
            'fields' => array('DISTINCT(ThreePhase.site_name)'),
            'order' =>array(array('ThreePhase.site_name' => 'asc')) 
            )
        );
        $this->set(compact('phases','three_phase_site_name'));



		// Data Retrieve From CellBattery Table

		$this->paginate = array(
			'limit' => 20,
			'order' => array('CellBattery.site_name' => 'asc'),
		);
		$this->CellBattery->recursive = 0;
		$cells = $this->paginate('CellBattery');

		$summ = $this->CellBattery->query("SELECT b1+b2+b3+b4+b5+b6+b7+b8+b9+b10+b11+b12+b13+b14+b15+b16+b17+b18+b19+b20+b21+b21+b23+b24 AS TotalVoltage FROM cell_batteries WHERE id= 1");

		$battery_site_name = $this->CellBattery->find('all', 
			array(
            	'fields' => array('DISTINCT(CellBattery.site_name) AS battery_site_name'),
            	'order' =>array('CellBattery.site_name' => 'asc' )
            )
        );

		$distinct_site_number = $this->FuelSensor->find('count', array(
			'fields' => 'DISTINCT FuelSensor.site_name',
			'conditions' => array('FuelSensor.status' => 'Active')));
		$this->set(compact('distinct_site_number','cells','battery_site_name','summ'));
	}




	public function specific_device_action($site_name = null){

		if (!$site_name) {
			$this->Session->setFlash('Please provide a site name');
			$this->redirect(array('action'=>'devices_data'));
		}
 
		$specific_site_name = $this->FuelSensor->findBySiteName($site_name);
 
		if (!$specific_site_name) {
			$this->Session->setFlash('Invalid FuelSensor Site Name Provided');
			$this->redirect(array('action'=>'devices_data'));
		}

		$min_remain_fuel = $this->FuelSensor->find('all', 
        array(
            'fields' => array("MIN(FuelSensor.remain_fuel) AS min_valuee"),
            'conditions' => array('FuelSensor.site_name' => $site_name)
            )
        );

        $max_remain_fuel = $this->FuelSensor->find('all', 
        array(
            'fields' => array("MAX(FuelSensor.remain_fuel) AS max_valuee"),
            'conditions' => array('FuelSensor.site_name' => $site_name)
            )
        );			

		$this->set('fuelsensor',$this->FuelSensor->find('all',array ('conditions' => array('site_name' => $site_name))));
		$this->set('threephase',$this->ThreePhase->find('all',array ('conditions' => array('site_name' => $site_name))));
		$this->set('cellbattery',$this->CellBattery->find('all',array ('conditions' => array('site_name' => $site_name))));

		$this->set(compact('site_name','min_remain_fuel','max_remain_fuel'));
	}

 
	public function get_data_all_from_device(){

		$contents = file_get_contents('http://10.5.40.83');

		function multiexplode ($delimiters, $string) {
			$ready = str_replace($delimiters, $delimiters[0], $string);
    		$launch = explode($delimiters[0], $ready);
    		return  $launch;
		}

		$get_device_data = multiexplode(array(",",":"), $contents);

		$array_len = count($get_device_data);

		$sum = 0;

		for ($i=4; $i < $array_len; $i++) { 
			$sum = $sum + $get_device_data[$i];
		}

		$this->IpRelay->read(null, 1);
		$this->IpRelay->set(array(
			'a'   	=> $get_device_data[0],
			'b'   	=> $get_device_data[1],
			'c' 	=> $get_device_data[2],
			'd'     => $get_device_data[3],
			'e'     => $get_device_data[4],
			'f'  	=> $get_device_data[5],
			'g'  	=> $get_device_data[6],
			'h'  	=> $get_device_data[7],
			'volt'  => $get_device_data[8],
			'j'  	=> $sum

		));

		$this->IpRelay->save();


		$last_id = $this->IpRelay->getLastInsertId();


		$this->set('fixed_data',$this->IpRelay->find('all',array ('conditions' => array('id' => $last_id))));
	}


	public function get_recent_data_specific($id=null){

		if (!$id) {
			$this->Session->setFlash('Please provide a site name');
			$this->redirect(array('action'=>'get_all_data'));
		}

		$this->set('recent_data_all',$this->IpRelay->find('all',array ('conditions' => array('id' => $id))));

	}


	public function get_all_data(){

   		/////////////////////////////////////////// Max Value With ID //////////////////////

   		$max = $this->IpRelay->find('all', 
        array(
            'fields' => array(
                'MAX(IpRelay.volt) AS max_value'

            ))
        );
    	//debug($max[0][0]['max_value']);
   		//$this->set('max_num', $max[0][0]['max_value']);
   		//$this->set(compact('max'));

   		$max_num = $max[0][0]['max_value'];

   		$this->set('max_num_id',$this->IpRelay->find('all',array ('conditions' => array('volt' => $max_num))));

   		/////////////////////////////////////   End  ////////////////////////////////////////


   		///////////////////////////////////// Min Value With ID /////////////////////////////

   		$min = $this->IpRelay->find('all', 
        array(
            'fields' => array(
                'MIN(IpRelay.volt) AS min_value'
            ))
        );

   		$min_num = $min[0][0]['min_value'];

   		$this->set('min_num_id',$this->IpRelay->find('all',array ('conditions' => array('volt' => $min_num))));
 
		/////////////////////////////////////////////// End //////////////////////////////////


		//$this->set('max_num', $this->IpRelay->query("SELECT MAX(volt) AS max_num FROM ip_relays"));

		//$this->set('min_num', $this->IpRelay->query("SELECT MIN(volt) AS min_numm FROM ip_relays"));

		$this->set('avg_num', $this->IpRelay->query("SELECT Avg(volt) AS avg_num FROM ip_relays"));


		$all_value = $this->IpRelay->find('all');
		$this->set(compact('get_device_data','all_value','last_id','first_id'));
	}



	public function time_count(){
		$this->set('time_add', $this->AddTime->find('all'));
		$time_diff = $this->AddTime->query("SELECT TIMEDIFF('5:30:30','4:45:50')AS time_diff");
		$this->set(compact('time_add','time_diff'));
	}




	public function ac_dc(){

		$curl_handle=curl_init();
		curl_setopt($curl_handle, CURLOPT_URL,'http://10.220.14.2/');
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Massive Electronics');
		$get_url_value = curl_exec($curl_handle);

		function multiexplode ($delimiters, $string) {
			$ready = str_replace($delimiters, $delimiters[0], $string);
    		$launch = explode($delimiters[0], $ready);
    		return  $launch;
		}	

		$pieces = multiexplode(array("{","site","=","(",",",")","}",";"), $get_url_value);
		$array_len = count($pieces);


		$dc_energy= ($pieces[6])/100;
		$dc_energy = $dc_energy+$pieces[4]+ $pieces[5];
		$dc_current = $pieces[8];
		$dc_current = $dc_current/10;
		$dc_watt = $pieces[7]*$dc_current;
		$dc_watt = $dc_watt/10000;
		$dc_watt = round($dc_watt,2);
		$dc_volt =$pieces[7]/10;
		$ac_energy = $pieces[11]/10;

		$ac_energy_value = floor($ac_energy);
	
		if($ac_energy_value >= 1){
			$ac_energy_value = $ac_energy_value/10;
			$updated_ac_energy_value = $pieces[10] + $ac_energy_value;			
		}
		else{
			$updated_ac_energy_value = $pieces[10] + $ac_energy_value;			
		}


		if (is_int($updated_ac_energy_value)) {
			$update_valuee = $updated_ac_energy_value."."."0";		
		}
		elseif ($updated_ac_energy_value >=1) {
			$update_valuee = $updated_ac_energy_value;		
		}
		else
		{
			$update_valuee = $updated_ac_energy_value;		
		}


		$now = getdate();
		$minutess = $now['minutes'];
		$secondss = $now["seconds"];
		if($minutess<10 and $secondss<10){
			$minutesss = "0".$minutess;
			$secondsss = "0".$secondss;
			$currentTime = $now["hours"]+5 . ":" . $minutesss .":" .  $secondsss;
		}
		elseif ($minutess<10) {
			$minutesss = "0".$minutess;
			$currentTime = $now["hours"]+5 . ":" . $minutesss .":" . $now["seconds"];
		}
		elseif ($secondss<10) {
			$secondsss = "0".$secondss;
			$currentTime = $now["hours"]+5 . ":" . $now["minutes"] .":". $secondsss;
		}
		else
		{
			$currentTime = $now["hours"]+5 . ":" . $now["minutes"] .":" . $now["seconds"];
		} 
		
    	$currentDate = $now["mday"] . "." . $now["mon"] . "." . $now["year"];
    	$get_datetime = $currentDate." ".$currentTime;


		$this->AcDc->read(null, 1);
		$this->AcDc->set(array(
			'site_id'   	=> $pieces[3],
			'data_1'		=> $dc_energy,
			'watt'   		=> $dc_watt,
			'data_2' 		=> $dc_volt,
			'data_3'     	=> $dc_current,
			'data_4'     	=> $update_valuee,
			'time'			=> $get_datetime
		));
		$this->AcDc->save();

		$this->paginate = array(
			'order' => array('AcDc.id' => 'desc' ),
			'limit' => 9
		);
		$this->AcDc->recursive = 0;
		$ac_dc_value = $this->paginate('AcDc');
		$this->set('ac_dc_valuee', $ac_dc_value);
	}
}