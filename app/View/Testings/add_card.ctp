<!-- <?php $this->assign('title', 'Add :: Card');?> -->
<!-- <div class="content-wrapper">
    <section class="content">
        <div class= "row">
            <div class="col-md-12" >
                <div class="bar bar-primary bar-top">
                    <h3 class="bar-title col-md-2"><?php echo __('Edit :: Device Info'); ?></h3>
                </div>
                <div class="row bar bar-secondary">
                    <div style="float: left; padding-left: 10px;  margin-bottom: 50px;" >
                        <?php echo $this->Html->link('<i class="fa fa-list"></i><span>Back to Operation</span>', array('action' => 'action_controller'),array('escape'=>false,'class'=>'btn btn-info')); ?>
                    </div>

                    <div style="margin-left: 10px; float: left; padding-left: 10px; margin-bottom: 50px;" >
                        <?php echo $this->Html->link('<i class="fa fa-list"></i><span>Back to Dashboard</span>', array('action' => 'dashboard'),array('escape'=>false,'class'=>'btn btn-info')); ?>
                    </div>
                </div>

                <div class="row bar bar-third">
                    <div class="col-md-12">
                        <?php echo $this->Form->create('Testing',array('class'=>'form-horizontal'));?> 
                        <?php echo $this->Form->input('id',array('type'=>'hidden'));?>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Site Name</label>
                            <div class="col-md-10">
                                <?php echo $this->Form->input('site_name',array( 'class'=>'form-control','div'=>false,'label'=>false,'readonly'=>true));?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Entry Card Number</label>
                            <div class="col-md-10">
                                <?php echo $this->Form->input('card_list',array( 'class'=>'form-control','div'=>false,'label'=>false));?>
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
                    </div>
                </div>

                <div class="row bar bar-third" style="width: 50%; float: left;">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <div style="text-align: center; width: 100%; height: 30px; border:1px; border-style:solid; background-color: green;">Device Card</div>
                            <table class="table table-striped" style="width: 100%;"> 
                                <thead>
                                    <tr class="text-center" bgcolor=#99ddff>
                                        <th><?php echo $this->Paginator->sort('Site Id'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 1'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 2'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 3'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 4'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 5'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 6'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 7'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 8'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 9'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 10'); ?></th>
                                    </tr>
                                </thead>
            
                                <tbody>
                                    <?php 
                                        foreach($site_details as $id=>$zone): ?>
                                            <tr>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['site_id']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_1']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_2']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_3']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_4']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_5']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_6']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_7']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_8']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_9']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_10']); ?></td>
                                            </tr>
                                        <?php endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row bar bar-third" style="width: 50%; float: left; padding-left: 10px;">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <div style="text-align: center; width: 100%; height: 30px; border:1px; border-style:solid; background-color: green; ">Zone's Card</div>
                            <table class="table table-striped" style="width: 100%;">
                                <thead>
                                    <tr class="text-center" bgcolor=#99ddff>
                                        <th><?php echo $this->Paginator->sort('Zone'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 1'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 2'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 3'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 4'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 5'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 6'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 7'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 8'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 9'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 10'); ?></th>
                                    </tr>
                                </thead>
            
                                <tbody>
                                    <?php 
                                        foreach($site_detailss as $id=>$zone): ?>
                                            <tr>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['zone_name']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_1']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_2']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_3']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_4']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_5']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_6']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_7']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_8']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_9']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_10']); ?></td>
                                            </tr>
                                        <?php endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
   </section>
</div> -->


