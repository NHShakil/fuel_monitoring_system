<style type="text/css">
	.form_hieght{
		height: 32px;
	}
	.form_width{
		width: 140px;
		height: 32px;
		margin-bottom: 10px;
		border-radius: 5px;
	}

    #rpt_container{
        margin:0 auto;
        padding:0;
        width:100%;
        height: auto;
        /*border:1px solid #CCC;*/
        background-color:#FAFAE7;
    }
    #selection_tab{
        width:20%;
        height:auto;
        float: left;
        margin-right:5%;
    }
    #report_page{
        width:100%;
        height:auto;
        float: left;
        background-color: #ffffff;
        /*background:url(../images/banner.jpg) no-repeat;*/
        margin-left:0;
        margin-bottom:2px;
        /*border:1px solid black;*/
        /*        border-radius:4px 4px 0px 0px;*/
    }
    #report_head{
        width:100%;
        height:90px;
        float: left;
        padding-top: 2%;
        /*        background-color: lightgoldenrodyellow;*/
        /*        border: 1px solid black;*/
    }
    #report_head_title{
        width:100%;
        height:25px;
        text-align: center;
        float: left;
        /*        background-color: lightsteelblue;*/
    }
    #report_head_field{
        width:15%;
        height:100%;
        margin-left:3%;
        float: left;
        /*        background-color: lightgoldenrodyellow;*/
        /*        border:1px solid blue;*/
    }
    #report_head_value{
        width:15%;
        height:100%;
        float: left;
        /*        background-color: lightgoldenrodyellow;*/
    }
    #report_head_gape{
        width:32%;
        height:100%;
        float: left;
        /*        background-color: lightgoldenrodyellow;*/
    }
    #report_head_part4{
        width:25%;
        height:100%;
        float: left;
        /*        background-color: lightgoldenrodyellow;*/
    }
    #report_data{
        width:100%;
        height:100%;
        float: left;
        margin-left:1%;
        /*        padding: 2%;*/
        /*        background-color: lightcyan;*/
    }
    #logo{
        width:80px;
        height:200px;
        margin-top:-15px;
        margin-left:388px;
        float:left;
        /*background:url(../images/gramweb.png) no-repeat;*/
    }
    .table_data {
        border-collapse: collapse;
    }
    
    .data_title {
        width:80px;
        /*padding: 1%;*/
        background-color: lightcyan;
        text-align: center;
        font-weight: bold;
        /*border: 1px solid black;*/
    }  
    .data {
        width:80px;
        /*        padding: 1%;*/
        text-align: center;
        /*border: 1px solid black;*/
    } 
    #report_fotter{
        width:100%;
        height:60px;
        float: left;
        padding: 1%;
        background-color: lightcyan;
        /*        background-color: lightgoldenrodyellow;*/
        /*        border: 1px solid black;*/
    }
    #footer_icon{
        width:50px;
        height:50px;
        float: left;
        padding: 2px;
    }
    #footer_textbox{
        width:80px;
        height:50px;
        float: left;
        padding: 2px;
        text-align: center;
    }
</style>

