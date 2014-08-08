<ol class="breadcrumb">
    <li><a data-toggle="tooltip" data-placement="right" title="Click here to go back to the overview of all cost data sets you have submitted so far" href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>">Compare costs</a></li>
    <li><a data-toggle="tooltip" data-placement="right" title="Click here to go to your profile" href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>"><?php echo htmlspecialchars($this->organization->name ) ?></a></li>
    <li><a data-toggle="tooltip" data-placement="right" title="Click here to go back to the cost data set" href="<?php echo JRoute::_('index.php?view=collection&layout=edit&collection_id=' . $this->collection->collection_id) ?>"><?php echo htmlspecialchars($this->collection->name ) ?></a></li>
    <li><a data-toggle="tooltip" data-placement="right" title="Click here to go back to the cost data set in this years" href="<?php echo JRoute::_('index.php?view=collection&layout=edit&collection_id=' . $this->collection->collection_id . "&active_interval=" . $this->interval->interval_id) ?>"><?php echo $this->interval->toString() ?></a></li>
    <li class="active">Add cost unit</li>
</ol>
<h1>Add cost unit</h1>
<p>Add a new cost unit and map it to the <a data-toggle="tooltip" data-placement="right" title="The framework of comparable costs is the template that was developed to make it easy for you to submit your cost data set information in order to make them comparable with others. Click here to go back to the overview of all cost data sets you have submitted so far" href="<?php echo JRoute::_('/get-started/12-how-does-it-work-compare-costs') ?>">framework of comparable costs</a>.</p>

<?php echo $this->_formView->render(); ?>
