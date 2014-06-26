<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>">Compare costs</a></li>
    <li><a href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>"><?php echo $this->organization->name ?></a></li>
    <li class="active"><?php echo $this->collection->name ?></li>
</ol>

<h1>Edit Collection</h1>
<p>Please fill out the following information for your collection and your content to help identify your cost determinants and enable a comparison of costs against similar organisations. This information is used to nuance and give sense to the submitted cost data. For example, the information "Data volume" will enable the calculation of costs per gigabyte, terabyte, petabyte...</p>

<?php echo $this->_formView->render(); ?>
