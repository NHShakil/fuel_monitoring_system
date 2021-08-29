<?php $this->assign('title', 'Door Status');?>
<div class="content-wrapper">
    <section class="content">
       <div class= "row">
    		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
        			<h2 class="bar-title col-md-4"><?php echo __('Reports :: Door Status'); ?></h2>
        		</div>
        	</div>
        	<div class="bar bar-third">
    			<div class="col-md-12">
					<div class="row">
				      	<div class="col-sm-4">
				      		<div class="panel panel-info">
            					<div class="panel-heading">Door Close: <?php echo $door_close ?> </div>
        						<table class="table table-striped" style="width: 100%;">
									<thead>
										<tr class="text-center" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">
											<th>Site Name</th>
											<th>Live Status</th>
											<th>Door Status</th>
											<th>last Update</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											foreach ($sites_info as $zone):
												if($zone['Testing']['door_status']==1){ ?>
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
														<td style="padding-left: 25px;">
						                    				<ul class="list-inline" style="padding-top: 5px;">
						                                        <?php
						                                            
						                                            if($zone['Testing']['door_status'] == 2){
						                                                $class= "relay-on";
						                                            }
						                                            elseif($zone['Testing']['door_status'] == 1){
						                                                $class= "relay-off";
						                                            }
						                                            elseif($zone['Testing']['door_status'] == 3){
						                                                $class= "relay-un";
						                                            }
						                                            elseif($zone['Testing']['door_status'] == 0){
						                                            	$class= "relay-off";
						                                            }
						                                            echo $this->Html->link("<li class='{$class}'></li>", array('controller'=>'configurations','action'=>'function_details', $zone['Testing']['id'],1),array('escape'=>false));
						                                            //echo "<li class='{$class}'></li>";
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
            					<div class="panel-heading">Door Open: <?php echo $door_open ?> </div>
        						<table class="table table-striped" style="width: 100%;">
									<thead>
										<tr class="text-center" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">
											<th>Site Name</th>
											<th>Live Status</th>
											<th>Door Status</th>
											<th>last Update</th>
										</tr>
									</thead>

									<tbody>
										<?php 
											foreach ($sites_info as $zone):
												if($zone['Testing']['door_status']==2){ ?>
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
														<td style="padding-left: 25px;">
						                    				<ul class="list-inline" style="padding-top: 5px;">
						                                        <?php
						                                            
						                                            if($zone['Testing']['door_status'] == 2){
						                                                $class= "relay-on";
						                                            }
						                                            elseif($zone['Testing']['door_status'] == 1){
						                                                $class= "relay-off";
						                                            }
						                                            elseif($zone['Testing']['door_status'] == 3){
						                                                $class= "relay-un";
						                                            }
						                                            elseif($zone['Testing']['door_status'] == 0){
						                                            	$class= "relay-off";
						                                            }
						                                            echo $this->Html->link("<li class='{$class}'></li>", array('controller'=>'configurations','action'=>'function_details', $zone['Testing']['id'],1),array('escape'=>false));
						                                            //echo "<li class='{$class}'></li>";
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
            					<div class="panel-heading">Door Unauthorized: <?php echo $unautorized ?> </div>
        						<table class="table table-striped" style="width: 100%;">
									<thead>
										<tr class="text-center" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">
											<th>Site Name</th>
											<th>Live Status</th>
											<th>Door Status</th>
											<th>last Update</th>
										</tr>
									</thead>

									<tbody>
										<?php 
											foreach ($sites_info as $zone):
												if($zone['Testing']['door_status']==3){ ?>
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
														<td style="padding-left: 25px;">
						                    				<ul class="list-inline" style="padding-top: 5px;">
						                                        <?php
						                                            
						                                            if($zone['Testing']['door_status'] == 2){
						                                                $class= "relay-on";
						                                            }
						                                            elseif($zone['Testing']['door_status'] == 1){
						                                                $class= "relay-off";
						                                            }
						                                            elseif($zone['Testing']['door_status'] == 3){
						                                                $class= "relay-un";
						                                            }
						                                            elseif($zone['Testing']['door_status'] == 0){
						                                            	$class= "relay-off";
						                                            }
						                                            echo $this->Html->link("<li class='{$class}'></li>", array('controller'=>'configurations','action'=>'function_details', $zone['Testing']['id'],1),array('escape'=>false));
						                                            //echo "<li class='{$class}'></li>";
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