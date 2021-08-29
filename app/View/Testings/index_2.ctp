<?php $this->assign('title', 'Operation :: Index');?>
<div class="content-wrapper">
    <section class="content">
		<div class="row">

			<div class="col-md-12">
				<div class="bar bar-primary bar-top">
                    <h2 class="bar-title col-md-4"><?php echo ('BTS-Device :: Operation Panel');?></h2>
                    <div class="col-md-8 text-right">
                        <?php 
                        	echo $this->Form->create('Testing',array('url'=>array('controller'=>'operations', 'action'=>'search_bts')), array('class'=>'searchForm','data-role'=>'form'));
                        	echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));
							echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));
							echo $this->Form->end();
						?>
                    </div>
                </div>
		
				<div class="row bar bar-secondary">
					<div class="col-md-12">
						<?php //echo $this->Html->link('<i class=\'glyphicon glyphicon-plus-sign\'></i> Add Card Readers', array('action' => 'add','admin'=>true),array('escape'=>false,'class'=>'btn btn-success')); ?>
					</div>	
				</div>
		
				<div class="row bar bar-third">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped" >
								<thead>
									<tr class="info">
										<th><?php echo $this->Paginator->sort('server_ip','Server Ip'); ?></th>
										<th><?php echo $this->Paginator->sort('ip_address','Ip Address'); ?></th>
										<th><?php echo $this->Paginator->sort('created','Created'); ?></th>
										<th><?php echo $this->Paginator->sort('modified','Modified'); ?></th>
										<th class="text-center action-th"><?php echo __('Actions'); ?></th>
									</tr>
								</thead>
					
								<tbody>
									<?php foreach ($zones as $cardReader): ?>
					
										<tr>
											<td><?php echo h($cardReader['Testing']['server_ip']); ?></td>
											<td><?php echo h($cardReader['Testing']['ip_address']); ?></td>
											<td><?php echo h($cardReader['Testing']['created']); ?></td>
											<td><?php echo h($cardReader['Testing']['modified']); ?></td>
											<td class="text-left action">

											<?php //array('action' => 'dv_log', $cardReader['CardReader']['id'],'admin'=>true)?>

											<?php echo $this->Html->link('<i class=\'fa fa-paw\'></i> Device Log', '#',array('escape'=>false,'class'=>'btn btn-info btn-sm','data-toggle'=>"modal", 'data-target'=>"#logFromDevice",'onclick'=>"startLogDownload('{$cardReader['Testing']['id']}')")); ?>

											<?php echo $this->Html->link('<i class=\'fa fa-file-excel-o\'></i> XL Log', array('action' => 'bts_log', $cardReader['Testing']['ip_address'],'xl'),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

											<?php echo $this->Html->link('<i class=\'fa fa-file-text\'></i> TXT Log', array('action' => 'bts_log', $cardReader['Testing']['ip_address'],'txt'),array('escape'=>false,'class'=>'btn btn-default btn-sm')); ?>

											<?php echo $this->Html->link('<i class=\'fa fa-unlock\'></i> Open Door', array('action' => 'bts_dooropen', $cardReader['Testing']['id']),array('escape'=>false,'class'=>'btn btn-info btn-sm')); ?>

											<?php echo $this->Html->link('<i class=\'fa fa-credit-card\'></i> Cards', array('action' => 'bts_card_manager', $cardReader['Testing']['id']),array('escape'=>false,'class'=>'btn btn-success btn-sm')); ?>

											<?php echo $this->Html->link('<i class=\'fa fa-cog\'></i> Config', array('action' => 'bts_configs', $cardReader['Testing']['id']),array('escape'=>false,'class'=>'btn btn-warning btn-sm')); ?>
								
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>

							<?php echo $this->Html->link('<i class=\'fa fa-unlock\'></i> Open Door', array('action' => 'door_open_testing'),array('escape'=>false,'class'=>'btn btn-info btn-sm')); 
							?>

							<?php echo $this->Html->link('<i class=\'fa fa-unlock\'></i> Add Card', array('action' => 'bts_add_card'),array('escape'=>false,'class'=>'btn btn-info btn-sm')); 
							?>

							<?php echo $this->Html->link('<i class=\'fa fa-cog\'></i> Config', array('action' => 'bts_configs'),array('escape'=>false,'class'=>'btn btn-info btn-sm')); 
							?>

						</div>
					</div>
				</div>
		
				<div class="row">
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
				</div>	
			</div>
		</div>
	</section>
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="logFromDevice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel">Log Downloader</h4>
      		</div>
      		<div class="modal-body">
       			<div class="progress downloadProcess">
			  		<div class="progress-bar downLoadProcessBar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
			  		</div>
				</div> 		
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      		</div>
    	</div>
  	</div>
</div>

<script type="text/javascript">
	function startLogDownload(deviceId){
		$.ajax({
			'method' 	: 'post',
			'url'		: "http://localhost/Massive_EMS/operations/dv_log/" + deviceId,
		}).success(function(data){
			
			if(data !== 'fail'){
				$('.downloadProcess').show();
				
				for(var i = 0; i<= 100; i++ ){

				}

				$('.modal-body').append('<a class="btn btn-info btn-sm" target="_blank" href="http://localhost/Massive_EMS/operations/bts_log/'+data+'/dv"><i class="fa fa-file-text"></i> Download</a>');
				
			}else{
				console.log(data);
				$('.downloadProcess').hide();
				$('.modal-body').html('<p class="alert alert-danger">Download Process failed, please Try again</p>');
			}
		});
	}
</script>
