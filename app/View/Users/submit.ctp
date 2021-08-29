<div class="content-wrapper">
    <section class="content">
		<?php
			echo $this->Form->create('Alu',array('class'=>'form-horizontal'));
			echo $this->Form->input('alu_name',array('class'=>'form-control','label'=>false, 'div'=>false));
			echo $this->Form->input('potol_name',array('class'=>'form-control','label'=>false, 'div'=>false));
			//echo $this->Form->input('role_id', array('class'=>'form-control','div'=>false,'label'=>false ));
			echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-info btn-left-margin','label'=>false,'div'=>false));
			echo $this->Form->end();
		?>
	</section>
</div>