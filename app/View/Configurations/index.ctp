<div class="content-wrapper">
    <section class="content">
       <div class= "row">
       		<div class="col-md-12" >
       			<div class="bar bar-primary bar-top">
					<span class="report-title pull-left"><i class=" fa fa-wrench fa-1x"></i> Device Configuration</span>	
					<!-- <div class="col-md-9 text-right">
				        <?php echo $this->Form->create('Testing',array('url'=>array('controller'=>'testings', 'action'=>'search_bts')), array('class'=>'searchForm','data-role'=>'form')); ?>
				        <?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
				        <?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
				        <?php echo $this->Form->end(); ?>
				    </div> -->
				</div>
				<div class="row bar bar-third">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped" style="width: 100%;">
								<thead>
									<tr class="text-center" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">
										<th>site_name</th>
										<th>Live</th>
										<th class="text-center action-th"><?php echo __('Operation'); ?></th>
									</tr>
								</thead>

								<tbody>
									<?php 
										foreach ($device_ip as $zone):
											if($zone['Testing']['status']==1){ ?>
												<tr class="success">
													<td style="font-size: 12px; padding-top: 14px;">
														<span>
															<?php 
																if($zone['Testing']['site_name']=='1238'){
																	echo $zone['Testing']['site_name'].' MNTBO2';
																}
																else{
																	echo $zone['Testing']['site_name'];
																}
															?>
														</span>
													</td>
													<td style="padding-left: 20px;">
														<ul class="list-inline">
															<?php 
																if($zone['Testing']['status']==1){
																	$class= "site-active";
																	echo "<li class='{$class}'></li>";
																}
															?>
														</ul>	
													</td>
													<td class="text-center action" style="padding-left: 20px;font-size: 14px; font-family: 'Times New Roman', Georgia, Serif;">
														<?php 
															echo $this->Html->link('<i class="fa fa-cog"></i><span> Device Config</span>', array('controller'=>'configurations','action' => 'device_configuration', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs'));
														?>
														<?php 
															echo $this->Html->link('<i class="fa fa-cog"></i><span> Card Management</span>', array('controller'=>'configurations','action' => 'card_management', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs'));
														?>

														<!-- <?php 
															echo $this->Html->link('<i class="fa fa-cog"></i><span> Door Alarm</span>', array('controller'=>'configurations','action' => 'door_alarm', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs'));
														?> -->
														<?php 

															//echo $this->Html->link('<i class="fa fa-cog"></i><span> Visitor Site Attendence Time</span>', array('controller'=>'reports','action' => '#', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs','data-toggle' => 'modal', 'data-target' => '#myModal'));


															echo $this->Html->link('<i class="fa fa-cog"></i><span> Visitor Site Attendence Time</span>', array('controller'=>'configurations','action' => 'site_attendence_time', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs'));
														?>
													</td>
												</tr><?php 
											}
											elseif($zone['Testing']['status']==0){ ?>
												<tr class="danger">
													<td style="font-size: 12px; padding-top: 14px;">
														<span>
															<?php 
																if($zone['Testing']['site_name']=='1238'){
																	echo $zone['Testing']['site_name'].' MNTBO2';
																}
																else{
																	echo $zone['Testing']['site_name'];
																}
															?>
														</span>
													</td>
													<td style="padding-left: 20px;">
														<ul class="list-inline">
															<?php 
																if($zone['Testing']['status']==0){ 
																	$class= "site-dead";
																	echo "<li class='{$class}'></li>";
																}
															?>
														</ul>	
													</td>
													<td class="text-center action" style="padding-left: 20px;font-size: 14px; font-family: 'Times New Roman', Georgia, Serif;">
														<?php 
															echo $this->Html->link('<i class="fa fa-cog"></i><span> Device Config</span>', array('controller'=>'configurations','action' => 'device_configuration', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs'));
														?>
														<?php 
															echo $this->Html->link('<i class="fa fa-cog"></i><span> Card Management</span>', array('controller'=>'configurations','action' => 'card_management', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs'));
														?>

														<!-- <?php 
															echo $this->Html->link('<i class="fa fa-cog"></i><span> Door Alarm</span>', array('controller'=>'configurations','action' => 'door_alarm', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs'));
														?> -->
														<?php 

															//echo $this->Html->link('<i class="fa fa-cog"></i><span> Visitor Site Attendence Time</span>', array('controller'=>'reports','action' => '#',$zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs','data-toggle' => 'modal', 'data-target' => '#myModal'));

															echo $this->Html->link('<i class="fa fa-cog"></i><span> Visitor Site Attendence Time</span>', array('controller'=>'configurations','action' => 'site_attendence_time', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs'));
														?>
													</td>
												</tr><?php 
											}
										endforeach; 
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
       		</div>
       	</div>
    </section>
</div>




<div class="container">
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Active Site List</h4>
				</div>
		        <div class="modal-body">
		          	<div class="row">
					  	<?php echo $this->Form->create('water_sensing',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'water_sensing',$device_ip['Testing']['Siteid'])));?>
							<div class="col-md-9">
								<div class="form-group">
					  				<label class="col-sm-3 control-label">Card Two </label>
						  			<div class="col-md-9">
							  			<?php echo $this->Form->input('water_sensing_val',array('class'=>'form-control','div'=>false,'label'=>false,'value'=>$device_ip['Testing']['blc'])); ?>
						  			</div>
					  			</div>
							</div>
					  		
				  			<div class="col-md-3">
				  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info')));?>
				  				<?php echo $this->Form->button('<i class="fa fa-times-circle-o"></i><span> Delete</span>',array('type'=>'submit','class'=>array('btn btn-danger')));?>
				  			</div>
					  	<?php echo $this->Form->end();?>
				  	</div>
		        </div>

		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
			</div>
		</div>
	</div>
</div>