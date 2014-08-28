<div class="contentprivacies form">
<?php echo $this->Form->create('Contentprivacy'); ?>
	<fieldset>
		<legend><?php echo __('Add Contentprivacy'); ?></legend>
	<?php
		echo $this->Form->input('privacy');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Contentprivacies'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Contents'), array('controller' => 'contents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Content'), array('controller' => 'contents', 'action' => 'add')); ?> </li>
	</ul>
</div>
