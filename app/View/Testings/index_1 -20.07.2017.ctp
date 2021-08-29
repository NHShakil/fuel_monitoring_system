<?php $this->assign('title', 'Device Ip List');?>
<meta http-equiv="refresh" content="5;">
<div class="content-wrapper">
    <section class="content">
       <div class= "row">
    		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
					<h3 class="bar-title col-md-2"><?php echo __('Device Ip List'); ?></h3>

					<div class="col-md-10 text-right">

                        <?php echo $this->Form->create('Testing',array('url'=>array('controller'=>'zones', 'action'=>'search_zone')), array('class'=>'searchForm','data-role'=>'form')); ?>

                        <?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>

                        <?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
                                
                        <?php echo $this->Form->end(); ?>
                    </div>
				</div>

				<div class="row bar bar-secondary">
					<div class="col-md-12">
						<?php echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Add Device Ip</span>', array('controller'=>'testings','action' => 'add'),array('escape'=>false,'class'=>'btn btn-success')); ?>
					</div>	
				</div>


				<div class="row bar bar-third">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped" >
								<thead>
									<tr class="text-center" bgcolor=#99ddff>
										<th><?php echo $this->Paginator->sort('site_name'); ?></th>
										<th><?php echo $this->Paginator->sort('Device Status'); ?></th>
										<th><?php echo $this->Paginator->sort('S Level'); ?></th>
										<th><?php echo $this->Paginator->sort('voltage'); ?></th>
										<th><?php echo $this->Paginator->sort('Door Open By'); ?></th>
										<th><?php echo $this->Paginator->sort('door_status'); ?></th>
										<th><?php echo $this->Paginator->sort('Al 1'); ?></th>
										<th><?php echo $this->Paginator->sort('Al 2'); ?></th>
										<th><?php echo $this->Paginator->sort('Al 3'); ?></th>
										<th><?php echo $this->Paginator->sort('Al 4'); ?></th>
										<th><?php echo $this->Paginator->sort('Al 5'); ?></th>
										<th><?php echo $this->Paginator->sort('Al 6'); ?></th>
										
										<th class="text-center action-th"><?php echo __('Actions'); ?></th>
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
														<td style="padding-left: 22px;"><?php echo h($zone['Testing']['site_name']); ?></td>
														<td style="padding-left: 40px;">
															<ul class="list-inline">
																<?php 
																	$class= "site-active";
																	echo "<div id='site-active'></div>";
																	echo "<li class='{$class}'></li>";
																	//echo "<div class='ppp'><li class='{$class}'></li><div class='spann'>Device Live</div></div>"
																?>
															</ul>	
														</td>
														<td style="padding-left: 20px;"><?php echo h($zone['Testing']['signal_strenght']);?></td>
														<td style="padding-left: 20px;"><?php echo h($zone['Testing']['voltage']); ?></td>
														<td style="padding-left: 40px;">
															<?php 
																$open_by = $zone['Testing']['door_open_by'];
																if($open_by=='1111111'){
																	echo "Open By Central";
																}
																else{
																	echo $open_by;
																} 
															?>
														
														</td>

														<td style="padding-left: 40px;">

						                    				<ul class="list-inline">
						                                        <?php
						                                            
						                                            if($zone['Testing']['door_status'] == 2){
						                                                $class= "relay-off";
						                                                echo "<div id='relay-off'></div>";
						                                                //echo "<div class='ppp'><li class='{$class}'></li><div class='spann'>Door Open</div></div>" 
						                                            }
						                                            elseif($zone['Testing']['door_status'] == 1){
						                                                $class= "relay-on";
						                                                echo "<div id='relay-on'></div>";
						                                                //echo "<div class='ppp'><li class='{$class}'></li><div class='spann'>Door Close</div></div>"
						                                            }
						                                            elseif($zone['Testing']['door_status'] == 3){
						                                                $class= "relay-un";
						                                                echo "<div id='relay-un'></div>";
						                                                //echo "<div class='ppp'><li class='{$class}'></li><div class='spann'>Unauthorized Access</div></div>"
						                                            }
						                                            elseif($zone['Testing']['door_status'] == 0){
						                                            	$class= "relay-on";
						                                            	echo "<div id='relay-on'></div>";
						                                            	//echo "<div class='ppp'><li class='{$class}'></li><div class='spann'>Door Open</div></div>"
						                                            }
						                                            echo "<li class='{$class}'></li>";
						                                            
						                                        ?>
			                                    			</ul>
														</td>

														<td style="padding-left: 20px;">
															<ul class="list-inline">
						                                        <?php
						                                            
						                                            if($zone['Testing']['alarm_1'] == 0){
						                                                $class= "alarm_one";
						                                                echo "<div id='alarm_one'></div>"; 
						                                            }
						                                            echo "<li class='{$class}'></li>";
						                                        ?>
						                                    </ul>
						                                </td>

						                                <td style="padding-left: 20px;">
															<ul class="list-inline">
						                                        <?php
						                                            
						                                            if($zone['Testing']['alarm_2'] == 0){
						                                                $class= "alarm_two";
						                                                echo "<div id='alarm_two'></div>"; 
						                                            }
						                                            echo "<li class='{$class}'></li>";  
						                                        ?>
						                                    </ul>
						                                </td>

						                                <td style="padding-left: 20px;">
															<ul class="list-inline">
						                                        <?php
						                                            
						                                            if($zone['Testing']['alarm_3'] == 0){
						                                                $class= "alarm_three";
						                                                echo "<div id='alarm_three'></div>"; 
						                                            }
						                                            echo "<li class='{$class}'></li>"; 
						                                        ?>
						                                    </ul>
						                                </td>

						                                <td style="padding-left: 20px;">
															<ul class="list-inline">
						                                        <?php
						                                            
						                                            if($zone['Testing']['alarm_4'] == 0){
						                                                $class= "alarm_four";
						                                                echo "<div id='alarm_four'></div>"; 
						                                            }
						                                            echo "<li class='{$class}'></li>";   
						                                        ?>
						                                    </ul>
						                                </td>
						                                <td style="padding-left: 20px;">
															<ul class="list-inline">
						                                        <?php
						                                            
						                                            if($zone['Testing']['alarm_5'] == 0){
						                                                $class= "alarm_five";
						                                                echo "<div id='alarm_five'></div>"; 
						                                            }
						                                            echo "<li class='{$class}'></li>"; 
						                                        ?>
						                                    </ul>
						                                </td>
						                                <td style="padding-left: 20px;">
															<ul class="list-inline">
						                                        <?php
						                                            
						                                            if($zone['Testing']['alarm_6'] == 0){
						                                                $class= "alarm_six";
						                                                echo "<div id='alarm_six'></div>"; 
						                                            }
						                                            echo "<li class='{$class}'></li>";
						                                            
						                                        ?>
						                                    </ul>
						                                </td>


														<td class="text-center action">

															<?php echo $this->Html->link('<i class="fa fa-unlock"></i><span> Door Open</span>', array('controller'=>'testings','action' => 'door_open', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Add Card</span>', array('controller'=>'testings','action' => 'add_card', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-minus-circle"></i><span> Delete Card</span>', array('controller'=>'testings','action' => 'delete_card', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-danger btn-sm')); ?>


															<?php echo $this->Html->link('<i class="fa fa-edit"></i><span> Edit Site</span>', array('action' => 'user_edit', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-warning btn-sm')); ?>

															<?php echo $this->Form->postLink('<i class="fa fa-times-circle-o"></i><span> Delete Site</span>', array('controller'=>'testings','action' => 'delete', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn btn-danger btn-sm'), __('Are you sure you want to delete?')); ?>
														</td>
													</tr>
												<?php }

												else{ ?>

													<tr class="danger">
														<td style="padding-left: 22px;"><?php echo h($zone['Testing']['site_name']); ?></td>
														<td style="padding-left: 40px; padding-top: 10px;">
															<ul class="list-inline">
																<?php 
																	$class= "site-dead";
																	echo "<div id='site-dead'></div>";
																	echo "<li class='{$class}'></li>";
																	//echo "<div class='ppp'><li class='{$class}'></li><div class='spann'>Device Dead</div></div>"
																?>
															</ul>	
														</td>

														<td style="padding-left: 20px;"><?php echo h($zone['Testing']['signal_strenght']);?></td>
														<td style="padding-left: 20px;"><?php echo h($zone['Testing']['voltage']); ?></td>
														<td style="padding-left: 40px;">
															<?php 
																$open_by = $zone['Testing']['door_open_by'];
																if($open_by=='1111111'){
																	echo $open_by;
																}
																else{
																	echo $open_by;
																} 
															?>
														
														</td>
														<td style="padding-left: 40px;">

						                    				<ul class="list-inline">
						                                        <?php
						                                            
						                                            if($zone['Testing']['door_status'] == 2){
						                                                $class= "relay-off";
						                                                echo "<div id='relay-off'></div>";
						                                            }
						                                            elseif($zone['Testing']['door_status'] == 1){
						                                                $class= "relay-on";
						                                                echo "<div id='relay-on'></div>";
						                                            }
						                                            elseif($zone['Testing']['door_status'] == 3){
						                                                $class= "relay-un";
						                                                echo "<div id='relay-un'></div>";
						                                            }
						                                            elseif($zone['Testing']['door_status'] == 0){
						                                            	$class= "relay-off";
						                                            	echo "<div id='relay-off'></div>";
						                                            }
						                                            echo "<li class='{$class}'></li>";
						                                            
						                                        ?>
			                                    			</ul>
														</td>


														<td style="padding-left: 20px;">
															<ul class="list-inline">
						                                        <?php
						                                            
						                                            if($zone['Testing']['alarm_1'] == 0){
						                                                $class= "alarm_one";
						                                                echo "<div id='alarm_one'></div>"; 
						                                            }
						                                            echo "<li class='{$class}'></li>";
						                                        ?>
						                                    </ul>
						                                </td>

						                                <td style="padding-left: 20px;">
															<ul class="list-inline">
						                                        <?php
						                                            
						                                            if($zone['Testing']['alarm_2'] == 0){
						                                                $class= "alarm_two";
						                                                echo "<div id='alarm_two'></div>"; 
						                                            }
						                                            echo "<li class='{$class}'></li>";  
						                                        ?>
						                                    </ul>
						                                </td>

						                                <td style="padding-left: 20px;">
															<ul class="list-inline">
						                                        <?php
						                                            
						                                            if($zone['Testing']['alarm_3'] == 0){
						                                                $class= "alarm_three";
						                                                echo "<div id='alarm_three'></div>"; 
						                                            }
						                                            echo "<li class='{$class}'></li>"; 
						                                        ?>
						                                    </ul>
						                                </td>

						                                <td style="padding-left: 20px;">
															<ul class="list-inline">
						                                        <?php
						                                            
						                                            if($zone['Testing']['alarm_4'] == 0){
						                                                $class= "alarm_four";
						                                                echo "<div id='alarm_four'></div>"; 
						                                            }
						                                            echo "<li class='{$class}'></li>";   
						                                        ?>
						                                    </ul>
						                                </td>
						                                <td style="padding-left: 20px;">
															<ul class="list-inline">
						                                        <?php
						                                            
						                                            if($zone['Testing']['alarm_5'] == 0){
						                                                $class= "alarm_five";
						                                                echo "<div id='alarm_five'></div>"; 
						                                            }
						                                            echo "<li class='{$class}'></li>"; 
						                                        ?>
						                                    </ul>
						                                </td>
						                                <td style="padding-left: 20px;">
															<ul class="list-inline">
						                                        <?php
						                                            
						                                            if($zone['Testing']['alarm_6'] == 0){
						                                                $class= "alarm_six";
						                                                echo "<div id='alarm_six'></div>"; 
						                                            }
						                                            echo "<li class='{$class}'></li>";
						                                            
						                                        ?>
						                                    </ul>
						                                </td>

														<td class="text-center action">

															<?php echo $this->Html->link('<i class="fa fa-unlock"></i><span> Door Open</span>', array('controller'=>'testings','action' => 'door_open', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Add Card</span>', array('controller'=>'testings','action' => 'add_card', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-minus-circle"></i><span> Delete Card</span>', array('controller'=>'testings','action' => 'delete_card', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-danger btn-sm')); ?>


															<?php echo $this->Html->link('<i class="fa fa-edit"></i><span> Edit Site</span>', array('action' => 'user_edit', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-warning btn-sm')); ?>

															<?php echo $this->Form->postLink('<i class="fa fa-times-circle-o"></i><span> Delete Site</span>', array('controller'=>'testings','action' => 'delete', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn btn-danger btn-sm'), __('Are you sure you want to delete?')); ?>

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
			</div>
	  	</div>
   	</section>
</div>

