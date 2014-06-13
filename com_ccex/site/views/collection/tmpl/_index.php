<?php foreach ($this->collections as $collection) {
    $collection = CCExHelpersCast::cast('CCExModelsCollection', $collection);
    $this->_showCollection->collection = $collection;
    echo $this->_showCollection->render();
    echo '<br/><br/>';
} ?>
