<?php $this->assign('title', 'BTS :: List');?>
<div class="content-wrapper">
    <section class="content">
        <div class="box box-primary">

<h1 class="page-title"><?php echo __('Card Reader details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($cardReader['CardReader']['id']); ?></dd>

	<dt><?php echo __('Base Station'); ?></dt>
	<dd>\<?php echo $this->Html->link($cardReader['BaseStation']['id'], array('controller' => 'base_stations', 'action' => 'view', $cardReader['BaseStation']['id'])); ?><dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($cardReader['CardReader']['status']); ?></dd>

	<dt><?php echo __('Created'); ?></dt>
	<dd><?php echo h($cardReader['CardReader']['created']); ?></dd>

	<dt><?php echo __('Modified'); ?></dt>
	<dd><?php echo h($cardReader['CardReader']['modified']); ?></dd>

</dl>
       </div>
   </section>
</div>