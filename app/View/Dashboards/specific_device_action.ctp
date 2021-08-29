<?php $this->assign('title', 'Dashboard');?>
<div class="content-wrapper">
    <section class="content">
        <div class= "row">
    		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
                    <h3 class="bar-title text-center"><?php echo('Environment Control System'); ?></h3>
            	</div>

        		<!-- <div class="row bar bar-secondary">
	        		<div class="col-md-12">
		        		<?php echo $this->Html->link('<i class="fa fa-list"></i><span> Fuel Sensor</span>', array(),array('escape'=>false,'class'=>'btn btn-success')); ?>
		    		</div>
				</div> -->


                <div class="box-header text-center">
                    <h3 class="box-title"> Fuel Monitoring Data</h3>
                </div>
                <div class="clearfix report-details">
                    <div class="box">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr class="text-center" bgcolor=#99ddff>
                                    <td>Site ID</td>
                                    <td>Total Vol.</td>
                                    <td>Remain Fuel</td>
                                    <td>Finish Fuel</td>
                                    <td>Hour Rate</td>
                                    <td>Max Fuel</td>
                                    <td>Min Fuel</td>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                    foreach($fuelsensor as $id=>$val1):?>
                                        <tr class="text-center">
                                            <td><?php echo $val1['FuelSensor']['site_name']; ?> </td>
                                            <td><?php echo $val1['FuelSensor']['total_volume'];?> </td>
                                            <td><?php echo $val1['FuelSensor']['remain_fuel'];?></td>
                                            <td><?php echo $val1['FuelSensor']['finish_fuel'];?></td>
                                            <td><?php echo $val1['FuelSensor']['run_hour'];?></td>
                                    <?php endforeach;?>

                                            <td><?php echo $max_remain_fuel[0][0]['max_valuee']?></td>
                                            <td><?php echo $min_remain_fuel[0][0]['min_valuee']?></td>
                                        </tr>  
                            </tbody>                        
                        </table>
                    </div>
                </div>


				<div class="box-header text-center">
					<h3 class="box-title text-center"> Three Phase Monitoring Data</h3>
				</div>

				<div class="clearfix report-details">
                    <div class="box">
					   <table id="example2" class="table table-bordered table-hover">
						    <thead>
                                <tr class="text-center" bgcolor=#99ddff>
                                    <td colspan="5">Phase 1</td>
                                    <td colspan="5">Phase 2</td>
                                    <td colspan="5">Phase 3</td>
                                </tr>

                                <tr class="text-center" bgcolor=#99ddff>
                                    <?php for ($i=1; $i <=3 ; $i++) { 
                                        echo "<td>voltage";
                                        echo "<td>current";
                                        echo "<td>kwhr";
                                        echo "<td>status";
                                        echo "<td>Pf";
                                    }?>                                
                                </tr>
                            </thead>
                        
                    	    <tbody>
                                <?php 
                                    foreach($threephase as $id=>$val):?>
                        	           <tr class="text-center">
                        		<!-- <td><?php echo $val['ThreePhase']['site_name']; ?></td> -->

                                            <?php 
                                                for ($i=1; $i <= 3; $i++){ ?>

                                                    <!-- <td> <?php echo $val['ThreePhase']['ln'.$i.'_volt']; ?></td> -->
                                                    <td> <?php echo $val['ThreePhase']['ln'.$i.'_volt']; ?></td>
                                                    <td> <?php echo $val['ThreePhase']['ln'.$i.'_current']; ?></td>
                                                    <td> <?php echo $val['ThreePhase']['ln'.$i.'_kwhr']; ?></td>
                                                    <td> <?php echo $val['ThreePhase']['ln'.$i.'_status']; ?></td>
                                                    <td> <?php echo $val['ThreePhase']['ln'.$i.'_pf']; ?></td>
                                                <?php } 
                                            ?>
                        	           </tr>
                                    <?php endforeach;
                                ?>
                            </tbody>
					   </table>
				    </div>
                </div>
                


				<div class="box-header text-center">
					<h3 class="box-title"> DC Cell Battery</h3>
				</div>

                <div class="clearfix report-details">
				    <div class="box">
					    <table id="example2" class="table table-bordered table-hover">
						    <thead>
                                <tr class= "text-center" bgcolor=#99ddff class="auto-margin">
                               <!--  <td rowspan="2">Site ID</td> -->
                                    <td colspan="24" class="text-center">Cell</td>
                                    <td rowspan="2">T.Volt</td>
                                    <td rowspan="2">B.R.H</td>
                                    <td rowspan="2">Current</td>
                                
                                </tr>
                                <tr class="text-center" bgcolor=#99ddff >
                                    <?php for ($i=1; $i <= 24 ; $i++) { 
                                        echo "<td>C".$i;
                                        //echo "<td>C$i</td>";
                                        }
                                    ?>                                
                                </tr>
                            </thead>
                                               
                            <tbody>

                                <?php 
                                    foreach ($cellbattery as $key => $val):?> 
                        	            <tr class="text-center">

                        		            <!-- <td><?php echo $val['CellBattery']['site_name']; ?></td> -->

                                            <?php 
                                                for ($i=1; $i <= 24; $i++){ ?>
                                                    <td> <?php echo $val['CellBattery']['b'.$i]; ?></td>
                                                <?php } 
                                            ?>
                                            <td><?php echo $val['CellBattery']['total_voltage'];?></td><td><?php echo $val['CellBattery']['battery_run_hour']; ?></td>
                                            <td><?php echo $val['CellBattery']['total_current']; ?></td>
                        	            </tr>
                                    <?php endforeach;
                                ?>
                            </tbody>						
					    </table>
				    </div>   				
  			    </div>
            </div>
  		</div>
    </section>
</div>            