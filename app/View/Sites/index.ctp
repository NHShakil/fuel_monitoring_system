<style type="text/css">
	.header_font_style{
		font-size: 15px; 
		font-family: 'Times New Roman',Georgia,Serif;
	}
	.font_style{
		font-size: 15px; 
		font-family: 'Times New Roman',Georgia,Serif;
	}
	.td_height{
		height: 35px;
	}
</style>



<div class="container-fluid">
    <div class="row">	
		
        <div class="card col-md-12">
          	<div class="card-header">
            	<div class="row bar bar-primary bar-top">
					<h2 class="bar-title"><?php echo str_repeat('&nbsp;', 1).__(' BTS :: List'); ?></h2>				
					<!-- <div class="col-md-8 text-right">
                        <?php echo $this->Form->create('Site',array('url'=>array('controller'=>'sites', 'action'=>'search_bts')), array('class'=>'searchForm','data-role'=>'form')); ?>
                        <?php echo $this->Form->input('keywords',array('type'=>'text','div'=>false,'label'=>false,'class'=>'search-box', 'placeholder'=>'Search key words'));?>
                        <?php echo $this->Form->button('Search',array('type'=>'submit','div'=>false,'label'=>false, 'class' =>'btn btn-default btn-sm'));?>                                
                        <?php echo $this->Form->end(); ?>
                    </div> -->
				</div>
          	

				<div class="row bar bar-secondary">
	    			<div class="col-md-12">
						<?php echo $this->Html->link('<i class="fa fa-plus-circle"></i><span> Add New Site</span>', array('action' => 'add'),array('escape'=>false,'class'=>'btn btn-success')); ?>
	    			</div>	
        		</div>

				<!-- Zone Tree -->
				
    			<div class="row bar bar-third">
					<div class="col-md-2">
						<div class="row bar bar-secondary">
							<div class="col-md-12">
								<strong> Zone Tree</strong>
								<?php echo $this->ZoneTree->createTree($treeData)?>
							</div>			
						</div>
					</div>

					<div id="tree-container"></div>
	
            		<div class="row col-md-10">
						<div class="card-body table-responsive no-padding">
                            <table id="example1" class="table table-bordered table-striped">
								<thead class="header_font_style" bgcolor=#99ddff>
									<th><?php echo $this->Paginator->sort('zone_id','Zone Name'); ?></th>
									<th><?php echo $this->Paginator->sort('SiteModuleId','Site ID'); ?></th>
									<th><?php echo $this->Paginator->sort('site_name','Site Name'); ?></th>
									<th><?php echo $this->Paginator->sort('site_category','Site Category'); ?></th>
									<th><?php echo $this->Paginator->sort('service_port','Service Port'); ?></th>
									<th><?php echo $this->Paginator->sort('server_ip','Server Ip'); ?></th>
									<th><?php echo $this->Paginator->sort('status'); ?></th>
									<th class="text-center action-th"><?php echo __('Actions'); ?></th>
								</thead>			
								<tbody>
									<?php  
										foreach ($sites as $site):?>			
											<tr class="font_style">
												<td class="td_height"><?php echo h($zones[$site['Site']['zone_id']]); ?></td>
												<td class="td_height"><?php echo h($site['Site']['SiteModuleId']); ?></td>
												<td class="td_height"><?php echo h($site['Site']['site_name']); ?></td>
												<td class="td_height"><?php echo h($site['Site']['site_category']); ?></td>
												<td class="td_height"><?php echo h($site['Site']['service_port']); ?></td>
												<td class="td_height"><?php echo h($site['Site']['server_ip']); ?></td>
												<td class="td_height"><?php echo h($status[$site['Site']['status']]); ?></td>
												<td class="text-center action td_height">
												<?php echo $this->Html->link('<i class="fa fa-edit"></i><span> Edit</span>', array('action' => 'edit', $site['Site']['id']),array('escape'=>false,'class'=>'btn btn-info btn-xs')); ?>

												<?php echo $this->Form->postLink('<i class="fa fa-times-circle-o" aria-hidden="true"></i><span> Delete</span>', array('action' => 'delete', $site['Site']['id']), array('escape'=>false,'class'=>'btn btn-danger btn-xs'), __('Are you sure you want to delete?')); ?>
												</td>
											</tr><?php 
										endforeach; 
									?>
								</tbody>
							</table>
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

		                            echo str_repeat('&nbsp;', 3);

		                            echo $this->Paginator->numbers(array('separator' => str_repeat('&nbsp;', 2),'tag'=>'li','currentTag'=>'a', 'currentClass'=>'current disabled'));

		                            echo str_repeat('&nbsp;', 3);

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

