<?php
	App::uses('AppModel', 'Model');
	class Site extends AppModel {
		public $displayField = 'site_name';
		public $actsAs = array('Containable');
		//public $displayField = 'id';

		/**
		 * Validation rules
		 *
		 * @var array
		 */

		public $validate = array(
			'zone_id' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => 'Please select a zone.',
					'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				)
			),
			'SiteModuleId' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => 'Please input BTS ID.',
					'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
				'isUnique' => array(
					'rule' => array('isUnique'),
					'message' => 'This site id already exists into system',
					'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				)
			),
			'site_name' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => 'Please input BTS name.',
					'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
				'isUnique' => array(
					'rule' => array('isUnique'),
					'message' => 'This site name already exists into system',
					'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				)
			),
			'service_port' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => 'Please input a service port ie xxx',
					'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
				'numeric' => array(
					'rule' => array('numeric'),
					'message' => 'Please Fillup Service Port',
					'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				)
			),
			'status' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => 'Please Fillup Service Status',
					'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),

			'server_ip' => array(
				'notBlank' => array(
					'rule' => array('notBlank'),
					'message' => 'Please input an ip address ie xxx.xxx.xxx.xxx',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			),
		);

		public $hasOne = array(
			'Testing' => array(
				'className' => 'Testing',
				'foreignKey' => 'site_name',
				'dependent' => true,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
			),

			'AlarmIdentifier' => array(
				'className' => 'AlarmIdentifier',
				'foreignKey' => 'site_name',
				'dependent' => true,
				'conditions' => '',
				'fields' => '',
				'order' => '',
				'limit' => '',
				'offset' => '',
				'exclusive' => '',
				'finderQuery' => '',
				'counterQuery' => ''
			)
		);
	}
?>
