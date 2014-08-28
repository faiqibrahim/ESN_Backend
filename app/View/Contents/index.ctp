<div class="contents index">
	<h2><?php echo __('Contents'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('content'); ?></th>
			<th><?php echo $this->Paginator->sort('contenttype_id'); ?></th>
			<th><?php echo $this->Paginator->sort('post_id'); ?></th>
			<th><?php echo $this->Paginator->sort('task_id'); ?></th>
			<th><?php echo $this->Paginator->sort('solution_id'); ?></th>
			<th><?php echo $this->Paginator->sort('contentprivacy_id'); ?></th>
			<th><?php echo $this->Paginator->sort('groupcontent_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($contents as $content): ?>
	<tr>
		<td><?php echo h($content['Content']['id']); ?>&nbsp;</td>
		<td><?php echo h($content['Content']['content']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($content['Contenttype']['id'], array('controller' => 'contenttypes', 'action' => 'view', $content['Contenttype']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($content['Post']['id'], array('controller' => 'posts', 'action' => 'view', $content['Post']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($content['Task']['title'], array('controller' => 'tasks', 'action' => 'view', $content['Task']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($content['Solution']['id'], array('controller' => 'solutions', 'action' => 'view', $content['Solution']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($content['Contentprivacy']['id'], array('controller' => 'contentprivacies', 'action' => 'view', $content['Contentprivacy']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($content['Groupcontent']['title'], array('controller' => 'groupcontents', 'action' => 'view', $content['Groupcontent']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $content['Content']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $content['Content']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $content['Content']['id']), array(), __('Are you sure you want to delete # %s?', $content['Content']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Content'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Contenttypes'), array('controller' => 'contenttypes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contenttype'), array('controller' => 'contenttypes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tasks'), array('controller' => 'tasks', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Task'), array('controller' => 'tasks', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Solutions'), array('controller' => 'solutions', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Solution'), array('controller' => 'solutions', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Contentprivacies'), array('controller' => 'contentprivacies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Contentprivacy'), array('controller' => 'contentprivacies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groupcontents'), array('controller' => 'groupcontents', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Groupcontent'), array('controller' => 'groupcontents', 'action' => 'add')); ?> </li>
	</ul>
</div>
