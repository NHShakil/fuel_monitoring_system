<?php $this->assign('title', 'Ip  :: Edit');?>
<div class="content-wrapper">
    <section class="content">
        <!-- <div class="box box-primary"> -->
		<div class= "row">
    		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
					<h3 class="bar-title col-md-2"><?php echo __('Ip Address :: Edit'); ?></h3>
				</div>
				<div class="row bar bar-secondary">
					<div class="col-md-12">
						<?php echo $this->Html->link('<i class="fa fa-list"></i><span> All Device Ip</span>', array('action' => 'index'),array('escape'=>false,'class'=>'btn btn-success')); ?>
					</div>	
				</div>

				<div class="row bar bar-third">
					<div class="col-md-12">
						<?php echo $this->Form->create('Testing',array('class'=>'form-horizontal'));?> 
						<?php echo $this->Form->input('id',array('type'=>'hidden'));?>
	
			
						<div class="form-group">
							<label class="col-sm-2 control-label">Server Ip Address</label>
							<div class="col-md-10">
								<?php echo $this->Form->input('server_ip',array('pattern' =>"((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$", 'class'=>'form-control','readonly'=>true,'div'=>false,'label'=>false));?>
							</div>
						</div>
			
						<!-- <div class="form-group">
							<label class="col-sm-2 control-label">Ip Address</label>
							<div class="col-md-10">
								<?php echo $this->Form->input('ip_address',array('pattern' =>"((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$",'class'=>'form-control','div'=>false, 'label' => false));?>
							</div>
						</div> -->


						<div class="row">
						  	<?php echo $this->Form->create('dip',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'operations', 'action'=>'bts_dip_config',$btsId)));?>
							<div class="col-md-9">
								<div class="form-group">
						  			<label class="col-sm-5 control-label">Device Ip</label>
							  		<div class="col-md-7">
								  		<?php echo $this->Form->input('ip_address',array('class'=>'form-control','div'=>false,'label'=>false, 'pattern' =>"((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$",'value'=>$btsDetails['Testing']['ip_address'])); ?>
							  		</div>
						  		</div>
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
