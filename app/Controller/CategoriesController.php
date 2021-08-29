<?php
	App::uses('AppController', 'Controller');
	App::uses('CakeTime', 'Utility');

	class CategoriesController extends AppController {
		public $uses = array('Category');

		public function ajax_categories() {
			if($this->request->is('put')){
				$options =   	$this->Category->find('list',
			        array(
			            'conditions' => array(
			                'Category.parent_id' => $_GET['data']['Category']['id']
			            )
			        )
			    );
			
			pr($options);
			$this->set(compact('options'));
			$this->render('/elements/ajax_dropdown', 'ajax');
			}
			
		}
	}

?>