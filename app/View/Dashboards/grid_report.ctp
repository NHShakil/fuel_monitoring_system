<?php $this->assign('title', 'Grid_Report');?>
<div class="content-wrapper">
    <section class="content">
       <div class= "row">
    		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
					<h2 class="bar-title col-md-2"><?php echo __('Grid::Data'); ?></h2>
				</div>


				<div class="clearfix report-details">
                <div class="box">
					<table id="example2" class="table table-bordered table-hover">
						<thead>
                            <tr class="text-center" bgcolor=#99ddff>
                            	<td >Site Name</td>
                                <td >Current</td>
                                <td >Voltage</td>
                                <td >Grid_Report</td>

                            </tr>
                        </thead>

                        <?php 
                            //echo $sum[0][0]['ItemSum'];
                            //echo $time_zone[0][0]['time_zonee'];
                        ?>


                        <tbody>
                        	
                        	<?php foreach ($grid_reports as $key => $value): ?>

                        		<?php if (($value['GridReport']['current']>20) and ($value['GridReport']['voltage']>180)) { ?>
                        			<tr class="text-center">                        			
                        				<td> <?php echo $value['GridReport']['site_name']; ?> </td>
                        				<td> <?php echo $value['GridReport']['current']; ?> </td>
                        				<td> <?php echo $value['GridReport']['voltage']; ?> </td>
                        				<td> <?php echo 'Grid On';?> </td>
                        			</tr>                        			
                        		<?php }
                        		else{ ?>
                        			<tr class="text-center">                        			
                        				<td> <?php echo $value['GridReport']['site_name']; ?> </td>
                        				<td> <?php echo $value['GridReport']['current']; ?> </td>
                        				<td> <?php echo $value['GridReport']['voltage']; ?> </td>
                        				<td> <?php echo 'Grid Fail';?> </td>
                        			</tr>
                        		<?php }?>
                        	<?php endforeach ?>                       		
                        </tbody>
                    </table>
                </div>
                </div>
			</div>
		</div>
    </section>
</div>    