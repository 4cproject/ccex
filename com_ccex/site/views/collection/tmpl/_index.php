<div class="collections">
    <?php for($i=0, $n = count($this->collections);$i<$n;$i++) {
        $collection = CCExHelpersCast::cast('CCExModelsCollection', $this->collections[$i]);
        $this->_showCollection->collection = $collection;
        $this->_showCollection->index = $i+1;
        echo $this->_showCollection->render();
    } ?>
</div>
