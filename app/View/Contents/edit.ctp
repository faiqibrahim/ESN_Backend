<div class="contents form">
<?php echo $this->Form->create('Content'); ?>
	<fieldset>
		<legend><?php echo __('Edit Content'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('content');
		echo $this->Form->input('contenttype_id');
		echo $this->Form->input('post_id');
		echo $this->Form->input('task_id');
		echo $this->Form->input('solution_id');
		echo $this->Form->input('contentprivacy_id');
		echo $this->Form->input('groupcontent_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Content.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Content.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Contents'), array('action' => 'index')); ?></li>
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
