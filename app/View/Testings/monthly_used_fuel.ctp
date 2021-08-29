<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="../../AdminLTE/plugins/fullcalendar/main.min.css">
<link rel="stylesheet" href="../../AdminLTE/plugins/fullcalendar-daygrid/main.min.css">
<link rel="stylesheet" href="../../AdminLTE/plugins/fullcalendar-timegrid/main.min.css">
<link rel="stylesheet" href="../../AdminLTE/plugins/fullcalendar-bootstrap/main.min.css">
<link rel="stylesheet" href="../../AdminLTE/plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="../../AdminLTE/dist/css/adminlte.min.css">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script src="../../AdminLTE/plugins/moment/moment.min.js"></script>
<script src="../../AdminLTE/plugins/fullcalendar/main.min.js"></script>
<script src="../../AdminLTE/plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="../../AdminLTE/plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="../../AdminLTE/plugins/fullcalendar-interaction/main.min.js"></script>
<script src="../../AdminLTE/plugins/fullcalendar-bootstrap/main.min.js"></script>


<?php

    $previous_six_months         = array();
    
    $previous_six_months_only    = array();

    $previous_six_months[]       = date('F, y');
    
    $previous_six_months_only[]  = date('F');

    $dateTime = new DateTime('first day of this month');
    
    for ($i = 1; $i <= 6; $i++) {
        $dateTime->modify('-1 month');

        $previous_six_months[]      = $dateTime->format('F, y');

        $previous_six_months_only[] = $dateTime->format('F');;
    }
   
    $monthName = $previous_six_months;

?>



<?php

    $fuelConsumed = array_values($monthly_used_fuels);

    //pr($fuelConsumed);
    
    for ($i=count($fuelConsumed);$i<6; $i++) {
        $fuelConsumed[$i] = 0;
    }
    


?>

<div class="container-fluid" style="visibility: hidden;">
    <div class="row">
        Noman
    </div>
</div>
<div class="container-fluid ">
 <div class="row">
    <?php
    for ($month=0; $month <= 5 ; $month++) {?>

        <div class="col-sm-2" style="height: 5%">

            <div class="small-box bg-info" >
                <div class="inner">
                    <h4><?php echo substr($monthName[$month],0,3).' '.substr($monthName[$month],-2);?></h4>

                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">
                            <?php
                            
                                $fuel_data = 0;
                                
                                foreach ($fuelConsumed as $key => $fuelData) {
                                    
                                    if($previous_six_months_only[$month] == $fuelData['month']){
                                    
                                        if($fuelData['total_used_fuel_per_month']=='' || $fuelData['total_used_fuel_per_month']<1){
                                            $fuel_data = "0.00 ";
                                        }
                                        else{
                                            $fuel_data = number_format($fuelData['total_used_fuel_per_month'],2);
                                        }
                                        
                                        break;
                                        
                                    }
                                    else{
                                        $fuel_data = "0 ";
                                    }
                                }
                                
                                echo $fuel_data;
                                
                                
                            ?> Ltr
                        </span>
                    </p>
                </div>
                
                
                <?php 
                
                    $phrase  = $monthName[$month];
                    $healthy = [",", " "];
                    $yummy   = ["-", ""];
                    $newPhrase = str_replace($healthy, $yummy, $phrase);
                    //print_r($newPhrase);
                ?>
                
                

                <a href="<?php echo $this->base;?>/testings/daily_used_fuel/<?php echo $id.'/'.$newPhrase?>" class="small-box-footer">Daily Used Detail<i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div><?php
        }
        ?>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="sticky-top mb-3">
                <div class="card">
                    <!-- <div class="card-header">
                        <h4 class="card-title">Draggable Events</h4>
                    </div> -->

                    <!-- <div class="card-body"> -->
                        <div id="external-events">
                            <!-- <div class="external-event bg-success">Lunch</div>
                            <div class="external-event bg-warning">Go home</div>
                            <div class="external-event bg-info">Do homework</div>
                            <div class="external-event bg-primary">Work on UI design</div>
                            <div class="external-event bg-danger">Sleep tight</div>
                            <div class="checkbox">
                              <label for="drop-remove">
                                <input type="checkbox" id="drop-remove">
                                remove after drop
                            </label> -->
                        </div>
                        <!-- </div> -->
                    </div>
                </div>


            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-12">
            <div class="card card-primary table-responsive no-padding">
                <div class="card-body p-0">
                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->


<script>
    $(document).ready(function(){

        /* initialize the external events
        -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function () {
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }
                
                $(this).data('eventObject', eventObject)

            })
        }

        ini_events($('#external-events div.external-event'))

        /* initialize the calendar
        -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d    = date.getDate(),
        m        = date.getMonth(),
        y        = date.getFullYear()

        var Calendar = FullCalendar.Calendar;

        var calendarEl = document.getElementById('calendar');


        var calendarData =[];

        $.ajax({
            async   : false,
            type: 'get',
            url: '<?php echo $this->Html->url(array('action' => 'ajaxRequest',$id)); ?>',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            },
            success: function(response) {
                
                var jsonUsedFuelData = jQuery.parseJSON(response);

                for (var i = 0; i < jsonUsedFuelData.length; i++) {
                    
                    dateTimeData = (jsonUsedFuelData[i].start.split(","));
                    
                    dateTime = new Date(
                        
                        dateTimeData[0],dateTimeData[1]-1,dateTimeData[2],"00","00","00"
                        
                    );
                    
                    calendarData.push({
                        title           : '\xa0\xa0\xa0\xa0'+jsonUsedFuelData[i].title,
                        start           : dateTime,
                        backgroundColor : '#8bf043', //red
                        borderColor     : '#f56954', //red
                        allDay          : true
                    });
                }
            },
            error: function(e) {
                alert("An error occurred: " + e.responseText.message);
                console.log(e);
            }
        });
        
        //console.log(calendarData[0]);

        var calendar = new Calendar(calendarEl, {
            plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
            header    : {
                left  : 'prev,next today',
                center: 'title',
                right : 'dayGridMonth'
            },

            events    : calendarData,
            editable  : false,
            droppable : true, // this allows things to be dropped onto the calendar !!!
            drop      : function(info) {
                
                if (checkbox.checked) {
                    
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                    
                }
            }    
        });

        calendar.render();
        
    })
</script>