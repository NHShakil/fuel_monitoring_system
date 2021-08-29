<div class="content-wrapper">
    <section class="content">
       	<div class= "row">
       		<div class="col-md-12" >
       			<div class="bar bar-primary bar-top">
					<span class="report-title pull-left"><i class=" fa fa-spinner fa-spin"></i> Reports</span>	
					<div class="col-md-10 text-right">
				        <?php echo $this->Form->create('Testing',array('url'=>array('controller'=>'testings', 'action'=>'search_bts')), array('class'=>'searchForm','data-role'=>'form')); ?>
				        <?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
				        <?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>
				        <?php echo $this->Form->end(); ?>
				    </div>
				</div>

				<div class="row bar bar-secondary">
					<div class="col-md-12">
						<?php echo $this->Html->link('<i class="fa fa-angle-double-left"></i><span> Back to Dashboard</span>', array('controller'=>'testings','action' => 'dashboard'),array('escape'=>false,'class'=>'btn btn-info')); ?>
					</div>	
				</div>

       			<div class="row bar bar-third">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped" style="width: 100%;">
								<thead>
									<tr class="text-center" bgcolor=#99ddff style="font-size: 12px; font-family: 'Times New Roman', Georgia, Serif;">
										<th>Site Name</th>
									</tr>
								</thead>
								<tbody>
									<?php 
										foreach ($live_status as $zone): ?>
											<tr>
												<td style="padding-left: 20px;font-size: 13px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['Testing']['site_name']); ?>
													
												</td>
											</tr>
											<?php
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

<!-- <!DOCTYPE html>
<html lang="en">
	<head>
  		<title>Bootstrap Example</title>
  		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>

	<body>
		<div class="container">
  			<h2>Modal Example</h2>
  			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModall">Open Modal</button>
  			<div class="modal fade" id="myModall" role="dialog">
    			<div class="modal-dialog">
      				<div class="modal-content">
        				<div class="modal-header">
          					<button type="button" class="close" data-dismiss="modal">&times;</button>
          					<h4 class="modal-title">Modal Header</h4>
        				</div>

				        <div class="modal-body">
				          <p>Some text in the modal.</p>
				        </div>

				        <div class="modal-footer">
				          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        </div>
      				</div>
    			</div>
  			</div>
		</div>
	</body>
</html> -->