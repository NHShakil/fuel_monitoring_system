<style>
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
        height:80px;
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
    .form_hieght{
      height: 32px;
    }
    .form_width{
      width: 140px;
      height: 32px;
      margin-bottom: 10px;
      border-radius: 5px;
    }
</style>
<script>
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


<?php $this->assign('title', 'Users Site Access Log Report');?>
<div class="content-wrapper">
    <section class="content">
       <div class= "row">
        <div class="col-md-12" >
            <div class="bar bar-primary bar-top">
              <h2 class="bar-title col-md-4"><?php echo __('Reports :: Users Site Access Log Report'); ?></h2>
            </div>
          </div>
          
          <div class="bar bar-third">
          <div class="col-md-12">
          <div class="row">
                <div class="col-sm-4">
                  <div class="panel panel-info">
                      <div class="panel-heading"> Selection Tab </div>
                      <div class="panel-body">
                        <?php echo $this->Form->create(false,array('class'=>'form-horizontal')); ?> 
                        

                    <div class="form_hieght">
                      <label class="col-sm-6 control-label"> Login User </label>
                      <div class="col-md-6">
                        <select id="user-type" name="user-type" class="form_width">
                          <option value="">User Type</option>
                          <?php
                              foreach ($users as $key => $value) {?>
                                  <option value="<?php echo $value["User"]["username"];?>"><?php echo $value['User']['username'];?></option>
                                  <?php 
                              }
                          ?>
                        </select>
                      </div>
                    </div>

                    <div class="form_hieght">
                        <label class="col-sm-6 control-label">Opened By</label>
                        <div class="col-md-6" id="open-by" name="open-by">
                            <?php echo $this->Form->input('door_open_by', array('options' =>$door_open_type,'class'=>'form_width','div'=>false,'label'=>false ));?>
                        </div>
                    </div>


                    <div class="form-group" style="padding-top: 20px;">
                    <div class="col-sm-offset-1 col-md-3">
                      <?php echo $this->Form->button('<i class="fa fa-refresh"></i><span> Reset </span>',array('type'=>'reset', 'class'=>'btn btn-warning btn-sm','label'=>false,'div'=>false));?>
                    </div>
          
                    <div class="col-md-4">
                      <!-- <?php echo $this->Form->button('Search',array('type'=>'submit','class'=>'btn btn-info btn-sm btn-left-margin','label'=>false,'div'=>false,'onclick'=>'return showMsg()'));?> -->

                      <?php echo $this->Form->button('<i class="fa fa-search"></i><span> Search </span>',array('type'=>'submit','class'=>'btn btn-info btn-sm btn-left-margin','label'=>false,'div'=>false));?>
                    </div>

                    <div class="col-md-4">
                      <?php 
                        echo $this->Html->link('<i class="fa fa-download"></i><span> Download </span>', array('controller'=>'reports','action' => 'report_download'),array('escape'=>false,'class'=>'btn btn-info btn-sm'));
                      ?>
                    </div>
                  </div>
                      </div>
                    </div>
                </div>

                <div class="col-sm-8">
                  <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading"> Site Access Report </div>
                        <div class="panel-body">   
                        <!-- Selected Zone:         <span id="msgZone"></span><br>
                    Selected Sub Zone:      <span id="msgSubZone"></span><br>
                    Selected Site:          <span id="msgSite"></span><br>
                    Selected StartTime:     <span id="msgStartTime"></span><br>
                    Selected EndTime:       <span id="msgEndTime"></span><br>
                    Selected CardNumber:    <span id="msgCardNumnber"></span><br>
                    Selected UserType:      <span id="msgUserType"></span><br>
                    Selected OpenedBy:      <span id="msgOpenedBy"></span><br> -->

                        <div class="rpt_container">
                            <div id = "report_page">
                                <div id = "report_head">
                                    <div id = "report_head_field">
                                        <table>
                                            <tr>
                                                <td>
                                                    <b>User Name</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>Open By</b>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b></b>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div id = "report_head_value">
                                        <table>
                                            <tr>
                                                <td>: </td>
                                                <td>
                                                  <?php 
                                                    if($user_type!=null){
                                                      echo $user_type;
                                                    }
                                                  ?>
                                                  
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>: </td>
                                                <td>
                                                  <?php
                                                    if($open_by!=null){
                                                      echo $open_by;
                                                    }
                                                  ?>  
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div id = "report_head_gape">
                                    </div>
                                    <div id = "report_head_field">
                                        <table>
                                            <tr>
                                                <td>
                                                    <b>Report Date</b>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div id = "report_head_value">
                                        <table>
                                            <tr>
                                                <td>: </td>
                                                <td>
                                                  <?php 
                                                    $date = new DateTime();
                                                    $date->setTimeZone(new DateTimeZone("Asia/Dhaka"));
                                                    $get_datetime     = $date->format('d-m-Y'); 
                                                    echo $get_datetime;
                                                  ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div id = "report_data">
                                  <table class="table table-striped">
                            <thead>
                              <tr class="text-center" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">
                                <th>SL NO</th>
                                <th>Site Name</th>
                                <th>User Name</th>
                                <th>Access Type</th>
                                <th>Access Time and Date</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                if(count($door_status_data)>0){
                                  if($user_report_flag  == true){
                                    foreach ($door_status_data as $key => $zone):?>
                                      <tr class="">
                                        <td style="font-size: 13px;">
                                          <span>
                                            <?php 
                                              echo $key+1;
                                            ?>  
                                          </span>
                                        </td>
                                        <td style="font-size: 13px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['site_name']);?></td>
                                        <td style="font-size: 13px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['door_open_user']);?></td>
                                        <td style="font-size: 13px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['door_open_by']);?></td>
                                        <td style="font-size: 13px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['door_open_time']); ?></td>
                                      </tr><?php
                                    endforeach;
                                  }
                                  else{
                                    foreach ($door_status_data as $key => $zone):?>
                                      <tr class="">
                                        <td style="font-size: 13px;">
                                          <span>
                                            <?php 
                                              echo $key+1;
                                            ?>  
                                          </span>
                                        </td>
                                        <td style="font-size: 13px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['site_name']);?></td>
                                        <td style="font-size: 13px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['door_open_user']);?></td>
                                        <td style="font-size: 13px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['door_open_by']);?></td>
                                        <td style="font-size: 13px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['DoorStatus']['door_open_time']); ?></td>
                                      </tr><?php
                                    endforeach;
                                  }
                                } 
                              ?>
                            </tbody>
                          </table>
                          <!-- <div class="row">
                            <div class="col-md-12">
                              <div class="pagination-block">
                                <p>
                                  <?php
                                    echo $this->Paginator->counter(array(
                                    'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                                  ));
                                  ?>      
                                </p>
                                <div class="pagination">
                                  <?php
                                    echo $this->Paginator->prev('< ' . __('previous'),array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
                                    echo $this->Paginator->numbers(array('separator' => '','tag'=>'li','currentTag'=>'a', 'currentClass'=>'current disabled'));
                                    echo $this->Paginator->next(__('next') . ' >', array('tag'=>'li','disabledTag'=>'a'), null, array('class' => 'prev disabled','tag'=>'li','disabledTag'=>'a'));
                                  ?>
                                </div>
                              </div>  
                            </div>
                          </div> -->
                        </div>
                              <!-- <div id = "report_data" >
                                  <table class="table_data">
                                      <tr>
                                          <td class = "data_title">Title</td>
                                          <td class = "data_title">Title</td>
                                          <td class = "data_title">Title</td>
                                          <td class = "data_title">Title</td>
                                          <td class = "data_title">Title</td>
                                          <td class = "data_title">Title</td>
                                          <td class = "data_title">Title</td>
                                          <td class = "data_title">Title</td>
                                          <td class = "data_title">Title</td>
                                          <td class = "data_title">Title</td>
                                      </tr>
                                          <?php
                                          for ($x = 0; $x <= 20; $x++) {
                                              echo "<tr>";
                                              echo "<td class = 'data'>Value</td>";
                                              echo "<td class = 'data'>Value</td>";
                                              echo "<td class = 'data'>Value</td>";
                                              echo "<td class = 'data'>Value</td>";
                                              echo "<td class = 'data'>Value</td>";
                                              echo "<td class = 'data'>Value</td>";
                                              echo "<td class = 'data'>Value</td>";
                                              echo "<td class = 'data'>Value</td>";
                                              echo "<td class = 'data'>Value</td>";
                                              echo "<td class = 'data'>Value</td>";
                                              echo "</tr>";
                                          } 
                                              ?>   
                                  </table>   
                              </div>
                                <div id = "report_footer">
                                    <div id = "footer_textbox" style="margin-left:3%">
                                        Page:
                                        <input type="text" name="current_page" size="1" value="1">
                                    </div>
                                    <div id = "footer_textbox">
                                        OF
                                        <input type="text" name="total_page" size="1" value="23">
                                    </div>
                                    <div id = "footer_icon">
                                        <?php 
                                        echo $this->Html->image('First.png', ['width'=>'30']); 
                                        ?>
                                    </div>
                                    <div id = "footer_icon">
                                        <?php 
                                        echo $this->Html->image('Previous.png', ['width'=>'30']); 
                                        ?>
                                    </div>
                                    <div id = "footer_icon">
                                        <?php 
                                        echo $this->Html->image('Next.png', ['width'=>'30']); 
                                        ?>
                                    </div>
                                    <div id = "footer_icon">
                                        <?php 
                                        echo $this->Html->image('Last.png', ['width'=>'30']); 
                                        ?>
                                    </div>
                                </div> -->
                                <!--  -->

                                <!-- <div id = "report_footer">
                                    <div id = "footer_textbox" style="margin-left:3%">
                                        Page:
                                        <input type="text" name="current_page" size="1" value="1">
                                    </div>
                                    <div id = "footer_textbox">
                                        OF
                                        <input type="text" name="total_page" size="1" value="23">
                                    </div>
                                    <div id = "footer_icon">
                                        <?php 
                                        echo $this->Html->image('First.png', ['width'=>'30']); 
                                        ?>
                                    </div>
                                    <div id = "footer_icon">
                                        <?php 
                                        echo $this->Html->image('Previous.png', ['width'=>'30']); 
                                        ?>
                                    </div>
                                    <div id = "footer_icon">
                                        <?php 
                                        echo $this->Html->image('Next.png', ['width'=>'30']); 
                                        ?>
                                    </div>
                                    <div id = "footer_icon">
                                        <?php 
                                        echo $this->Html->image('Last.png', ['width'=>'30']); 
                                        ?>
                                    </div>
                                </div> -->
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

<script>
    $(document).ready(function() {
        $('#date_time').attr('disabled','disabled'); 
        $('#start_time').attr('disabled','disabled');
        $('#expire_time').attr('disabled','disabled');
        $('select[name="Noman"]').on('change',function(){
            var  others = $(this).val();
            if(others != "0"){           
                $('#date_time').removeAttr('disabled');
                $('#start_time').removeAttr('disabled');
                $('#expire_time').removeAttr('disabled');
            }
            else
            {
                $('#date_time').attr('disabled','disabled'); 
                $('#start_time').attr('disabled','disabled');
                $('#expire_time').attr('disabled','disabled');
            }  
        });
    });
</script>