<?php $this->assign('title', 'Add :: Card');?>
<div class="content-wrapper">
    <section class="content">
        <div class= "row">
            <div class="col-md-12" >
                <div class="bar bar-primary bar-top">
                    <h3 class="bar-title col-md-2"><?php echo __('Edit :: Device Info'); ?></h3>
                </div>
                <div class="row bar bar-secondary">
                    <div style="float: left; padding-left: 10px;  margin-bottom: 50px;" >
                        <?php echo $this->Html->link('<i class="fa fa-list"></i><span>Back to Operation</span>', array('action' => 'action_controller'),array('escape'=>false,'class'=>'btn btn-info')); ?>
                    </div>

                    <div style="margin-left: 10px; float: left; padding-left: 10px; margin-bottom: 50px;" >
                        <?php echo $this->Html->link('<i class="fa fa-list"></i><span>Back to Dashboard</span>', array('action' => 'dashboard'),array('escape'=>false,'class'=>'btn btn-info')); ?>
                    </div>
                </div>

                <div class="row bar bar-third">
                    <div class="col-md-12">
                        <?php echo $this->Form->create('CardManagement',array('class'=>'form-horizontal'));?> 
                        <?php echo $this->Form->input('id',array('type'=>'hidden'));?>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Site Name</label>
                            <div class="col-md-10">
                                <?php echo $this->Form->input('site_name',array( 'class'=>'form-control','div'=>false,'label'=>false));?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Site ID</label>
                            <div class="col-md-10">
                                <?php echo $this->Form->input('SiteModuleId',array( 'class'=>'form-control','div'=>false,'label'=>false));?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Entry Card Number</label>
                            <div class="col-md-10">
                                <?php echo $this->Form->input('card_number',array('options' =>$card_list, 'class'=>'form-control','div'=>false,'label'=>false));?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Card Type</label>
                            <div class="col-md-10">
                                <?php echo $this->Form->input('card_type',array('options' =>$card_type,'name'=>'Noman','class'=>'form-control','div'=>false,'label'=>false));?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"> Date </label>
                            <div class="col-md-10">
                                <?php echo $this->Form->input('date_time',array('class'=>'form-control','div'=>false,'label'=>false,'id'=>'date_time','placeholder'=>'only day'));?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"> Start Time </label>
                            <div class="col-md-10">
                                <?php echo $this->Form->input('start_time',array('class'=>'form-control','div'=>false,'label'=>false,'id'=>'start_time','placeholder'=>'only hour'));?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label"> End Time </label>
                            <div class="col-md-10">
                                <?php echo $this->Form->input('expire_time',array('class'=>'form-control','div'=>false,'label'=>false,'id'=>'expire_time','placeholder'=>'how many hour'));?>
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
                    </div>
                </div>

                <div class="row bar bar-third" style="width: 50%; float: left;">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <div style="text-align: center; width: 100%; height: 30px; border:1px; border-style:solid; background-color: green;">Device Card</div>
                            <table class="table table-striped" style="width: 100%;"> 
                                <thead>
                                    <tr class="text-center" bgcolor=#99ddff>
                                        <th><?php echo $this->Paginator->sort('Site Id'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 1'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 2'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 3'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 4'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 5'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 6'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 7'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 8'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 9'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 10'); ?></th>
                                    </tr>
                                </thead>
            
                                <tbody>
                                    <?php 
                                        foreach($site_details as $id=>$zone): ?>
                                            <tr>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['site_name']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_1']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_2']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_3']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_4']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_5']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_6']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_7']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_8']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_9']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_10']); ?></td>
                                            </tr>
                                        <?php endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row bar bar-third" style="width: 50%; float: left; padding-left: 10px;">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <div style="text-align: center; width: 100%; height: 30px; border:1px; border-style:solid; background-color: green; ">Zone's Card</div>
                            <table class="table table-striped" style="width: 100%;">
                                <thead>
                                    <tr class="text-center" bgcolor=#99ddff>
                                        <th><?php echo $this->Paginator->sort('Zone'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 1'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 2'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 3'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 4'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 5'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 6'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 7'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 8'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 9'); ?></th>
                                        <th><?php echo $this->Paginator->sort('Card 10'); ?></th>
                                    </tr>
                                </thead>
            
                                <tbody>
                                    <?php 
                                        foreach($site_detailss as $id=>$zone): ?>
                                            <tr>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['zone_name']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_1']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_2']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_3']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_4']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_5']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_6']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_7']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_8']); ?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_9']);?></td>
                                                <td style="padding-left: 20px;"> <?php echo h($zone['card_10']); ?></td>
                                            </tr>
                                        <?php endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
   </section>
</div>

<script>
    $(document).ready(function() {
        $('#date_time').attr('disabled','disabled'); 
        $('#start_time').attr('disabled','disabled');
        $('#expire_time').attr('disabled','disabled');
        $('select[name="Noman"]').on('change',function(){
            var  others = $(this).val();
            if(others != "0"){           
                $('#date_time').removeAttr('disabled');
                $('#start_time').removeAttr('disabled');
                $('#expire_time').removeAttr('disabled');
            }
            else
            {
                $('#date_time').attr('disabled','disabled'); 
                $('#start_time').attr('disabled','disabled');
                $('#expire_time').attr('disabled','disabled');
            }  
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('select[card_no="Card_No"]').on('change',function(){
            var  others = $(this).val();
            if(others != "0"){           
                $('#card_number').removeAttr('disabled');   
            } 
        });
    });
</script>



