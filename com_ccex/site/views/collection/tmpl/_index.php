<div class="row collections">
    <?php if(count($this->collections) == 0) { ?>
        <div class="container">
            <div class="collections-empty">Click the button below to add a new cost data set.</div>
        </div>
    <?php } else { 
    
        for($i=0, $n = count($this->collections);$i<$n;$i++) {
            $collection = CCExHelpersCast::cast('CCExModelsCollection', $this->collections[$i]);
            $this->_showCollection->collection = $collection;
            $this->_showCollection->index = $i+1;
            echo $this->_showCollection->render();
        }

    } ?>
</div>
