<div class="requesttypesRoles index">
	<h2><?php echo __('Requesttypes Roles'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('requesttype_id'); ?></th>
			<th><?php echo $this->Paginator->sort('role_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($requesttypesRoles as $requesttypesRole): ?>
	<tr>
		<td><?php echo h($requesttypesRole['RequesttypesRole']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($requesttypesRole['Requesttype']['id'], array('controller' => 'requesttypes', 'action' => 'view', $requesttypesRole['Requesttype']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($requesttypesRole['Role']['id'], array('controller' => 'roles', 'action' => 'view', $requesttypesRole['Role']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $requesttypesRole['RequesttypesRole']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $requesttypesRole['RequesttypesRole']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $requesttypesRole['RequesttypesRole']['id']), array(), __('Are you sure you want to delete # %s?', $requesttypesRole['RequesttypesRole']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Requesttypes Role'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Requesttypes'), array('controller' => 'requesttypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Requesttype'), array('controller' => 'requesttypes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
	</ul>
</div>
