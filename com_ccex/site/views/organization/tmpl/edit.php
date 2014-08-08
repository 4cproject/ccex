<ol class="breadcrumb">
	<li><a data-toggle="tooltip" data-placement="right" title="Click here to go back to the overview of all cost data sets you have submitted so far" href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>">Compare costs</a></li>
	<li class="active"><?php echo $this->organization->name ?></li>
</ol>

<h1>Organisation profile</h1>
<p>Please fill out the following profile information for your organisation to help identify your cost determinants and enable a comparison of costs against similar organisations. None of the information will be shared unless you explicitly allow this.</p>

<?php echo $this->_formView->render(); ?>
