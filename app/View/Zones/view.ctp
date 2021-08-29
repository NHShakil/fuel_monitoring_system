<h1 class="page-title"><?php echo __('Zone details'); ?></h1>
<dl>
	<dt><?php echo __('Id'); ?></dt>
	<dd><?php echo h($zone['Zone']['id']); ?></dd>

	<dt><?php echo __('Parent Zone'); ?></dt>
	<dd>\<?php echo $this->Html->link($zone['ParentZone']['name'], array('controller' => 'zones', 'action' => 'view', $zone['ParentZone']['id'])); ?><dd>

	<dt><?php echo __('Name'); ?></dt>
	<dd><?php echo h($zone['Zone']['name']); ?></dd>

	<dt><?php echo __('Status'); ?></dt>
	<dd><?php echo h($zone['Zone']['status']); ?></dd>

	<dt><?php echo __('Created'); ?></dt>
	<dd><?php echo h($zone['Zone']['created']); ?></dd>

	<dt><?php echo __('Modified'); ?></dt>
	<dd><?php echo h($zone['Zone']['modified']); ?></dd>

</dl>
