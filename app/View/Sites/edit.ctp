<?php $this->assign('title', 'BTS :: Edit');?>
<div class="container-fluid">
    <div class="row">	
		<div class="col-md-12">

            <div class="card card-info">
              	<div class="card-header">
                	<h3 class="bar-title col-md-2"><?php echo __('BTS :: Edit'); ?></h3>
              	</div>

              	<div class="card-header">
	        		
		        	<?php echo $this->Html->link('<i class="fa fa-list"></i><span> All Base Stations</span>', array('action' => 'index'),array('escape'=>false,'class'=>'btn btn-success')); ?>
		    		
				</div>


              	<div class="card-body">
              		<?php echo $this->Form->create('Site',array('class'=>'form-horizontal'));?> 
					<?php echo $this->Form->input('id',array('type'=>'hidden'));?>
                	<div class="form-group">
                  		<label>Zone</label>
                  		<?php echo $this->Form->input('zone_id',array('options'=>$zoness, 'class'=>'form-control','label'=>false, 'div'=>false));?>
                	</div>


	                <div class="form-group">
	                  	<label>Site ID</label>
	                  	<div class="input-group">
	                    	<div class="input-group-prepend">
	                      		<span class="input-group-text"><i class="fas fa-file"></i></span>
	                    	</div>

	                    	<?php echo $this->Form->input('SiteModuleId',array('class'=>'form-control','label'=>false, 'div'=>false));?>

	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label>Site Name</label>
	                  	<div class="input-group">
	                    	<div class="input-group-prepend">
	                      		<span class="input-group-text"><i class="fas fa-file"></i></span>
	                    	</div>

	                    	<?php echo $this->Form->input('site_name',array('class'=>'form-control','label'=>false, 'div'=>false));?>

	                  	</div>
	                </div>

	                <div class="form-group">
	                  	<label>Site Name</label>
	                  	<div class="input-group">
	                    	<div class="input-group-prepend">
	                      		<span class="input-group-text"><i class="fas fa-file"></i></span>
	                    	</div>

	                		<?php echo $this->Form->input('site_category',array('options'=> $site_category,'class'=>'form-control','label'=>false, 'div'=>false));?>

	                  	</div>
	                </div>

	                <div class="form-group">
                  		<label>Service Port</label>

                  		<div class="input-group">
                    		<div class="input-group-prepend">
                      			<span class="input-group-text"><i class="fas fa-laptop"></i></span>
                    		</div>
                    		<?php echo $this->Form->input('service_port',array('class'=>'form-control','value'=>'80','readonly'=>true,'label'=>false, 'div'=>false));?>
                  		</div>
                  		<!-- /.input group -->
                	</div>


                	<div class="form-group">
                  		<label>Server IP</label>

                  		<div class="input-group">
                    		<div class="input-group-prepend">
                      			<span class="input-group-text"><i class="fas fa-laptop"></i></span>
                    		</div>
                    		<?php echo $this->Form->input('server_ip',array('pattern' =>"((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$",'readonly'=>true,'class'=>'form-control','value'=>'167.86.113.96','div'=>false,'label'=>false));?>
                  		</div>
                  		<!-- /.input group -->
                	</div>


                	<div class="form-group">
	                  	<label>Used Frequency</label>
	                  	<div class="input-group">
	                    	<div class="input-group-prepend">
	                      		<span class="input-group-text"><i class="fas fa-file"></i></span>
	                    	</div>

	                		<?php echo $this->Form->input('used_frequency',array('class'=>'form-control','label'=>false, 'div'=>false));?>

	                  	</div>
	                </div>

	                <div class="form-group">
                  		<label>Status</label>
                  		<?php echo $this->Form->input('status',array('options'=>$status,'class'=>'form-control','div'=>false, 'label'=>false));?>
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







