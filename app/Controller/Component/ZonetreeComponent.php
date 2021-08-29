<?php 
class ZonetreeComponent extends Component{

	
	
	public function zoneTree($threaded,$level=0, $tree = array()) {
		foreach($threaded as $k=>$v){
			$tree[$v['Zonee']['id']] = $this->treeDashBuilder($level)." {$v['Zonee']['title']}";
			if(sizeof($v['children']) >0){
				$tree = $this->zoneTree($v['children'],$level+1,$tree);
			}
		}
		return $tree;
	}
	
	private function treeDashBuilder($level){
		$dashes = '';
		for($i=0; $i<$level;$i++){
			$dashes .= '-';
		}
		return $dashes;
	}
	
}