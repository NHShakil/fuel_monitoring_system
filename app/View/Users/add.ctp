<?php $this->assign('title', 'Add :: User');?>
<div class="container-fluid">
    <div class="row">   
        <div class="col-md-12">

            <div class="card card-info">
                <div class="card-header">
                    <h2 class="bar-title col-md-2"><?php echo __('User :: Add'); ?></h2>
                </div>

                <div class="card-header">
                    
                    <?php echo $this->Html->link('<i class="fa fa-list"></i><span> All Users</span>', array('action' => 'index'),array('escape'=>false,'class'=>'btn btn-success')); ?>
                    
                </div>

                <div class="card-body">
                    <?php echo $this->Form->create('User',array('class'=>'form-horizontal')); ?>
                    
                    <div class="form-group">
                        <label>Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <?php echo $this->Form->input('username',array('class'=>'form-control', 'label' =>false,'div'=>false));?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <?php echo $this->Form->input('email',array('class'=>'form-control','label'=>false, 'div'=>false));?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <?php echo $this->Form->input('password',array('class'=>'form-control','div'=>false,'label'=>false));?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <?php echo $this->Form->input('password_confirm', array('class'=>'form-control','type'=>'password','div'=>false, 'maxLength' => 255,'label'=>false));?>
                        </div>
                    </div>

                    

                    <div class="form-group">
                        <label>Role</label>
                        <?php echo $this->Form->input('role_id',array('class'=>'form-control','div'=>false,'label'=>false ));?>
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
