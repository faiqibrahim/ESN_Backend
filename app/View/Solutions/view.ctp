<div class="solutions view">
<h2><?php echo __('Solution'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($solution['Solution']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Solution'); ?></dt>
		<dd>
			<?php echo h($solution['Solution']['solution']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Task'); ?></dt>
		<dd>
			<?php echo $this->Html->link($solution['Task']['title'], array('controller' => 'tasks', 'action' => 'view', $solution['Task']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($solution['User']['id'], array('controller' => 'users', 'action' => 'view', $solution['User']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Solution'), array('action' => 'edit', $solution['Solution']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Solution'), array('action' => 'delete', $solution['Solution']['id']), array(), __('Are you sure you want to delete # %s?', $solution['Solution']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Solutions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Solution'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tasks'), array('controller' => 'tasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task'), array('controller' => 'tasks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contents'), array('controller' => 'contents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Content'), array('controller' => 'contents', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Contents'); ?></h3>
	<?php if (!empty($solution['Content'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Content'); ?></th>
		<th><?php echo __('Contenttype Id'); ?></th>
		<th><?php echo __('Post Id'); ?></th>
		<th><?php echo __('Task Id'); ?></th>
		<th><?php echo __('Solution Id'); ?></th>
		<th><?php echo __('Contentprivacy Id'); ?></th>
		<th><?php echo __('Groupcontent Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($solution['Content'] as $content): ?>
		<tr>
			<td><?php echo $content['id']; ?></td>
			<td><?php echo $content['content']; ?></td>
			<td><?php echo $content['contenttype_id']; ?></td>
			<td><?php echo $content['post_id']; ?></td>
			<td><?php echo $content['task_id']; ?></td>
			<td><?php echo $content['solution_id']; ?></td>
			<td><?php echo $content['contentprivacy_id']; ?></td>
			<td><?php echo $content['groupcontent_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'contents', 'action' => 'view', $content['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'contents', 'action' => 'edit', $content['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'contents', 'action' => 'delete', $content['id']), array(), __('Are you sure you want to delete # %s?', $content['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Content'), array('controller' => 'contents', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
