<div class="grouproles form">
<?php echo $this->Form->create('Grouprole'); ?>
	<fieldset>
		<legend><?php echo __('Add Grouprole'); ?></legend>
	<?php
		echo $this->Form->input('role');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Grouproles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Group Users'), array('controller' => 'group_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group User'), array('controller' => 'group_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
