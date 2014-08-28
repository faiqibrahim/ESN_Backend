<div class="contactroles form">
<?php echo $this->Form->create('Contactrole'); ?>
	<fieldset>
		<legend><?php echo __('Edit Contactrole'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('role');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Contactrole.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Contactrole.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Contactroles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Contacts'), array('controller' => 'contacts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contact'), array('controller' => 'contacts', 'action' => 'add')); ?> </li>
	</ul>
</div>
