<?php 

$this->Html->addCrumb(__d('forum', 'Administration', true), array('controller' => 'forum', 'action' => 'index'));
$this->Html->addCrumb(__d('forum', 'Reported', true), array('controller' => 'reports', 'action' => 'index'));
$this->Html->addCrumb(__d('forum', 'Topics', true), array('controller' => 'reports', 'action' => 'topics')); ?>

<div class="controls float-right">
	<?php 
	echo $this->Html->link(__d('forum', 'Topics', true), array('controller' => 'reports', 'action' => 'topics'), array('class' => 'button'));
	echo $this->Html->link(__d('forum', 'Posts', true), array('controller' => 'reports', 'action' => 'posts'), array('class' => 'button'));
	echo $this->Html->link(__d('forum', 'Users', true), array('controller' => 'reports', 'action' => 'users'), array('class' => 'button')); ?>
</div>

<div class="title">
	<h2><?php __d('forum', 'Reported Topics'); ?></h2>
</div>

<?php echo $this->Form->create('Report', array('url' => $this->here)); ?>

<div class="container">
	<div class="containerContent">
		<?php echo $this->element('pagination'); ?>

		<table class="table topics">
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th><?php echo $this->Paginator->sort(__d('forum', 'Topic', true), 'Topic.title'); ?></th>
					<th><?php echo $this->Paginator->sort(__d('forum', 'Reported By', true), 'Reporter.'. $config['userMap']['username']); ?></th>
					<th><?php __d('forum', 'Comment'); ?></th>
					<th><?php echo $this->Paginator->sort(__d('forum', 'Reported On', true), 'Report.created'); ?></th>
				</tr>
			</thead>
			<tbody>

			<?php if (!empty($reports)) {
				foreach ($reports as $counter => $report) { ?>

				<tr<?php if ($counter % 2) echo ' class="altRow"'; ?>>
					<td class="icon"><input type="checkbox" name="data[Report][items][]" value="<?php echo $report['Report']['id']; ?>:<?php echo $report['Topic']['id']; ?>" /></td>
					<td>
						<?php if (!empty($report['Topic']['id'])) {
							echo $this->Html->link($report['Topic']['title'], array('controller' => 'topics', 'action' => 'view', $report['Topic']['slug'], 'admin' => false));
						} else {
							echo '<em class="gray">('. __d('forum', 'Deleted', true) .')</em>';
						} ?>
					</td>
					<td><?php echo $this->Html->link($report['Reporter'][$config['userMap']['username']], array('controller' => 'users', 'action' => 'edit', $report['Reporter']['Profile']['id'], 'admin' => true)); ?></td>
					<td><?php echo $report['Report']['comment']; ?></td>
					<td><?php echo $this->Time->nice($report['Report']['created'], $this->Common->timezone()); ?></td>
				</tr>
				
				<?php }
			} else { ?>

				<tr>
					<td colspan="5" class="empty"><?php __d('forum', 'There are no reported topics.'); ?></td>
				</tr>
				
			<?php } ?>
				
			</tbody>
		</table>

		<?php echo $this->element('pagination'); ?>
	</div>
</div>	

<div class="moderate">
	<?php 
	echo $this->Form->input('action', array(
		'options' => array(
			'delete' => __d('forum', 'Delete Topic(s)', true),
			'close' => __d('forum', 'Close Topic(s)', true),
			'remove' => __d('forum', 'Remove Report Only', true)
		),
		'div' => false,
		'label' => __d('forum', 'Perform Action', true) .': '
	));
	
	echo $this->Form->submit(__d('forum', 'Process', true), array('div' => false, 'class' => 'buttonSmall')); ?>
</div>

<?php echo $this->Form->end(); ?>