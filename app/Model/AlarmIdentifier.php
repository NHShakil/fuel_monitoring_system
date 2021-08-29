<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');


class AlarmIdentifier extends AppModel {

	public $displayField = 'id';
    
	public $validate = array(
        'site_name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'An IP address is required',
				'allowEmpty' => false
            ),
			
			'unique' => array(
				'rule'    => array('isUniqueSiteName'),
				'message' => 'This site_name is already in use'
			)
        )		
    );
	

	function isUniqueSiteName($check) {

		$ip = $this->find('first',array('fields' => array('AlarmIdentifier.id','AlarmIdentifier.site_name'),'conditions' => array('AlarmIdentifier.site_name' => $check['site_name'])));

		if(!empty($ip)){

			if($this->data[$this->alias]['site_name'] == $ip['AlarmIdentifier']['site_name']){
				return true; 
			}
			else
			{
				return false; 
			}
		}
		else
		{
			return true; 
		}
    }
}

?>
