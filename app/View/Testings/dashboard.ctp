<div class= "row">
	<div class="col-md-12" >
		<div class="bar bar-primary bar-top">
			<div class="col-md-12">
				<div class="btn-toolbar">
					<div class="col-md-2">
						<span class="report-title pull-left"><i class=" fa fa-spinner fa-spin"></i> Dashboard</span>	
					</div>

					<?php 
						echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Live: '.$active.'</span>', array('controller'=>'reports','action' => '#',1),array('escape'=>false,'class'=>'btn btn-success btn-sm','data-toggle' => 'modal', 'data-target' => '#myModalActive')).str_repeat('&nbsp;', 1);
						
						echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Inactive: '.$draft.'</span>', array('controller'=>'reports','action' => '#',3),array('escape'=>false,'class'=>'btn btn-warning btn-sm','data-toggle' => 'modal', 'data-target' => '#myModalInactive')).str_repeat('&nbsp;', 1             );

						echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Not Updating: '.$inactive.'</span>', array('controller'=>'reports','action' => '#',2),array('escape'=>false,'class'=>'btn btn-danger btn-sm','data-toggle' => 'modal', 'data-target' => '#myModalDraft'));
					?>
				</div>
			</div>
		</div>
		
		<?php echo $this->Session->flash();?>

        <hr>
		<div class="card">
            <div class="card-header bg-warning">
              	<h3 class="card-title">Last Update Data of All Sites</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive no-padding" id="show">
                <table id="example1" class="table table-bordered table-striped">
                	<thead>
						<tr bgcolor=#99ddff class="text-left" bgcolor=#99ddff style="font-size: 15px; font-family: 'Times New Roman', Georgia, Serif;">
							<th>DREDGER NAME</th>
							<th>LAST UPDATE TIME</th>
							<th class="text-left">LIVE</th>
							<th class="text-center">GMS SIGNAL</th>
							<th class="text-right">RECEIVED FUEL</th>
						</tr>
					</thead>
					
                	<tbody>
						<?php 
							foreach ($zones as $zone):
								if($zone['Testing']['status']==1){ ?>
									<tr class="success">
										<td class="font-size-text">
											<?php 
												echo $this->Html->link( $zone['Testing']['site_name'], array('action'=>'fixed_device', $zone['Testing']['id']),array('escape' => false,'class'=>'font-size-text'));
											?>
										</td>
										<td class="font-size-text"><?php echo h($zone['Testing']['full_date_time']);?></td>
										<td >
											<ul class="list-inline text-center" style="margin-top: 8px;">
												<?php 
													if($zone['Testing']['status']==1){

														$class= "site-active";
														
														echo $this->Html->link("<li class='{$class}'></li>", array('controller'=>'testings','action'=>'dead_list', $zone['Testing']['id']),array('escape' => false));	

													}
												?>
											</ul>
										</td>

										<td class="font-size-text text-center"><?php echo h($zone['Testing']['signal_strenght']);?></td>
										<td class="font-size-text text-right">
											<?php 
												echo $this->Html->link(number_format($zone['Testing']['consumed_fuel'],2), array('controller'=>'testings', 'action'=>'monthly_used_fuel', $zone['Testing']['id']),array('escape' => false));
												
											?>
										</td>
									</tr>
									<?php
								}
								elseif($zone['Testing']['status']==0){ ?>
									<tr class="danger">
										<td class="font-size-text">
											<?php 
												echo $this->Html->link( $zone['Testing']['site_name'], array('action'=>'fixed_device', $zone['Testing']['id']),array('escape' => false));
											?>
										</td>
										<td class="font-size-text"><?php echo h($zone['Testing']['full_date_time']);?></td>
										<td class="font-size-text">
											<ul class="list-inline" style="margin-top: 8px;">
												<?php 
													if($zone['Testing']['status']==0){

														$class= "site-dead";
														
														echo $this->Html->link("<li class='{$class}'></li>", array('controller'=>'testings','action'=>'dead_list', $zone['Testing']['id']),array('escape' => false));	

													}
												?>
											</ul>
										</td>

										<td class="font-size-text text-center"><?php echo h($zone['Testing']['signal_strenght']);?></td>
										<td class="font-size-text text-right">
											<?php 
												echo $this->Html->link( number_format($zone['Testing']['consumed_fuel'],2), array('controller'=>'testings', 'action'=>'monthly_used_fuel', $zone['Testing']['id']),array('escape' => false));
												
											?>
										</td>
									</tr>

								<?php }
							endforeach 
						?>
					<tbody>
					<!--<tfoot>-->
					<!--	<tr bgcolor=#99ddff class="text-left" bgcolor=#99ddff style="font-size: 15px; font-family: 'Times New Roman', Georgia, Serif;">-->
					<!--		<th>DREDGER NAME</th>-->
					<!--		<th>LAST UPDATE TIME</th>-->
					<!--		<th class="text-left">LIVE</th>-->
					<!--		<th class="text-center">GMS SIGNAL</th>-->
					<!--		<th class="text-right">RECEIVED FUEL</th>-->
					<!--	</tr>-->
					<!--</tfoot>-->
				</table>
			</div>

			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

			<script type="text/javascript">
				$(document).ready(function() {
					setInterval(function () {
						$('#show').load('index')
					},120000);
				});
			</script>

			
		</div>


	</div>
	
