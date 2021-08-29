<?php $this->assign('title', 'TestIng :: SIte');?>
<div class="content-wrapper">
    <section class="content">
        <div class= "row">
    		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
		            <h2 class="bar-title col-md-2"><?php echo __('Test :: Add'); ?></h2>
	            </div>
                <div class="row bar bar-secondary">
	        		<div class="col-md-12">
		        		<?php echo $this->Html->link('<i class="fa fa-list"></i><span>  All  Site</span>', array('action' => 'dashboard'),array('escape'=>false,'class'=>'btn btn-success')); ?>
		    		</div>
				</div>

				<div class="row bar bar-third">
	        		<div class="col-md-12">
	            		<?php echo $this->Form->create('Testing',array('class'=>'form-horizontal')); ?>

		    				<div class="form-group">
			    				<label class="col-sm-2 control-label">Server Address </label>
			        			<div class="col-md-10">
				        			<?php echo $this->Form->input('server_ip',array('pattern' =>"((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$",'readonly'=>true,'class'=>'form-control','value'=>'144.48.2.11','div'=>false,'label'=>false));?>
			        			</div>
		    				</div>

		    				<div class="form-group">
			    				<label class="col-sm-2 control-label">Site Name </label>
			        			<div class="col-md-10">
				        			<?php echo $this->Form->input('site_name',array('class'=>'form-control','div'=>false,'label'=>false));?>
			        			</div>
		    				</div>

							<div class="form-group">
								<div class="col-sm-offset-2 col-md-1">
									<?php echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));?>
								</div>
			
								<div class="col-md-1">
								<?php echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-info btn-left-margin','label'=>false,'div'=>false));?>
								</div>
							</div>

	    				<?php echo $this->Form->end(); ?>
	        		</div> 
	    		</div>
	    	</div>
     	</div>
   	</section>
</div>
