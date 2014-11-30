<?php $this->setLayoutVar('title','Send-Mail') ?>

<h2>Make-Mail</h2>


<form action="<?php echo $base_url; ?>/mails/sendmailpost" method="post">
	<input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>" />

	<p>Send User Select:
		<select class="form-control" name="send_user" action="<?php echo $base_url; ?>/status/mailsendpost" method="post">
			<?php foreach ($send_user as $select_user): ?>
			<option><?php echo $this->escape($select_user['user_name']); ?></option>
			<?php endforeach; ?>
		</select>
	</p>

	<textarea name="mail_body" rows="10" cols="60" class="form-control" placeholder="Please write mail"><?php echo $this->escape($mail_body); ?></textarea>


		<div class="form-group">
          <input type="submit" value="This Mail Send!!" class="btn btn-primary" >
        </div>
	<!-- <p>
		<input type="submit" value="This Mail Send!!" />
	</p> -->
</form>