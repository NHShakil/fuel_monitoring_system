<?php $this->assign('title', 'Edit :: Data');?>
<div class="content-wrapper">
    <section class="content">
        <!-- <div class="box box-primary"> -->



<div class= "row">
    <div class="col-md-12" >
        <div class="bar bar-primary bar-top">
            <h3 class="bar-title col-md-2 "><?php echo __(' Edit :: User'); ?></h3>
            <!-- <span class="report-title pull-right">
                <?php echo $this->Form->create('search',array('class'=>'form-inline'));?>
                <div class="form-group">
                    <?php echo $this->Form->input('keyword',array('div'=>false,'label'=>false,'class'=>'form-control'))?>
                </div>
                <?php echo $this->Form->button('Search',array('div'=>false,'label'=>false,'class'=>'form-control'))?>				
                <?php echo $this->Form->end();?>
            </span> -->
        </div>







<!-- <div class="row bar bar-primary bar-top">
    <div class="col-md-12">
        <h3 class="bar-title"><?php echo __('Edit :: User'); ?></h3>
    </div>
</div> -->

<div class="row bar bar-secondary">
    <div class="col-md-2">
        <?php echo $this->Html->link('<i class="fa fa-list"></i><span> All Users</span>', array('controller' => 'users','action' => 'index'),array('escape'=>false,'class'=>'btn btn-success')); ?>
    </div>  
</div>

<div class="row bar bar-third">
    <div class="col-md-12">
    <?php echo $this->Form->create('User',array('class'=>'form-horizontal'));?> 
            <?php echo $this->Form->input('id',array('type'=>'hidden'));?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Username </label>
                <div class="col-md-10">
                    <?php echo $this->Form->input('username',array('class'=>'form-control', 'label' =>false,'div'=>false));?>
                </div>
            </div>
    
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-md-10">
                    <?php echo $this->Form->input('email',array('class'=>'form-control','label'=>false, 'div'=>false));?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">New Password</label>
                <div class="col-md-10">
                    <?php echo $this->Form->input('password_update',array('maxLength' => 255, 'type'=>'password','placeholder'=>'Enter New Password','required' => 0, 'class'=>'form-control','div'=>false,'label'=>false));?>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Retype New Password</label>
                <div class="col-md-10">
                    <?php echo $this->Form->input('password_confirm_update',array('maxLength' => 255,'type'=>'password','placeholder'=>'Enter Password Again','required' => 0,'class'=>'form-control','div'=>false, 'label' => false));?>
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

     <!-- </div> -->
   </section>
</div>