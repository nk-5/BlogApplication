<?php $this->setLayoutVar('title','LOGIN') ?>

<h2>LOGIN</h2>

<p>
	<a href="<?php echo $base_url; ?>/account/signup">NEW USER ACCOUNT</a>
</p>

<form action="<?php echo $base_url; ?>/account/authenticate" method="post">
	<input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>" />

	<?php if (isset($errors) && count($errors) > 0): ?>
	<?php echo $this->render('errors',array('errors' => $errors)); ?>
	<?php endif; ?>

	<?php echo $this->render('account/inputs',array('user_name' => $user_name,'password' => $password,)); ?>

	<p>
		<input type="submit" value="LOGIN" />
	</p>
</form>