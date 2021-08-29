<?php 
	function check_menu_active($current_location,$options){
		$condition = false;
		if((in_array($current_location['controller'],$options['controllers'],true)  && in_array($current_location['plugin'],$options['plugins'],'true'))== true){
			$condition = true;
		}
		if($condition == true){
			echo 'in';
		}
	}
	
	if($this->request['plugin'] == ''){
		$plugin = 'default';
	}else{
		$plugin = $this->request['plugin'];
	}
	
	$current_location = array('plugin'=>$plugin,'controller'=>$this->request['controller']);
	
	
	//check_menu_active(array('plugin'=>'default','controller'=>'menus'),array('plugins'=>array('default'),'controllers'=>array('menus')));
	
?>

<div class="col-md-2 left-bar">
	<div class="bar bar-primary bar-top">
		<?php echo $this->Html->link('<i class="fa fa-dashboard"></i> Dashboard',['controller'=>'dashboards','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false,'class'=>'dashboard-link']); ?>
	</div>
	<div class="panel-group" id="accordion-menu">
		
		<!-- Operation -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<?php echo $this->Html->link('<i class="fa fa-cogs"></i> OPR Manager <i class="fa fa-angle-double-down pull-right"></i>','#opeationManager',['escape'=>false,'data-toggle'=>"collapse" ,'data-parent'=>"#accordion-menu"]);?>
				</h4>
			</div>
			<div id="opeationManager" class="panel-collapse collapse <?php check_menu_active($current_location,array('plugins'=>array('default'),'controllers'=>array('operations')));?>">
				<div class="panel-body panel-body-custom">
					<ul class="left-bar-menu-ul">
						<li>
							<?php echo $this->Html->link('<i class="fa fa-signal"></i> BTS',['controller'=>'operations','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
					</ul>
				</div>
			</div>
		</div>
		
		
		<!-- Operation 
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<?php echo $this->Html->link('<i class="fa fa-cogs"></i> OPR Manager <i class="fa fa-chevron-down pull-right"></i>','#opeationManager',['escape'=>false,'data-toggle'=>"collapse" ,'data-parent'=>"#accordion-menu"]);?>
				</h4>
			</div>
			<div id="opeationManager" class="panel-collapse collapse <?php check_menu_active($current_location,array('plugins'=>array('default'),'controllers'=>array('assigned_cards','device_logs')));?>">
				<div class="panel-body panel-body-custom">
					<ul class="left-bar-menu-ul">
						<li>
							<?php echo $this->Html->link('<i class="fa fa-th-list"></i> Assigned Cards',['controller'=>'assigned_cards','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						
						<li>
							<?php echo $this->Html->link('<i class="fa fa-plus-square-o"></i>Open Lock',['controller'=>'assigned_cards','action'=>'openlock','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						
						
						<li>
							<?php echo $this->Html->link('<i class="fa fa-plus-square-o"></i>Device Logs',['controller'=>'device_logs','action'=>'device_log_lists','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
					</ul>
				</div>
			</div>
		</div>-->
		
		<!-- System manager -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<?php echo $this->Html->link('<i class="fa fa-bar-chart"></i> Sys Manager <i class="fa fa-angle-double-down pull-right"></i>','#stationManager',['escape'=>false,'data-toggle'=>"collapse" ,'data-parent'=>"#accordion-menu"]);?>
				</h4>
			</div>
			<div id="stationManager" class="panel-collapse collapse <?php check_menu_active($current_location,array('plugins'=>array('default'),'controllers'=>array( 'zones','card_readers','cards')));?>">
				<div class="panel-body panel-body-custom">
					<ul class="left-bar-menu-ul">
						<li>
							<?php echo $this->Html->link('<i class="fa fa-cloud"></i> Zone',['controller'=>'zones','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-sellsy"></i> Base Station',['controller'=>'card_readers','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-credit-card"></i> Cards',['controller'=>'cards','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
					</ul>
				</div>
			</div>
		</div>
		
		
	

		<!-- user manager -->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<?php echo $this->Html->link('<i class="fa fa-users"></i> User Manager <i class="fa fa-angle-double-down pull-right"></i>','#userManager',['escape'=>false,'data-toggle'=>"collapse" ,'data-parent'=>"#accordion-menu"]);?>
				</h4>
			</div>
			<div id="userManager" class="panel-collapse collapse <?php check_menu_active($current_location,array('plugins'=>array('default'),'controllers'=>array('users','roles')));?>">
				<div class="panel-body panel-body-custom">
					<ul class="left-bar-menu-ul">
						<li>
							<?php echo $this->Html->link('<i class="fa fa-user"></i> Users',['controller'=>'users','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
						<li>
							<?php echo $this->Html->link('<i class="fa fa-flag"></i> Roles',['controller'=>'roles','action'=>'index','admin'=>true,'plugin'=>false],['escape'=>false]);?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	

	</div>
</div>
