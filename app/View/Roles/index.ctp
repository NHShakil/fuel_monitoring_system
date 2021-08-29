<?php $this->assign('title', 'Role :: Index');?>

<div class= "row">
    <div class="col-md-12" >
        <div class="bar bar-primary bar-top">
            <h1 class="bar-title col-md-2"><?php echo __('Role :: List'); ?></h1>
        </div>

        <div class="row bar bar-secondary">
            <div class="col-md-12">
                <?php echo $this->Html->link('<i class="fa fa-plus-circle"></i> Add Roles', array('action' => 'add'),array('escape'=>false,'class'=>'btn btn-warning')); ?>
            </div>  
        </div>





		<div class="report-details">
            <div class="card-body table-responsive no-padding">
                <table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr class="text-left" bgcolor=#99ddff>
							<th><?php echo $this->Paginator->sort('title'); ?></th>
							<th><?php echo $this->Paginator->sort('description'); ?></th>
							<th><?php echo $this->Paginator->sort('status'); ?></th>
							<th class="text-right action-th"><?php echo __('Actions'); ?></th>
						</tr>
					</thead>			
					<tbody>
						<?php foreach ($roles as $role): ?>
							<tr>
								<td><?php echo h($role['Role']['title']); ?>&nbsp;</td>
								<td><?php echo h($role['Role']['description']); ?>&nbsp;</td>
								<td><?php echo h($status[$role['Role']['status']]); ?>&nbsp;</td>
								<td class="text-right action">
									<?php
										echo $this->Html->link('<i class="fa fa-edit"></i> Edit', array('action' => 'edit', $role['Role']['id']),array('escape'=>false,'class'=>'btn btn-info'));
										
										echo $this->Form->postLink('<i class="fa fa-times-circle-o" aria-hidden="true"></i> Delete', array('action' => 'delete', $role['Role']['id']), array('escape'=>false,'class'=>'btn btn-danger'), __('Are you sure you want to delete?'));
										 
									?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="pagination-block">
					<p>
						<?php
							echo $this->Paginator->counter(array(
							'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
						));?>			
					</p>
					<div class="pagination">
						<?php
							echo $this->Paginator->prev('< ' . __('previous'),array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));

                            echo str_repeat('&nbsp;', 3);

                            echo $this->Paginator->numbers(array('separator' => str_repeat('&nbsp;', 2),'tag'=>'li','currentTag'=>'a', 'currentClass'=>'current disabled'));

                            echo str_repeat('&nbsp;', 3);

                            echo $this->Paginator->next(__('next') . ' >', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
						?>
					</div>
				</div>	
			</div>
		</div>
	</div>
</div>
