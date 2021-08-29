<div class="content-wrapper">
    <section class="content">
       	<div class= "row">
       		<div class="col-md-12" >
   				<div class="bar bar-primary bar-top">
        			<h2 class="bar-title col-md-4"><?php echo __('Site Under Construction'); ?></h2>
        		</div>
       		</div>
       		<div class="bar bar-third">
    			<div class="col-md-12">
					<div class="row">
					  	<?php echo $this->Form->create('lockdelay',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'lock_delay_edit',$readerData['Testing']['site_name'])));?>
							<div class="col-md-9">
								<h1 class="text-center" style="color:red;">Under Construction</h1>
								<!-- <div class="form-group">
					  				<label class="col-sm-3 control-label">Time Hour</label>
						  			<div class="col-md-9">
							  			<?php echo $this->Form->input('blc',array('class'=>'form-control','type' => 'number', 'step' => '.5', 'min' => 0.5, 'max' => '5', 'div'=>false,'label'=>false,'value'=>$readerData['Testing']['blc'])); ?>
						  			</div>
					  			</div> -->
							</div>
					  		
				  			<!-- <div class="col-md-3">
				  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> Door Open</span>',array('type'=>'submit','class'=>array('btn btn-info')));?>
				  			</div> -->
					  	<?php echo $this->Form->end();?>
					</div>
				</div>
			</div>
       	</div>
    </section>
</div>