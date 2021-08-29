<div class= "row">
    <div class="col-md-12">
        <div class="card">
            <div class= "row">
                        
                <!-- <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Used Fuel Search by Date</h3>
                        </div>
                        
                        <div class="card-body">
                            
                            <?php echo $this->Form->create(false,array('url'=>array('controller'=>'testings', 'action'=>'used_fuel_by_date')), array('class'=>'searchForm','data-role'=>'form')); ?>
                            <input type="hidden" name="site_id" value=<?php echo $testingId['Testing']['SiteModuleId'];?> >
                            
                            
                            <div class="form-group">
                                <label>Date From To:</label>
    
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="date_value" class="form-control float-right" id="reservation">
                                </div>
                            </div>
                            
                            <div class="inner">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-sm">
                                        <?php echo $this->Form->submit('Submit',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-info'));?>
                                        
                                    </span>
                                </p>
                            </div>
                            
                            <?php echo $this->Form->end();
                            
                                if(isset($total_used_fuel)):?>
                                    <div class="form-group">
                                        <label>Result:</label>
                    
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-file"></i></span>
                                            </div>
                                            <?php if(isset($total_used_fuel)){ ?>
                                                <?php echo $this->Form->input('#',array('class'=>'form-control','label'=>false, 'div'=>false,'value'=>number_format($total_used_fuel,2)));?>
                                            <?php } ?>
                                            
                                        </div>
                                    </div><?php
                                endif
                            ?>
                        </div>
                    </div>
                </div> -->
                         
                         
                         
                <div class="col-md-12">
                    <div class="card-header" >
          
                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-sm-3">
                                    <?php echo $this->Form->create(false,array('url'=>array('controller'=>'testings', 'action'=>'used_fuel_by_date')), array('class'=>'searchForm','data-role'=>'form')); ?>
                                    <input type="hidden" name="site_id" value=<?php echo $testingId['Testing']['SiteModuleId'];?> >
                                    

                                    <div class="">
                                        <div class="inner">
                                            <label class="col-md-12 control-label" style="margin-top:6px;">From</label>

                                            <p class="d-flex flex-column">
                                                <span class="text-bold text-sm">
                                                    <?php echo $this->Form->input('start_date', 
                                                        array(
                                                            'class'             => 'form-control datepicker-here', 
                                                            'label'             => false,
                                                            'id'                => 'start_date',
                                                            'type'              => 'text',
                                                            'data-language'     => 'en',
                                                            'data-date-format'  => 'dd-mm-yyyy',
                                                            'placeholder'       => 'dd/mm/yyyy',
                                                            'autocomplete'      => 'off',
                                                            'required'          => true
                                                        )
                                                    );?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-3">

                                    <div class="">
                                        <div class="inner">
                                            <label class="col-md-12 control-label" style="margin-top:6px;">To</label>

                                            <p class="d-flex flex-column">
                                                <span class="text-bold text-sm">
                                                    <?php echo $this->Form->input('end_date', 
                                                        array(
                                                            'class'             => 'form-control datepicker-here', 
                                                            'label'             => false,
                                                            'id'                => 'end_date',
                                                            'type'              => 'text',
                                                            'data-language'     => 'en',
                                                            'data-date-format'  => 'dd-mm-yyyy',
                                                            'placeholder'       => 'dd/mm/yyyy',
                                                            'autocomplete'      => 'off',
                                                            'required'          => true
                                                        )
                                                    );?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-3">

                                    <div class="">
                                        <div class="inner">
                                            <label class="col-md-12 control-label" style="visibility: hidden;">Submit</label>

                                            <p class="d-flex flex-column">
                                                <span class="text-bold text-sm" style="margin-top: 23px;">
                                                    <?php echo $this->Form->submit('Submit',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-info'));?>
                                                    
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php echo $this->Form->end(); ?>

                                <?php if(isset($total_used_fuel)){?>
                                    <div class="col-sm-3">

                                        <div class="">
                                            <div class="inner">
                                                <label class="col-md-12 control-label" style="margin-top:6px;">Result: </label>

                                                <p class="d-flex flex-column">
                                                    <span class="text-bold text-sm" style="margin-top: 17px;">
                                                        <?php 
                                                            if($total_used_fuel>=1){
                                                                echo $this->Form->input('#',array('class'=>'form-control','label'=>false, 'div'=>false,'value'=>number_format($total_used_fuel,2)));
                                                            }
                                                            else{
                                                                echo $this->Form->input('#',array('class'=>'form-control','label'=>false, 'div'=>false,'value'=>"0.00"));
                                                            }
                                                        ?>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div><?php
                                } ?>

                            </div>
                        </div>
                        
                    </div>
                </div>



                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Daily Used Fuel</h3>
                        </div>

                        <div class="card-body table-responsive no-padding">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr bgcolor=#99ddff>
                                        <th>#</th>
                                        <th>DATE</th>
                                        <th>SITE NAME</th>
                                        <th class="text-right">USED FUEL PER DAY</th>
                                        
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                        foreach ($monthly_used_fuels as $key => $zone):?>
                                            <tr class="success">
                                                <td class="font-size-text"><?php echo $key+1;?></td>
                                                <td class="font-size-text"><?php echo h($zone['todays_date']);?></td>
                                                <td class="font-size-text"><?php echo h($zone['site_name']);?></td>
                                                <td class="font-size-text text-right">

                                                    <?php 
                                                    if($zone['fuel_flag']==1){
                                                        if($zone['used_fuel_perday']<1){
                                                            echo "0.00";
                                                        }
                                                        elseif($testingId['Testing']['consumed_fuel']>$zone['current_fuel_litre']){
                                                            echo $this->Number->precision(($testingId['Testing']['consumed_fuel'] - $zone['current_fuel_litre']),2);
                                                        }
                                                        else{
                                                            echo $this->Number->precision($zone['used_fuel_perday'],2);
                                                        }
                                                       
                                                    }else{
                                                        if($zone['used_fuel_perday']<1){
                                                            echo "0.00";
                                                        }
                                                        else{
                                                            echo $this->Number->precision($zone['used_fuel_perday'], 2);
                                                        }
                                                    }
                                                    ?>

                                                </td>
                                            </tr><?php

                                        endforeach
                                    ?>
                                </tbody>

                                <!--<tfoot>-->
                                    
                                <!--    <tr bgcolor=#99ddff>-->
                                <!--        <th>#</th>-->
                                <!--        <th>DATE</th>-->
                                <!--        <th>SITE NAME</th>-->
                                <!--        <th class="text-right">USED FUEL PER DAY</th>-->
                                        
                                <!--    </tr>-->
                                <!--</tfoot>-->
                            </table>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>



<?php

    function time_format($time_end, $time_start){
        if(strtotime($time_end)-strtotime($time_start)>180){
            return true;
        }
    }

    function activeDead($time_start){
        $date = new DateTime();
        $date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
        $get_datetimee   = $date->format('d.m.Y H:i:s');
        $start           = strtotime($time_start);
        $systime         = strtotime($get_datetimee);
        $diff            = $systime - $start;
        $hours           = floor($diff / (3600));
        $minutes         = floor(($diff - $hours * 3600)/60);
        $seconds         = floor((($diff - $hours * 3600)-($minutes*60))%60);

        if(strlen($hours)== 1){
            $hours = '0'.$hours; 
        }
        if(strlen($minutes)==1){
            $minutes = '0'.$minutes;
        }
        if(strlen($seconds)==1){
            $seconds = '0'.$seconds;
        }
        $time_duration = $hours.':'.$minutes.':'.$seconds;
        return $time_duration; 
    }
?>






<link href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/base/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/jquery-ui.min.js"></script>


<script>
    
    $(document).ready(function () {
        $('#reservation').daterangepicker({
            timePicker: false,
            timePickerIncrement: 30,
            locale: {
                format: 'DD/MM/YYYY'
            }
        })
        
        $('#timepicker').datetimepicker({
            format: 'LT'
        })
    });
    
</script>

            
<script>
    $(document).ready(function () {
        $('input[id$=start_date]').datepicker({
            dateFormat:     'dd/mm/yy',//check change
            changeMonth:    true,
            changeYear:     true,
            maxDate:        0,
            minDate:        '22/02/2020'
        });
        
        $('input[id$=end_date]').datepicker({
            dateFormat:     'dd/mm/yy',//check change
            changeMonth:    true,
            changeYear:     true,
            maxDate:        0,
            minDate:        '22/02/2020'
        });
    });
</script>
