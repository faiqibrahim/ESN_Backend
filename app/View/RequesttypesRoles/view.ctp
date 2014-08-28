<div class="requesttypesRoles view">
<h2><?php echo __('Requesttypes Role'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($requesttypesRole['RequesttypesRole']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Requesttype'); ?></dt>
		<dd>
			<?php echo $this->Html->link($requesttypesRole['Requesttype']['id'], array('controller' => 'requesttypes', 'action' => 'view', $requesttypesRole['Requesttype']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo $this->Html->link($requesttypesRole['Role']['id'], array('controller' => 'roles', 'action' => 'view', $requesttypesRole['Role']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Requesttypes Role'), array('action' => 'edit', $requesttypesRole['RequesttypesRole']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Requesttypes Role'), array('action' => 'delete', $requesttypesRole['RequesttypesRole']['id']), array(), __('Are you sure you want to delete # %s?', $requesttypesRole['RequesttypesRole']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Requesttypes Roles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Requesttypes Role'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Requesttypes'), array('controller' => 'requesttypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Requesttype'), array('controller' => 'requesttypes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
	</ul>
</div>
