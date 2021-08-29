<style type="text/css">
	li:first-child input[type='radio']{
    -webkit-appearance:none;
    width:15px;
    height:15px;
    border:3px solid #6a706d;
    border-radius:50%;
    outline:none;
    margin: 0 13px -3px 0;
    /*box-shadow:0 0 5px 0px #6a706d inset;*/
    }
    li:first-child input[type='radio']:before {
        content:'';
        display:block;
        width:60%;
        height:60%;
        margin: 20% auto;    
        border-radius:50%;    
    }
    li:first-child input[type='radio']:checked:before {
        background:#6a706d;
    }
    li:nth-child(2) input[type='radio'] {
    -webkit-appearance:none;
    width:15px;
    height:15px;
    border:3px solid #f1d04d;
    border-radius:50%;
    outline:none;
     margin: 0 13px -3px 0;
    }

    li:nth-child(2) input[type='radio']:before {
        content:'';
        display:block;
        width:60%;
        height:60%;
        margin: 20% auto;    
        border-radius:50%;    
    }
    li:nth-child(2) input[type='radio']:checked:before{
        background:#f1d04d;
    }

    li:nth-child(3) input[type='radio'] {
    -webkit-appearance:none;
    width:15px;
    height:15px;
    border:3px solid #caaf40;
    border-radius:50%;
    outline:none;
    /*box-shadow:0 0 5px 0px #caaf40 inset;*/
    margin: 0 13px -3px 0;
    }

    li:nth-child(3) input[type='radio']:before {
        content:'';
        display:block;
        width:60%;
        height:60%;
        margin: 20% auto;    
        border-radius:50%;    
    }
    li:nth-child(3) input[type='radio']:checked:before{
        background:#caaf40;
    }

    li:nth-child(4) input[type='radio'] {
    -webkit-appearance:none;
    width:15px;
    height:15px;
    border:3px solid #92d04f;
    border-radius:50%;
    outline:none;
    /*box-shadow:0 0 5px 0px #92d04f inset;*/
    margin: 0 13px -3px 0;
    }

    li:nth-child(4) input[type='radio']:before {
        content:'';
        display:block;
        width:60%;
        height:60%;
        margin: 20% auto;    
        border-radius:50%;    
    }
    li:nth-child(4) input[type='radio']:checked:before{
        background:#92d04f;
    }

    li:nth-child(5) input[type='radio'] {
    -webkit-appearance:none;
    width:15px;
    height:15px;
    border:3px solid #7aaf42;
    border-radius:50%;
    outline:none;
    /*box-shadow:0 0 5px 0px #7aaf42 inset;*/
    margin: 0 13px -3px 0;
    }
    li:nth-child(5) input[type='radio']:hover {
        box-shadow:0 0 5px 0px #7aaf42 inset;
    }
    li:nth-child(5) input[type='radio']:before {
        content:'';
        display:block;
        width:60%;
        height:60%;
        margin: 20% auto;    
        border-radius:50%;    
    }
    li:nth-child(5) input[type='radio']:checked:before{
        background:#7aaf42;
    }    

    li:nth-child(6) input[type='radio'] {
    -webkit-appearance:none;
    width:15px;
    height:15px;
    border:3px solid #ed5850;
    border-radius:50%;
    outline:none;
    /*box-shadow:0 0 5px 0px #b70218 inset;*/
    margin: 0 13px -3px 0;
    }

    li:nth-child(6) input[type='radio']:before {
        content:'';
        display:block;
        width:60%;
        height:60%;
        margin: 20% auto;    
        border-radius:50%;    
    }
    li:nth-child(6) input[type='radio']:checked:before{
        background:#ed5850;
    }

    li:nth-child(7) input[type='radio'] {
    -webkit-appearance:none;
    width:15px;
    height:15px;
    border:3px solid #b70218;
    border-radius:50%;
    outline:none;
    /*box-shadow:0 0 5px 0px #b70218 inset;*/
    margin: 0 13px -3px 0;
    }
    li:nth-child(7) input[type='radio']:before {
        content:'';
        display:block;
        width:60%;
        height:60%;
        margin: 20% auto;    
        border-radius:50%;    
    }
    li:nth-child(7) input[type='radio']:checked:before{
        background:#b70218;
    }
</style>

