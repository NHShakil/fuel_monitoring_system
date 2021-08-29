<?php $this->assign('title', 'Card :: List');?>
	<div class="content-wrapper">
    	<section class="content">
			<div class="row bar bar-primary bar-top">
				<div class="col-md-4">
					<h2 class="bar-title"><?php echo __("Card :: Card Management"); ?></h2>
				</div>
			</div>

			<div class="row bar bar-secondary">
				<div class="col-md-6">
					<?php echo $this->Html->link('<i class=\'fa fa-cog\'></i> BTS Operation Board', array('action' => 'index'),array('escape'=>false,'class'=>'btn btn-success')); ?>
				</div>	
	
				<div class="col-md-6 text-right">
					<?php echo $this->Html->link('<i class=\'fa fa-angle-double-left\'></i> Back', array('action' => 'index',$backButton[0],"page:$backButton[1]"),array('escape'=>false,'class'=>'btn btn-info')); ?>
				</div>	
			</div>

			<div class="row bar bar-third">
				<div class="col-md-12">
					<div class="row">
						<!-- current cards -->
						<div class="col-md-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									Currnet Cards
								</div>
								<div class="panel-body">
					  				<div class="table-responsive">
										<table class="table table-striped">
											<thead>
												<tr class="info">
													<th>Number</th>
													<th class="text-right action-th">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach($allCards['assignedCards'] as $id => $number): ?>
													<tr>
														<td><?php echo $number;?></td>
														<td class="text-right action-th">
															<?php 
																echo $this->Form->postLink('<i class=\'fa fa-remove\'></i> Remove', array('action' => 'bts_delete_card',$btsId,$id,$number), array('escape'=>false,'class'=>'btn btn-danger btn-sm'), __('Are you sure you want to remove?'));
															?>
														</td>
													</tr>
												<?php endforeach;?>
											</tbody>
										</table>
									</div>
								</div>					
							</div>
						</div>
			
						<!-- Available -->
						<!-- current cards -->
						<div class="col-md-6">
							<div class="panel panel-default">
								<div class="panel-heading">
									Available Cards
								</div>
								<div class="panel-body">
					  				<div class="table-responsive">
										<table class="table table-striped">
											<thead>
												<tr class="info">
													<th>Number</th>
													<th>Actions</th>
												</tr>
									
											</thead>
											<tbody>
												<?php foreach($allCards['freeCards'] as $id => $number): ?>
													<tr>
														<td><?php echo $number;?></td>
														<td class="text-right action-th">
															<?php 
																echo $this->Form->postLink('<i class=\'fa fa-share-alt\'></i> Assign', array('action' => 'bts_add_card',$btsId,$id,$number), array('escape'=>false,'class'=>'btn btn-warning btn-sm'), __('Are you sure you want to assign?')); 
															?>
														</td>
													</tr>
													<?php endforeach;?>									
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>