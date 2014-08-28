<div class="requesttypesRoles form">
<?php echo $this->Form->create('RequesttypesRole'); ?>
	<fieldset>
		<legend><?php echo __('Edit Requesttypes Role'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('requesttype_id');
		echo $this->Form->input('role_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('RequesttypesRole.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('RequesttypesRole.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Requesttypes Roles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Requesttypes'), array('controller' => 'requesttypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Requesttype'), array('controller' => 'requesttypes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
	</ul>
</div>
