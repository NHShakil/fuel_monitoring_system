<?php $this->assign('title', 'Add :: Role');?>
<div class="container-fluid">
    <div class="row">   
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    <h1 class="bar-title col-md-2"><?php echo __('Role :: Add'); ?></h1>
                </div>

                <div class="card-header">
                    
                    <?php echo $this->Html->link('<i class="fa fa-list"></i></i> List Roles', array('action' => 'index'),array('escape'=>false,'class'=>'btn btn-warning')); ?>
                    
                </div>



				<div class="card-body">
					<div class="col-md-12">


						<?php echo $this->Form->create('Role',array('class'=>'form-horizontal')); ?>

						<div class="form-group">
	                        <label>Title</label>
	                        <div class="input-group">
	                            <div class="input-group-prepend">
	                                <span class="input-group-text"><i class="fas fa-file"></i></span>
	                            </div>
	                            <?php echo $this->Form->input('title',array('class'=>'form-control','div'=>false,'label'=>false));?>
	                        </div>
	                    </div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Description</label>
							<div class="col-md-10">
								<?php echo $this->Form->input('description',array('type'=>'textarea','class'=>'form-control','div'=>false,'label'=>false));?>	
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Permission</label>
							<div class="col-md-10">
								<?php
									foreach($acl_array as $m_key => $module):
										echo "<div class='clearfix'>".$this->Html->link('<span>'.strtoupper($m_key).'</span>', array(),array('escape'=>false,'class'=>'btn btn-info'))."</div>";
										echo "<br>";
	
										echo "<ul class='list'>";

											foreach($module as $key=>$acl_data):
												echo "<li class='controller permission_module'>".$this->Form->input("permission.{$acl_data['controller']}",
												array('type'=>'checkbox', 'checked'=>true, 'value'=>$acl_data['controller'],'onchange'=>'permission_select_deselect_child(this)'));

												echo "<ul class='actions'>";


												foreach($acl_data['actions'] as $key=>$action):
													echo "<li>".$this->Form->input("permission.{$acl_data['controller']}.{$action}",array('type'=>'checkbox','checked'=>true, 'value'=>[$action]))."</li>";
												endforeach;
												echo "<br>";

												echo "</ul></li>";
											endforeach;
										echo "</ul><div class='clearfix'></div>";
									endforeach;

								?>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Status</label>
							<div class="col-md-10">
								<?php echo $this->Form->input('status',array('options'=>$status, 'class'=>'form-control','div'=>false, 'label'=>false));?>	
							</div>
						</div>

						<div class="card-footer">

	                        <?php echo $this->Form->button('Submit',array('type'=>'submit','class'=>'btn btn-info','label'=>false,'div'=>false));?>

	                        <?php echo $this->Form->button('Reset',array('type'=>'reset', 'class'=>'btn btn-warning float-right','label'=>false,'div'=>false));?>
	                    </div>

						<?php echo $this->Form->end();?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


