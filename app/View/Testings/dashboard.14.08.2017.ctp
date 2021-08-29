<div class="content-wrapper">
    <section class="content">
       <div class= "row">
       		<div class="col-md-12" >
				<div style="width:100%;">
					<div id="show" style="width:100%; float: left;">

						<div class="row bar bar-third">
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table table-striped" style="width: 100%;">
										<thead>
											<tr class="text-center" bgcolor=#99ddff>
												<th><?php echo $this->Paginator->sort('site_name'); ?></th>
												<th><?php echo $this->Paginator->sort('Live'); ?></th>
												<th><?php echo $this->Paginator->sort('Signal'); ?></th>
												<th><?php echo $this->Paginator->sort('voltage'); ?></th>
												<th><?php echo $this->Paginator->sort('Open By'); ?></th>
												<th><?php echo $this->Paginator->sort('Door'); ?></th>
												<th><?php echo $this->Paginator->sort('Reader'); ?></th>
												<th><?php echo $this->Paginator->sort('Al 1'); ?></th>
												<th><?php echo $this->Paginator->sort('Al 2'); ?></th>
												<th><?php echo $this->Paginator->sort('Al 3'); ?></th>
												<th><?php echo $this->Paginator->sort('Al 4'); ?></th>
												<th><?php echo $this->Paginator->sort('RL 1'); ?></th>
												<th><?php echo $this->Paginator->sort('RL 2'); ?></th>
												<th class="text-center action-th" style="width: 10%;"><?php echo $this->Paginator->sort('Time'); ?></th>
												<th class="text-center action-th" style="width: 4%;"><?php echo __('Operation'); ?></th>
											</tr>
										</thead>
					
										<tbody>

											<?php 

												$handle = file_get_contents("C:/datatemp/LiveDevice.txt");
												$ex_val = explode(',', $handle);
												foreach ($zones as $zone): ?>

													<?php
														$site_match = '';
														$site_namee = $zone['Testing']['site_name'];
														for($i=0;$i<count($ex_val)-1;$i++){
															if($zone['Testing']['site_name'] == $ex_val[$i]){ 
																$site_match = $zone['Testing']['site_name'];
															}
														}

														if($site_match == $site_namee){?>

															<tr class="success">
																<td style="padding-left: 20px;"><?php echo h($zone['Testing']['site_name']); ?></td>
																<td style="padding-left: 20px; ">
																	<ul class="list-inline">
																		<?php 
																			$class= "site-active";
																			echo "<li class='{$class}'></li>";
																		?>
																	</ul>	
																</td>
																<td style="padding-left: 20px;"><?php echo h($zone['Testing']['signal_strenght']);?></td>
																<td style="padding-left: 20px;"><?php echo h($zone['Testing']['voltage']); ?></td>
																<td style="padding-left: 15px;">
																	<?php 
																		$open_by = $zone['Testing']['door_open_by'];
																		if($open_by=='1111111'){
																			echo "Central";
																		}
																		elseif($open_by=='2222222'){
																			echo "EMU";
																		}
																		else{
																			echo $open_by;
																		} 
																	?>
																
																</td>

																<td style="padding-left: 25px;">

								                    				<ul class="list-inline">
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
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
					                                    			</ul>
																</td>
																<td style="padding-left: 25px;">

																	<ul class="list-inline">
									                                        <?php
									                                            
									                                            if($zone['Testing']['card_reader'] == 0){
									                                                $class= "reader-active";  
									                                            }
									                                            elseif($zone['Testing']['card_reader'] == 1){
									                                            	$class= "reader-fail";
									                                            }
									                                            echo "<li class='{$class}'></li>";
									                                            //echo "<div class='ppp'><li class='{$class}'></li><div class='spann'>Voltage</div></div>";
									                                        ?>
									                                </ul>		
																</td>

																<td style="padding-left: 20px; background-color: #99c9f7;">
																	<ul class="list-inline">
								                                        <?php
								                                            
								                                            if($zone['Testing']['alarm_1'] == 0){
								                                                $class= "alarm_one_active";  
								                                            }
								                                            elseif($zone['Testing']['alarm_1'] == 1){
								                                            	$class= "alarm_one_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
								                                    </ul>
								                                </td>

								                                <td style="padding-left: 20px; background-color: #99c9f7;">
																	<ul class="list-inline">
								                                        <?php
								                                            
								                                            if($zone['Testing']['alarm_2'] == 0){
								                                                $class= "alarm_two_active";  
								                                            }
								                                            elseif($zone['Testing']['alarm_2'] == 1){
								                                            	$class= "alarm_two_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
								                                    </ul>
								                                </td>

								                                <td style="padding-left: 20px; background-color: #99c9f7;">
																	<ul class="list-inline">
								                                        <?php
								                                            
								                                            if($zone['Testing']['alarm_3'] == 0){
								                                                $class= "alarm_three_active";  
								                                            }
								                                            elseif($zone['Testing']['alarm_3'] == 1){
								                                            	$class= "alarm_three_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
								                                    </ul>
								                                </td>

								                                <td style="padding-left: 20px; background-color: #99c9f7;">
																	<ul class="list-inline">
								                                        <?php 
								                                            
								                                            if($zone['Testing']['alarm_4'] == 0){
								                                                $class= "alarm_four_active";  
								                                            }
								                                            elseif($zone['Testing']['alarm_4'] == 1){
								                                            	$class= "alarm_four_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
								                                    </ul>
								                                </td>
								                                <td style="padding-left: 20px; background-color: #d8d8d8;">
																	<ul class="list-inline">
								                                        <?php
								                                            
								                                            if($zone['Testing']['alarm_5'] == 0){
								                                                $class= "alarm_five_active";  
								                                            }
								                                            elseif($zone['Testing']['alarm_5'] == 1){
								                                            	$class= "alarm_five_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
								                                    </ul>
								                                </td>
								                                <td style="padding-left: 20px;background-color: #d8d8d8;">
																	<ul class="list-inline">
								                                        <?php
								                                            
								                                             if($zone['Testing']['alarm_6'] == 0){
								                                                $class= "alarm_six_active";  
								                                            }
								                                            elseif($zone['Testing']['alarm_6'] == 1){
								                                            	$class= "alarm_six_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
								                                    </ul>
								                                </td>

								                                <td style="padding-left: 20px;"><?php echo h($zone['Testing']['modified']);?></td>

																<td class="text-center action">

																	<!-- <input onclick="change_1()" type="button" value="ON" id="myButton1" style="background-color: #5daf54;"></input> -->

																	<?php 
																		if($zone['Testing']['door_status'] == 1){
																			echo $this->Html->link('<i class="fa fa-lock"></i><span> Door Close</span>', array('controller'=>'testings','action' => 'door_open', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs', 'data-target'=>"#logFromDevice",'onclick'=>"startLogDownload('{$zone['Testing']['id']}')" ));
																		}
																		elseif($zone['Testing']['door_status'] == 2){
																			echo $this->Html->link('<i class="fa fa-unlock"></i><span> Door Open</span>', array('controller'=>'testings','action' => 'door_open', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs', 'data-target'=>"#logFromDevice",'onclick'=>"startLogDownload('{$zone['Testing']['id']}')" ));
																		}
																	?>


																	<!-- <?php echo $this->Html->link('<i class="fa fa-unlock"></i><span> Door Open</span>', array('controller'=>'testings','action' => 'door_open', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs')); ?> -->


																	<!-- <?php echo $this->Html->link('<i class="fa fa-unlock"></i><span> Door Open</span>', array('controller'=>'testings','action' => 'door_open', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs', 'data-target'=>"#logFromDevice",'onclick'=>"startLogDownload('{$zone['Testing']['id']}')" )); ?> -->


																</td>

															</tr>
														<?php }

														else{ ?>

															<tr class="danger">
																<td style="padding-left: 20px;"><?php echo h($zone['Testing']['site_name']); ?></td>
																<td style="padding-left: 20px;">
																	<ul class="list-inline">
																		<?php 
																			$class= "site-dead";
																			echo "<li class='{$class}'></li>";
																		?>
																	</ul>	
																</td>

																<td style="padding-left: 20px;"><?php echo h($zone['Testing']['signal_strenght']);?></td>
																<td style="padding-left: 20px;"><?php echo h($zone['Testing']['voltage']); ?></td>
																<td style="padding-left: 15px;">
																	<?php 
																		$open_by = $zone['Testing']['door_open_by'];
																		if($open_by=='1111111'){
																			echo "Central";
																		}
																		elseif($open_by=='2222222'){
																			echo "EMU";
																		}
																		else{
																			echo $open_by;
																		} 
																	?>
																
																</td>
																<td style="padding-left: 25px;">

								                    				<ul class="list-inline">
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

								                                            echo "<li class='{$class}'></li>"; 
								                                        ?>
					                                    			</ul>
																</td>
																<td style="padding-left: 25px;">

																	<ul class="list-inline">
									                                        <?php
									                                            
									                                            if($zone['Testing']['card_reader'] == 0){
									                                                $class= "reader-active";  
									                                            }
									                                            elseif($zone['Testing']['card_reader'] == 1){
									                                            	$class= "reader-fail";
									                                            }
									                                            echo "<li class='{$class}'></li>";
									                                            //echo "<div class='ppp'><li class='{$class}'></li><div class='spann'>Voltage</div></div>";
									                                        ?>
									                                </ul>		
																</td>
																<td style="padding-left: 20px; background-color: #99c9f7;">
																	<ul class="list-inline">
								                                        <?php
								                                            
								                                            if($zone['Testing']['alarm_1'] == 0){
								                                                $class= "alarm_one_active";  
								                                            }
								                                            elseif($zone['Testing']['alarm_1'] == 1){
								                                            	$class= "alarm_one_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
								                                    </ul>
								                                </td>

								                                <td style="padding-left: 20px; background-color: #99c9f7;">
																	<ul class="list-inline">
								                                        <?php
								                                            
								                                            if($zone['Testing']['alarm_2'] == 0){
								                                                $class= "alarm_two_active";  
								                                            }
								                                            elseif($zone['Testing']['alarm_2'] == 1){
								                                            	$class= "alarm_two_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>"; 
								                                        ?>
								                                    </ul>
								                                </td>

								                                <td style="padding-left: 20px; background-color: #99c9f7;">
																	<ul class="list-inline">
								                                        <?php
								                                            
								                                            if($zone['Testing']['alarm_3'] == 0){
								                                                $class= "alarm_three_active";  
								                                            }
								                                            elseif($zone['Testing']['alarm_3'] == 1){
								                                            	$class= "alarm_three_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>"; 
								                                        ?>
								                                    </ul>
								                                </td>

								                                <td style="padding-left: 20px; background-color: #99c9f7;">
																	<ul class="list-inline">
								                                        <?php 
								                                            
								                                            if($zone['Testing']['alarm_4'] == 0){
								                                                $class= "alarm_four_active";  
								                                            }
								                                            elseif($zone['Testing']['alarm_4'] == 1){
								                                            	$class= "alarm_four_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>"; 
								                                        ?>
								                                    </ul>
								                                </td>
								                                <td style="padding-left: 20px; background-color: #d8d8d8;">
																	<ul class="list-inline">
								                                        <?php
								                                            
								                                            if($zone['Testing']['alarm_5'] == 0){
								                                                $class= "alarm_five_active";  
								                                            }
								                                            elseif($zone['Testing']['alarm_5'] == 1){
								                                            	$class= "alarm_five_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
								                                    </ul>
								                                </td>
								                                <td style="padding-left: 20px;background-color: #d8d8d8;">
																	<ul class="list-inline">
								                                        <?php
								                                            
								                                             if($zone['Testing']['alarm_6'] == 0){
								                                                $class= "alarm_six_active";  
								                                            }
								                                            elseif($zone['Testing']['alarm_6'] == 1){
								                                            	$class= "alarm_six_deactive";
								                                            }
								                                            echo "<li class='{$class}'></li>";
								                                        ?>
								                                    </ul>
								                                </td>

								                                <td style="padding-left: 20px;"><?php echo h($zone['Testing']['modified']);?></td>

																<td class="text-center action">

																	<?php 
																		if($zone['Testing']['door_status'] == 1){
																			echo $this->Html->link('<i class="fa fa-lock"></i><span> Door Close</span>', array('controller'=>'testings','action' => 'door_open', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs', 'data-target'=>"#logFromDevice",'onclick'=>"startLogDownload('{$zone['Testing']['id']}')" ));
																		}
																		elseif($zone['Testing']['door_status'] == 2){
																			echo $this->Html->link('<i class="fa fa-unlock"></i><span> Door Open</span>', array('controller'=>'testings','action' => 'door_open', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs', 'data-target'=>"#logFromDevice",'onclick'=>"startLogDownload('{$zone['Testing']['id']}')" ));
																		}
																	?>

																	<!-- <?php echo $this->Html->link('<i class="fa fa-unlock"></i><span> Door Open</span>', array('controller'=>'testings','action' => 'door_open', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs')); ?> -->

																	<!-- <?php echo $this->Html->link('<i class="fa fa-unlock"></i><span> Door Open</span>', array('controller'=>'testings','action' => 'door_open', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs', 'data-target'=>"#logFromDevice",'onclick'=>"startLogDownload('{$zone['Testing']['id']}')" )); ?> -->

																</td>
																
															</tr>
														<?php }
													?>
												<?php endforeach; 
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="pagination-block">
								<p>
									<?php
										echo $this->Paginator->counter(array(
										'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
									));
									?>			
								</p>
								<div class="pagination">
									<?php
										echo $this->Paginator->prev('< ' . __('previous'),array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
										echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','currentTag'=>'a', 'currentClass'=>'current disabled'));
										echo $this->Paginator->next(__('next') . ' >', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
									?>
								</div>
							</div>	
						</div>
					</div>

					<script type="text/javascript">
						$(document).ready(function() {
							setInterval(function () {
								$('#show').load('index_1')
							}, 2000);
						});
					</script>

					<script type="text/javascript">
						function startLogDownload(device_id) // no ';' here
						{
						    //document.getElementById("myButton1").value="OFF"; 	
						    var elem = document.getElementById("logFromDevice");
						    if (elem.value=="ON") {
								elem.value = "OFF";
								document.getElementById('logFromDevice').style.backgroundColor="gray";
						    }
						    else{
								elem.value = "ON";
								document.getElementById('logFromDevice').style.backgroundColor="#5daf54";
						    }
						}
					</script>
				</div>
			</div>
		</div>
	</section>
</div>