<script type="text/javascript">
	function getSubZone(val) {
		$.ajax({
			type: "POST",
			url: "get_subzone",
			data:'id='+val,
			success: function(data){
				$("#sub-zone-name").html(data);
			},
            error: function(xhr,textStatus,error){
                //alert(error);
            }
		});

		$.ajax({
			type: "POST",
			url: "get_site",
			data:'id='+val,
			success: function(data){
				$("#site-name").html(data);
			},
            error: function(xhr,textStatus,error){
                //alert(error);
            }
		});
	}

	function getSubZoneid(val) {
		$.ajax({
			type: "POST",
			url: "get_parent_zone",
			data:'id='+val,
			success: function(data){
				$("#sub-zone-name").html(data);
			},
            error: function(xhr,textStatus,error){
                //alert(error);
            }
		});

		$.ajax({
			type: "POST",
			url: "get_site",
			data:'id='+val,
			success: function(data){
				$("#site-name").html(data);
			},
            error: function(xhr,textStatus,error){
                //alert(error);
            }
		});
	}

	function selectSite(val){
		$.ajax({
			type: "POST",
			url: "select_site_value",
			data:'SiteModuleId='+val,
			success: function(data){
				console.log(data);
				$("#selectedd-site").html(data);
			},
            error: function(xhr,textStatus,error){
                alert(error);
            }
		});

		$.ajax({
			type: "POST",
			url: "card_number",
			data:'SiteModuleId='+val,
			success: function(data){
				console.log(data);
				$("#card-number").html(data);
			},
            error: function(xhr,textStatus,error){
                alert(error);
            }
		});
	}

	function showMsg(){
		var zone_name      = $('#zone-name').val();
		var sub_zone_name  = $('#sub-zone-name').val();
		var site_name      = $('#site-name').val();
		var start_time     = $('#start-time').val();
		var end_time       = $('#end-time').val();
		var card_number    = $('#card-number').val();
		var user_type      = $('#user-type').val();
		var open_by        = $('#open-by').val();

		/*$.ajax({
			type: "POST",
			url: "get_site",
			data:'id='+val,
			success: function(data){
				$("#sub-zone-name").html(data);
			},
            error: function(xhr,textStatus,error){
                alert(textStatus);
            }
		});*/



		$("#msgZone").html($("#zone-name option:selected").text());
		$("#msgSubZone").html($("#sub-zone-name option:selected").text());
		$("#msgSite").html($("#site-name option:selected").text());
		$("#msgStartTime").html($('#start-time').val());
		$("#msgEndTime").html($('#end-time').val());
		$("#msgCardNumnber").html($("#card-number option:selected").text());
		$("#msgUserType").html($("#user-type option:selected").text());
		$("#msgOpenedBy").html($("#open-by option:selected").text());
		return false;
	}
</script>


