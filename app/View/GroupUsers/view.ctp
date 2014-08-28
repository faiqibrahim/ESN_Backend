<div class="groupUsers view">
<h2><?php echo __('Group User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($groupUser['GroupUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupUser['Group']['title'], array('controller' => 'groups', 'action' => 'view', $groupUser['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupUser['User']['id'], array('controller' => 'users', 'action' => 'view', $groupUser['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Grouprole'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupUser['Grouprole']['id'], array('controller' => 'grouproles', 'action' => 'view', $groupUser['Grouprole']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group User'), array('action' => 'edit', $groupUser['GroupUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Group User'), array('action' => 'delete', $groupUser['GroupUser']['id']), array(), __('Are you sure you want to delete # %s?', $groupUser['GroupUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Group Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Grouproles'), array('controller' => 'grouproles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Grouprole'), array('controller' => 'grouproles', 'action' => 'add')); ?> </li>
	</ul>
</div>
