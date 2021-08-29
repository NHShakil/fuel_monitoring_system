<?php
class AvrlogComponent extends Component {

	//avr command list
	public function logParser($data){
		
		$arrayData = explode(',',$data);
		
		
		$thisCommands = $this->decodeCommandAndStatus($arrayData[4]);
		
		$thisDeviceStatus = $this->decodeDeviceStatus($arrayData['5']);
		
		$returnArray = array(
			'type'		=> $arrayData[0],
			'command'	=> $thisCommands['action'],
			'commandBy' => 'central',
			'value'		=> $arrayData[3],
			'status'    => $thisCommands['status']
		);
		
		if($thisCommands['action'] == 'ip_config'){
			$subCommandDetails = $this->subCommands($arrayData[3]);
		} elseif($thisCommands['action'] == 'device_config'){
			$subCommandDetails = $this->subCommands($arrayData[3]);
		}elseif($thisCommands['action'] == 'device_event_trigger'){
			if($thisDeviceStatus['unauthorized_card'] == '1'){ 
				$subCommandDetails = $this->subCommands($arrayData[3]);
			}elseif($thisDeviceStatus['blc_status'] == '1'){
				$returnArray['command'] = 'blc_active';
				$returnArray['commandBy'] = 'device';
				$returnArray['status'] = $thisDeviceStatus['lockStatus'];
			}else{
				$returnArray['command'] = 'lock_open';
				$returnArray['commandBy'] = 'device';
				$returnArray['status'] = $thisDeviceStatus['openbycard'];
			}
		}
		
		if(isset($subCommandDetails)){
			$returnArray = array(
					'command'	=> $subCommandDetails['subCommand'],
					'commandBy' => $subCommandDetails['commandBy'],
					'value'		=> $subCommandDetails['value'],
					'status'    => $thisCommands['status']
			);
			
			if($returnArray['command'] == 'date_time'){
				$returnArray['value'] = $arrayData[1];
			}elseif($returnArray['command'] == 'device_ip'){
				$returnArray['value'] = '-';
			}elseif($returnArray['command'] == 'server_ip'){
				$returnArray['value'] = '-';
			}
		}
		
		if($returnArray['command'] == 'lock_open' && $returnArray['commandBy'] == 'central'){
			$returnArray['value'] = '-';
		}
		
		
		
		$returnArray['date'] = $arrayData[1];
		$returnArray['time'] = $arrayData[2];
		return $returnArray;
	}
	
	public function subCommands($data){
		$subCommandBits = substr($data,0,4);
		//echo $data;
		$subCommands =  array(
			'1111'	=> 'lock_open', //central
			'2222'	=> 'lock_open',	//emu
			'3333' 	=> 'date_time', //central
			'4444'	=> 'device_ip', //central
			'5555'	=> 'server_ip', //central
			'6666'  => 'set_blc',   //blc
			'8888'	=> 'lock_delay'	//central
		);
		
		//sub command
		$commandBy = 'central';
		if(!isset($subCommands[$subCommandBits])){
			$thisSubCommand = 'theft_try'; //
			$commandBy = 'device';
		}else{
			$thisSubCommand = $subCommands[$subCommandBits]; //
		}
		
		//value & command by
		$value = $data;
		
		
		if($subCommandBits == '6666'){
			$value = substr($data,4,8);
		}elseif($subCommandBits == '8888'){
			$value = substr($data,4,8);
		}elseif($subCommandBits == '1111'){
			$value = '-';
		}
		//
		return array(
			'subCommand'	=> $thisSubCommand,
			'commandBy'		=> $commandBy,
			'value'			=> $value
		);
	}
	
	public function commandList(){
		$commandList = array(
			'card_add' 				=> '00000001', //card add
			'card_delete' 			=> '00000010', //cadd delete
			'lock_open'				=> '00000100', //Lock open
			'download'				=> '00001000',
			'ip_config'				=> '00010000',
			'device_config'			=> '00100000',
			'device_event_trigger' 	=> '01000000'
		);
		return array_flip($commandList);
	}
	
	//decode command and respective status
	public function decodeCommandAndStatus($data){
		$commandAndStatus = str_pad(decbin($data), 8, '0', STR_PAD_LEFT);
		
		$commandCode = str_pad(substr($commandAndStatus,0,7),8, '0', STR_PAD_LEFT);
		$commandStatus = substr($commandAndStatus,7,8);
		
		//command list
		$commandList = $this->commandList();
		return array(
			'action'	=> $commandList[$commandCode],
			'status'	=> $commandStatus		
		);
	}
	
	//device status list
	public function deviceStatus(){
		$statusList = array(
			'blc_status',
			'openbycentral',
			'openbyemu',
			'openbycard',
			'cardReader',
			'unauthorized_card',
			'lockFail',
			'lockStatus'
				
		);
		return array_reverse($statusList);
	}
	
	public function decodeDeviceStatus($data){
		$dStatus = str_pad(decbin($data), 8, '0', STR_PAD_LEFT);
		$thisStatusArray = str_split($dStatus);
		$statusList = $this->deviceStatus();
		
		$returnData = array();
		
		foreach($statusList as $k=>$v){
			$returnData[$v] = $thisStatusArray[$k];
		}
		
		return $returnData;
	}


}