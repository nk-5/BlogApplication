<?php $this->setLayoutVar('title','Search') ?>

<h2>User-Search</h2>


<form action="<?php echo $base_url; ?>/status/searchpost" method="post">
	<input type="hidden" name="_token" value="<?php echo $this->escape($_token); ?>" />

	<div class="form-group">
          <div class="col-sm-4">
            <input type="text" id="name" class="form-control" placeholder="Please input your id" name="search_name"><?php echo $this->escape($search_name); ?>
          </div>
        </div>
        
	<div class="form-group">
		<div class="col-sm-4">
			<input type="submit" value="Search!!" class="btn btn-primary" >
		</div>
	</div>

</form>