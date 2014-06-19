<div class="row collection">
    <div class="container">
        <h2>
            <div class="index">
                #<?php echo $this->index ?>
            </div>
            <?php echo $this->collection->name ?> 
            <small><a href="<?php echo JRoute::_('index.php?view=collection&layout=edit&collection_id=' . $this->collection->collection_id) ?>"><span class="glyphicon glyphicon-edit"></span></a></small>
            <br>
            <small><?php echo $this->collection->scope ?></small>
        </h2>
        <p><?php echo $this->collection->description ?></p>

        <?php
            $this->_indexInterval->intervals = $this->collection->intervals();
            $this->_indexInterval->lastInterval = $this->collection->lastInterval();
            $this->_indexInterval->collection = $this->collection;
            echo $this->_indexInterval->render();
        ?>
    </div>
</div>
