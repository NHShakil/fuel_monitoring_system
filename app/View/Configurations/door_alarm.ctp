<?php $this->assign('title', 'Door Open By');?>
<div class="content-wrapper">
    <section class="content">
       	<div class= "row">
       		<div class="col-md-12" >
       			<div class="bar bar-primary bar-top">
       				<h2 class="bar-title col-md-4"><?php echo __('Reports :: Door Open By'); ?></h2>
       			</div>
       			<div class="row bar bar-third">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr class="text-center" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">
									<th>Site Name</th>
									<th>Device ID</th>
									<th>User PC IP</th>
									<th>Door Open User</th>
									<th>Door Open BY</th>
									<th class="text-center action-th" style="width: 12%;">Time</th>
								</tr>
							</thead>

							<tbody>

								<?php 
									foreach ($readerDataa as $zone):?>
										<tr>
											<td style="font-size: 12px; padding-top: 14px;">
												<span><?php echo $zone['DoorStatus']['site_name'];?></span>
											</td>
											<td style="font-size: 12px; padding-top: 14px;">
												<span><?php echo $zone['DoorStatus']['SiteModuleId'];?></span>
											</td>
											<td style="font-size: 12px; padding-top: 14px;">
												<span><?php echo $zone['DoorStatus']['user_pc_ip'];?></span>
											</td>
											<td style="padding-left: 20px;">
												<?php echo $zone['DoorStatus']['door_open_user'];?>	
											</td>
											<td style="padding-left: 20px;">
												<?php echo $zone['DoorStatus']['door_open_by'];?>	
											</td>
											<td style="padding-left: 20px;">
												<?php echo $zone['DoorStatus']['door_open_time'];?>	
											</td>
										</tr> <?php 
									endforeach; 
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