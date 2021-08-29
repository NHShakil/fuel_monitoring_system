<?php $this->assign('title', 'Site Log History');?>
<div class= "row">
    <div class="col-md-12" >
        <div class="bar bar-primary bar-top">
            <h2 class="bar-title col-md-4"><?php echo __('Log History of a Site'); ?></h2>

        </div>

        <div class="row bar bar-secondary">
            <div class="col-md-12">
                <?php echo $this->Html->link('<i class="fa fa-angle-double-left"></i><span> Back To Dashboard</span>', array('controller'=>'testings','action' => 'dashboard'),array('escape'=>false,'class'=>'btn btn-info')); ?>
            </div>  
        </div>


		<div class="card-body table-responsive no-padding">
            <table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr class="text-left" bgcolor=#99ddff style="font-size: 15px; font-family: 'Times New Roman', Georgia, Serif;">
                            <th>#</th>
							<th class="text-center">TIME</th>
							<th class="text-center">GSM SIGNAL</th>
							<th class="text-right">CONSUMED FUEL</th>
							<!-- <th >Balance Fuel</th> -->
						</tr>
					</thead>

					<tbody>

						<?php 
							foreach ($details as $key =>$zone):
								if($zone['TestingLogDevice']['status']==1){ ?>
									<tr class="success">
                                        <td style="font-size: 15px;font-family: 'Times New Roman', Georgia, Serif;"><?php echo $key+1;?></td>
										<td class="text-center" style="font-size: 15px;font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['TestingLogDevice']['full_date_time']);?></td>
										<td class="text-center" style="font-size: 15px;font-family: 'Times New Roman', Georgia, Serif;"><?php echo h($zone['TestingLogDevice']['signal_strenght']);?></td>
										<td class="text-right" style="font-size: 15px; font-family: 'Times New Roman', Georgia, Serif;"><?php echo $this->Number->precision($zone['TestingLogDevice']['consumed_fuel'],2); ?></td>
													
									</tr> <?php 
								}
							endforeach; 
						?>
					</tbody>
			</table>
		</div>
		<div class="row">
            <div class="col-md-12">
                <div class="pagination-block">
                    <p>
                        <?php
                            echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));
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