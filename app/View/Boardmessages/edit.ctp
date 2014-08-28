<div class="boardmessages form">
<?php echo $this->Form->create('Boardmessage'); ?>
	<fieldset>
		<legend><?php echo __('Edit Boardmessage'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('message');
		echo $this->Form->input('group_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('generated');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Boardmessage.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Boardmessage.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Boardmessages'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
