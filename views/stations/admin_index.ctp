<?php

$this->Html->addCrumb(__d('forum', 'Administration', true), array('controller' => 'forum', 'action' => 'index'));
$this->Html->addCrumb(__d('forum', 'Forums', true), array('controller' => 'stations', 'action' => 'index')); ?>

<div class="controls float-right">
	<?php echo $this->Html->link(__d('forum', 'Add Forum', true), array('action' => 'add'), array('class' => 'button')); ?>
</div>

<div class="title">
	<h2><?php __d('forum', 'Manage Forums'); ?></h2>
</div>

<?php echo $this->Form->create('Forum', array('url' => $this->here));

if (!empty($forums)) {
	foreach ($forums as $forum) { ?>

<div class="container">
	<div class="containerHeader">		
		<h3>
			<span class="float-right">
				<?php echo $this->Html->link(__d('forum', 'Edit', true), array('action' => 'edit', $forum['Forum']['id'])); ?> -
				<?php echo $this->Html->link(__d('forum', 'Delete', true), array('action' => 'delete', $forum['Forum']['id'])); ?>
			</span>
			
			<?php
			echo $this->Form->input('Forum.'. $forum['Forum']['id'] .'.orderNo', array('value' => $forum['Forum']['orderNo'], 'div' => false, 'label' => false, 'style' => 'width: 20px', 'maxlength' => 2, 'class' => 'align-center'));
			echo $this->Form->input('Forum.'. $forum['Forum']['id'] .'.id', array('value' => $forum['Forum']['id'], 'type' => 'hidden')); ?>

			<?php echo $forum['Forum']['title']; ?> 
			(<?php echo $this->Common->options('forumStatus', $forum['Forum']['status']); ?>)
		</h3>
	</div>
	
	<div class="containerContent">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th colspan="2"><?php __d('forum', 'Forum'); ?></th>
					<th><?php __d('forum', 'Status'); ?></th>
					<th><?php __d('forum', 'Topics'); ?></th>
					<th><?php __d('forum', 'Posts'); ?></th>
					<th><?php __d('forum', 'Read'); ?></th>
					<th><?php __d('forum', 'Post'); ?></th>
					<th><?php __d('forum', 'Reply'); ?></th>
					<th><?php __d('forum', 'Poll'); ?></th>
					<th><?php __d('forum', 'Options'); ?></th>
				</tr>
			</thead>
			<tbody>
    
			<?php if (!empty($forum['Children'])) {
				foreach ($forum['Children'] as $child) {
					echo $this->element('admin/forum_row', array(
						'forum' => $child
					));

					if (!empty($child['SubForum'])) {
						foreach ($child['SubForum'] as $subForum) {
							echo $this->element('admin/forum_row', array(
								'forum' => $subForum,
								'child' => true
							));
						}
					}
				} 
			} else { ?>

				<tr>
					<td colspan="11" class="empty">
						<?php __d('forum', 'There are no forums to display.'); ?> 
						<?php echo $this->Html->link(__d('forum', 'Add Forum', true), array('action' => 'add')); ?>.
					</td>
				</tr>

			<?php } ?>

			</tbody>
		</table>
	</div>
</div>

<?php } }

echo $this->Form->submit(__d('forum', 'Update Order', true), array('class' => 'button'));
echo $this->Form->end(); ?>