<?php $this->assign('title', 'Log Download');?>
<div class="content-wrapper">
    <section class="content">
       <div class= "row">
    		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
        			<h2 class="bar-title col-md-4"><?php echo __('Log :: Download All Sites'); ?></h2>
        		</div>
        		<div class="row bar bar-third">
        			<div class="col-md-12" >
						<div class="table-responsive">
							<table class="table table-striped" style="width: 100%; font-size: 12px; font-family: 'Cambria', Georgia, Serif;">
								<thead>
									<tr bgcolor=#99ddff>
										<th class="text-center" rowspan="2"><?php echo $this->Paginator->sort('site_name'); ?></th>
										<th class="text-center action-th" colspan="14"><?php echo ('Log Value'); ?></th>
										<th class="text-center" rowspan="2"><?php echo ('Log Download'); ?></th>
									</tr>
									<tr bgcolor=#99ddff>
										<td> Site Name</td>
										<td> Signal</td>
										<td> Voltage</td>
										<td> Door Open By</td>
										<td> Door Status </td>
										<td> Reader</td>
										<td> Al 1</td>
										<td> Al 2</td>
										<td> Al 3</td>
										<td> Al 4</td>
										<td> RL 1</td>
										<td> RL 2</td>
										<td> Time</td>
										<td> Format</td>
									</tr>
								</thead>

								<tbody>
									<?php 
										$j=0;
                                        foreach ($zones as $key => $zone) {
											$site_namee = $zone['Testing']['SiteModuleId'];
											
											if($zone['Testing']['status'] == '1'){?>
												<tr class="success" style="height: 47px;">
													<td class="text-center" style="margin-top: 10px;"><?php echo h($zone['Testing']['site_name']); ?>
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
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+2; ?>" value="<?php echo $j+2;?>" name="signal_strenght">
										                        <label for="inlineCheckbox<?php echo $j+2;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-primary">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+3; ?>" value="<?php echo $j+3;?>" name="voltage">
										                        <label for="inlineCheckbox<?php echo $j+3;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-info">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+4; ?>" value="<?php echo $j+4;?>" name="door_open_by">
										                        <label for="inlineCheckbox<?php echo $j+4;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-warning">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+5; ?>" value="<?php echo $j+5;?>" name="door_status">
										                        <label for="inlineCheckbox<?php echo $j+5;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-danger">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+6; ?>" value="<?php echo $j+6;?>" name="card_reader">
										                        <label for="inlineCheckbox<?php echo $j+6;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+7; ?>" value="<?php echo $j+7;?>" name="alarm_1">
										                        <label for="inlineCheckbox<?php echo $j+7;?>"></label>
										                    </div>
														</td>
														<td>
										                    <div class="checkbox checkbox-inline checkbox-primary">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+8;?>" value="<?php echo $j+8;?>" name="alarm_2">
										                        <label for="inlineCheckbox<?php echo $j+8;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-info">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+9;?>" value="<?php echo $j+9;?>" name="alarm_3">
										                        <label for="inlineCheckbox<?php echo $j+9;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-warning">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+10;?>" value="<?php echo $j+10;?>" name="alarm_4">
										                        <label for="inlineCheckbox<?php echo $j+10;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-danger">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+11;?>" value="<?php echo $j+11;?>" name="alarm_5">
										                        <label for="inlineCheckbox<?php echo $j+11;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+12;?>" value="<?php echo $j+12;?>" name="alarm_6">
										                        <label for="inlineCheckbox<?php echo $j+12;?>"></label>
										                    </div>
										                </td>

										                <td>
										                    <div class="checkbox checkbox-inline checkbox-warning">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+13;?>" value="<?php echo $j+13;?>" name="modified" disabled="disabled" checked="checked">
										                        <label for="inlineCheckbox<?php echo $j+13;?>"></label>
										                    </div>

															<input type="hidden" id="inlineCheckbox<?php echo $j+13;?>" name="modified" value="<?php echo $j+13;?>" />
														</td>
														
										                <td style="padding-top:15px;">
															<div class="btn-group dropdown" id="todos">
													            <button class="btn btn-info btn-xs dropdown-toggle botn-todos" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">XLS
													            <span class="caret caret-posicion"></span>
													            </button>
													            <ul class="dropdown-menu ancho-todos" aria-labelledby="dropdownMenu1">
													              	<li><a href="#"><input type="radio" id="busqueda1" value="<?php echo $j+14;?>" name="xls"  class="todoss"><span>XLS</span></a></li>
													              	<li><a href="#"><input type="radio" id="busqueda2" value="<?php echo $j+14;?>" name="csv" class="enc">CSV</a></li>
													              	<li><a href="#"><input type="radio" id="busqueda3" value="<?php echo $j+14;?>" name="pdf" class="enca">PDF</a></li>
													            </ul>
													        </div>
										                </td>

														<td>
										                    <?php 
										                    	echo $this->Form->button('<i class="fa fa-cloud-download" aria-hidden="true"></i><span> Download</span>',array('type'=>'submit','class'=>'btn btn-info btn-xs btn-left-margin','label'=>false,'div'=>false, 'style'=>'margin-left: 20px;'));
										                    ?>
										                </td>
													<?php echo $this->Form->end(); ?>
                                                </tr>
                                                <?php
                                            }
                                            else{ ?>
                                            	<tr class="danger" style="height: 47px;">
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
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+2; ?>" value="<?php echo $j+2;?>" name="signal_strenght">
										                        <label for="inlineCheckbox<?php echo $j+2;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-primary">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+3; ?>" value="<?php echo $j+3;?>" name="voltage">
										                        <label for="inlineCheckbox<?php echo $j+3;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-info">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+4; ?>" value="<?php echo $j+4;?>" name="door_open_by">
										                        <label for="inlineCheckbox<?php echo $j+4;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-warning">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+5; ?>" value="<?php echo $j+5;?>" name="door_status">
										                        <label for="inlineCheckbox<?php echo $j+5;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-danger">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+6; ?>" value="<?php echo $j+6;?>" name="card_reader">
										                        <label for="inlineCheckbox<?php echo $j+6;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+7; ?>" value="<?php echo $j+7;?>" name="alarm_1">
										                        <label for="inlineCheckbox<?php echo $j+7;?>"></label>
										                    </div>
														</td>
														<td>
										                    <div class="checkbox checkbox-inline checkbox-primary">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+8;?>" value="<?php echo $j+8;?>" name="alarm_2">
										                        <label for="inlineCheckbox<?php echo $j+8;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-info">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+9;?>" value="<?php echo $j+9;?>" name="alarm_3">
										                        <label for="inlineCheckbox<?php echo $j+9;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-warning">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+10;?>" value="<?php echo $j+10;?>" name="alarm_4">
										                        <label for="inlineCheckbox<?php echo $j+10;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-danger">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+11;?>" value="<?php echo $j+11;?>" name="alarm_5">
										                        <label for="inlineCheckbox<?php echo $j+11;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+12;?>" value="<?php echo $j+12;?>" name="alarm_6">
										                        <label for="inlineCheckbox<?php echo $j+12;?>"></label>
										                    </div>
										                </td>
										                <td>
										                    <div class="checkbox checkbox-inline checkbox-warning">
										                        <input type="checkbox" id="inlineCheckbox<?php echo $j+13;?>" value="<?php echo $j+13;?>" name="modified" disabled="disabled" checked="checked">
										                        <label for="inlineCheckbox<?php echo $j+13;?>"></label>
										                    </div>

															<input type="hidden" id="inlineCheckbox<?php echo $j+13;?>" name="modified" value="<?php echo $j+13;?>" />
														</td>
														<td style="padding-top:15px;">
															<div class="btn-group dropdown" id="todos">
													            <button class="btn btn-info btn-xs dropdown-toggle botn-todos" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">XLS
													            <span class="caret caret-posicion"></span>
													            </button>
													            <ul class="dropdown-menu ancho-todos" aria-labelledby="dropdownMenu1">
													              	<li><a href="#"><input type="radio" id="busqueda1" value="<?php echo $j+14;?>" name="xls"  class="todoss"><span>XLS</span></a></li>
													              	<li><a href="#"><input type="radio" id="busqueda2" value="<?php echo $j+14;?>" name="csv" class="enc">CSV</a></li>
													              	<li><a href="#"><input type="radio" id="busqueda3" value="<?php echo $j+14;?>" name="pdf" class="enca">PDF</a></li>
													            </ul>
													        </div>
										                </td>
														<td>
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

<!-- <script type="text/javascript">
	var options = [];
	$('.dropdown-menu a').on( 'click', function( event ) {
	   	var $target = $(event.currentTarget),
	    val = $target.attr('data-value'),
	    $inp = $target.find('input'),
	    idx;
	   	if(( idx = options.indexOf( val )) > -1) {
	      	options.splice( idx, 1 );
	      	setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
	   	}else {
	      	options.push( val );
	      	setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
	   	}
	   	$( event.target ).blur();  
	   	console.log( options );
	   	return false;
	});
</script> -->

<script type="text/javascript">
	$('.dropdown-menu').on( 'click', 'a', function() {
        var text = $(this).html();
        //alert(text);
        var htmlText = text + ' <span class="caret caret-posicion"></span>';
        $(this).closest('.dropdown').find('.dropdown-toggle').html(htmlText);
    });
</script>


