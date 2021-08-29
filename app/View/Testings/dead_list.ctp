<style>

	th, td {
		border: 1px solid azure ;
		white-space: nowrap;
	}
	.list-inline {
		display: flex;
		justify-content: center;
	}

	div.dataTables_wrapper {
	    width: auto;
	    margin: 0 auto;
	}

</style>

<?php
	$date = new DateTime();
    $date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
    $get_datetimefull = $date->format('d-m-Y H:i:s');
?>

<?php $this->assign('title', 'Dead List');?>
<div class= "row">
    <div class="col-md-12" >
        <div class="bar bar-primary bar-top">
            <h2 class="bar-title col-md-2"><?php echo __('Dead List of a Site'); ?></h2>

        </div>

        <div class="row bar bar-secondary">
            <div class="col-md-12">
                <?php echo $this->Html->link('<i class="fa fa-angle-double-left"></i><span> Back To Dashboard</span>', array('controller'=>'testings','action' => 'dashboard'),array('escape'=>false,'class'=>'btn btn-info')); ?>
            </div>  
        </div>


        <div class="clearfix report-details">
            <div class="box table-responsive">
                <table class="table table-bordered table-hover">
					<thead>
						<tr bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;" class="text-left">										
							<th>Site_Id</th>
							<th>Dead Time</th>
							<th>Live Time</th>
							<th>Dead Duration</th>
						</tr>
					</thead>

					<tbody>
						<?php 
							foreach ($datas as $zone): 
								if($zone['DeadList']['active_one']==1){ ?>
									<tr class="success" style="font-family: 'Cambria', Georgia, Serif;">
										<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DeadList']['site_name']); ?>
										</td>

										<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DeadList']['start_time']); ?>
										</td>

										<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DeadList']['time_duration']); ?>
										</td>

										<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo activeDead($zone['DeadList']['start_time']); ?>
											
										</td>	
									</tr><?php

								}
								elseif(time_format($zone['DeadList']['end_time'],$zone['DeadList']['start_time'])==true){ ?>
									<tr class="success" style="font-family: 'Cambria', Georgia, Serif;">
										<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DeadList']['site_name']); ?>
										</td>

										<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DeadList']['start_time']); ?>
										</td>

										<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DeadList']['end_time']); ?>
										</td>

										<td style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DeadList']['time_duration']); ?>
											
										</td>	
									</tr><?php 
								}
							endforeach; 
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>




<?php
	function time_format($time_end, $time_start)
	{
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