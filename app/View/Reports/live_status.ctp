<?php $this->assign('title', 'Device Live Status');?>
<div class="content-wrapper">
    <section class="content">
       <div class= "row">
    		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
        			<h2 class="bar-title col-md-4"><?php echo __('Reports :: Live Status'); ?></h2>
        		</div>
        	</div>
        	<div class="bar bar-third">
    			<div class="col-md-12">
					<div class="row">
				      	<div class="col-sm-4">
				      		<div class="panel panel-info">
            					<div class="panel-heading">Live Site: <?php echo $active ?> </div>
        						<table class="table table-striped" style="width: 100%;">
									<thead>
										<tr class="text-center" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">
											<th>Site Name</th>
											<th>Live Status</th>
											<th>last Update</th>
										</tr>
									</thead>

									<tbody>
										<?php 
											foreach ($sites_info as $zone):
												if($zone['Testing']['status']==1){ ?>
													<tr class="success">
														<td style="font-size: 12px; padding-top: 14px;">
															<span>
																<?php echo $zone['Testing']['site_name'];?>
															</span>
														</td>
														<td style="padding-left: 20px;">
															<ul class="list-inline">
																<?php 
																	if($zone['Testing']['status']==1){
																		$class= "site-active";	
																	}
																	elseif($zone['Testing']['status']==0){
																		$class= "site-dead";
																	}
																	echo "<li class='{$class}'></li>";
																?>
															</ul>	
														</td>
														<td style="font-size: 12px; padding-top: 14px;">
															<span>
																<?php echo $zone['Testing']['modified'];?>
															</span>
														</td>
													</tr><?php 
												}
											endforeach; 
										?>
									</tbody>
								</table>
          					</div>
				      	</div>
				      	<div class="col-sm-4">
				      		<div class="panel panel-danger">
            					<div class="panel-heading">Dead Site: <?php echo $inactive ?> </div>
        						<table class="table table-striped" style="width: 100%;">
									<thead>
										<tr class="text-center" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">
											<th>Site Name</th>
											<th>Live Status</th>
											<th>last Update</th>
										</tr>
									</thead>

									<tbody>
										<?php 
											foreach ($sites_info as $zone):
												if($zone['Testing']['status']==0){ ?>
													<tr class="success">
														<td style="font-size: 12px; padding-top: 14px;">
															<span>
																<?php echo $zone['Testing']['site_name'];?>
															</span>
														</td>
														<td style="padding-left: 20px;">
															<ul class="list-inline">
																<?php 
																	if($zone['Testing']['status']==1){
																		$class= "site-active";	
																	}
																	elseif($zone['Testing']['status']==0){
																		$class= "site-dead";
																	}
																	echo "<li class='{$class}'></li>";
																?>
															</ul>	
														</td>
														<td style="font-size: 12px; padding-top: 14px;">
															<span>
																<?php echo $zone['Testing']['modified'];?>
															</span>
														</td>
													</tr><?php 
												}
											endforeach; 
										?>
									</tbody>
								</table>
          					</div>
				      	</div>
				      	<div class="col-sm-4">
				      		<div class="panel panel-warning">
            					<div class="panel-heading">Inactive Site: <?php echo $draft ?> </div>
        						<table class="table table-striped" style="width: 100%;">
									<thead>
										<tr class="text-center" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">
											<th>Site Name</th>
											<th>Live Status</th>
											<th>last Update</th>
										</tr>
									</thead>

									<tbody>
										<?php 
											foreach ($sites_info as $zone):
												if($zone['Testing']['status']==''){ ?>
													<tr class="success">
														<td style="font-size: 12px; padding-top: 14px;">
															<span>
																<?php echo $zone['Testing']['site_name'];?>
															</span>
														</td>
														<td style="padding-left: 20px;">
															<ul class="list-inline">
																<?php 
																	if($zone['Testing']['status']==1){
																		$class= "site-active";	
																	}
																	elseif($zone['Testing']['status']==0){
																		$class= "site-dead";
																	}
																	echo "<li class='{$class}'></li>";
																?>
															</ul>	
														</td>
														<td style="font-size: 12px; padding-top: 14px;">
															<span>
																<?php echo $zone['Testing']['modified'];?>
															</span>
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
        </div>
    </section>
</div>