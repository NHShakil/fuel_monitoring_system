<div class="content-wrapper">
    <section class="content">
    	<div class= "row">
    		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
					<h2 class="bar-title col-md-2"><?php echo __('IpRelay::Data'); ?></h2>
				</div>

                <div class="clearfix report-details">
				    <div class="box">
					   <table id="example2" class="table table-bordered table-hover">
						  <thead>
                                <tr class="text-center" bgcolor=#99ddff>  
                                    <td rowspan="2">ID</td>
                                    <td rowspan="2">Temp</td>
                                    <td rowspan="2">Time</td>
                                    <td rowspan="2">Status</td>
                                    <td rowspan="2">Duration</td>
                                </tr>
                            </thead>


                            <?php 
                        	   $i=0;
                        	   foreach ($time_add as $key => $value_add) {
                        		  $array_status[$i] = $value_add['AddTime']['status'];
                        		  $array_time[$i] = ($value_add['AddTime']['time_column']);
                        		  $i++;
                        	    }
                            ?>

                            <?php

                        	   /*$time1 = new DateTime('09:00:59');
							    $time2 = new DateTime('12:05:20');
							    $interval = $time1->diff($time2);
							    echo $interval->format('%h hour(s)'.'%i minute(s)'.'%s second(s)');
							    echo "<br>";

							    $timee = "06:58:00";
							    $timeee = "00:40:00";
							    $secs = strtotime($timeee)-strtotime("00:00:00");
							    $result1 = date("H:i:s",strtotime($timee)-$secs);
							    echo $result1;
							
							    $date1 = "2009-03-26";
							    $date2 = "2009-06-26";
							    $diff = abs(strtotime($date2) - strtotime($date1));
							    $years = floor($diff / (365*60*60*24));
							    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
							    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
							    printf("%d years, %d months, %d days\n", $years, $months, $days);*/

							    $high_hours=0;
							    $high_min=0;
							    $high_sec =0;
							    $low_hours=0;
							    $low_min=0;
							    $low_sec =0;

                        	    for ($j=0; $j < $i-1;) {
                        		    if((($array_status[$j] =='low') and ($array_status[$j+1]=='low')) ||(($array_status[$j] =='low') and ($array_status[$j+1]=='high'))){

                        			    $timee_low = $array_time[$j+1];
									    $timeee_low = $array_time[$j];
									    $diff = abs(strtotime($timee_low) - strtotime($timeee_low));
                                        $duration[$j] = date("H:i:s",$diff).'=>Low';
									    $low_hours =($low_hours + floor($diff / (60*60)));
									    $low_min = abs($low_min + floor(($diff - $low_hours*60*60)/(60)));
                        		    }
                        		    else{

                        			    $timee_high = $array_time[$j+1];
									    $timeee_high = $array_time[$j];
									    $diff = abs(strtotime($timee_high) - strtotime($timeee_high));
                                        $duration[$j] = date("H:i:s",$diff).'=>High';
									    $high_hours = ($high_hours + floor($diff / (60*60)));
									    $high_min = abs($high_min + (($diff - floor($high_hours*60*60))/(60)));
                        		    }
                        		    $j++;
                        	    }
                        	//echo $low_value->format('%h hour(s)'.'%i minute(s)'.'%s second(s)');
                        	//echo $high_value->format('%h hour(s)'.'%i minute(s)'.'%s second(s)');
                            ?>
                
                            <?php $j=0;
                                foreach ($time_add as $key => $value):?>
                                         
                        		    <tbody>
                        			    <tr class="text-center">
                        				    <td><?php echo $value['AddTime']['id']; ?></td>
                                            <td><?php echo($value['AddTime']['temp']);?></td>
                        				    <td><?php echo $value['AddTime']['time_column']; ?></td>
                        				    <td><?php echo $value['AddTime']['status']; ?></td>
                                            <td>
                                                <?php 
                                                    if($i == $j+1){
                                                        echo 'null';
                                                    }
                                                    else{
                                                        echo $duration[$j];
                                                    }
                                                ?>    
                                            </td>
                                        <?php  $j++; ?> 
                                	<?php endforeach;?>
                        		</tr>                        	                        	
                        	</tbody>
						</table>
					</div>
                </div>
			</div>
		</div>
    </section>
</div>    
