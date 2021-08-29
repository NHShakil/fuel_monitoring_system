<?php $this->assign('title', 'Get:: Data');?>
<div class="content-wrapper">
    <section class="content">
       <div class= "row">
    		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
					<h2 class="bar-title col-md-2"><?php echo __('IpRelay::Data'); ?></h2>
				</div>

				<div class="row bar bar-secondary">
                    <div class="col-md-3">
                        <?php echo $this->Html->link('<i class="fa fa-bar" aria-hidden="true"></i><span> All Value IpRelay</span>', array('action'=>'get_all_data'),array('escape'=>false,'class'=>'btn btn-success')); ?>
                    </div>  
                </div>

                <div class="box">
					<table id="example2" class="table table-bordered table-hover">
						<thead>     
                            <tr class="text-center" bgcolor=#99ddff>                  
                                <td rowspan="2">Auto ID</td>
                                <td rowspan="2">IP_Address</td>
                                <td rowspan="2">EEE</td>
                                <td rowspan="2">Temp</td>
                                <td rowspan="2">Current</td>
                                <td rowspan="2">HHH</td>
                                <td rowspan="2">Volt</td>
                                <td rowspan="2">Sum</td> 
                            </tr>
                        </thead>


                        <?php 
                            foreach ($recent_data_all as $key => $value):?>            
                        <tbody>
                        	<tr class="text-center">
                                <td><?php echo $value['IpRelay']['id']; ?></td>
                        		<td><?php echo $value['IpRelay']['a'].'.'.$value['IpRelay']['b'].'.'.$value['IpRelay']['c'].'.'.$value['IpRelay']['d']; ?></td>

                                <td><?php echo $value['IpRelay']['e']; ?></td>
                                <td><?php echo $value['IpRelay']['f']; ?></td>
                                <td><?php echo $value['IpRelay']['g']; ?></td>
                                <td><?php echo $value['IpRelay']['h']; ?></td>
                                <td><?php echo $value['IpRelay']['volt']; ?></td>
                                <td><?php echo $value['IpRelay']['j']; ?></td>
                                <?php endforeach;?>
                        	</tr>                        	                        	
                        </tbody>
					</table>
				</div>
			</div>
		</div>    
    </section>
</div>