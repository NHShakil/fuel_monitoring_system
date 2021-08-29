<?php

App::uses('Controller', 'Controller');


class AppController extends Controller {
	public function initialize(){
		parent::initialize();
		$this->User->id = $this->Auth->user('id'); // target correct record
		$users = $this->Auth->user('username');
		$loginAction = $this->Cookie->read($users);
	}


	public $components = array(

		'Session',
		
		'Auth' => array(
			'loginAction' =>array(
				'controller' => 'users',
				'action' => 'login',
				'plugin' => false
			),
			'loginRedirect' => array(
				'controller' => 'dashboards',
				'action' => 'index',
				'plugin' => false
			),
			'logoutRedirect' => array(
				'controller' => 'users',
				'action' => 'login',
				'plugin' => false
			),

			'authorize' => array('Controller'),	
		),
    );


	public $status 		= 	[
		'1' 		=> 		'Active',
		'0'			=> 		'Inactive',
		'2'			=> 		'Draft'
	];

	public $site_category = 	[
		'A' 		=> 		'A',
		'B'			=> 		'B',
		'C'			=> 		'C',
		'D'			=> 		'D',
		'E'			=> 		'E'
	];



	public $live_status = 	[
		'0'		        => 		'Not Updating',
		'3' 		    => 		'All',
		'1' 		    => 		'Live',
		'2'			    => 		'Inactive'
	];

	public $role 		=	[
		'Super Admin' 	=> 		'Super Admin',
		'Admin' 		=> 		'Admin',
		'End User' 		=> 		'End User'
	];

	

	public $live_mode 	= 		[
		'off'			=> 		'Off',
		'on' 			=> 		'On'
	];

	
	public $download_format = 	[
		'xls'			=> 		'XLS',
		'csv' 			=> 		'CSV',
		'pdf' 			=> 		'PDF'
	];

	public $acl_array 	= [

		'Operation Management' 	=>[

			[
				'controller' 	=> 'dashboards',
				'actions'		=> ['index','ac_dc','time_count','grid_report','get_all_data',
									'devices_data','specific_device_action','get_data_all_from_device','get_recent_data_specific','dac_index','avl_index','pi_chart','gen_index','esc_index','dvs_index','hbt_index'
				]
			],

			[
				'controller'    => 'testings',
				'actions'       => ['add','edit','index','index_2','delete','add_card','door_open','dashboard','download_card','show_card',
									'write_ip','write_ipp','bts_configs','date_time','delete_card','user_edit','data','action_controller',
									'door_open_form','download_log','search_bts','fixed_device','refresh_value','dead_list','monthly_used_fuel','daily_used_fuel','used_fuel_by_date','ajaxRequest']
			]		
		],
		
		'System Management'  	=>[
			[
				'controller'	=> 'sites',
				'actions'		=> ['index','add','edit','delete','search_bts','response','onSlectQuery']
			],

			[
				'controller'	=> 'zones',
				'actions'		=> ['index','add','edit','delete']
			]
		],
					

		'User Management' 		=>[
					
			[
				'controller'	=> 'users',
				'actions'		=> ['add','edit','index','delete','submit','download','alldownload']
			],

			[
				'controller'	=> 'roles',
				'actions'		=> ['index','add','edit','delete']
			],	

			[
				'controller'	=> 'logintables',
				'actions'		=> ['index','delete']
			],

			[
				'controller'	=> 'profiles',
				'actions'		=> ['index','edit']
			]			
		],		
	];
	

	public function beforeFilter() {
        $this->Auth->allow('login');
        $this->set('role',$this->role);
        $this->set('status', $this->status);
        $this->set('card_list',$this->card_list);
        $this->set('card_type',$this->card_type);
        $this->set('live_mode',$this->live_mode);
        $this->set('acl_array',$this->acl_array);
        $this->set('alarm_name',$this->alarm_name);
        $this->set('lock_status',$this->lock_status);
        $this->set('live_status',$this->live_status);
        $this->set('status_level',$this->status_level);
        $this->set('card_validity',$this->card_validity);
        $this->set('reader_status',$this->reader_status);
        $this->set('site_category',$this->site_category);
        $this->set('door_open_type',$this->door_open_type);
        $this->set('door_open_status',$this->door_open_status);
        $this->set('download_format',$this->download_format);
		$this->set('auth_user',$this->Auth->user());
    }

    public function isAuthorized($user = null){
		$permission_array = json_decode($user['Role']['accesslist'],true);

		//dashboards
		$permission_array['testings']['dashboard']    	   = 'dashboard';
		$permission_array['dashboards']['search_bts']      = 'search_bts';
		$permission_array['sites']['search_bts']           = 'search_bts';
		$permission_array['testings']['search_bts']        = 'search_bts';
		$permission_array['cards']['search_assigned_card'] = 'search_assigned_card';
		$permission_array['dashboards']['watchdog'] 	   = 'watchdog';

		//users permission
		$permission_array['users']['edit']	        	   = 'edit';
		$permission_array['users']['login'] 			   = 'login';
		$permission_array['users']['logout'] 			   = 'logout';	
		
		if(isset($permission_array[$this->params['controller']][$this->params['action']])){
			if($permission_array[$this->params['controller']][$this->params['action']] == $this->params['action']){
				return true;
			}
		}
		return false;
	}

	public function requestToAvr($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT,1);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
}
