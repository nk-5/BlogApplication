<?php $this->setLayoutVar('title','ACCOUNT SIGN UP') ?>

<h2>ACCOUNT SIGN UP</h2>

<form action="<?php echo $base_url; ?>/account/register" method="post">
	<input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>" />

	<?php if (isset($errors) && count($errors) > 0): ?>
	<?php echo $this->render('errors',array('errors' => $errors)); ?>
	<?php endif; ?>

<!--	<?php// if (isset($errors) && count($errors) > 0): ?> 
	<ul class="error_list">
		<?php// foreach ($errors as $error): ?>
		<li><?php// echo $this->escape($error); ?></li>
		<?php// endforeach; ?>
	</ul>
	<?php// endif; ?>
-->

<!--
	<table>
		<tbody>
			<tr>
				<th>UserID</th>
				<td>
					<input type="text" name="user_name" value="<?php// echo $this->escape($user_name); ?>" />
				</td>
			</tr>

			<tr>
				<th>Password</th>
				<td>
					<input type="password" name="password" value="<?php// echo $this->escape($password); ?>"/>
				</td>
			</tr>
		</tbody>
	</table>
-->

	<?php echo $this->render('account/inputs',array('user_name' => $user_name,'password' => $password,)); ?>

	<p>
		<input type="submit" value="SIGN UP!!" />
	</p>
</form>
