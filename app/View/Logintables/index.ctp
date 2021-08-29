
<?php $this->assign('title', 'Login History');?>
<div class= "row">
    <div class="col-md-12" >
        <div class="bar bar-primary bar-top">
            <h2 class="bar-title col-md-2"><?php echo __('Users Login List'); ?></h2>

        </div>

        <div class="row bar bar-secondary">
            <div class="col-md-12">
                <?php 
                    echo $this->Form->postLink('<i class="fa fa-times-circle-o" aria-hidden="true"></i><span> Inactive Log Delete</span>', array('controller'=>'logintables','action' => 'delete'), array('escape'=>false,'class'=>'btn btn-danger'), __('Are you sure you want to delete?')); 
                ?>
            </div>  
        </div>

        <div class="clearfix report-details">
            <div class="card-body table-responsive no-padding">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center" bgcolor=#99ddff>
                            <th class="text-center action-th"><?php echo $this->Paginator->sort('ip_address','IP Address'); ?></th>
                            <th class="text-center action-th"><?php echo $this->Paginator->sort('username','Username'); ?></th> 
                            <th class="text-center action-th"><?php echo $this->Paginator->sort('login_address','Login Address'); ?></th>          
                            <th class="text-center action-th"><?php echo $this->Paginator->sort('login_time',' Login Time'); ?></th>
                            <th class="text-center action-th"><?php echo $this->Paginator->sort('logout_time',' Logout Time');?></th>
                            <th class="text-center action-th"><?php echo $this->Paginator->sort('login_status',' Login Status'); ?></th>
                            <th class="text-center action-th"><?php echo $this->Paginator->sort('login_count',' Login Count'); ?></th>                   
                        </tr>
                    </thead>
                    <tbody>
                       <?php  foreach ($users as $user):?>
                            <tr>
                                <td class="text-center action"><?php echo h($user['LoginTable']['ip_address']); ?></td>
                                <td class="text-center action"><?php echo h($user['LoginTable']['username']); ?></td>
                                <td class="text-center action"><?php echo h($user['LoginTable']['login_address']); ?></td>
                                <td class="text-center action"><?php echo h($user['LoginTable']['login_time']);?></td>
                                <td class="text-center action"><?php echo h($user['LoginTable']['logout_time']);?></td>
                                <td class="text-center action"><?php echo h($user['LoginTable']['login_status']);?></td>
                                <td class="text-center action"><?php echo h($user['LoginTable']['login_count']);?></td>
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
                            echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));
                        ?>
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



