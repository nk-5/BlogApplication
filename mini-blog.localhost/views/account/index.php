<?php $this->setLayoutVar('title','ACCOUNT') ?>

<h2>ACCOUNT</h2>

<p>
	User-ID:<a href="<?php echo $base_url; ?>/user/<?php echo $this->escape($user['user_name']); ?>">
				<strong><?php echo $this->escape($user['user_name']); ?></strong>
			</a>
</p>

<ul>
	<li>
		<a href="<?php echo $base_url; ?>/">HOME</a>
	</li>

	<li>
		<a href="<?php echo $base_url; ?>/account/signout">LOGOUT</a>
	</li>
</ul>
	

<h3>FOLLOWING</h3>

<?php if (count($followings) > 0): ?>
<ul>
	<?php foreach  ($followings as $following): ?>
	<li>
		<a href="<?php echo $base_url; ?>/user/<?php echo $this->escape($following['user_name']); ?>">
			<?php echo $this->escape($following['user_name']); ?>
		</a>
	</li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>

<h3>Mail Box</h3>
	<div class="col-md-6">Send-Users</div>
	<div class="col-md-2 col-md-offset-4"></div>
	<br>
<ul>
	<?php $i = 0; ?>
	<?php while($i < $following_user_count['COUNT(DISTINCT send_user)']){; ?>
	<?php foreach  ($send_users as $send_user): ?>	
		<li>
			<a href="<?php echo $base_url; ?>/mails/<?php echo $this->escape($user['id']); ?>/mailboxview">
				<p><?php echo $this->escape($send_user['send_user']); ?><span class="badge"><?php echo $this->escape($following_count[$i]['COUNT(send_user_id)']); ?></span></p>
			</a>
		</li>
		<?php $i++; ?>
	<?php endforeach; ?>
	<?php }; ?>

</ul>