<div class="usersInterests view">
<h2><?php echo __('Users Interest'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($usersInterest['UsersInterest']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($usersInterest['User']['id'], array('controller' => 'users', 'action' => 'view', $usersInterest['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Interest'); ?></dt>
		<dd>
			<?php echo $this->Html->link($usersInterest['Interest']['id'], array('controller' => 'interests', 'action' => 'view', $usersInterest['Interest']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Users Interest'), array('action' => 'edit', $usersInterest['UsersInterest']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Users Interest'), array('action' => 'delete', $usersInterest['UsersInterest']['id']), array(), __('Are you sure you want to delete # %s?', $usersInterest['UsersInterest']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users Interests'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users Interest'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Interests'), array('controller' => 'interests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Interest'), array('controller' => 'interests', 'action' => 'add')); ?> </li>
	</ul>
</div>
