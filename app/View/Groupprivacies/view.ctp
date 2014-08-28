<div class="groupprivacies view">
<h2><?php echo __('Groupprivacy'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($groupprivacy['Groupprivacy']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Privacy'); ?></dt>
		<dd>
			<?php echo h($groupprivacy['Groupprivacy']['privacy']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Groupprivacy'), array('action' => 'edit', $groupprivacy['Groupprivacy']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Groupprivacy'), array('action' => 'delete', $groupprivacy['Groupprivacy']['id']), array(), __('Are you sure you want to delete # %s?', $groupprivacy['Groupprivacy']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Groupprivacies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Groupprivacy'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Groups'); ?></h3>
	<?php if (!empty($groupprivacy['Group'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Startdate'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Groupprivacy Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($groupprivacy['Group'] as $group): ?>
		<tr>
			<td><?php echo $group['id']; ?></td>
			<td><?php echo $group['title']; ?></td>
			<td><?php echo $group['description']; ?></td>
			<td><?php echo $group['startdate']; ?></td>
			<td><?php echo $group['created']; ?></td>
			<td><?php echo $group['user_id']; ?></td>
			<td><?php echo $group['groupprivacy_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'groups', 'action' => 'view', $group['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'groups', 'action' => 'edit', $group['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'groups', 'action' => 'delete', $group['id']), array(), __('Are you sure you want to delete # %s?', $group['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
