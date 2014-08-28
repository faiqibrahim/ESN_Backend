<div class="boardmessages view">
<h2><?php echo __('Boardmessage'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($boardmessage['Boardmessage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($boardmessage['Boardmessage']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($boardmessage['Group']['title'], array('controller' => 'groups', 'action' => 'view', $boardmessage['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($boardmessage['User']['id'], array('controller' => 'users', 'action' => 'view', $boardmessage['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Generated'); ?></dt>
		<dd>
			<?php echo h($boardmessage['Boardmessage']['generated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Boardmessage'), array('action' => 'edit', $boardmessage['Boardmessage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Boardmessage'), array('action' => 'delete', $boardmessage['Boardmessage']['id']), array(), __('Are you sure you want to delete # %s?', $boardmessage['Boardmessage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Boardmessages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Boardmessage'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
