<?php $this->setLayoutVar('title','Mail Box') ?>

<h2>Mail Box</h2>

	<?php if (isset($errors) && count($errors) > 0): ?>
		<?php echo $this->render('errors',array('errors' => $errors)); ?>
		<?php else: ?>
			<script type="text/javascript">
				alert("Complete of Transmit!!");
			</script>
	<?php endif; ?>


<h3>Mail Content</h3>
<?php if(count($errors) == 0): ?>
	<p style="font size:5;">From:<?php echo $this->escape($send_user['user_name']); ?></p>
		<!-- <P style="color:red;font-size: 30px;font-weight: bold;line-height: 30px;font-style: italic;">NEW!!</P> -->
		<span size="10" class="label label-danger">NEW!</span>
			<strong style="font-size:40px;"><?php echo $this->escape($mail_body); ?></strong>

		<P style="font-size: 20px;font-weight: bold;line-height: 30px;font-style: italic;">My Transmit Mails</P>
			<div id="statuses">
				<?php foreach ($statuses as $status): ?>
				<?php echo $this->render('mails/mailstatus',array('status' => $status)); ?>
				<?php endforeach; ?>
			</div>
<?php endif; ?>

		<P style="font-size: 20px;font-weight: bold;line-height: 30px;font-style: italic;">Incomming Mails of Other Users</P>
		
		<div id="statuses">
				<?php foreach ($other_user_statuses as $status): ?>
				<?php echo $this->render('mails/mailstatus',array('status' => $status)); ?>
				<?php endforeach; ?>
		</div>