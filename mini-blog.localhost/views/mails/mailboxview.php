<?php $this->setLayoutVar('title','Mail Box') ?>

<h2>Mail Box</h2>

<h3>Mail Content</h3>
			<div id="statuses">
				<?php foreach ($mail_contents as $status): ?>
				<?php echo $this->render('mails/mailstatus',array('status' => $status)); ?>
				<?php endforeach; ?>
			</div>