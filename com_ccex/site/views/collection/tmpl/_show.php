<h2>
	<?php echo $this->collection->name ?> 
	<small><a style="opacity:0.6" href="<?php echo JRoute::_('index.php?view=collection&layout=edit&collection_id=' . $this->collection->collection_id) ?>"><span class="glyphicon glyphicon-edit"></span></a></small>
	<br>
	<small><?php echo $this->collection->scope ?></small>
</h2>
<p><?php echo $this->collection->description ?></p>

<?php
    $this->_indexInterval->intervals = $this->collection->intervals();
    $this->_indexInterval->lastInterval = $this->collection->lastInterval();
    echo $this->_indexInterval->render();
?>
