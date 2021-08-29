

<?php
	App::uses('Helper', 'View');
	class ZoneTreeHelper extends Helper{
		public $helpers = array('Html');
		public function createTree($data){
			$html = '<ul>';
				foreach ($data as $parent => $child){
					$html .= '<li>'.$this->Html->link("{$child['Zone']['name']}",array('controller'=>'sites','action'=>'index',$child['Zone']['id']));
					if(!empty($child['children'])){
						$html.= $this->createTree($child['children']);
					}
					$html .= '</li>';
				}
			$html .= '</ul>';
			return $html;
		}
	}