<?php $this->setLayoutVar('title','Home') ?>

<h2>Home</h2>

<form action="<?php echo $base_url; ?>/status/post" method="post">
	<input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>" />

<!--********** Errors Method **************/ -->

	<?php if (isset($errors) && count($errors) > 0): ?>
	<?php echo $this->render('errors',array('errors' => $errors)); ?>
	<?php endif; ?>

	<form class="form-horizontal" style="margin-bottom:15px">
        <div class="form-group"><!--has-error-->
          <div class="col-sm-4">
            <input type="textarea" id="body" name="body" rows="2" cols="60" class="form-control" placeholder="Please input tweet!!"><?php echo $this->escape($body); ?>
          </div>
        </div>
	
 		<div class="form-group">
 			<div class="col-md-4">
 				<input type="submit" value="Tweet!!" class="btn btn-primary" >
        		</div>
      	<div>
	</form>

	<br>
	<br>
	<br>
	<h3>Tweet Contents</h3>

	<div id="statuses">
		<?php foreach ($statuses as $status): ?>
		<?php echo $this->render('status/status',array('status' =>  $status)); ?>
		<?php endforeach; ?>
	</div>

</div>


