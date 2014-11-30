<?php $this->setLayoutVar('title','FIND RESULT') ?>

<h2>FIND RESULT</h2>

	<?php if (isset($errors) && count($errors) > 0): ?>
	<?php echo $this->render('errors',array('errors' => $errors)); ?>
	<?php endif; ?>



<h2><p>User:<?php echo $this->escape($search_name); ?></h2>

<?php if(count($errors) == 0): ?>
	<?php if($statuses != null): ?>
		<p>FIND OTHER USER</p>
		<div id="statuses">
			<?php foreach ($statuses as $status): ?>
			<?php echo $this->render('status/status',array('status' => $status)); ?>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<p style="color:red;">USER NOT FOUND</p>
	<?php endif; ?>
<?php endif; ?>