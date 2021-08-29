<?php $this->assign('title', 'Device Ip List');?>
<div class="content-wrapper">
    <section class="content">
       <div class= "row">
    		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
					<h3 class="bar-title col-md-2"><?php echo __('Device List'); ?></h3>

					<div style="padding-left: 390px;">	
				        <div class="btn btn-success col-md-2">
				            <?php echo "Active: ".$active; ?>
				        </div>
				        
				        <div class="btn btn-danger col-md-2">
				            <?php echo "Dead: ".$inactive; ?>
				        </div>
					    
				        <div class="btn btn-warning col-md-2">
				            <?php echo "Draft: ".$draft;?>
				        </div>
				    </div>

					<div class="col-md-4 text-right">

                        <?php echo $this->Form->create('Testing',array('url'=>array('controller'=>'testings', 'action'=>'search_bts')), array('class'=>'searchForm','data-role'=>'form')); ?>

                        <?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>

                        <?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
                                
                        <?php echo $this->Form->end(); ?>
                    </div>
				</div>

				<div class="row bar bar-secondary">
					<div class="col-md-10">
						<?php echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Add New Device</span>', array('controller'=>'sites','action' => 'add'),array('escape'=>false,'class'=>'btn btn-success')); ?>
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
										<th class="text-center action-th"><?php echo __('Actions'); ?></th>
									</tr>
								</thead>

								<tbody>

									<?php 

										foreach ($zones as $zone):


											if($zone['Testing']['status']==1){ ?>

													<tr class="success" style="height: 47px;">
														<td style="padding-left: 20px;"><?php echo h($zone['Testing']['site_name']); ?></td>
														<td style="padding-left: 50px;">
															<ul class="list-inline">
																<?php 
																	$class= "site-active";
																	echo "<li class='{$class}'></li>";
																?>
															</ul>	
														</td>
														<td class="text-center action">
															<?php echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Add Card</span>', array('controller'=>'testings','action' => 'add_card', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-download"></i><span> Get Card</span>', array('controller'=>'testings','action' => 'download_card', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-file"></i><span> Show Card</span>', array('controller'=>'testings','action' => 'show_card', $zone['Testing']['site_name']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-minus-circle"></i><span> Delete Card</span>', array('controller'=>'testings','action' => 'delete_card', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-danger btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-download"></i><span> Log Download</span>', array('controller'=>'testings','action' => 'download_log', $zone['Testing']['site_name']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-edit"></i><span> Edit Site</span>', array('action' => 'user_edit', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-warning btn-sm')); ?>

															<?php echo $this->Form->postLink('<i class="fa fa-times-circle-o"></i><span> Delete Site</span>', array('controller'=>'testings','action' => 'delete', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn btn-danger btn-sm'), __('Are you sure you want to delete?')); ?>
														</td>
													</tr>
												<?php }

												elseif($zone['Testing']['status']==0){ ?>

													<tr class="danger" style="height: 47px;">
														<td style="padding-left: 20px;"><?php echo h($zone['Testing']['site_name']); ?></td>
														<td style="padding-left: 50px;">
															<ul class="list-inline">
																<?php 
																	$class= "site-dead";
																	echo "<li class='{$class}'></li>";
																?>
															</ul>	
														</td>
														<td class="text-center action">

															<?php echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Add Card</span>', array('controller'=>'testings','action' => 'add_card', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-download"></i><span> Get Card</span>', array('controller'=>'testings','action' => 'download_card', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-file"></i><span> Show Card</span>', array('controller'=>'testings','action' => 'show_card', $zone['Testing']['site_name']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-minus-circle"></i><span> Delete Card</span>', array('controller'=>'testings','action' => 'delete_card', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-danger btn-sm')); ?>

															<?php echo $this->Html->link('<i class="fa fa-download"></i><span> Log Download</span>', array('controller'=>'testings','action' => 'download_log', $zone['Testing']['site_name']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

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
			</div>
	  	</div>
   	</section>
</div>
