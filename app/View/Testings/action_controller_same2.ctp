<div class="row bar bar-third">
	<div class="col-md-12" style="width: 100%;">
		<div class="table-responsive">
			<table class="table table-striped" style="width: 100%;">
				<thead>
					<tr class="text-center" bgcolor=#99ddff>

						<th class="text-center action-th" style="width: 8%;"><?php echo __('Actions'); ?></th>
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
								
										<td class="text-left action" style="padding-left: 60px;">

											<?php echo $this->Html->link('<i class="fa fa-unlock"></i><span> Door Open</span>', array('controller'=>'testings','action' => 'door_open', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs')); ?>
											
											<div class="btn-group" role="group">

                                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-xs dropdown-toggle" 
                                                	data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Config<span class="caret"></span>
                                                </button>

                                                <ul class="dropdown-menu">

											      	<li><?php echo $this->Html->link('<span> Add Card</span>', array('controller'=>'testings','action' => 'add_card', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn')); ?></li>

											      	<li><?php echo $this->Html->link('<span> Delete Card</span>', array('controller'=>'testings','action' => 'delete_card', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn')); ?>
											      		
											      	</li>

											      	<li><?php echo $this->Html->link('<span> Download Card</span>', array('controller'=>'testings','action' => 'download_card', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn')); ?>  		
											      	</li>


											      	<li><?php echo $this->Html->link('<span> Show Card</span>', array('controller'=>'testings','action' => 'show_card', $zone['Testing']['site_name']),array('escape'=>false,'class'=>'btn')); ?>      		
											      	</li>

											      
											      	<li><?php echo $this->Html->link('<span> Edit Site</span>', array('action' => 'user_edit', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn')); ?>
											      		
											      	</li>

											      	<li><?php echo $this->Form->postLink('<span> Delete Site</span>', array('controller'=>'testings','action' => 'delete', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn'), __('Are you sure you want to delete?')); ?>
											      		
											      	</li>
                                                </ul>
                            				</div>
										</td>
									</tr>
								<?php }

								else{ ?>

									<tr class="danger" style="height: 47px;">
								
										<td class="text-left action" style="padding-left: 60px;">

											<?php echo $this->Html->link('<i class="fa fa-unlock"></i><span> Door Open</span>', array('controller'=>'testings','action' => 'door_open', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs')); ?>
											
											<div class="btn-group" role="group">

                                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-xs dropdown-toggle" 
                                                	data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Config<span class="caret"></span>
                                                </button>

                                                <ul class="dropdown-menu">

											      	<li><?php echo $this->Html->link('<span> Add Card</span>', array('controller'=>'testings','action' => 'add_card', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn')); ?></li>

											      	<li><?php echo $this->Html->link('<span> Delete Card</span>', array('controller'=>'testings','action' => 'delete_card', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn')); ?>
											      		
											      	</li>

											      	<li><?php echo $this->Html->link('<span> Download Card</span>', array('controller'=>'testings','action' => 'download_card', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn')); ?>  		
											      	</li>


											      	<li><?php echo $this->Html->link('<span> Show Card</span>', array('controller'=>'testings','action' => 'show_card', $zone['Testing']['site_name']),array('escape'=>false,'class'=>'btn')); ?>      		
											      	</li>

											      
											      	<li><?php echo $this->Html->link('<span> Edit Site</span>', array('action' => 'user_edit', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn')); ?>
											      		
											      	</li>

											      	<li><?php echo $this->Form->postLink('<span> Delete Site</span>', array('controller'=>'testings','action' => 'delete', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn'), __('Are you sure you want to delete?')); ?>
											      		
											      	</li>
                                                </ul>
                            				</div>
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