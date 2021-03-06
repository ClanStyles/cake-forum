<?php 

$this->Html->addCrumb($settings['site_name'], array('controller' => 'forum', 'action' => 'index'));

if (!empty($forum['Parent']['slug'])) {
	$this->Html->addCrumb($forum['Parent']['title'], array('controller' => 'stations', 'action' => 'view', $forum['Parent']['slug']));
}

$this->Html->addCrumb($forum['Forum']['title'], array('controller' => 'stations', 'action' => 'view', $forum['Forum']['slug'])); ?>

<div class="title">
	<h2><?php echo $pageTitle; ?></h2>
</div>

<?php echo $this->Form->create('Topic', array('url' => $this->here)); ?>

<div class="container">
	<div class="containerContent">
		<?php 
		echo $this->Form->input('title', array('label' => __d('forum', 'Title', true)));
		echo $this->Form->input('forum_id', array('options' => $forums, 'escape' => false, 'empty' => '-- '. __d('forum', 'Select a Forum', true) .' --', 'label' => __d('forum', 'Forum', true)));

		if ($this->Common->hasAccess(AccessLevel::SUPER, $forum['Forum']['id'])) {
			echo $this->Form->input('status', array('options' => $this->Common->options('topicStatus'), 'label' => __d('forum', 'Status', true)));
			echo $this->Form->input('type', array('options' => $this->Common->options('topicTypes'), 'label' => __d('forum', 'Type', true)));
		} 

		if ($type == 'poll') {
			echo $this->Form->input('options', array(
				'type' => 'textarea',
				'label' => __d('forum', 'Poll Options', true), 
				'after' => '<span class="inputText">'. __d('forum', 'One option per line. Max 10 options.', true) .'</span>', 
				'rows' => 5
			));
			
			echo $this->Form->input('expires', array(
				'label' => __d('forum', 'Expiration Date', true), 
				'after' => '<span class="inputText">'. __d('forum', 'How many days till expiration? Leave blank to last forever.', true) .'</span>', 
				'class' => 'numeric'
			));
		} 
			
		echo $this->Form->input('content', array(
			'after' => '<span class="inputText">[b], [u], [i], [img], [url], [email], [code], [align], [list], [li], [color], [size], [quote]</span>',
			'label' => __d('forum', 'Content', true), 
			'type' => 'textarea', 
			'rows' => 15
		));
		
		echo $this->element('markitup', array('textarea' => 'TopicContent')); ?>
	</div>
</div>

<?php 
echo $this->Form->submit($pageTitle, array('class' => 'button'));
echo $this->Form->end(); ?>
