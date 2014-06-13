<h1 class="page-header">Compare costs</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco.</p>

<?php echo $this->_showOrganization->render(); ?>
<br/>
<?php echo $this->_indexCollection->render(); ?>

<div class="row" style="margin-top:20px">
	<div class="col-md-3">
		<a href="<?php echo JRoute::_('index.php?view=collection&layout=add') ?>" class="btn btn-primary btn-block">Add collection</a>
	</div>
	<div class="col-md-3 col-md-offset-6">
		<a href="<?php echo JRoute::_('#RESULTS') ?>" class="btn btn-success btn-block">See results <span class="fa fa-angle-right"></span></a>
	</div>
</div>

<br/></br>
