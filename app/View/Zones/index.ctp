<style type="text/css">
	.header_font_style{
		font-size: 18px; 
		font-family: 'Times New Roman',Georgia,Serif;
	}

	.font_style{
		font-size: 15px; 
		font-family: 'Times New Roman',Georgia,Serif;
	}
	.td_height{
		height: 35px;
	}
</style>

<?php $this->assign('title', 'Zones');?>
<div class="container-fluid">
    <div class="row">	
		
        <div class="card col-md-12">
          	<div class="card-header">
            	<div class="row bar bar-primary bar-top">
					<h3 class="bar-title col-md-2"><?php echo str_repeat('&nbsp;', 1).__('Zones'); ?></h3>			
					<!-- <div class="col-md-6 text-right">
                        <?php echo $this->Form->create('Zone',array('url'=>array('controller'=>'zones', 'action'=>'search_zone')), array('class'=>'searchForm','data-role'=>'form')); ?>

                        <?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>

                        <?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
                                
                        <?php echo $this->Form->end(); ?>
                    </div> -->
				</div>
          	

				<div class="row bar bar-secondary">
	    			<div class="col-md-12">
						<?php echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Add Zone</span>', array('controller'=>'zones','action' => 'add'),array('escape'=>false,'class'=>'btn btn-success')); ?>
	    			</div>	
        		</div>




				<div class="row bar bar-third">
					<div class="col-md-12">
						<div class="card-body table-responsive no-padding">
                            <table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr class="text-left" bgcolor=#99ddff>
										<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
										<th><?php echo $this->Paginator->sort('name'); ?></th>
										<th><?php echo $this->Paginator->sort('status'); ?></th>
										<th><?php echo $this->Paginator->sort('created'); ?></th>
										<th><?php echo $this->Paginator->sort('modified'); ?></th>
										<th class="text-center action-th"><?php echo __('Actions'); ?></th>
									</tr>
								</thead>
			
								<tbody>
									<?php foreach ($zones as $zone): ?>
									<tr>
										<td>
											<?php echo $this->Html->link($zone['ParentZone']['name'], array('controller' => 'zones', 'action' => 'view', $zone['ParentZone']['id'])); ?>
										</td>
										<td><?php echo h($zone['Zone']['name']); ?></td>
										<td><?php echo h($status[$zone['Zone']['status']]);?></td>
										<td><?php echo h($zone['Zone']['created']); ?></td>
										<td><?php echo h($zone['Zone']['modified']); ?></td>
										<td class="text-center action">
											<?php echo $this->Html->link('<i class="fa fa-edit"></i><span> Edit</span>', array('controller'=>'zones','action' => 'edit', $zone['Zone']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs')); ?>

											<?php echo $this->Form->postLink('<i class="fa fa-times-circle-o"></i><span> Delete</span>', array('controller'=>'zones','action' => 'delete', $zone['Zone']['id']), array('escape'=>false,'class'=>'btn btn-danger btn-xs'), __('Are you sure you want to delete?')); ?>
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

									echo str_repeat('&nbsp;', 5);

									echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','currentTag'=>'a', 'currentClass'=>'current disabled',str_repeat('&nbsp;', 1)));

									echo str_repeat('&nbsp;', 5);

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