</div>


<div class="modal" id="myModalActive">
    <div class="modal-dialog">
      	<div class="modal-content">
      
        	<!-- Modal Header -->
	        <div class="modal-header">
	          <h4 class="modal-title">Live Site List</h4>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
        
        	<!-- Modal body -->
	        <div class="modal-body">
	          	<div class="table-responsive">
					<table class="table table-striped" style="width: 100%;">
						<thead>
							<tr class="text-left" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">
								<th>Site Name</th>
								<th>Last update</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($live_statuss as $zone): 
									if($zone['Testing']['status']==1){ ?>
										<tr>
											<td style="font-size: 13px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['Testing']['site_name']);?>
											</td>
											<td style="font-size: 13px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['Testing']['full_date_time']);?>
											</td>
										</tr><?php
									}
								endforeach;
							?>
						</tbody>
					</table>
				</div>
	        </div>
        
	        <!-- Modal footer -->
	        <div class="modal-footer">
	          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	        </div>
        
      	</div>
    </div>
</div>

<div class="modal" id="myModalInactive">
    <div class="modal-dialog">
      	<div class="modal-content">
      
        	<!-- Modal Header -->
	        <div class="modal-header">
	          <h4 class="modal-title">Inactive Site List</h4>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
        
        	<!-- Modal body -->
	        <div class="modal-body">
	          	<div class="table-responsive">
					<table class="table table-striped" style="width: 100%;">
						<thead>
							<tr class="text-left" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">
								<th>Site Name</th>
								<th>Last update</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($live_statuss as $zone): 
									if($zone['Testing']['status']==2){ ?>
										<tr>
											<td style="font-size: 13px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['Testing']['site_name']);?>
											</td>
											<td style="font-size: 13px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['Testing']['modified']);?>
											</td>
										</tr><?php
									}
								endforeach;
							?>
						</tbody>
					</table>
				</div>
	        </div>
        
	        <!-- Modal footer -->
	        <div class="modal-footer">
	          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	        </div>
        
      	</div>
    </div>
</div>

<div class="modal" id="myModalDraft">
    <div class="modal-dialog">
      	<div class="modal-content">
      
        	<!-- Modal Header -->
	        <div class="modal-header">
	          <h4 class="modal-title">Not Updating Site List</h4>
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	        </div>
        
        	<!-- Modal body -->
	        <div class="modal-body">
	          	<div class="table-responsive">
					<table class="table table-striped" style="width: 100%;">
						<thead>
							<tr class="text-left" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">
								<th>Site Name</th>
								<th>Last update</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($live_statuss as $zone): 
									if($zone['Testing']['status']==0){ ?>
										<tr>
											<td style="font-size: 13px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['Testing']['site_name']);?>
											</td>
											<td style="font-size: 13px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['Testing']['full_date_time']);?>
											</td>
										</tr><?php
									}
								endforeach;
							?>
						</tbody>
					</table>
				</div>
	        </div>
        
	        <!-- Modal footer -->
	        <div class="modal-footer">
	          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	        </div>
        
      	</div>
    </div>
</div>


