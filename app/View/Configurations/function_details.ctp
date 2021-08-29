<!-- <style type="text/css">
	table {
    	max-width:650px;
    	table-layout:fixed;
   		margin:auto;
	}
	
	thead, tfoot {
	    background:#f9f9f9;
	    display:table;
	    width:100%;
	    width:calc(100% - 10px);
	}
	tbody {
	    height:525px;
	    overflow:auto;
	    overflow-x:hidden;
	    display:block;
	    width:100%;
	}
	tbody tr {
	    display:table;
	    width:100%;
	    table-layout:fixed;
	}
</style> -->

<div class="content-wrapper">
    <section class="content">
       <div class= "row">
       		<div class="col-md-12" >
				<div style="width:100%;">
					<div id="show" style="width:100%; float: left;">

						<div class="row bar bar-secondary">
                            <div class="col-md-2">
                                <?php echo $this->Html->link('<i class="fa fa-angle-double-left"></i><span> Back To Dashboard</span>', array('controller'=>'testings','action' => 'dashboard'),array('escape'=>false,'class'=>'btn btn-info')); ?>
                            </div>

                            <div class="col-md-3">
                                <?php 
                                	//echo $this->Html->link('<i class="fa fa-angle-double-left"></i><span> AC and DVS Running Time</span>', array('controller'=>'fibers','action' => '#',1),array('escape'=>false,'class'=>'btn btn-info','data-toggle' => 'modal', 'data-target' => '#myModal_live'));
                                ?>
                            </div>
                        </div>

						<div class="row bar bar-third">
							<div class="col-md-12">
								<!-- <table class="table table-hover">
								  	<thead>
								    	<tr>
								      		<th scope="col">#</th>
								      		<th scope="col">First</th>
								      		<th scope="col">Last</th>
								      		<th scope="col">Handle</th>
								    	</tr>
								  	</thead>
								  	<tbody>
								    	<tr>
								      		<th scope="row">1</th>
								      		<td>Mark</td>
								      		<td>Otto</td>
								      		<td>@mdo</td>
								    	</tr>
								    	<tr>
								      		<th scope="row">2</th>
								      		<td>Jacob</td>
								      		<td>Thornton</td>
								      		<td>@fat</td>
								    	</tr>
								    	<tr>
								      		<th scope="row">3</th>
								      		<td colspan="2">Larry the Bird</td>
								      		<td>@twitter</td>
								    	</tr>
								  	</tbody>
								</table> -->


								<div class="table-responsive">
									<table class="table table-striped" style="width: 100%;">
										<?php 
											if($conditional_value == '1'){ ?>
												<thead>
													<tr bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">
														<th class="text-left"> Site_Name </th>											
														<th class="text-center"> Site_Id </th>
														<th class="text-center"> User's OS </th>
														<th class="text-center"> User's PC Name </th>
														<th class="text-center"> User's PC IP </th>
														<th class="text-center"> User's Browser </th>
														<th class="text-center"> Door Open User </th>
														<th class="text-center"> Door Open BY </th>
														<th class="text-center"> Time </th>
													</tr>
												</thead>
						
												<tbody>
													<?php 
														foreach ($TestingLogDeviceReaderData as $zone): ?>
															<tr class="success" style="font-family: 'Cambria', Georgia, Serif;">
																<td class="text-left" style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['site_name']); ?>
																</td>
																<td class="text-center" style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['SiteModuleId']); ?>
																</td>
																<td class="text-center" style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['user_os_name']); ?>
																</td>
																<td class="text-center" style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['user_pc_name']); ?>
																</td>
																<td class="text-center" style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['user_pc_ip']); ?>
																</td>
																<td class="text-center" style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['user_browser_name']); ?>
																</td>
																<td class="text-center" style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['door_open_user']); ?>
																</td>
																<td class="text-center" style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['door_open_by']); ?>
																</td>
																<td class="text-center" style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['door_open_time']); ?>
																</td>
															</tr>
														<?php endforeach; 
													?>
												</tbody>
											<?php }

											elseif($conditional_value == '2'){ ?>
												<thead>
													<tr bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">											
														<th class="text-left">Site_Id</th>
														<th class="text-center">Reader Status</th>
														<th class="text-center">Time</th>
													</tr>
												</thead>
						
												<tbody>
													<?php 
														foreach ($TestingLogDeviceReaderData as $zone): ?>
															<tr class="success" style="font-family: 'Cambria', Georgia, Serif;">
																<td class="text-left" style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['TestingLogDevice']['SiteModuleId']); ?>
																</td>
																<td class="text-center" style="padding-left: 25px;">
								                    				<ul class="list-inline" style="padding-top: 5px;">
								                    					<?php
								                                            if($zone['TestingLogDevice']['card_reader'] == 0){
								                                                $class= "reader-active";  
								                                            }
								                                            elseif($zone['TestingLogDevice']['card_reader'] == 1){
								                                            	$class= "reader-fail";
								                                            }
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
						                                			</ul>
																</td>
																<td class="text-center" style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['TestingLogDevice']['modified']); ?>
																	
																</td>	
															</tr>
														<?php endforeach; 
													?>
												</tbody>
											<?php }

											elseif($conditional_value == '3'){?>
												<thead>
													<tr class="text-center" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">											
														<th>Site_Id</th>
														<th>Lock Position</th>
														<th>Time</th>
													</tr>
												</thead>
						
												<tbody>
													<?php 
														foreach ($TestingLogDeviceReaderData as $zone): ?>
															<tr class="success" style="font-family: 'Cambria', Georgia, Serif;">
																<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['TestingLogDevice']['SiteModuleId']); ?>
																</td>
																<td style="padding-left: 25px;">
								                    				<ul class="list-inline" style="padding-top: 5px;">
								                    					<?php
								                                            if($zone['TestingLogDevice']['alarm_1'] == 0){
								                                                $class= "alarm_one_active";  
								                                            }
								                                            elseif($zone['TestingLogDevice']['alarm_1'] == 1){
								                                            	$class= "alarm_one_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
						                                			</ul>
																</td>
																<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['TestingLogDevice']['modified']); ?>
																	
																</td>	
															</tr>
														<?php endforeach; 
													?>
												</tbody>
											<?php }

											elseif($conditional_value == '4'){?>
												<thead>
													<tr class="text-center" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">											
														<th>Site_Id</th>
														<th>Lock Position</th>
														<th>Time</th>
													</tr>
												</thead>
						
												<tbody>
													<?php 
														foreach ($TestingLogDeviceReaderData as $zone): ?>
															<tr class="success" style="font-family: 'Cambria', Georgia, Serif;">
																<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['TestingLogDevice']['SiteModuleId']); ?>
																</td>
																<td style="padding-left: 25px;">
								                    				<ul class="list-inline" style="padding-top: 5px;">
								                    					<?php
								                                            if($zone['TestingLogDevice']['alarm_2'] == 0){
								                                                $class= "alarm_one_active";  
								                                            }
								                                            elseif($zone['TestingLogDevice']['alarm_2'] == 1){
								                                            	$class= "alarm_one_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
						                                			</ul>
																</td>
																<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['TestingLogDevice']['modified']); ?>
																	
																</td>	
															</tr>
														<?php endforeach; 
													?>
												</tbody>
											<?php }

											elseif($conditional_value == '5'){?>
												<thead>
													<tr class="text-center" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">											
														<th>Site_Id</th>
														<th>Lock Position</th>
														<th>Time</th>
													</tr>
												</thead>
						
												<tbody>
													<?php 
														foreach ($TestingLogDeviceReaderData as $zone): ?>
															<tr class="success" style="font-family: 'Cambria', Georgia, Serif;">
																<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['TestingLogDevice']['SiteModuleId']); ?>
																</td>
																<td style="padding-left: 25px;">
								                    				<ul class="list-inline" style="padding-top: 5px;">
								                    					<?php
								                                            if($zone['TestingLogDevice']['alarm_3'] == 0){
								                                                $class= "alarm_one_active";  
								                                            }
								                                            elseif($zone['TestingLogDevice']['alarm_3'] == 1){
								                                            	$class= "alarm_one_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
						                                			</ul>
																</td>
																<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['TestingLogDevice']['modified']); ?>
																	
																</td>	
															</tr>
														<?php endforeach; 
													?>
												</tbody>
											<?php }

											elseif($conditional_value == '6'){?>
												<thead>
													<tr class="text-center" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">											
														<th>Site_Id</th>
														<th>Lock Position</th>
														<th>Time</th>
													</tr>
												</thead>
						
												<tbody>
													<?php 
														foreach ($TestingLogDeviceReaderData as $zone): ?>
															<tr class="success" style="font-family: 'Cambria', Georgia, Serif;">
																<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['TestingLogDevice']['SiteModuleId']); ?>
																</td>
																<td style="padding-left: 25px;">
								                    				<ul class="list-inline" style="padding-top: 5px;">
								                    					<?php
								                                            if($zone['TestingLogDevice']['alarm_4'] == 0){
								                                                $class= "alarm_one_active";  
								                                            }
								                                            elseif($zone['TestingLogDevice']['alarm_4'] == 1){
								                                            	$class= "alarm_one_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
						                                			</ul>
																</td>
																<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['TestingLogDevice']['modified']); ?>
																	
																</td>	
															</tr>
														<?php endforeach; 
													?>
												</tbody>
											<?php }

											elseif($conditional_value == '7'){?>
												<thead>
													<tr class="text-center" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">											
														<th>Site_Id</th>
														<th>Lock Position</th>
														<th>Time</th>
													</tr>
												</thead>
						
												<tbody>
													<?php 
														foreach ($TestingLogDeviceReaderData as $zone): ?>
															<tr class="success" style="font-family: 'Cambria', Georgia, Serif;">
																<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['TestingLogDevice']['SiteModuleId']); ?>
																</td>
																<td style="padding-left: 25px;">
								                    				<ul class="list-inline" style="padding-top: 5px;">
								                    					<?php
								                                            if($zone['TestingLogDevice']['alarm_5'] == 0){
								                                                $class= "alarm_one_active";  
								                                            }
								                                            elseif($zone['TestingLogDevice']['alarm_5'] == 1){
								                                            	$class= "alarm_one_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
						                                			</ul>
																</td>
																<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['TestingLogDevice']['modified']); ?>
																	
																</td>	
															</tr>
														<?php endforeach; 
													?>
												</tbody>
											<?php }

											elseif($conditional_value == '8'){?>
												<thead>
													<tr class="text-center" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">											
														<th>Site_Id</th>
														<th>Lock Position</th>
														<th>Time</th>
													</tr>
												</thead>
						
												<tbody>
													<?php 
														foreach ($TestingLogDeviceReaderData as $zone): ?>
															<tr class="success" style="font-family: 'Cambria', Georgia, Serif;">
																<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['TestingLogDevice']['SiteModuleId']); ?>
																</td>
																<td style="padding-left: 25px;">
								                    				<ul class="list-inline" style="padding-top: 5px;">
								                    					<?php
								                                            if($zone['TestingLogDevice']['alarm_6'] == 0){
								                                                $class= "alarm_one_active";  
								                                            }
								                                            elseif($zone['TestingLogDevice']['alarm_6'] == 1){
								                                            	$class= "alarm_one_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
						                                			</ul>
																</td>
																<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['TestingLogDevice']['modified']); ?>
																	
																</td>	
															</tr>
														<?php endforeach; 
													?>
												</tbody><?php 
											}
										?>
									</table>
								</div>
							</div>
						</div>
					</div>					
				</div>

				<div class="row">
					<div class="col-md-12">
						<div class="pagination-block" style="height: 5px;">
							<p>
								<?php
									echo $this->Paginator->counter(array(
									'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
								));
								?>			
							</p>
							<div class="pagination" style="height: 5px;">
								<?php
									echo $this->Paginator->prev('< ' . __('previous'),array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
									echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','currentTag'=>'a', 'currentClass'=>'current disabled'));
									echo $this->Paginator->next(__('next') . ' >', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
								?>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</section>
</div>