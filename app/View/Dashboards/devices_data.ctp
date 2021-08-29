<?php $this->assign('title', 'Dashboard');?>
<div class="content-wrapper">
    <section class="content">
        <div class= "row">
            <div class="col-md-12" >
                <div class="bar bar-primary bar-top">
                    <span class="bar-title col-md-4"><i class=" fa fa-spinner fa-spin"></i> Environment System Control</span>
                    <!-- <div class="col-md-8 text-right">
                        <?php echo $this->Form->create('Bts',array('class'=>'searchForm','data-role'=>'form')); ?>
                        <?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
                        <?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>        
                        <?php echo $this->Form->end(); ?>
                    </div> -->
                </div>


                <!-- <div class="row bar bar-secondary">
                    <div class="col-md-3">
                        <?php echo $this->Html->link('<span> Dashboard</span>', array('action'=>'devices_data'),array('escape'=>false,'class'=>'btn btn-success')); ?>
                    </div>  
                </div> -->


                <div class="clearfix report-details">
                <div class="box">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr class="text-center" bgcolor=#99ddff>
                                <th class="text-center"><?php echo $this->Paginator->sort('site_name','Site Name'); ?></th>
                                <td>Remain Fuel</td>
                                <td>Total Voltage</td>
                                <td>Current</td>
                                <td>Line1 KWHr</td>
                                <td>Line2 KWHr</td>
                                <td>Line3 KWHr</td>
                            </tr>
                        </thead>

                        <?php 
                            foreach ($fuelss as $key => $fuell) {
                                //echo $fuell['FuelSensor']['id'];
                                $site_namee = $fuell['FuelSensor']['site_name'];
                                $remain_fuell = $fuell['FuelSensor']['remain_fuel'];
                            }
                        ?>

                        <!-- <?php echo $site_namee; ?>
                        <?php echo $remain_fuell; ?> -->
                        <!-- <?php echo $min_remain_fuel; ?> -->


                        <!-- <?php
                            echo " Without Round=> ".$summ[0][0]['TotalVoltage'];
                            echo ' With Round=> '.round($summ[0][0]['TotalVoltage'], 2);
                            echo " CTG Min Value=>".$min_remain_fuel[0][0]['min_valuee'];
                        ?> -->


                        <!-- Distinct Value of a Site Start -->
                        <?php $n=0;
                            foreach ($fuel_site_name as $key => $value) : ?>
                                <?php $fuel_site_name[$n] = $value['FuelSensor']['site_name'];
                                //$abc =  $value['FuelSensor']['remain_fuel'];
                                $n++;
                            endforeach;
                        ?>

                        <?php $n=0;  ?>
                        <?php foreach ($three_phase_site_name as $key => $value) : ?>
                            <?php $three_phase_site_namee[$n] = $value['ThreePhase']['site_name'];
                            $n++;
                        endforeach?>

                        <?php $n=0;  ?>
                        <?php foreach ($battery_site_name as $key => $value) : ?>
                            <?php $battery_site_name[$n] = $value['CellBattery']['battery_site_name'];
                            $n++;
                        endforeach?>

                        <!-- Distinct Value of a Site End -->



                        <?php $i=0;  ?>
                        <?php                         
                            foreach($fuels as $id=>$fuel): ?>
                                <!-- <?php $site_name[$i] = $fuel['FuelSensor']['site_name']; ?> -->
                                <?php $site_name_fuel[$i] = $fuel['FuelSensor']['site_name']; ?>
                                <?php $remain_fuel[$i] = $fuel['FuelSensor']['remain_fuel']; ?>                            
                                <?php //echo $site_name[$i];                            
                                $i++;                                                              
                            endforeach;
                        ?>                        


                        <?php $j=0; ?>
                        <?php                         
                            foreach($cells as $id=>$cell): ?>
                                <?php $site_name_cell[$j] = $cell['CellBattery']['site_name']; ?>
                                <?php $total_voltage[$j] =  $cell['CellBattery']['total_voltage']; ?>
                                <?php $total_current[$j] =  $cell['CellBattery']['total_current']; ?>
                                <?php $j++; 
                            endforeach;
                        ?>                        
                        

                        <?php $k=0; ?>
                        <?php                         
                            foreach($phases as $id=>$phase): ?>
                                <?php $site_name_phase[$k] = $phase['ThreePhase']['site_name']; ?>
                                <?php $ln1_kwhr[$k] = $phase['ThreePhase']['ln1_kwhr']; ?>
                                <?php $ln2_kwhr[$k] = $phase['ThreePhase']['ln2_kwhr']; ?>
                                <?php $ln3_kwhr[$k] = $phase['ThreePhase']['ln3_kwhr']; ?>
                                <?php $k++;       
                            endforeach;
                        ?>

                        <!-- <?php echo $distinct_site_number; ?>   -->


                        <tbody>
                            <?php 
                                for ($l=0; $l < $distinct_site_number ; $l++) { ?>

                                    <?php

                                        if (($fuel_site_name[$l] == $three_phase_site_namee[$l]) and ($three_phase_site_namee[$l] == $battery_site_name[$l])) { ?>

                                            <tr class="text-center">

                                                <td><?php echo $this->Html->link( $fuel_site_name[$l],   array('action'=>'specific_device_action', $fuel_site_name[$l]),array('escape' => false));?>
                                                </td>
                                               <!--  <td> <?php echo $remain_fuell; ?> </td> -->

                                                <td>
                                                <?php
                                                    if ($fuel_site_name[$l] == $site_namee) {
                                                        echo $remain_fuell;
                                                    }
                                                    else
                                                    {
                                                        echo $remain_fuel[$l+1];
                                                    }
                                                ?>
                                                </td>
                                                <td> <?php echo $total_voltage[$l]; ?> </td>
                                                <td> <?php echo $total_current[$l]; ?> </td>
                                                <td> <?php echo $ln1_kwhr[$l]; ?> </td>
                                                <td> <?php echo $ln2_kwhr[$l]; ?> </td>
                                                <td> <?php echo $ln3_kwhr[$l]; ?> </td>
                                            </tr>
                                        <?php } 
                                    ?> 
                                <?php } 
                            ?>
                        </tbody>                
                    </table>
                </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="pagination-block">
                        <p>
                            <?php
                                echo $this->Paginator->counter(array(
                                'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                            ));?>          
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