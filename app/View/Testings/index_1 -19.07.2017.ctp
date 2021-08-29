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
										<!-- <th><?php echo $this->Paginator->sort('server_ip'); ?></th> -->
										
										<th><?php echo $this->Paginator->sort('site_name'); ?></th>
										<th><?php echo $this->Paginator->sort('voltage'); ?></th>
										<th><?php echo $this->Paginator->sort('Door Open By'); ?></th>
										<th><?php echo $this->Paginator->sort('created'); ?></th>
										<th><?php echo $this->Paginator->sort('modified'); ?></th>
										<th><?php echo $this->Paginator->sort('door_status'); ?></th>
										<th><?php echo $this->Paginator->sort('Device Status'); ?></th>
										<th class="text-center action-th"><?php echo __('Actions'); ?></th>
									</tr>
								</thead>
			
								<tbody>

									<?php 

										$handle = file_get_contents("C:/datatemp/LiveDevice.txt");
										$ex_val = explode(',', $handle);
										//print_r($ex_val);
										//echo "Len=>".count($ex_val);
										

										foreach ($zones as $zone): ?>

											<?php

												$site_name = $zone['Testing']['site_name'];
												//echo $site_name;
												for($i=0;$i<count($ex_val)-1;$i++){
													if($site_name == $ex_val[$i]){ ?>

														<tr class="success">
											
															<!-- <td><?php echo h($zone['Testing']['server_ip']); ?></td> -->
															
															<td><?php echo h($zone['Testing']['site_name']); ?></td>
															<td><?php echo h($zone['Testing']['voltage']); ?></td>
															<td>
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
															<td><?php echo h($zone['Testing']['created']); ?></td>
															<td><?php echo h($zone['Testing']['modified']); ?></td>

															<td style="padding-left: 40px;">

							                    				<ul class="list-inline">
							                                        <?php
							                                            
							                                            if($zone['Testing']['door_status'] == 2){
							                                                $class= "relay-on";
							                                                echo "<div id='relay-off'></div>";
							                                                //echo h($zone['Testing']['door_status']);
							                                            }

							                                            elseif($zone['Testing']['door_status'] == 1){
							                                                $class= "relay-off";
							                                                echo "<div id='relay-on'></div>";
							                                            }

							                                            elseif($zone['Testing']['door_status'] == 3){
							                                                $class= "relay-un";
							                                                echo "<div id='relay-un'></div>";
							                                                //echo chr(7);

							                                               /* ?>

							                                                <EMBED src="tada.wav" autostart=true loop=false volume=100 hidden=true><NOEMBED><BGSOUND src="tada.wav"></NOEMBED>

							                                            <?php*/

							                                            }

							                                            elseif($zone['Testing']['door_status'] == 0){
							                                            	$class= "relay-off";
							                                            	echo "<div id='relay-off'></div>";
							                                            }

							                                            echo "<li class='{$class}'></li>";
							                                            
							                                        ?>
				                                    			</ul>
															</td>

															<td style="padding-left: 40px;">
																<ul class="list-inline">
																	<?php 
																		$class= "site-active";
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
													<?php break; }
												} ?>


											<?php endforeach; ?>

											<?php 

												$handle = file_get_contents("C:/datatemp/LiveDevice.txt");
												$ex_val = explode(',', $handle);

												foreach ($zones as $zone): ?>

													<?php 
														$site_name = $zone['Testing']['site_name'];
														
														for($i=0; $i<count($ex_val)-1; $i++){
															if($site_name == $ex_val[$i]){
																$site_match = $site_name;
															}
														}

														if($site_match!=$site_name){ ?>

															<tr class="danger">
										
																<!-- <td><?php echo h($zone['Testing']['server_ip']); ?></td> -->
																
																<td><?php echo h($zone['Testing']['site_name']); ?></td>
																<td><?php echo h($zone['Testing']['voltage']); ?></td>
																<td><?php echo h($zone['Testing']['door_open_by']); ?></td>
																<td><?php echo h($zone['Testing']['created']); ?></td>
																<td><?php echo h($zone['Testing']['modified']); ?></td>

																<td style="padding-left: 40px;">

								                    				<ul class="list-inline">
								                                        <?php
								                                            
								                                            if($zone['Testing']['door_status'] == 2){
								                                                $class= "relay-on";
								                                                echo "<div id='relay-off'></div>";
								                                                //echo h($zone['Testing']['door_status']);
								                                            }

								                                            elseif($zone['Testing']['door_status'] == 1){
								                                                $class= "relay-off";
								                                                echo "<div id='relay-on'></div>";
								                                            }

								                                            elseif($zone['Testing']['door_status'] == 3){
								                                                $class= "relay-un";
								                                                echo "<div id='relay-un'></div>";
								                                                //echo chr(7);

								                                               /* ?>

								                                                <EMBED src="tada.wav" autostart=true loop=false volume=100 hidden=true><NOEMBED><BGSOUND src="tada.wav"></NOEMBED>

								                                            <?php*/

								                                            }

								                                            elseif($zone['Testing']['door_status'] == 0){
								                                            	$class= "relay-off";
								                                            	echo "<div id='relay-off'></div>";
								                                            }

								                                            echo "<li class='{$class}'></li>";
								                                            
								                                        ?>
					                                    			</ul>
																</td>

																<td style="padding-left: 40px;">
																	<ul class="list-inline">
																		<?php 
																			$class= "site-dead";
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

													endforeach; 
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

