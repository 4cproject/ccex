<div class="row collection">
    <a name="collection<?php echo $this->collection->collection_id ?>"></a>
    <div class="container">
        <div class="pull-left">
            <h2>
                <div class="index">
                    #<?php echo $this->index ?>
                </div>
                <?php echo $this->collection->name ?> 
                <small><a href="<?php echo JRoute::_('index.php?view=collection&layout=edit&collection_id=' . $this->collection->collection_id) ?>"><span class="fa fa-edit"></span></a></small>
                <br>
                <small><?php echo $this->collection->scope ?></small>
            </h2>
            <p><?php echo $this->collection->description ?></p>
        </div>
        <div class="clearfix"></div>
        <?php
            $this->_indexInterval->intervals = $this->collection->intervals();
            $this->_indexInterval->lastInterval = $this->collection->lastInterval();
            $this->_indexInterval->collection = $this->collection;
            echo $this->_indexInterval->render();
        ?>
    </div>
</div>
