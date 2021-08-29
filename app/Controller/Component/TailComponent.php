<?php 
class TailComponent extends Component{
	
	// The name of the file to read
	private $FILE_NAME =  'tempLog.log';
	private  $LINES_TO_DISPLAY = 20;
	
	public function realTimeTerminal(){
		$file = WWW_ROOT . 'tempLog/'. $this->FILE_NAME;
		if (!is_file($file)) {
			return array(
					'status' 	=> false,
					'message'	=> 'Not a file'
			);
			//die("Not a file - ".$this->FILE_NAME."\n");
		}
		
		if (!$lines = $this->get_lines($file,$this->LINES_TO_DISPLAY)) {
			return array(
					'status' 	=> false,
					'message'	=> ''
			);
		}
		
		return array(
				'status' 	=> true,
				'message'	=> $this->get_lines($file,$this->LINES_TO_DISPLAY)
		);
		
	}
	
	
	private function get_lines($filename,$lines_to_display) {
		if (!$open_file = fopen($filename,'r')) {
			return false;
		}
		$pointer = -2; 
		$char = '';
		$beginning_of_file = false;
		$lines = array();
		for ($i=1;$i<=$lines_to_display;$i++) {
			if ($beginning_of_file == true) {
				continue;
			}
			
			while ($char != "\n") {
				if(fseek($open_file,$pointer,SEEK_END) < 0) {
					$beginning_of_file = true;
					rewind($open_file);
					break;
				}
				$pointer--;
				fseek($open_file,$pointer,SEEK_END);
				$char = fgetc($open_file);
			}
			array_push($lines,fgets($open_file));
			$char = '';
		}
		fclose($open_file);
		return $lines;
	}
	
}