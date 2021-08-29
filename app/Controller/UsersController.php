<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
//CakePlugin::load('BotDetect');

class UsersController extends AppController {

	public $uses = array('User','LoginTable','Role');
	
	var $helpers = array('Html', 'Form','Csv'); 

	public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
    	'order' => array('User.username' => 'asc' ) 
    );

    public $components = array(
        'Paginator',
        // load the BotDetect Captcha component and set its parameter
        'BotDetect.Captcha' => array(
            'captchaConfig' => 'AuthCaptcha'
        )
    );
	
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login'); 
    }

    public function login() {
		
		$this->layout = "login";
		//if already logged-in, redirect
		if($this->Session->check('Auth.User')){
			$this->redirect(array('action' => 'index'));		
		}
		if ($this->request->is('post')) {

			///////////// Captcha start here ///////////////

			//$code = $this->request->data['User']['CaptchaCode'];
            //$isHuman = captcha_validate($code);
            // clear previous user input, since each Captcha code can only be validated once
            //unset($this->request->data['User']['CaptchaCode']);
            //if ($isHuman && $this->Auth->login()) {

            ///////////// Captcha End here ////////////////

			if ($this->Auth->login()){
				$this->User->id = $this->Auth->user('id'); // target correct record
				$user = $this->Auth->user('username');
				$count = $this->LoginTable->find('count', 
					array(
						'conditions' => array(
							'LoginTable.username' => $this->Auth->user('username')
						)
					)
				);
				if($count == 1){
					$this->LoginTable->updateAll(
						array(
							'LoginTable.login_count' 			=> $count
						),                    
						array(
							'LoginTable.username' => $this->Auth->user('username')
						)
					);
				}				
				$count = $count+1;
				$date = new DateTime();
				$date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
				$get_datetime = $date->format('YmdHis');

				if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
				    $ip = $_SERVER['HTTP_CLIENT_IP'];
				} 
				elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
				    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
				}
				else {
				    $ip = $_SERVER['REMOTE_ADDR'];
				}
				//$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
				/*echo $details->city;
				pr($details->city);
				pr($details->country);*/

				//pr(file_get_contents("http://ipinfo.io/{$ip}/json"));

				$date = date(DATE_ATOM);
				if($ip=='::1'){
					$this->LoginTable->saveField('ip_address', 	'Root');
				}
				else{
					$this->LoginTable->saveField('ip_address', 	$ip);
				}

        		$this->LoginTable->saveField('username', $user);
        		//$this->LoginTable->saveField('login_address', "$details->city,$details->country");
        		$this->LoginTable->saveField('login_time', $get_datetime);
        		$this->LoginTable->saveField('logout_time', $get_datetime);
        		$this->LoginTable->saveField('login_status','Active');
        		$this->LoginTable->saveField('login_count', $count);
				$this->Session->setFlash('You have successfully login');
				$this->redirect(array('controller'=>'testings','action'=>'dashboard'));
			} 
			else 
			{
                //if (!$isHuman) {
                    // Captcha validation failed, return an error message
                    //$this->Session->setFlash(__('Captcha is Incorrect'));
                //} 
                //else 
                //{
                	$this->Session->setFlash('Your Username or Password is Incorrect','flash_custom');
                //}
            }
		} 
	}

    public function index() {
		$this->paginate = array(
			'limit' => 25,
			'order' => array('User.username' => 'asc' )
		);
		$this->User->recursive = 0;
		$users = $this->paginate('User');
		$avg   = intval(count($users)/2);
		$this->set(compact('users','avg'));
    }

    public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

    public function add() {

        if ($this->request->is('post')) {
			$this->User->create();

			//pr($this->request->data);

			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('The user has been created');
				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash('The user could not be created. Please, try again.');		
			}	
        }
        else
        {
        	//pr($this->request->data);
        }
        $roles = $this->User->Role->find('list',array('conditions'=>array('status'=>'1')));
		$this->set(compact('roles'));
    }

    public function edit($id = null) {

	    if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}

		$user = $this->User->findById($id);
		if (!$user) {
			$this->Session->setFlash('Invalid User ID Provided');
			$this->redirect(array('action'=>'index'));
		}

		if ($this->request->is('post') || $this->request->is('put')) {
			$this->User->id = $id;
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been updated'));
				$this->redirect(array('action' => 'index', $id));
			}
			else
			{
				$this->Session->setFlash(__('Unable to update your user.'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $user;
		}

		$roles = $this->User->Role->find('list',array('conditions'=>array('status'=>'1')));
		$this->set(compact('roles'));
    }
    
	public function delete($id = null) {
		
		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}
		
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
			$this->redirect(array('action'=>'index'));
        }
        $this->request->allowMethod('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash('The User has been deleted.');
		} else {
			$this->Session->setFlash('The user could not be deleted. Please, try again.');
		}
		return $this->redirect(array('action' => 'index'));
    }

	public function download($username=null){

		if (!$username) {
			$this->Session->setFlash('Please provide an Username');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('datas',
			$this->LoginTable->find('all',
				array (
					'conditions' 	=> array('username' => $username),
					'fields'		=> array('ip_address','username','login_time','logout_time','login_status','login_count')
				)
			)
		);

		$this->set('download_file_name', $this->Auth->user('username'));
		$this->layout = null;
    	$this->autoLayout = false;
    	Configure::write('debug','0');
	}

	public function alldownload(){

		$this->set('datas', $this->LoginTable->find('all'));
		$this->set(compact('datas'));
		$this->layout = null;
    	$this->autoLayout = false;
    	Configure::write('debug','0');
	}

	public function logout() {
		$this->User->id = $this->Auth->user('id');
		$user = $this->Auth->user('username');
        $date = date(DATE_ATOM);

        $date = new DateTime();
		$date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
		$get_datetime = $date->format('YmdHis');

        $specificallyThisOne = $this->LoginTable->find('first', array('conditions' => array('LoginTable.login_time' => $user)));

        $this->set('datee', $this->LoginTable->find('all', array ('conditions' => array('LoginTable.login_time' => $user))));

        $var ='Inactive';        
		$this->LoginTable->updateAll(
  			array(
    			'LoginTable.logout_time' =>  "'$get_datetime'",
    			//'LoginTable.active_time' =>  "'$date->diff($LoginTable.login_time)'",
    			'LoginTable.login_status' => "'Inactive'"

  			),
  			array(
    			'LoginTable.login_status' => 'Active',
    			'LoginTable.username' => $user
  			)
		);

		$this->redirect($this->Auth->logout());
	}

	public function submit() {

        if ($this->request->is('post')) {	
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been created'));
				$this->redirect(array('action' => 'index'));
			} 
			else 
			{
				$this->Session->setFlash(__('The user could not be created. Please, try again.'));
			}	
        }
        $roles = $this->User->Role->find('list',array('conditions'=>array('status'=>'active')));
		$this->set(compact('roles'));
    }

    ///////  If I want that I don't delete a user. 
    ///////// I only Active or Reactive a user then use this comment code.

    /*public function delete($id = null) {
		
		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}
		
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
			$this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 0)) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }*/
	
	/*public function activate($id = null) {
		
		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}
		
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
			$this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 1)) {
            $this->Session->setFlash(__('User re-activated'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not re-activated'));
        $this->redirect(array('action' => 'index'));
    }*/

    // Download more function. But it is not properly.

    /*public function download($id=null){
    	if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}
		$user = $this->User->findById($id);

		if (!$user) {
			$this->Session->setFlash('Invalid User ID Provided');
			$this->redirect(array('action'=>'index'));
		}

		if ($this->request->is('post')) {
			$this->User->id = $id;
			if ($this->User->download($this->request->data)) {
				$this->Session->setFlash(__('Download Complete'));
				$this->redirect(array('action' => 'index', $id));
			}
			else
			{
				$this->Session->setFlash(__('Unable to download.'));
			}
		}			
    }*/


    /*public function downloadSamplefile() {
  		$this->viewClass = 'Media';
  		// Download app/webroot/files/example.csv
  		$params = array(
     				'id'        => 'example.csv',
     				'name'      => 'example',
     				'extension' => 'csv',
     				'download'  => true,
     				'path'      => APP . 'webroot' . DS. 'files'. DS  // file path
 					);

 		$this->set($params);
	}*/


	/*public function downloadentries() {
 
        if($this->request->is('post')) {
            $this->loadModel('LoginTable');
            $filename = "myfile.csv";
            $start_date = '2016-11-09 00:00:00';
            $end_date = '2016-11-10 23:59:59';
            $results = $this->LoginTable->find('all', array(
                        'conditions' => array('LoginTable.login_time >=' => $start_date, 
                                        'LoginTable.login_time <=' => $end_date)
                    ));

            $path = APP . 'webroot' . DS. 'files'. DS;
            $csv_file = fopen('$path', 'w');
 
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename="'.$filename.'"');
 
            $header_row = array("username", "login_time","logout_time");
 
            fputcsv($csv_file,$header_row,',','"');
            foreach($results AS $result) {
                $row = array(
                $result['LoginTable']['username'],
                $result['LoginTable']['login_time'],
                $result['LoginTable']['logout_time']
                );
 
                fputcsv($csv_file,$row,',','"');
            }
            fclose($csv_file);
        }
        $this->layout = false;
        $this->render(false);
        return false;
    }*/   
    

}

?>