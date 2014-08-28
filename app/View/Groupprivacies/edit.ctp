<div class="groupprivacies form">
<?php echo $this->Form->create('Groupprivacy'); ?>
	<fieldset>
		<legend><?php echo __('Edit Groupprivacy'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('privacy');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Groupprivacy.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Groupprivacy.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Groupprivacies'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
