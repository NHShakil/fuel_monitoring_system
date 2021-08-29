<?php $this->assign('title', 'Device Ip List');?>
<div class="content-wrapper">
    <section class="content">
       <div class= "row">
    		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
					<h3 class="bar-title col-md-2"><?php echo __('Card List'); ?></h3>
				</div>


				<div class="row bar bar-secondary">
					<div class="col-md-2">
                        <?php echo $this->Html->link('<i class="fa fa-list"></i><span>Back to Operation</span>', array('action' => 'action_controller'),array('escape'=>false,'class'=>'btn btn-info')); ?>
                    </div>

                    <div class="col-md-10">
                        <?php echo $this->Html->link('<i class="fa fa-list"></i><span>Back to Dashboard</span>', array('action' => 'dashboard'),array('escape'=>false,'class'=>'btn btn-info')); ?>
                    </div>	
				</div>


				<div class="row bar bar-third">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped" style="width: 100%;">
								<thead>
									<tr class="text-center" bgcolor=#99ddff>
										<th><?php echo $this->Paginator->sort('Site Id'); ?></th>
										<th><?php echo $this->Paginator->sort('Card 1'); ?></th>
										<th><?php echo $this->Paginator->sort('Card 2'); ?></th>
										<th><?php echo $this->Paginator->sort('Card 3'); ?></th>
										<th><?php echo $this->Paginator->sort('Card 4'); ?></th>
										<th><?php echo $this->Paginator->sort('Card 5'); ?></th>
										<th><?php echo $this->Paginator->sort('Card 6'); ?></th>
										<th><?php echo $this->Paginator->sort('Card 7'); ?></th>
										<th><?php echo $this->Paginator->sort('Card 8'); ?></th>
										<th><?php echo $this->Paginator->sort('Card 9'); ?></th>
										<th><?php echo $this->Paginator->sort('Card 10'); ?></th>
									</tr>
								</thead>
			
								<tbody>
									<?php 
										foreach($site_details as $id=>$zone): ?>
											<tr>
												<td style="padding-left: 20px;"> <?php echo h($zone['site_name']); ?></td>
												<td style="padding-left: 20px;"> <?php echo h($zone['card_1']);?></td>
												<td style="padding-left: 20px;"> <?php echo h($zone['card_2']); ?></td>
												<td style="padding-left: 20px;"> <?php echo h($zone['card_3']);?></td>
												<td style="padding-left: 20px;"> <?php echo h($zone['card_4']); ?></td>
												<td style="padding-left: 20px;"> <?php echo h($zone['card_5']);?></td>
												<td style="padding-left: 20px;"> <?php echo h($zone['card_6']); ?></td>
												<td style="padding-left: 20px;"> <?php echo h($zone['card_7']);?></td>
												<td style="padding-left: 20px;"> <?php echo h($zone['card_8']); ?></td>
												<td style="padding-left: 20px;"> <?php echo h($zone['card_9']);?></td>
												<td style="padding-left: 20px;"> <?php echo h($zone['card_10']); ?></td>
											</tr>
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

