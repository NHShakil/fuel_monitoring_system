
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr bgcolor=#99ddff class="text-left" bgcolor=#99ddff style="font-size: 15px; font-family: 'Times New Roman', Georgia, Serif;">
			<th>DREDGER NAME</th>
			<th>LAST UPDATE TIME</th>
			<th class="text-left">LIVE</th>
			<th class="text-center">GMS SIGNAL</th>
			<th class="text-right">RECEIVED FUEL</th>
		</tr>
	</thead>
	
	<tbody>
		<?php 
			foreach ($zones as $zone):
				if($zone['Testing']['status']==1){ ?>
					<tr class="success">
						<td class="font-size-text">
							<?php 
								echo $this->Html->link( $zone['Testing']['site_name'], array('action'=>'fixed_device', $zone['Testing']['id']),array('escape' => false,'class'=>'font-size-text'));
							?>
						</td>
						<td class="font-size-text"><?php echo h($zone['Testing']['full_date_time']);?></td>
						<td >
							<ul class="list-inline text-center" style="margin-top: 8px;">
								<?php 
									if($zone['Testing']['status']==1){

										$class= "site-active";
										
										echo $this->Html->link("<li class='{$class}'></li>", array('controller'=>'testings','action'=>'dead_list', $zone['Testing']['id']),array('escape' => false));	

									}
								?>
							</ul>
						</td>

						<td class="font-size-text text-center"><?php echo h($zone['Testing']['signal_strenght']);?></td>
						<td class="font-size-text text-right">
							<?php 
								echo $this->Html->link(number_format($zone['Testing']['consumed_fuel'],2), array('controller'=>'testings', 'action'=>'monthly_used_fuel', $zone['Testing']['id']),array('escape' => false));
								
							?>
						</td>
					</tr>
					<?php
				}
				elseif($zone['Testing']['status']==0){ ?>
					<tr class="danger">
						<td class="font-size-text">
							<?php 
								echo $this->Html->link( $zone['Testing']['site_name'], array('action'=>'fixed_device', $zone['Testing']['id']),array('escape' => false));
							?>
						</td>
						<td class="font-size-text"><?php echo h($zone['Testing']['full_date_time']);?></td>
						<td class="font-size-text">
							<ul class="list-inline" style="margin-top: 8px;">
								<?php 
									if($zone['Testing']['status']==0){

										$class= "site-dead";
										
										echo $this->Html->link("<li class='{$class}'></li>", array('controller'=>'testings','action'=>'dead_list', $zone['Testing']['id']),array('escape' => false));	

									}
								?>
							</ul>
						</td>

						<td class="font-size-text text-center"><?php echo h($zone['Testing']['signal_strenght']);?></td>
						<td class="font-size-text text-right">
							<?php 
								echo $this->Html->link( number_format($zone['Testing']['consumed_fuel'],2), array('controller'=>'testings', 'action'=>'monthly_used_fuel', $zone['Testing']['id']),array('escape' => false));
								
							?>
						</td>
					</tr>

				<?php }
			endforeach 
		?>
	<tbody>
	<!--<tfoot>-->
	<!--	<tr bgcolor=#99ddff class="text-left" bgcolor=#99ddff style="font-size: 15px; font-family: 'Times New Roman', Georgia, Serif;">-->
	<!--		<th>DREDGER NAME</th>-->
	<!--		<th>LAST UPDATE TIME</th>-->
	<!--		<th class="text-left">LIVE</th>-->
	<!--		<th class="text-center">GMS SIGNAL</th>-->
	<!--		<th class="text-right">RECEIVED FUEL</th>-->
	<!--	</tr>-->
	<!--</tfoot>-->
</table>
