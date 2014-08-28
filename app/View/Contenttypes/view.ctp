<div class="contenttypes view">
<h2><?php echo __('Contenttype'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($contenttype['Contenttype']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($contenttype['Contenttype']['type']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Contenttype'), array('action' => 'edit', $contenttype['Contenttype']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Contenttype'), array('action' => 'delete', $contenttype['Contenttype']['id']), array(), __('Are you sure you want to delete # %s?', $contenttype['Contenttype']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contenttypes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contenttype'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contents'), array('controller' => 'contents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Content'), array('controller' => 'contents', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Contents'); ?></h3>
	<?php if (!empty($contenttype['Content'])): ?>
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
	<?php foreach ($contenttype['Content'] as $content): ?>
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
