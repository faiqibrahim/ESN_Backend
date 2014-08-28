<div class="grouproles view">
<h2><?php echo __('Grouprole'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($grouprole['Grouprole']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($grouprole['Grouprole']['role']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Grouprole'), array('action' => 'edit', $grouprole['Grouprole']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Grouprole'), array('action' => 'delete', $grouprole['Grouprole']['id']), array(), __('Are you sure you want to delete # %s?', $grouprole['Grouprole']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Grouproles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grouprole'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Users'), array('controller' => 'group_users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group User'), array('controller' => 'group_users', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Group Users'); ?></h3>
	<?php if (!empty($grouprole['GroupUser'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Group Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Grouprole Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($grouprole['GroupUser'] as $groupUser): ?>
		<tr>
			<td><?php echo $groupUser['id']; ?></td>
			<td><?php echo $groupUser['group_id']; ?></td>
			<td><?php echo $groupUser['user_id']; ?></td>
			<td><?php echo $groupUser['grouprole_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'group_users', 'action' => 'view', $groupUser['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'group_users', 'action' => 'edit', $groupUser['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'group_users', 'action' => 'delete', $groupUser['id']), array(), __('Are you sure you want to delete # %s?', $groupUser['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Group User'), array('controller' => 'group_users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
