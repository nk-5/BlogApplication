<?php $this->setLayoutVar('title','Send-Mail') ?>

<!-- <h2>Make-Mai</h2> -->


<form action="<?php echo $base_url; ?>/mails/mailsendpost" method="post">
	<input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>" />
	<p>Send User Name:</p>
		<select name="send_user" size="3" multiple>
			<option value="ja">Japanese</option>
			<option value="en">English</option>
			<option value="fr">franch</option>
		</select>		

	<textarea name="mail_body" rows="10" cols="60" value="Please write mail"><?php echo $this->escape($mail_body); ?></textarea>

	<p>
		<input type="submit" value="This Mail Send!!" />
	</p>
</form>