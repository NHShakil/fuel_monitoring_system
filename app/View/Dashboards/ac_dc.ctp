<?php $this->assign('title', 'Ac_DC_Value');?>
<div class="content-wrapper">
    <section class="content">
       <div class= "row">
    		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
					<h2 class="bar-title col-md-3"><?php echo __('Ac Energy::Dc Energy'); ?></h2>
				</div>
                <!-- <div class="box-header text-center">
                    <h3 class="box-title"> Energy </h3>
                </div> -->

                <div class="clearfix report-details">
                    <div class="box">
                        <table id="example2" class="table table-bordered table-hover ">
                            <thead>
                                <tr class="text-center" bgcolor=#99ddff>
                                    <td rowspan="2">Site ID</td>
                                    <td colspan="3">Dc Energy</td>
                                    <td colspan="1">Ac Energy</td>
                                    <td rowspan="2">Time</td>
                                </tr>

                                <tr class="text-center" bgcolor=#cccccc>
                                    <td>Energy(KWH)</td>
                                    <td>Voltage(V)</td>
                                    <td>Current(I)</td>
                                    <td>Energy(KWH)</td>                    
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    foreach ($ac_dc_valuee as $key => $value):?>
                                        <tr class="text-center">
                                            <td><?php echo $value['AcDc']['site_id'];?> </td>   
                                            <td><?php echo $value['AcDc']['data_1'];?> </td>
                                            <td><?php echo $value['AcDc']['data_2'];?> </td>
                                            <td><?php echo $value['AcDc']['data_3'];?> </td>
                                            <td><?php echo $value['AcDc']['data_4'];?> </td>
                                            <td><?php echo $value['AcDc']['time'];?> </td>
                                        </tr>
                                    <?php endforeach;?>  
                            </tbody>                        
                        </table>
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
                                ?>          
                            </p>
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
			</div>
		</div>
    </section>
</div>
   