<?php $this->assign('title', 'Reports :: Door Status');?>
<div class="content-wrapper">
    <section class="content">
        <div class= "row">
            <div class="col-md-12" >
                <div class="bar bar-primary bar-top">
                    <h2 class="bar-title col-md-4"><?php echo __('Reports :: Select a Site for Door Status'); ?></h2>
                </div>

                <div class="row bar bar-secondary">
                    <div class="col-md-12">
                        <?php echo $this->Html->link('<i class="fa fa-angle-double-left"></i><span> Back to Dashboard </span>', array('controller'=>'fibers','action' => 'dashboard'),array('escape'=>false,'class'=>'btn btn-info')); ?>
                    </div>
                </div>


                <div class="row bar bar-third">
                    <div class="col-md-3">
                        <div class="row bar bar-secondary">
                            <div class="col-md-12">
                                <strong> Zone Tree</strong>
                                
                                <?php echo $this->ZoneeeTree->createTree($ZoneTree)?>

                            </div>          
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="table-responsive">
                            <table class="table table-striped">

                                <thead>
                                    <tr>
                                        <th><?php echo $this->Paginator->sort('zone_id','Zone Name'); ?></th>
                                        <th><?php echo $this->Paginator->sort('name','Bts Name'); ?></th>
                                    </tr>

                                </thead>            
                                <tbody>
                                    <?php  foreach ($sites as $site):?>         
	                                    <tr>
	                                        <td><?php echo h($zones[$site['Site']['zone_id']]); ?></td>
	                                        <td><?php echo $this->Html->link( $site['Site']['site_name'],array('controller'=>'configurations','action'=>'door_alarm', $site['Site']['id']),array('escape' => false) );?></td>
	                                        
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
                    </di
            </div>
        </div>
   </section>
</div>