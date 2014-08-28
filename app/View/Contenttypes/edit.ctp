<div class="contenttypes form">
<?php echo $this->Form->create('Contenttype'); ?>
	<fieldset>
		<legend><?php echo __('Edit Contenttype'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('type');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Contenttype.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Contenttype.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Contenttypes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Contents'), array('controller' => 'contents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Content'), array('controller' => 'contents', 'action' => 'add')); ?> </li>
	</ul>
</div>
