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
                        <?php echo $this->Html->link('<i class="fa fa-bed" aria-hidden="true"></i><span> View FUll Data</span>', array('action'=>'index'),array('escape'=>false,'class'=>'btn btn-success')); ?>
                    </div>  
                </div>

                <div class="box">
					<table id="example2" class="table table-bordered table-hover">
						<thead>
                            <tr class="text-center" bgcolor=#99ddff>
                                <th class="text-center"><?php echo $this->Paginator->sort('id','Auto ID'); ?></th>
                                <td rowspan="2">IP_Address</td>
                                <td rowspan="2">Temp</td>
                                <td rowspan="2">Volt</td>
                            </tr>

                        </thead>
                
                        <?php 
                            foreach ($fixed_data as $key => $value):?>            
                        <tbody>
                        	<tr class="text-center">
                                <td><?php echo $this->Html->link( $value['IpRelay']['id'],
                                array('action'=>'get_recent_data_specific', $value['IpRelay']['id']),
                                array('escape' => false));?>
                                </td>
                        		<td><?php echo $value['IpRelay']['a'].'.'.$value['IpRelay']['b'].'.'.$value['IpRelay']['c'].'.'.$value['IpRelay']['d']; ?></td>

                        		<td><?php echo $value['IpRelay']['f']; ?></td>
                        		<td><?php echo $value['IpRelay']['volt']; ?></td>  
                                <?php endforeach;?>
                        	</tr>                        	                        	
                        </tbody>
					</table>
				</div>
			</div>
		</div>    
    </section>
</div>