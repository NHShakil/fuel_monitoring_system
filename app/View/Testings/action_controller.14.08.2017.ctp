<?php $this->assign('title', 'Device Ip List');?>
<div class="content-wrapper">
    <section class="content">
       <div class= "row">
    		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
					<h3 class="bar-title col-md-2"><?php echo __('Device List'); ?></h3>

					<div class="col-md-10 text-right">

                        <?php echo $this->Form->create('Testing',array('url'=>array('controller'=>'zones', 'action'=>'search_zone')), array('class'=>'searchForm','data-role'=>'form')); ?>

                        <?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>

                        <?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
                                
                        <?php echo $this->Form->end(); ?>
                    </div>
				</div>

				<div class="row bar bar-secondary">
					<div class="col-md-10">
						<?php echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Add New Device</span>', array('controller'=>'testings','action' => 'add'),array('escape'=>false,'class'=>'btn btn-success')); ?>
					</div>	
				</div>

				<div class="row bar bar-third">
					<div class="col-md-12" style="width: 100%;">
						<div class="table-responsive">
							<table class="table table-striped" style="width: 100%;">
								<thead>
									<tr class="text-center" bgcolor=#99ddff>
										<th><?php echo $this->Paginator->sort('site_name'); ?></th>
										<th><?php echo $this->Paginator->sort('Device Status'); ?></th>
										<!-- <th><?php echo $this->Paginator->sort('BLC'); ?></th> -->
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

													<tr class="success" style="height: 47px;">
														<td style="padding-left: 20px;"><?php echo h($zone['Testing']['site_name']); ?></td>
														<td style="padding-left: 50px;">
															<ul class="list-inline">
																<?php 
																	$class= "site-active";
																	//echo "<div class='info'><li class='{$class}'></li><div class='info'>Device Live</div></div>";
																	echo "<li class='{$class}'></li>";
																?>
															</ul>	
														</td>
														<!-- <td style="padding-left: 20px;"><?php echo h($zone['Testing']['blc']); ?></td> -->
														<td class="text-center action">

															<?php echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Add Card</span>', array('controller'=>'testings','action' => 'add_card', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-download"></i><span> Get Card</span>', array('controller'=>'testings','action' => 'download_card', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-file"></i><span> Show Card</span>', array('controller'=>'testings','action' => 'show_card', $zone['Testing']['site_name']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-minus-circle"></i><span> Delete Card</span>', array('controller'=>'testings','action' => 'delete_card', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-danger btn-sm')); ?>


															<?php echo $this->Html->link('<i class="fa fa-edit"></i><span> Edit Site</span>', array('action' => 'user_edit', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-warning btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-download"></i><span> Log Download</span>', array('controller'=>'testings','action' => 'download_log', $zone['Testing']['site_name']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Form->postLink('<i class="fa fa-times-circle-o"></i><span> Delete Site</span>', array('controller'=>'testings','action' => 'delete', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn btn-danger btn-sm'), __('Are you sure you want to delete?')); ?>
														</td>
													</tr>
												<?php }

												else{ ?>

													<tr class="danger" style="height: 47px;">
														<td style="padding-left: 20px;"><?php echo h($zone['Testing']['site_name']); ?></td>
														<td style="padding-left: 50px;">
															<ul class="list-inline">
																<?php 
																	$class= "site-dead";
																	//echo "<div class='info'><li class='{$class}'></li><div class='info'>Device Live</div></div>";
																	echo "<li class='{$class}'></li>";
																?>
															</ul>	
														</td>
														<!-- <td style="padding-left: 20px;"><?php echo h($zone['Testing']['blc']); ?></td> -->
														<td class="text-center action">

															<?php echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Add Card</span>', array('controller'=>'testings','action' => 'add_card', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-download"></i><span> Get Card</span>', array('controller'=>'testings','action' => 'download_card', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-file"></i><span> Show Card</span>', array('controller'=>'testings','action' => 'show_card', $zone['Testing']['site_name']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-minus-circle"></i><span> Delete Card</span>', array('controller'=>'testings','action' => 'delete_card', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-danger btn-sm')); ?>


															<?php echo $this->Html->link('<i class="fa fa-edit"></i><span> Edit Site</span>', array('action' => 'user_edit', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-warning btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-download"></i><span> Log Download</span>', array('controller'=>'testings','action' => 'download_log', $zone['Testing']['site_name']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

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

				</br>

				<!-- <input type='button' id="btn" class="btn-info" value="click for ajax" />
				<script type="text/javascript">
					$('#btn').click(function(){
					    var btn = $(this);
					    $.post('http://jsfiddle.net/echo/jsonp/',{delay: 5}).complete(function(){
					        btn.prop('disabled', false);
					    });
					    btn.prop('disabled', true);
					});
				</script>

				<input type="checkbox" id="checkme"/><input type="submit" name="sendNewSms" class="inputButton" id="sendNewSms" value=" Send "  class="btn-danger" />
				<script type="text/javascript">
					var checker = document.getElementById('checkme');
					var sendbtn = document.getElementById('sendNewSms');
					checker.onchange = function() {
					  sendbtn.disabled = !!this.checked;
					};
				</script> -->
			</div>
	  	</div>
   	</section>
</div>
