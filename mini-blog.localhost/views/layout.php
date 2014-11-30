<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1" > -->
	<title>
		<?php if (isset($title)): echo $this->escape($title) . ' - ';endif; ?>Mini Blog</title>
		<link rel="stylesheet" type="text/css" media="screen" href="/css/style.css" />
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">

<!--     		<link rel="stylesheet" type="text/css" media="screen" href="/css/bootstrap.min.css" />
 -->
</head>
<body>
	<div id="header">
	</div>
<!-- <p><i class="glyphicon glyphicon-user"></i><strong><?php// echo $this->escape($user['user_name']); ?></strong></p>
 -->		<div class="mast_header">
			<?php if($session->isAuthenticated()): ?>
				<div class="bs-docs-header" id="content">
					<div class="container">
						<h1>Mini Blog Application</h1>
						<p>Let's Start Blog Application!!</p>
					</div>
				</div>
				<div role="navigation">
					<ul class="nav nav-justified">
						<li class="action"><a href="<?php echo $base_url; ?>/">HOME</a></li>
						<li><a href="<?php echo $base_url; ?>/account">ACCOUNT</a></li>
						<li><a href="<?php echo $base_url; ?>/status/searchindex">FIND</a></li>
						<li><a href="<?php echo $base_url; ?>/mails/sendmailview">MAIL</a></li>
					</ul>
				</div>
			<?php else: ?>
				<a href="<?php echo $base_url; ?>/account/signin">LOGIN</a>
				<a href="<?php echo $base_url; ?>/account/signup">ACCOUNT SIGN UP</a>
			<?php endif; ?>
		</div>
	

	<div id="main">
		<?php echo $_content; ?>
	</div>

	 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	// <script src="account/js/bootstrap.min.js"></script> -->
</body>
</html>