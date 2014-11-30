<?php $this->setLayoutVar('title','Search') ?>

<h2>User-Search</h2>


<form action="<?php echo $base_url; ?>/find/user/user:name/user/:id" method="post">
	<input type="text" name="search" value="Please input Your ID"<?php echo $this->escape($search_name); ?> />

	<p>
		<input type="submit" value="talk!!" />
	</p>
</form>