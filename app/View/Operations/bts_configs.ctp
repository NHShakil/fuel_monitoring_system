<div class="content-wrapper">
    <section class="content">
    	<div class="row">
			<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
					<h2 class="bar-title col-md-6"><?php echo __("{$btsDetails['CardReader']['name']} Device :: Configuration Panel"); ?></h2>
				</div>
			


				<div class="row bar bar-secondary">
					<div class="col-md-6">
						<?php echo $this->Html->link('<i class=\'fa fa-cog\'></i> BTS Operation Board', array('action' => 'index'),array('escape'=>false,'class'=>'btn btn-success')); ?>
					</div>
					<div class="col-md-6 text-right">
						<?php echo $this->Html->link('<i class=\'fa fa-angle-double-left\'></i> Back', array('action' => 'index',$backButton[0],"page:$backButton[1]"),array('escape'=>false,'class'=>'btn btn-info')); ?>
					</div>	
				</div>

				<div class="row bar bar-third">
					<div class="col-md-12">
	
						<div class="row">
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										Configurations
									</div>
					
									<div class="panel-body">
									<!-- Blc -->
									<div class="row">
						  				<?php echo $this->Form->create('blc',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'operations', 'action'=>'bts_blc_config', $btsId)));?>
											<div class="col-md-9">
												<div class="form-group">
						  							<label class="col-sm-5 control-label">BLC Voltage</label>
							  						<div class="col-md-7">
								  						<?php echo $this->Form->input('voltage',array('class'=>'form-control','type' => 'number', 'step' => '.1', 'min' => 20, 'max' => '60', 'div'=>false,'label'=>false,'value'=>$btsDetails['CardReader']['blc'])); ?>
							  						</div>
						  						</div>
											</div>
						  		
					  						<div class="col-md-3">
					  							<?php echo $this->Form->button('EDIT',array('type'=>'submit','class'=>array('btn btn-info')));?>
					  						</div>
						  				<?php echo $this->Form->end();?>
					  				</div>
					  	
					  				<!-- Lock delay -->
					  				<div class="row">
						  				<?php echo $this->Form->create('lockdelay',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'operations', 'action'=>'bts_lockdelay_config',$btsId)));?>
											<div class="col-md-9">
												<div class="form-group">
						  							<label class="col-sm-5 control-label">Lock delay</label>
							  						<div class="col-md-7">
								  						<?php echo $this->Form->input('time',array('min'=>10,'max'=>180,'type'=>'number', 'class'=>'form-control','div'=>false,'label'=>false,'value'=>$btsDetails['CardReader']['lock_delay'])); ?>
							  						</div>
						  						</div>
											</div>
						  		
					  					<div class="col-md-3">
					  						<?php echo $this->Form->button('EDIT',array('type'=>'submit','class'=>array('btn btn-info')));?>
					  					</div>
						  				<?php echo $this->Form->end();?>
					  				</div>
					  	
				  					<div class="row">
						  				<?php echo $this->Form->create('bts_datetime',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'operations', 'action'=>'bts_datetime_config',$btsId)));?>
										<div class="col-md-9">
											<div class="form-group">
						  						<label class="col-sm-5 control-label">Date Time</label>
							  					<div class="col-md-7">
								  					<?php echo $this->Form->input('date_time',array('class'=>'form-control','readonly'=>true, 'value' => date('d-m-Y')." | ".date('H-i-s'), 'div'=>false,'label'=>false)); ?>
							  					</div>
						  					</div>
										</div>
						  		
					  					<div class="col-md-3">
					  						<?php echo $this->Form->button('EDIT',array('type'=>'submit','class'=>array('btn btn-info')));?>
					  					</div>
						  				<?php echo $this->Form->end();?>
					  				</div>
					  	
					  				<div class="row">
						  				<?php echo $this->Form->create('dip',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'operations', 'action'=>'bts_dip_config',$btsId)));?>
										<div class="col-md-9">
											<div class="form-group">
						  						<label class="col-sm-5 control-label">Device Ip</label>
							  					<div class="col-md-7">
								  					<?php echo $this->Form->input('bts_ip',array('class'=>'form-control','div'=>false,'label'=>false, 'pattern' =>"((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$",'value'=>$btsDetails['CardReader']['ip_address'])); ?>
							  					</div>
						  					</div>
										</div>
						  		
					  					<div class="col-md-3">
					  						<?php echo $this->Form->button('EDIT',array('type'=>'submit','class'=>array('btn btn-info')));?>
					  					</div>
						  				<?php echo $this->Form->end();?>
					  				</div>
					  	
				  					<div class="row">
						  				<?php echo $this->Form->create('sip',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'operations', 'action'=>'bts_sip_config',$btsId)));?>
										<div class="col-md-9">
											<div class="form-group">
						  						<label class="col-sm-5 control-label">Server Ip</label>
							  					<div class="col-md-7">
								  					<?php echo $this->Form->input('server_ip',array('class'=>'form-control','div'=>false,'label'=>false, 'pattern' =>"((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$", 'readonly' => true, 'value'=>$btsDetails['CardReader']['server_ip'])); ?>
							  					</div>
						  					</div>
										</div>
						  		
					  					<div class="col-md-3">
					  						<?php echo $this->Form->button('EDIT',array('type'=>'submit','class'=>array('btn btn-info')));?>
					  					</div>
						  				<?php echo $this->Form->end();?>
					  				</div>
					  	
					  				<div class="row">
						  				<?php echo $this->Form->create('liveMode',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'operations', 'action'=>'bts_livemode_config',$btsId)));?>
										<div class="col-md-9">
											<div class="form-group">
						  						<label class="col-sm-5 control-label">Live Mode</label>
							  					<div class="col-md-7">
								  					<?php echo $this->Form->input('live_mode',array('options' => $live_mode, 'class'=>'form-control','div'=>false,'label'=>false)); ?>
							  					</div>
						  					</div>
										</div>
						  		
					  					<div class="col-md-3">
					  						<?php echo $this->Form->button('EDIT',array('type'=>'submit', 'default'=>$btsDetails['CardReader']['live_mode'],'class'=>array('btn btn-info')));?>
					  					</div>
						  				<?php echo $this->Form->end();?>
					  				</div>					  	
								</div>
							</div>
						</div>
			
						<div class="col-md-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									Current Configuration
								</div>
								<div class="panel-body">
									<dl class="dl-horizontal">
										<dt>BLC</dt>
							  			<dd><?php echo $btsDetails['CardReader']['blc'];?> V</dd>

							  			<dt>Lock Delay</dt>
							  			<dd><?php echo $btsDetails['CardReader']['lock_delay'];?> S</dd>							  
							  			<dt>Date Time</dt>
							  			<dd><?php echo $btsDetails['CardReader']['date_time'];?></dd>
							  
							  			<dt>Device IP</dt>
							  			<dd><?php echo $btsDetails['CardReader']['ip_address'];?></dd>
							  
							  			<dt>Server IP</dt>
							  			<dd><?php echo $btsDetails['CardReader']['server_ip'];?></dd>
							  
							  			<dt>Live Mode</dt>
							  			<dd><?php echo $live_mode[$btsDetails['CardReader']['live_mode']];?></dd>							  
									</dl>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>