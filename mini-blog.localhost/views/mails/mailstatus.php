<div class="status">
		<div class="status_content">
			<a href="<?php echo $base_url; ?>/user/<?php echo $this->escape($status['send_user']); ?>">
				<?php echo $this->escape($status['send_user']); ?>
			</a>
			<?php echo $this->escape($status['mail_body']); ?>
		</div>
		
		<div>
			<a href="<?php echo $base_url; ?>/user/<?php echo $this->escape($status['send_user']); ?>/status/<?php echo $this->escape($status['id']); ?>"></a>

			<?php echo $this->escape($status['created_at']); ?>
		</div>
</div>