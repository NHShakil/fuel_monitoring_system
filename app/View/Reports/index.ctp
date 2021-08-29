<style type="text/css">
	.padding_value{
		padding-top: 10px;
	}
</style>

<?php $this->assign('title', 'Reports');?>
<div class="content-wrapper">
    <section class="content">
       <div class= "row">
    		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
        			<h2 class="bar-title col-md-5"><?php echo __('Reports :: Dynamic Report Architecture for Download'); ?></h2>
        		</div>
        		<div class="row bar bar-third">
        			<div class="col-md-12" >
						<div class="table-responsive">
							<table class="table table-striped" style="width: 100%; font-size: 12px; font-family: 'Cambria', Georgia, Serif;">
								<thead>
									<tr bgcolor=#99ddff>
										<th class="text-center" rowspan="2"><?php echo $this->Paginator->sort('site_name'); ?></th>
										<th class="text-center action-th" colspan="14"><?php echo ('Log Value'); ?></th>
										<th class="text-center" rowspan="2"><?php echo ('Download'); ?></th>
									</tr>
									<tr bgcolor=#99ddff>
										<td> Site Name</td>
										<td> Live </td>
										<td> Signal</td>
										<td> Voltage</td>
										<td> Door Open By</td>
										<td> Door Status </td>
										<td> Reader Fail</td>
										<td> Al 1</td>
										<td> Al 2</td>
										<td> Al 3</td>
										<td> Al 4</td>
										<td> RL 1</td>
										<td> RL 2</td>
										<td> Time</td>
									</tr>
								</thead>

								<tbody>
									<?php 
										$j=0;
                                        foreach ($zones as $key => $zone) {
											$site_namee = $zone['Testing']['SiteModuleId'];
											
											if($zone['Testing']['status'] == '1'){?>
												<tr class="success">
													<td class="text-center"><?php echo h($zone['Testing']['site_name']); ?>
                                                    </td>
                                                    <?php echo $this->Form->create('Reports',array('action' =>'create_report'));?>
                                                    	<td>
                                                    		<div class="checkbox checkbox-inline checkbox-info">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+1;?>" value="<?php echo $site_namee;?>" name="SiteModuleId" disabled="disabled" checked="checked">
										                        <label for="inlineCheckbox<?php echo $j+1;?>"></label>
										                    </div>

															<input type="hidden" id="inlineCheckbox<?php echo $j+1;?>" name="SiteModuleId" value="<?php echo $site_namee; ?>" /> 
														</td>
														<td>
										                    <div class="checkbox checkbox-inline">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+2; ?>" value="<?php echo $j+2;?>" name="status">
										                        <label for="inlineCheckbox<?php echo $j+2;?>"></label>
										                    </div>
										                </td>
														<td>
										                    <div class="checkbox checkbox-inline">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+3; ?>" value="<?php echo $j+3;?>" name="signal_strenght">
										                        <label for="inlineCheckbox<?php echo $j+3;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-primary">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+4; ?>" value="<?php echo $j+4;?>" name="voltage">
										                        <label for="inlineCheckbox<?php echo $j+4;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-info">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+5; ?>" value="<?php echo $j+5;?>" name="door_open_by">
										                        <label for="inlineCheckbox<?php echo $j+5;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-warning">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+6; ?>" value="<?php echo $j+6;?>" name="door_status">
										                        <label for="inlineCheckbox<?php echo $j+6;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-danger">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+7; ?>" value="<?php echo $j+7;?>" name="card_reader">
										                        <label for="inlineCheckbox<?php echo $j+7;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+8; ?>" value="<?php echo $j+8;?>" name="alarm_1">
										                        <label for="inlineCheckbox<?php echo $j+8;?>"></label>
										                    </div>
														</td>
														<td>
										                    <div class="checkbox checkbox-inline checkbox-primary">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+9;?>" value="<?php echo $j+9;?>" name="alarm_2">
										                        <label for="inlineCheckbox<?php echo $j+9;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-info">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+10;?>" value="<?php echo $j+10;?>" name="alarm_3">
										                        <label for="inlineCheckbox<?php echo $j+10;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-warning">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+11;?>" value="<?php echo $j+11;?>" name="alarm_4">
										                        <label for="inlineCheckbox<?php echo $j+11;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-danger">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+12;?>" value="<?php echo $j+12;?>" name="alarm_5">
										                        <label for="inlineCheckbox<?php echo $j+12;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+13;?>" value="<?php echo $j+13;?>" name="alarm_6">
										                        <label for="inlineCheckbox<?php echo $j+13;?>"></label>
										                    </div>
										                </td>

										                <td>
										                    <div class="checkbox checkbox-inline checkbox-warning">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+14;?>" value="<?php echo $j+14;?>" name="modified" disabled="disabled" checked="checked">
										                        <label for="inlineCheckbox<?php echo $j+14;?>"></label>
										                    </div>

															<input type="hidden" id="inlineCheckbox<?php echo $j+14;?>" name="modified" value="<?php echo $j+14;?>" />
														</td>
														<td class="text-center">
										                    <?php 
										                    	echo $this->Form->button('<i class="fa fa-cloud-download" aria-hidden="true"></i><span> Download</span>',array('type'=>'submit','class'=>'btn btn-info btn-xs btn-left-margin','label'=>false,'div'=>false, 'style'=>'margin-left: 20px;'));
										                    ?>
										                </td>
													<?php echo $this->Form->end(); ?>
                                                </tr>
                                                <?php
                                            }
                                            else{ ?>
                                            	<tr class="danger">
													<td class="text-center"><?php echo h($zone['Testing']['site_name']); ?>
                                                    </td>
                                                    
                                                    <?php echo $this->Form->create('Reports',array('action' =>'create_report'));?>
                                                    	<td>
                                                    		<div class="checkbox checkbox-inline checkbox-info">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+1;?>" value="<?php echo $zone['Testing']['SiteModuleId'];?>" name="SiteModuleId" disabled="disabled" checked="checked">
										                        <label for="inlineCheckbox<?php echo $j+1;?>"></label>
										                    </div>

															<input type="hidden" id="inlineCheckbox<?php echo $j+1;?>" name="SiteModuleId" value="<?php echo $zone['Testing']['SiteModuleId'];?>" /> 
                            							</td>
                            							<td>
										                    <div class="checkbox checkbox-inline">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+2; ?>" value="<?php echo $j+2;?>" name="status">
										                        <label for="inlineCheckbox<?php echo $j+2;?>"></label>
										                    </div>
										                </td>
                            							<td>
										                    <div class="checkbox checkbox-inline">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+3; ?>" value="<?php echo $j+3;?>" name="signal_strenght">
										                        <label for="inlineCheckbox<?php echo $j+3;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-primary">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+4; ?>" value="<?php echo $j+4;?>" name="voltage">
										                        <label for="inlineCheckbox<?php echo $j+4;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-info">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+5; ?>" value="<?php echo $j+5;?>" name="door_open_by">
										                        <label for="inlineCheckbox<?php echo $j+5;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-warning">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+6; ?>" value="<?php echo $j+6;?>" name="door_status">
										                        <label for="inlineCheckbox<?php echo $j+6;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-danger">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+7; ?>" value="<?php echo $j+7;?>" name="card_reader">
										                        <label for="inlineCheckbox<?php echo $j+7;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+8; ?>" value="<?php echo $j+8;?>" name="alarm_1">
										                        <label for="inlineCheckbox<?php echo $j+8;?>"></label>
										                    </div>
														</td>
														<td>
										                    <div class="checkbox checkbox-inline checkbox-primary">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+9;?>" value="<?php echo $j+9;?>" name="alarm_2">
										                        <label for="inlineCheckbox<?php echo $j+9;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-info">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+10;?>" value="<?php echo $j+10;?>" name="alarm_3">
										                        <label for="inlineCheckbox<?php echo $j+10;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-warning">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+11;?>" value="<?php echo $j+11;?>" name="alarm_4">
										                        <label for="inlineCheckbox<?php echo $j+11;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-danger">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+12;?>" value="<?php echo $j+12;?>" name="alarm_5">
										                        <label for="inlineCheckbox<?php echo $j+12;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+13;?>" value="<?php echo $j+13;?>" name="alarm_6">
										                        <label for="inlineCheckbox<?php echo $j+13;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-warning">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+14;?>" value="<?php echo $j+14;?>" name="modified" disabled="disabled" checked="checked">
										                        <label for="inlineCheckbox<?php echo $j+14;?>"></label>
										                    </div>

															<input type="hidden" id="inlineCheckbox<?php echo $j+14;?>" name="modified" value="<?php echo $j+14;?>" />
														</td>
														<td class="text-center">
										                	<?php echo $this->Form->button('<i class="fa fa-cloud-download" aria-hidden="true"></i><span> Download</span>',array('type'=>'submit','class'=>'btn btn-info btn-xs btn-left-margin','label'=>false,'div'=>false, 'style'=>'margin-left: 20px;'));?>
										                </td>
													<?php echo $this->Form->end(); ?>
                                                </tr><?php
                                            }
                                        $j=$j+17; 
                                        }
                                    ?>
                                </tbody>
							</table>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="pagination-block" style="height: 5px;">
									<p>
										<?php
											echo $this->Paginator->counter(array(
											'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
										));
										?>			
									</p>
									<div class="pagination" style="height: 5px;">
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
			</div>
		</div>
	</section>
</div>


