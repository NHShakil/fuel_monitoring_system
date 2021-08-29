<div class="row bar bar-third">
	<div class="col-md-12">
		<?php echo $this->Form->create('Testing',array('class'=>'form-horizontal')); ?>

			

			<div class="form-group">
				<label class="col-sm-2 control-label">Signal Strength</label>
    			<div class="col-md-10">
        			<?php echo $this->Form->input('signal_strenght',array('class'=>'form-control','div'=>false,'label'=>false));?>
    			</div>
			</div>

			<div class="form-group">
				<label class="col-sm-2 control-label">Voltage</label>
    			<div class="col-md-10">
        			<?php echo $this->Form->input('voltage',array('class'=>'form-control','div'=>false,'label'=>false));?>
    			</div>
			</div>


			<div class="form-group">
				<div class="col-sm-offset-2 col-md-3">
					<?php echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning','label'=>false,'div'=>false));?>
				</div>

				<div class="col-md-1">
				<?php echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-info btn-left-margin','label'=>false,'div'=>false));?>
				</div>
			</div>

		<?php echo $this->Form->end(); ?>
	</div> 
</div>

