<?php $this->assign('title', 'Zone :: Edit');?>
<div class="container-fluid">
    <div class="row">	
		<div class="col-md-12">

            <div class="card card-info">
              	<div class="card-header">
                	<h3 class="bar-title col-md-2"><?php echo __('Zone :: Edit'); ?></h3>
              	</div>

              	<div class="card-header">
	        		
		        	<?php echo $this->Html->link('<i class="fa fa-list"></i><span> List Zone</span>', array('controller'=>'zones','action' => 'index'), array('escape'=>false,'class'=>'btn btn-success')); ?>
		    		
				</div>


              	<div class="card-body">
              		<?php echo $this->Form->create('Zone',array('class'=>'form-horizontal')); ?>
					<?php echo $this->Form->input('id',array('type'=>'hidden'));?>
                	<div class="form-group">
                  		<label>Parent Zone</label>
                  		<?php echo $this->Form->input('parent_id',array('options'=>$parentZones,'empty'=>true, 'class'=>'form-control','div'=>false, 'label'=>false));?>
                	</div>


	                <div class="form-group">
	                  	<label>Zone Name</label>
	                  	<div class="input-group">
	                    	<div class="input-group-prepend">
	                      		<span class="input-group-text"><i class="fas fa-file"></i></span>
	                    	</div>
	                    	<?php echo $this->Form->input('name',array('class'=>'form-control','div'=>false,'label'=>false));?>

	                  	</div>
	                </div>

	                <div class="form-group">
                  		<label>Status</label>
                  		<?php echo $this->Form->input('status',array('options'=> $status,'class'=>'form-control','div'=>false, 'label'=>false));?>
                	</div>

                	<div class="card-footer">

                		<?php echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-info','label'=>false,'div'=>false));?>

                  		<?php echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning float-right','label'=>false,'div'=>false));?>
                	</div>

                	<?php echo $this->Form->end(); ?>
            	</div>

          	</div>
        </div>
    </div>
</div>



