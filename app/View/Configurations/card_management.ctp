<?php $this->assign('title', 'Device :: Config');
	$date 			= new DateTime();
	$date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
?>
<div class="content-wrapper">
    <section class="content bgimage">
       <div class= "row">
       		<div class="col-md-12" >
	       		<div class="bar bar-primary bar-top">
					<h3 class="bar-title col-md-4"><?php echo __("{$readerData['Testing']['site_name']} Device :: Configuration Panel"); ?></h3>

					<div class="col-md-8 text-right">

	                    <?php echo $this->Form->create('Testing',array('url'=>array('controller'=>'fibers', 'action'=>'dashboard')), array('class'=>'searchForm','data-role'=>'form')); ?>

	                    <?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>

	                    <?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
	                            
	                    <?php echo $this->Form->end(); ?>
	                </div>
				</div>
				<div class="row bar bar-secondary">
					<div class="col-md-6 text-left">
						<?php echo $this->Html->link('<i class=\'fa fa-angle-double-left\'></i> Back', array('controller'=>'configurations','action' => 'index'),array('escape'=>false,'class'=>'btn btn-info')); ?>
					</div>
					<div class="col-md-6 text-right">
						<?php echo $this->Html->link('<i class=\'fa fa-angle-double-left\'></i> BTS Operation Board', array('controller'=>'configurations','action' => 'index'),array('escape'=>false,'class'=>'btn btn-warning')); ?>
					</div>
				</div>
				<div class="row bar bar-third">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										Internal Card
									</div>
									<div class="panel-body">
									  	<div class="row">
										  	<?php echo $this->Form->create('door_sensing',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'door_sensing',$readerData['Testing']['site_name'])));?>
												<div class="col-md-7">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align:left;">Card One</label>
											  			<div class="col-md-7" style="text-align:left;">
												  			<?php echo $this->Form->input('door_sensing_val',array('class'=>'form-control','div'=>false,'label'=>false,'value'=>$readerData['Testing']['blc'])); ?>
											  			</div>
										  			</div>
												</div>
										  		
									  			<div class="col-md-5">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info btn-sm')));?>
									  				<?php echo $this->Form->button('<i class="fa fa-times-circle-o"></i><span> Delete</span>',array('type'=>'submit','class'=>array('btn btn-danger btn-sm')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
									  	</div>

									  	<div class="row">
										  	<?php echo $this->Form->create('water_sensing',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'water_sensing',$readerData['Testing']['site_name'])));?>
												<div class="col-md-7">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align: left;">Card Two </label>
											  			<div class="col-md-7">
												  			<?php echo $this->Form->input('water_sensing_val',array('class'=>'form-control','div'=>false,'label'=>false,'value'=>$readerData['Testing']['blc'])); ?>
											  			</div>
										  			</div>
												</div>
										  		
									  			<div class="col-md-5">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info btn-sm')));?>
									  				<?php echo $this->Form->button('<i class="fa fa-times-circle-o"></i><span> Delete</span>',array('type'=>'submit','class'=>array('btn btn-danger btn-sm')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
									  	</div>

									  	<div class="row">
										  	<?php echo $this->Form->create('smoke_sensing',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'smoke_sensing',$readerData['Testing']['site_name'])));?>
												<div class="col-md-7">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align: left;">Card Three </label>
											  			<div class="col-md-7">
												  			<?php echo $this->Form->input('smoke_sensing_val',array('class'=>'form-control','div'=>false,'label'=>false,'value'=>$readerData['Testing']['blc'])); ?>
											  			</div>
										  			</div>
												</div>
										  		
									  			<div class="col-md-5">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info btn-sm')));?>
									  				<?php echo $this->Form->button('<i class="fa fa-times-circle-o"></i><span> Delete</span>',array('type'=>'submit','class'=>array('btn btn-danger btn-sm')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
									  	</div>

									  	<div class="row">
										  	<?php echo $this->Form->create('internal_no_nc_edit',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'internal_no_nc_edit',$readerData['Testing']['site_name'])));?>
												<div class="col-md-7">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align: left;">Card Four </label>
											  			<div class="col-md-7">
												  			<?php echo $this->Form->input('internal_relay_no_nc',array('class'=>'form-control','value'=>$readerData['Testing']['blc'],'placeholder'=>'xxx','div'=>false,'label'=>false)); ?>
											  			</div>
										  			</div>
												</div>
									  			<div class="col-md-5">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info btn-sm')));?>
									  				<?php echo $this->Form->button('<i class="fa fa-times-circle-o"></i><span> Delete</span>',array('type'=>'submit','class'=>array('btn btn-danger btn-sm')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
									  	</div>

									  	<div class="row">
										  	<?php echo $this->Form->create('all_relay_no_nc_edit',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'all_relay_no_nc_edit',$readerData['Testing']['site_name'])));?>
												<div class="col-md-7">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align: left;">Card Five </label>
											  			<div class="col-md-7">
												  			<?php echo $this->Form->input('all_relay_no_nc',array('class'=>'form-control','value'=>$readerData['Testing']['blc'],'placeholder'=>'xxx','div'=>false,'label'=>false)); ?>
											  			</div>
										  			</div>
												</div>
									  			<div class="col-md-5">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info btn-sm')));?>
									  				<?php echo $this->Form->button('<i class="fa fa-times-circle-o"></i><span> Delete</span>',array('type'=>'submit','class'=>array('btn btn-danger btn-sm')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
									  	</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										Visitor Card
									</div>
									<div class="panel-body">
									  	<div class="row">
										  	<?php echo $this->Form->create('door_sensing',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'door_sensing',$readerData['Testing']['site_name'])));?>
												<div class="col-md-7">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align: left;">Card One</label>
											  			<div class="col-md-7">
												  			<?php echo $this->Form->input('door_sensing_val',array('class'=>'form-control','div'=>false,'label'=>false,'value'=>$readerData['Testing']['blc'])); ?>
											  			</div>
										  			</div>
												</div>
										  		
									  			<div class="col-md-5">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info btn-sm')));?>
									  				<?php echo $this->Form->button('<i class="fa fa-times-circle-o"></i><span> Delete</span>',array('type'=>'submit','class'=>array('btn btn-danger btn-sm')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
									  	</div>

									  	<div class="row">
										  	<?php echo $this->Form->create('water_sensing',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'water_sensing',$readerData['Testing']['site_name'])));?>
												<div class="col-md-7">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align: left;">Card Two </label>
											  			<div class="col-md-7">
												  			<?php echo $this->Form->input('water_sensing_val',array('class'=>'form-control','div'=>false,'label'=>false,'value'=>$readerData['Testing']['blc'])); ?>
											  			</div>
										  			</div>
												</div>
										  		
									  			<div class="col-md-5">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info btn-sm')));?>
									  				<?php echo $this->Form->button('<i class="fa fa-times-circle-o"></i><span> Delete</span>',array('type'=>'submit','class'=>array('btn btn-danger btn-sm')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
									  	</div>

									  	<div class="row">
										  	<?php echo $this->Form->create('smoke_sensing',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'smoke_sensing',$readerData['Testing']['site_name'])));?>
												<div class="col-md-7">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align: left;">Card Three </label>
											  			<div class="col-md-7">
												  			<?php echo $this->Form->input('smoke_sensing_val',array('class'=>'form-control','div'=>false,'label'=>false,'value'=>$readerData['Testing']['blc'])); ?>
											  			</div>
										  			</div>
												</div>
										  		
									  			<div class="col-md-5">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info btn-sm')));?>
									  				<?php echo $this->Form->button('<i class="fa fa-times-circle-o"></i><span> Delete</span>',array('type'=>'submit','class'=>array('btn btn-danger btn-sm')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
									  	</div>

									  	<div class="row">
										  	<?php echo $this->Form->create('internal_no_nc_edit',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'internal_no_nc_edit',$readerData['Testing']['site_name'])));?>
												<div class="col-md-7">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align: left;">Card Four </label>
											  			<div class="col-md-7">
												  			<?php echo $this->Form->input('internal_relay_no_nc',array('class'=>'form-control','value'=>$readerData['Testing']['blc'],'placeholder'=>'xxx','div'=>false,'label'=>false)); ?>
											  			</div>
										  			</div>
												</div>
									  			<div class="col-md-5">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info btn-sm')));?>
									  				<?php echo $this->Form->button('<i class="fa fa-times-circle-o"></i><span> Delete</span>',array('type'=>'submit','class'=>array('btn btn-danger btn-sm')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
									  	</div>

									  	<div class="row">
										  	<?php echo $this->Form->create('all_relay_no_nc_edit',array('class'=>'form-horizontal','type'=>'post','url' => array('controller'=>'deviceconfigurations', 'action'=>'all_relay_no_nc_edit',$readerData['Testing']['site_name'])));?>
												<div class="col-md-7">
													<div class="form-group">
										  				<label class="col-sm-5 control-label" style="text-align: left;">Card Five </label>
											  			<div class="col-md-7">
												  			<?php echo $this->Form->input('all_relay_no_nc',array('class'=>'form-control','value'=>$readerData['Testing']['blc'],'placeholder'=>'xxx','div'=>false,'label'=>false)); ?>
											  			</div>
										  			</div>
												</div>
									  			<div class="col-md-5">
									  				<?php echo $this->Form->button('<i class="fa fa-edit"></i><span> EDIT</span>',array('type'=>'submit','class'=>array('btn btn-info btn-sm')));?>
									  				<?php echo $this->Form->button('<i class="fa fa-times-circle-o"></i><span> Delete</span>',array('type'=>'submit','class'=>array('btn btn-danger btn-sm')));?>
									  			</div>
										  	<?php echo $this->Form->end();?>
									  	</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										Current Configuration Part One
									</div>
									<div class="panel-body">
										<dl class="dl-horizontal">
										  	<dt>Card One</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>
										  
										  	<dt>Card Two</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>
										  
										  	<dt>Card Three</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>
										  
										  	<dt>Card Four</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>
										  
										  	<dt>Card Five</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>
										</dl>
									</div>
								</div>
							</div>

							<div class="col-md-6">
								<div class="panel panel-default">
									<div class="panel-heading">
										Current Configuration Part Two
									</div>
									<div class="panel-body">
										<dl class="dl-horizontal">
										  	<dt>Card One</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>
										  
										  	<dt>Card Two</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>
										  
										  	<dt>Card Three</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>
										  
										  	<dt>Card Four</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>
										  
										  	<dt>Card Five</dt>
										  	<dd><?php echo $readerData['Testing']['blc'];?></dd>
										</dl>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>