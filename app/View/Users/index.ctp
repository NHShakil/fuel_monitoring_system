<?php $this->assign('title', 'User :: Index');?>

<div class= "row">
    <div class="col-md-12" >
        <div class="bar bar-primary bar-top">
            <h2 class="bar-title col-md-2"><?php echo str_repeat('&nbsp;', 1).__('Users :: List'); ?></h2>
            <!-- <div class="col-md-10 text-right">
                <?php echo $this->Form->create('Bts',array('class'=>'searchForm','data-role'=>'form')); ?>
                <?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
                <?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>        
                <?php echo $this->Form->end(); ?>
            </div> -->
        </div>

        <div class="row bar bar-secondary">
            <div class="col-md-12">
                <?php echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Add New User</span>', array('controller'=>'users','action' => 'add'),array('escape'=>false,'class'=>'btn btn-info')); ?>
            </div>  
        </div>


        <div class="clearfix report-details">
            <div class="card-body table-responsive no-padding">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr class="text-center" bgcolor=#99ddff class="col-md-12">
                            <th><?php echo $this->Paginator->sort('username','Username'); ?></th>
                            <th><?php echo $this->Paginator->sort('created','Created'); ?></th>
                            <th><?php echo $this->Paginator->sort('modified','Modified'); ?></th>
                            <th><?php echo $this->Paginator->sort('role_id'); ?></th>
                            <th><?php echo $this->Paginator->sort('status',' Status'); ?></th>
                            <th class="text-center action-th"><?php echo __('Actions'); ?></th>
                            <th class="text-center action-th"><?php echo __('Login History'); ?></th>
                            <th class="text-center action-th"><?php echo __('All History'); ?></th>
                        </tr>
                    </thead>

           		    <tbody>
           			    <?php  
                            foreach ($users as $key => $user) { ?>
                                <tr>
                                    <td><?php echo $this->Html->link( $user['User']['username']  ,   array('action'=>'edit', $user['User']['id']),array('escape' => false) );?></td>
                                    <td><?php echo h($user['User']['created']); ?></td>
                                    <td><?php echo h($user['User']['modified']); ?></td>

                                    <td><?php echo $user['Role']['title']; ?></td>
                                    <td><?php echo $user['User']['status']; ?></td>
                    
                    
                                    <td class="text-center action">
                                        <?php 
                                            echo $this->Html->link('<i class="fa fa-edit"></i><span> Edit</span>', array('action' => 'edit', $user['User']['id']),array('escape'=>false,'class'=>'btn btn-info'));
                                            
                                        ?>

                                        <?php 
                                            echo $this->Form->postLink('<i class="fa fa-times-circle-o" aria-hidden="true"></i><span> Delete</span>', array('action' => 'delete', $user['User']['id']), array('escape'=>false,'class'=>'btn btn-danger'), __('Are you sure you want to delete?'));
                                            
                                        ?>
                                    </td>


                                    <td class="text-center action">
                                        <?php 
                                            echo $this->Html->link('<i class="fa fa-download"></i><span> Download</span>', array('controller' => 'users', 'action' => 'download', $user['User']['username']), array('escape'=>false,'class'=>'btn btn-success')); 
                                        ?>
                                    </td>
                                    <?php
                                        if($key == $avg){ ?>
                                            <td class="text-center action">
                                                <?php echo $this->Html->link('<i class="fa fa-download"></i><span> Download</span>', array('controller' => 'users', 'action' => 'alldownload', $user['User']['username']=='Massive'), array('escape'=>false,'class'=>'btn btn-success')); 
                                                ?>                                
                                            </td><?php 
                                        }
                                    ?>
                                </tr><?php
                            }
                        ?>
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
	





<div class="modal fade" id="logFromDevice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        	<span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">User History Download</h4>
      </div>
      <div class="modal-body">
            <div class="progress downloadProcess">
              <div class="progress-bar downLoadProcessBar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
              </div>
            </div>            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    function startLogDownload(userId){
        $.ajax({
            'method'    : 'post',
            'url'       : "http://localhost/Massive_EMS/app/webroot/files/" + userId,
            //'url'       : "C:\xampp\htdocs\Massive_EMS\app\webroot\files" + deviceId,
        }).success(function(data){
            
            if(data !== 'fail'){
                $('.downloadProcess').show();
                
                for(var i = 0; i<= 100; i++ ){

                }

                $('.modal-body').append('<a class="btn btn-info btn-sm" target="_blank" href="http://localhost/Massive_EMS/app/webroot/files/'+data+'/dv"><i class="fa fa-file-text"></i> Download</a>');
                
            }else{
                console.log(data);
                $('.downloadProcess').hide();
                $('.modal-body').html('<p class="alert alert-danger">Download Process failed, please Try again</p>');
            }
        });
    }
</script>




