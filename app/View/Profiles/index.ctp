<?php $this->assign('title', 'Profile');?>
<div class="content-wrapper">
    <section class="content">
        <div class="box">
            <div class="row bar bar-primary bar-top">
    <div class="col-md-3">
        <h2 class="bar-title"><?php echo __('Users :: List'); ?></h2>
    </div>
</div>

<div class="row bar bar-secondary">
  
        </div>
            <div class="box-body">
                <table class="table table-bordered">
	<thead>
	<tr>
                                    <td>Username</td>
                                    <td>E-mail</td>
                                    <td>Created</td>
                                    <td>Modified</td>
                                    <td>Role</td>
                                    <td>Status</td>
                                    <th class="text-right action-th"><?php echo __('Actions'); ?></th>
                                    
    </tr>	
	</thead>
	<tbody>
	<?php  foreach ($users as $userss):?>
            
                <tr>
                                	
                    <td><?php echo $userss['User']['username']; ?> </td>
                    <td><?php echo $userss['User']['email']; ?> </td>
                    <td><?php echo $userss['User']['created']; ?> </td>
                    <td><?php echo $userss['User']['modified']; ?> </td>
                    <td><?php echo $userss['Role']['title']; ?> </td>
                    <td><?php echo $userss['User']['status']; ?> </td>
                    <td class="text-right action">
									
					<?php
						if($userss['Role']['title'] != 'ACMS Manager'):
							echo $this->Html->link('<i class="fa fa-edit"></i> Edit', array('controller'=>'users','action' => 'edit', $userss['User']['id']),array('escape'=>false,'class'=>'btn btn-warning'))." ";
							endif;
						
							if($userss['User']['username'] != 'admin' and $userss['User']['username'] != 'admin'):
								echo $this->Form->postLink('<i class="fa fa-times-circle-o" aria-hidden="true"></i> Delete', array('action' => 'delete', $userss['User']['id']), array('escape'=>false,'class'=>'btn btn-danger'), __('Are you sure you want to delete?'));
								endif; 
									?>
					</td>
                </tr>
            <?php endforeach; ?>
	</tbody>
</table>
</div>
<!-- <div class="row">
    <div class="col-md-12">
        <div class="pagination-block">
            <p>
            <?php
            echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
            ));
            ?>          </p>
            <div class="pagination">
            <?php
        echo $this->Paginator->prev('< ' . __('previous'),array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
        echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','currentTag'=>'a', 'currentClass'=>'current disabled'));
        echo $this->Paginator->next(__('next') . ' >', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
    ?>
            </div>
        </div>  
    </div>
</div> -->
</div>
</section>
</div>

