<?php $this->assign('title', 'Device Ip List');?>
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
										<th><?php echo $this->Paginator->sort('server_ip'); ?></th>
										<th><?php echo $this->Paginator->sort('ip_address'); ?></th>
										<!-- <th><?php echo $this->Paginator->sort('created'); ?></th>
										<th><?php echo $this->Paginator->sort('modified'); ?></th> -->
										<th class="text-center action-th"><?php echo __('Actions'); ?></th>
									</tr>
								</thead>
			
							<tbody>
								<?php foreach ($zones as $zone): ?>
								<tr>
									
									<td><?php echo h($zone['Testing']['server_ip']); ?></td>
									<td><?php echo h($zone['Testing']['ip_address']); ?></td>
									<!-- <td><?php echo h($zone['Testing']['created']); ?></td>
									<td><?php echo h($zone['Testing']['modified']); ?></td> -->
									<td class="text-center action">

										<?php echo $this->Html->link('<i class="fa fa-unlock"></i><span> Door Open</span>', array('controller'=>'testings','action' => 'door_open', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

										<?php echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Add Card</span>', array('controller'=>'testings','action' => 'add_card', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

										<?php echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Read Card Number</span>', array('controller'=>'testings','action' => 'read_card_number', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

										<?php echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Download</span>', array('controller'=>'testings','action' => 'download', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>


										<?php echo $this->Html->link('<i class="fa fa-clock-o"></i><span> Date Time</span>', array('controller'=>'testings','action' => 'date_time', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

										<?php echo $this->Html->link('<i class="fa fa-edit"></i><span> New Device IP</span>', array('controller'=>'testings','action' => 'write_ip', $zone['Testing']['ip_address']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

										<?php echo $this->Html->link('<i class="fa fa-minus-circle"></i><span> Delete Card</span>', array('controller'=>'testings','action' => 'delete_card', $zone['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

										<?php echo $this->Form->postLink('<i class="fa fa-times-circle-o"></i><span> Delete</span>', array('controller'=>'testings','action' => 'delete', $zone['Testing']['id']), array('escape'=>false,'class'=>'btn btn-danger btn-sm'), __('Are you sure you want to delete?')); ?>
									</td>
								</tr>
								<?php endforeach; ?>
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