<?php $this->assign('title', 'Voltage/Signal Graph');?>
<div class="content-wrapper">
    <section class="content">
       <div class= "row">
    		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
        			<h2 class="bar-title col-md-4"><?php echo __('Voltage/Signal Graph'); ?></h2>
        		</div>
        	</div>

        	<div class="bar bar-third">
    			<div class="col-md-12">
					<div class="row">
				      	<div class="col-sm-4">
				      		<div class="panel panel-info">
            					<div class="panel-heading"><b> Selection Tab</b> </div>
            					<div class="panel-body">
            						<?php echo $this->Form->create(false,array('class'=>'form-horizontal')); ?> 
            						<div class="form_hieght">
					    				<label class="col-sm-6 control-label"> Select Zone </label>
					    				<div class="col-md-6">
											<select name="zone-name" id="zone-name" class="form_width"  onchange="getSubZone(this.value);">
												<option value="">Select Zone</option>
												<?php
												    foreach ($zones as $key => $value) {?>
												        <option value="<?php echo $value["Zone"]["id"];?>"><?php echo $value['Zone']['name'];?></option>
												        <?php 
												    }
												?>
											</select>
										</div>
				    				</div>

				    				<div class="form_hieght">
					    				<label class="col-sm-6 control-label"> Select Sub Zone</label>
					    				<div class="col-md-6">
											<select id="sub-zone-name" name="sub-zone-name" class="form_width"  onchange="getSubZoneid(this.value);">
												<option value="">Select Subzone</option>
											</select>
										</div>
				    				</div>

				    				<div class="form_hieght">
					    				<label class="col-sm-6 control-label"> Select Site </label>
					    				<div class="col-md-6">
					    					<select id="site-name" name="site-name" class="form_width" onchange="selectSite(this.value);" required>
						    					<option value="">Select Site</option>
													<?php
													    foreach ($sites as $key => $value) {?>
													        <option value="<?php echo $value["Site"]["SiteModuleId"];?>"><?php echo $value['Site']['site_name'];?></option>
													        <?php 
													    }
													?>
											</select>
										</div>
				    				</div>

				    				<div class="form_hieght">
			                            <label class="col-sm-6 control-label"> Signal/Voltage Lebel</label>
			                            <div class="col-md-6" id="open-by" name="open-by">
			                                <?php echo $this->Form->input('status_level', array('options'=>$status_level,'class'=>'form_width','div'=>false,'label'=>false,'required'=>true));?>
			                            </div>
			                        </div>

				    				<div class="form-group" style="padding-top: 20px;">
										<div class="col-sm-offset-4 col-md-3">
											<?php echo $this->Form->button('<i class="fa fa-refresh"></i><span> Reset </span>',array('type'=>'reset', 'class'=>'btn btn-warning btn-sm','label'=>false,'div'=>false));?>
										</div>
					
										<div class="col-md-4">
											<?php echo $this->Form->button('<i class="fa fa-search"></i><span> Search </span>',array('type'=>'submit','class'=>'btn btn-info btn-sm btn-left-margin','label'=>false,'div'=>false));?>
										</div>
									</div>
            					</div>
          					</div>
				      	</div>

				      	

				      	<div class="col-sm-8">
				      		<div class="col-md-12">
				      			<div class="panel panel-info">
	            					<div class="panel-heading"><b> Voltage / Signal Graph Presentation</b></div>
	            					<div class="panel-body">
								        <div class="rpt_container">
								      		<div id="container" style="min-width: 510px; height: 400px; margin: 0 auto;"></div>
								      		<?php
									      		//pr($voltage_flag_ini);
									      		//pr($voltage_flag);
									      		/*$dataTable        = array();
												$timeInMilisecond = array();
												foreach ($datas as $key => $row) {
													if($row["TestingLogDevice"]["modified"]!=''){
														$dateTime           = $row["TestingLogDevice"]["modified"];
														$timeInMilisecond[] = "'$dateTime',";
														$dataTable[]        = "{$row['TestingLogDevice']['voltage']},";
							            			}	
												}
												pr($timeInMilisecond);
												pr($dataTable);*/
									      	?>
								      		    <script type="text/javascript">
													<?php 
														if($voltage_flag==true){
															$table_field  = 'voltage';
															$Graph_field  = 'Voltage';
														}
														elseif($signal_strenght_flag==true){
															$table_field  = 'signal_strenght';
															$Graph_field  = 'Signal Lebel';
														}
														elseif($voltage_flag_ini == true){
															$table_field  = 'voltage';
															$Graph_field  = 'Voltage';
														}
														
														$dataTable        = array();
														$timeInMilisecond = array();
														foreach ($datas as $key => $row) {
															if($row["TestingLogDevice"]["modified"]!=''){
																$dateTime           = $row["TestingLogDevice"]["modified"];
																$timeInMilisecond[] = "'$dateTime',";
																$dataTable[]        = "{$row['TestingLogDevice'][$table_field]},";
									            			}	
														}
													?>
													$.getJSON('https://cdn.rawgit.com/highcharts/highcharts/057b672172ccc6c08fe7dbb27fc17ebca3f5b770/samples/data/usdeur.json',
													    function () {
													        Highcharts.chart('container', {
													            chart: {
													                zoomType: 'x'
													            },
													            title: {
													                text: 'Time vs <?php echo $Graph_field;?>'
													            },
													            subtitle: {
													                text: document.ontouchstart === undefined ? 'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
													            },
													            xAxis: {
													                categories: [
													                	<?php echo join($timeInMilisecond); ?>
													                ]
													            },
													            yAxis: {
													                title: {
													                    text: '<?php echo $Graph_field;?>'
													                }
													            },
													            legend: {
													                enabled: true
													            },
													            credits : {
													        		href : "http://www.massiveelectronicsbd.com",
													        		text : "Massive Electronics"
													      		},
													            plotOptions: {
													                area: {
													                    fillColor: {
													                        linearGradient: {
													                            x1: 0,
													                            y1: 0,
													                            x2: 0,
													                            y2: 1
													                        },
													                        stops: [
													                            [0, Highcharts.getOptions().colors[0]],
													                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
													                        ]
													                    },
													                    marker: {
													                        radius: 2
													                    },
													                    lineWidth: 1,
													                    states: {
													                        hover: {
													                            lineWidth: 1
													                        }
													                    },
													                    threshold: null
													                }
													            },

													            series: [{
													                type: 'area',
													                name: '<?php echo $Graph_field;?>',
													                data: [
													                	<?php echo join($dataTable); ?>
													                ]
													            }]
													        });
													    }
													);	
												</script>
							            	</div>
							            </div>
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