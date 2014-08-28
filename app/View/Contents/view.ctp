<div class="contents view">
<h2><?php echo __('Content'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($content['Content']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($content['Content']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contenttype'); ?></dt>
		<dd>
			<?php echo $this->Html->link($content['Contenttype']['id'], array('controller' => 'contenttypes', 'action' => 'view', $content['Contenttype']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post'); ?></dt>
		<dd>
			<?php echo $this->Html->link($content['Post']['id'], array('controller' => 'posts', 'action' => 'view', $content['Post']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Task'); ?></dt>
		<dd>
			<?php echo $this->Html->link($content['Task']['title'], array('controller' => 'tasks', 'action' => 'view', $content['Task']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Solution'); ?></dt>
		<dd>
			<?php echo $this->Html->link($content['Solution']['id'], array('controller' => 'solutions', 'action' => 'view', $content['Solution']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contentprivacy'); ?></dt>
		<dd>
			<?php echo $this->Html->link($content['Contentprivacy']['id'], array('controller' => 'contentprivacies', 'action' => 'view', $content['Contentprivacy']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Groupcontent'); ?></dt>
		<dd>
			<?php echo $this->Html->link($content['Groupcontent']['title'], array('controller' => 'groupcontents', 'action' => 'view', $content['Groupcontent']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Content'), array('action' => 'edit', $content['Content']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Content'), array('action' => 'delete', $content['Content']['id']), array(), __('Are you sure you want to delete # %s?', $content['Content']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Contents'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Content'), array('action' => 'add')); ?> </li>
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
