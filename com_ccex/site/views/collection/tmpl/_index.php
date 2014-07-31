<div class="row collections">
    <?php if(count($this->collections) == 0) { ?>
        <div class="container">
            <div class="collections-empty">There are no cost data sets, please add some in the button below.</div>
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
