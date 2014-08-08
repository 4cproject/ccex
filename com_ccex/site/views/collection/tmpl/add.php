<ol class="breadcrumb">
    <li><a data-toggle="tooltip" data-placement="right" title="Click here to go back to the overview of all cost data sets you have submitted so far" href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>">Compare costs</a></li>
    <li><a data-toggle="tooltip" data-placement="right" title="Click here to go to your profile" href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>"><?php echo htmlspecialchars($this->organization->name ) ?></a></li>
    <li class="active">Add cost data set</li>
</ol>

<h1>Add cost data set</h1>
<p>Please fill out the following information for your cost data set and your content to help identify your cost determinants and enable a comparison of costs against similar organisations. This information is used to nuance and give sense to the submitted cost data. For example, the information "Data volume" will enable the calculation of costs per gigabyte, terabyte, petabyte...</p>

<?php echo $this->_formView->render(); ?>
