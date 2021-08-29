<?php $this->assign('title', 'Dashboard');?>
<div class="content-wrapper">
    <section class="content">

        <!-- <div class="box box-primary"> -->
            <!-- <div class="box-header with-border">
                <h3 class="box-title">Dashboard</h3>
            </div> -->

<div class= "row">
    <div class="col-md-9" >
        <div class="bar bar-primary bar-top">
            <span class="report-title pull-left"><i class=" fa fa-spinner fa-spin"></i>  BTS</span>
           <div class="col-md-11 text-right">
                    <?php echo $this->Form->create('Bts',array('class'=>'searchForm','data-role'=>'form')); ?>
                    <?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
                    <?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
        
                    <?php echo $this->Form->end(); ?>
                </div>
        </div>


    <div class="row bar bar-secondary">
        <div class="col-md-3">
            <?php echo $this->Html->link('<span> Dashboard</span>', array(),array('escape'=>false,'class'=>'btn btn-success')); ?>
        </div>  
    </div>





        <div class="clearfix report-details">
            <div class="row">

                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>BTS Name</td>
                                    <td>Ip Address</td>
                                    <td>Temp (C)</td>
                                    <td>Voltage (V)</td>
                                    <td class="text-center action">Relays</td>
                                    <!-- <td>Relays</td> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($bts_name as $id=>$val): 
                                    $logDetails = json_decode($val['Site']['log_details'],true);           
                                ?>
                                <tr>
                                    <td><?php echo $val['Site']['name']; ?> </td>
                                    <td><?php echo $val['Site']['ip_address']; ?> </td>
                                    <td><?php echo 35; ?> </td>
                                    <td><?php echo (544/17); ?> </td>
                                   <td>
                                        <ul class="list-inline">
                                            <?php
                                                $all_log=array();
                                                $i=0;
                                                foreach($logDetails[2] as $key => $val):

                                                    switch ($i) {
                                                        case '0':
                                                           echo $this->Html->link('Avl', array('action' => 'action',$val),array('escape'=>false,'class'=>'btn btn-info'));
                                                           echo " ";
                                                            break;

                                                        case '1':
                                                           echo $this->Html->link('Gen', array('action' => 'action'),array('escape'=>false,'class'=>'btn btn-success'));
                                                           echo " ";
                                                            break;

                                                        case '2':
                                                           echo $this->Html->link('Ac', array('action' => 'action'),array('escape'=>false,'class'=>'btn btn-warning'));
                                                           echo " ";
                                                            break;

                                                        case '3':
                                                           echo $this->Html->link('Door', array('action' => 'action'),array('escape'=>false,'class'=>'btn btn-info'));
                                                           echo " ";
                                                            break;

                                                        case '4':
                                                           echo $this->Html->link('Ven', array('action' => 'action'),array('escape'=>false,'class'=>'btn btn-success'));
                                                           echo " ";
                                                            break;

                                                        case '5':
                                                           echo $this->Html->link('Fan', array('action' => 'action'),array('escape'=>false,'class'=>'btn btn-warning'));
                                                            break;
                                                        
                                                        default:
                                                            echo 'Invalid Command';
                                                            break;
                                                    }
                                                    $i++;
                                                endforeach;

                                                /*foreach($logDetails[2] as $key => $val):
                                                    if($val == 1){
                                                        //$class= "button-on",'value'=>Avl;
                                                        echo $this->Html->link('Avl', array('action' => 'debug'),array('escape'=>false,'class'=>'btn btn-success'));
                                                        $class = "relay-on";
                                                    }
                                                    else
                                                    {
                                                        echo $this->Html->link('Gen', array('action' => 'debug'),array('escape'=>false,'class'=>'btn btn-success'));
                                                        $class = "relay-off";
                                                    }
                                                    echo "<li class='{$class}'></li>";
                                                endforeach;*/

                                            ?>
                                        </ul>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    

    <div class="col-md-3" >
        <div class="bar bar-primary bar-top">
            <h1 class="report-title"><i class="fa fa-spinner fa-spin"></i> Health Board</h1>
        </div>
        <div class="clearfix report-details">

            <div class="btn btn-success col-4">
                    <?php echo "Active ".$active; ?>
            </div>

            <div class="btn btn-warning col-4">
                    <?php echo "Dead ".$inactive; ?>
            </div>

            <div class="btn btn-danger col-4">
                    <?php echo "Draft ".$draft; ?>
            </div>

        </div>

        <div class="bar bar-primary bar-top">
                <h1 class="report-title"><i class="fa fa-spinner fa-spin"></i> Live Events</h1>
        </div>
        <div class = "clearfix report-details ">
            <div class = "live-event-data terminal">
                Live Event data
            </div>
            <div class = "live-event-command">
                <?php 
                    echo $this->Form->create('Terminal');
                    echo $this->Form->input('command',array('div'=>false, 'label'=>false,'class'=>'col-md-12 command-box'));
                    echo $this->Form->end();
                ?>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <div class="pagination-block">
            <p>
            <?php
            echo $this->Paginator->counter(array(
            'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
            ));
            ?>          </p>
            <div class="pagination">
            <?php
        echo $this->Paginator->prev('< ' . __('previous'),array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
        echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','currentTag'=>'a', 'currentClass'=>'current disabled'));
        echo $this->Paginator->next(__('next') . ' >', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
    ?>
            </div>
        </div>  
    </div>
</div>
</section>
</div>