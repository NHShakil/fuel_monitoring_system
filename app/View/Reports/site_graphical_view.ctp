<style type="text/css">
	#chartdiv {
		width		: 100%;
		height		: 500px;
		font-size	: 11px;
	}
</style>
<?php $this->assign('title', 'Chart Live Site');?>
<div class="content-wrapper">
    <section class="content">
       <div class= "row">
       		<div class="col-md-12" >
        		<div class="bar bar-primary bar-top">
        			<h2 class="bar-title col-md-4"><?php echo __('Reports :: Live/Dead/Draft Site Status Graph'); ?></h2>
        		</div>
        	</div>

       		<div class="col-md-12" >
       			<div class="bar bar-secondary">
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-info">
						      	<div class="panel-heading"> Site Communication Status</div>
						      	<div class="panel-body">
						      		<div id="container_1" style="width: 100%; height: 400px; margin: 0 auto"></div>
						      	</div>
						    </div>
       					</div>
       				</div>
       			</div>
       		</div>
       	</div>
    </section>
</div>

<script type="text/javascript">
	Highcharts.chart('container_1', {
	    chart: {
	        type: 'column'
	    },
	    title: {
	        text: 'Site Communication Status'
	    },
	    xAxis: {
	        categories: [
	            'Status'
	        ],
	        crosshair: false
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Site Number'
	        }
	    },
	    credits : {
			href : "http://www.massiveelectronicsbd.com",
			text : "Massive Electronics"
		},
	    tooltip: {
	        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
	        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
	            '<td style="padding:0"><b>{point.y}</b></td></tr>',
	        footerFormat: '</table>',
	        shared: true,
	        useHTML: true
	    },
	    plotOptions: {
	        column: {
	            pointPadding: 0.2,
	            borderWidth: 0
	        }
	    },
	    series: [
		    {
		        name: 'Live',
		        data: [
		        	<?php echo  $active;?>
		        ]

		    }, 
		    {
		        name: 'Dead', 
		        data: [<?php echo $inactive;?>]

		    },
		    {
		        name: 'Draft', 
		        data: [<?php echo $draft;?>]

		    }
	    ]
	});
</script>