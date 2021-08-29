<?php $this->assign('title', 'Device :: Config');
	$date 			= new DateTime();
	$date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
?>
<div class="content-wrapper">
    <section class="content bgimage">
       <div class= "row">
       		<div class="col-md-12" >
	       		<div class="bar bar-primary bar-top">
					<h3 class="bar-title col-md-4"><?php echo __("{$readerData['Testing']['site_name']} Device :: Configuration Panel"); ?></h3>

					<div class="col-md-8 text-right">

	                    <?php echo $this->Form->create('Testing',array('url'=>array('controller'=>'fibers', 'action'=>'dashboard')), array('class'=>'searchForm','data-role'=>'form')); ?>

	                    <?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>

	                    <?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
	                            
	                    <?php echo $this->Form->end(); ?>
	                </div>
				</div>
				<div class="row bar bar-secondary">
					<div class="col-md-6 text-left">
						<?php echo $this->Html->link('<i class=\'fa fa-angle-double-left\'></i> Back', array('controller'=>'configurations','action' => 'index'),array('escape'=>false,'class'=>'btn btn-info')); ?>
					</div>
					<div class="col-md-6 text-right">
						<?php echo $this->Html->link('<i class=\'fa fa-angle-double-left\'></i> BTS Operation Board', array('controller'=>'configurations','action' => 'index'),array('escape'=>false,'class'=>'btn btn-warning')); ?>
					</div>
				</div>
				<div class="row bar bar-third">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										Configurations Part One
									</div>
									<div class="panel-body">
										<div class="row">
										  	<?php echo $this->Form->create('blc',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'blc_edit',$readerData['Testing']['site_name'])));?>
										  
												<div class="col-md-9">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align:left;">BLC Voltage</label>
											  			<div class="col-md-7">
												  			<?php echo $this->Form->input('blc',array('class'=>'form-control','type' => 'number', 'step' => '.5', 'min' => 20, 'max' => '60', 'div'=>false,'label'=>false,'value'=>$readerData['Testing']['blc'])); ?>
											  			</div>
										  			</div>
												</div>
										  		
									  			<div class="col-md-3">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
									  	</div>
									  	
									  	<div class="row">
										  	<?php echo $this->Form->create('lockdelay',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'lock_delay_edit',$readerData['Testing']['site_name'])));?>
												<div class="col-md-9">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align:left;">Lock delay</label>
											  			<div class="col-md-7">
												  			<?php echo $this->Form->input('blc',array('class'=>'form-control','type' => 'number', 'step' => '.5', 'min' => 20, 'max' => '60', 'div'=>false,'label'=>false,'value'=>$readerData['Testing']['blc'])); ?>
											  			</div>
										  			</div>
												</div>
										  		
									  			<div class="col-md-3">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
									  	</div>
									  	
								  		<div class="row">
										  	<?php echo $this->Form->create('bts_datetime',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'time_edit',$readerData['Testing']['site_name'])));?>
												<div class="col-md-9">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align:left;">Date Time Update</label>
											  			<div class="col-md-7">
												  			<?php echo $this->Form->input('date_time',array('class'=>'form-control','readonly'=>true, 'value' => $date->format('d-m-y')." | ".$date->format('H:i:s'), 'div'=>false,'label'=>false)); ?>
											  			</div>
										  			</div>
												</div>
									  			<div class="col-md-3">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
									  	</div>
									  	
									  	<div class="row">
										  	<?php echo $this->Form->create('dip',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'device_ip',$readerData['Testing']['site_name'])));?>
												<div class="col-md-9">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align:left;">Device Ip</label>
											  			<div class="col-md-7">
												  			<?php echo $this->Form->input('site_ip',array('class'=>'form-control','div'=>false,'label'=>false, 'pattern' =>"((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$",'value'=>$readerData['Testing']['blc'])); ?>
											  			</div>
										  			</div>
												</div>
										  		
									  			<div class="col-md-3">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
									  	</div>
									  	
								  		<div class="row">
										  	<?php echo $this->Form->create('sip',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'server_ip',$readerData['Testing']['site_name'])));?>
												<div class="col-md-9">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align:left;">Server Ip</label>
											  			<div class="col-md-7">
												  			<?php echo $this->Form->input('server_ip',array('class'=>'form-control','div'=>false,'label'=>false, 'pattern' =>"((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$",'readonly'=>true,'value'=>'144.48.2.11','div'=>false,'label'=>false)); ?>
											  			</div>
										  			</div>
												</div>
										  		
									  			<div class="col-md-3">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
									  	</div>

									  	<div class="row">
										  	<?php echo $this->Form->create('device_id_update',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'device_id_update',$readerData['Testing']['site_name'])));?>
												<div class="col-md-9">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align:left;">Device ID Update</label>
											  			<div class="col-md-7">
												  			<?php echo $this->Form->input('deviceId',array('class'=>'form-control','div'=>false,'label'=>false,'value'=>$readerData['Testing']['blc'])); ?>
											  			</div>
										  			</div>
												</div>
										  		
									  			<div class="col-md-3">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
										</div>

										<div class="row">
										  	<?php echo $this->Form->create('module_id_update',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'module_id_update',$readerData['Testing']['site_name'])));?>
												<div class="col-md-9">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align:left;">Module ID Update</label>
											  			<div class="col-md-7">
												  			<?php echo $this->Form->input('moduleId',array('class'=>'form-control','div'=>false,'label'=>false,'value'=>$readerData['Testing']['blc'])); ?>
											  			</div>
										  			</div>
												</div>
										  		
									  			<div class="col-md-3">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel panel-default">
										<div class="panel-heading">
											Configurations Part Two
										</div>
										<div class="panel-body">
										  	<div class="row">
											  	<?php echo $this->Form->create('door_sensing',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'door_sensing',$readerData['Testing']['site_name'])));?>
													<div class="col-md-9">
														<div class="form-group">
											  				<label class="col-sm-5 control-label" style="text-align:left;">Door Sensing</label>
												  			<div class="col-md-7">
													  			<?php echo $this->Form->input('door_sensing_val',array('class'=>'form-control','div'=>false,'label'=>false,'value'=>$readerData['Testing']['blc'])); ?>
												  			</div>
											  			</div>
													</div>
											  		
										  			<div class="col-md-3">
										  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info')));?>
										  			</div>
											  	<?php echo $this->Form->end();?>
										  	</div>

										  	<div class="row">
											  	<?php echo $this->Form->create('water_sensing',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'water_sensing',$readerData['Testing']['site_name'])));?>
													<div class="col-md-9">
														<div class="form-group">
											  				<label class="col-sm-5 control-label" style="text-align:left;">Water Sensing </label>
												  			<div class="col-md-7">
													  			<?php echo $this->Form->input('water_sensing_val',array('class'=>'form-control','div'=>false,'label'=>false,'value'=>$readerData['Testing']['blc'])); ?>
												  			</div>
											  			</div>
													</div>
											  		
										  			<div class="col-md-3">
										  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info')));?>
										  			</div>
											  	<?php echo $this->Form->end();?>
										  	</div>

										  	<div class="row">
											  	<?php echo $this->Form->create('smoke_sensing',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'smoke_sensing',$readerData['Testing']['site_name'])));?>
													<div class="col-md-9">
														<div class="form-group">
											  				<label class="col-sm-5 control-label" style="text-align:left;">Smoke Sensing </label>
												  			<div class="col-md-7">
													  			<?php echo $this->Form->input('smoke_sensing_val',array('class'=>'form-control','div'=>false,'label'=>false,'value'=>$readerData['Testing']['blc'])); ?>
												  			</div>
											  			</div>
													</div>
											  		
										  			<div class="col-md-3">
										  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info')));?>
										  			</div>
											  	<?php echo $this->Form->end();?>
										  	</div>

										  	<div class="row">
											  	<?php echo $this->Form->create('internal_no_nc_edit',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'internal_no_nc_edit',$readerData['Testing']['site_name'])));?>
													<div class="col-md-9">
														<div class="form-group">
											  				<label class="col-sm-5 control-label" style="text-align:left;">Internal NO/NC </label>
												  			<div class="col-md-7">
													  			<?php echo $this->Form->input('internal_relay_no_nc',array('class'=>'form-control','value'=>$readerData['Testing']['blc'],'placeholder'=>'xxx','div'=>false,'label'=>false)); ?>
												  			</div>
											  			</div>
													</div>
										  			<div class="col-md-3">
										  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info')));?>
										  			</div>
											  	<?php echo $this->Form->end();?>
										  	</div>

										  	<div class="row">
											  	<?php echo $this->Form->create('all_relay_no_nc_edit',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'all_relay_no_nc_edit',$readerData['Testing']['site_name'])));?>
													<div class="col-md-9">
														<div class="form-group">
											  				<label class="col-sm-5 control-label" style="text-align:left;">All Relay NO/NC </label>
												  			<div class="col-md-7">
													  			<?php echo $this->Form->input('all_relay_no_nc',array('class'=>'form-control','value'=>$readerData['Testing']['blc'],'placeholder'=>'xxx','div'=>false,'label'=>false)); ?>
												  			</div>
											  			</div>
													</div>
										  			<div class="col-md-3">
										  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info')));?>
										  			</div>
											  	<?php echo $this->Form->end();?>
										  	</div>

										  	<div class="row">
											  	<?php echo $this->Form->create('device_request_date',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'device_request_date',$readerData['Testing']['site_name'])));?>
													<div class="col-md-9">
														<div class="form-group">
											  				<label class="col-sm-5 control-label" style="text-align:left;">Device Date</label>
												  			<div class="col-md-7">
													  			<?php echo $this->Form->input('device_date',array('class'=>'form-control','readonly'=>true,'value'=>$readerData['Testing']['blc'],'div'=>false,'label'=>false)); ?>
												  			</div>
											  			</div>
													</div>
										  			<div class="col-md-3">
										  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info')));?>
										  			</div>
											  	<?php echo $this->Form->end();?>
										  	</div>

										  	<div class="row">
											  	<?php echo $this->Form->create('device_request_time',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'device_request_time',$readerData['Testing']['site_name'])));?>
													<div class="col-md-9">
														<div class="form-group">
											  				<label class="col-sm-5 control-label" style="text-align:left;">Device Time</label>
												  			<div class="col-md-7">
													  			<?php echo $this->Form->input('device_time',array('class'=>'form-control','readonly'=>true,'value'=>$readerData['Testing']['blc'], 'div'=>false,'label'=>false)); ?>
												  			</div>
											  			</div>
													</div>
										  			<div class="col-md-3">
										  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info')));?>
										  			</div>
											  	<?php echo $this->Form->end();?>
										  	</div>
										</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										Current Configuration Part One
									</div>
									<div class="panel-body">
										<dl class="dl-horizontal">
										  	<dt>BLC</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?> V</dd>
										  
										  	<dt>Lock Delay</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?> S</dd>
										  
										  	<dt>Date Time</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>
										  
										  	<dt>Device IP</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>
										  
										  	<dt>Server IP</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>

										  	<dt>Device ID</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>

										  	<dt>Module ID</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>
										</dl>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										Current Configuration Part Two
									</div>
									<div class="panel-body">
										<dl class="dl-horizontal">
										  	<dt>Door Sensing</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>

										  	<dt>Water Sensing</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>

										  	<dt>Smoke Sensing</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>

										  	<dt>Internal NO/NC</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>

										  	<dt>All Relay NO/NC</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>

										  	<dt>Device Date</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>

										  	<dt>Device Time</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>
										</dl>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>