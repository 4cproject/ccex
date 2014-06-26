<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>">Compare costs</a></li>
    <li><a href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>"><?php echo $this->organization->name ?></a></li>
    <li><a href="<?php echo JRoute::_('index.php?view=collection&layout=edit&collection_id=' . $this->collection->collection_id) ?>"><?php echo $this->collection->name ?></a></li>
    <li><a href="<?php echo JRoute::_('index.php?view=collection&layout=edit&collection_id=' . $this->organization->organization_id . "&active_interval=" . $this->interval->interval_id) ?>"><?php echo $this->interval->toString() ?></a></li>
    <li class="active">Add cost unit</li>
</ol>
<h1>Add cost unit</h1>
<p>Add a new cost unit and map it to the <a href="<?php echo JRoute::_('#ABOUT#FRAMEWORK') ?>">framework of comparable costs</a>.</p>

<?php echo $this->_formView->render(); ?>
