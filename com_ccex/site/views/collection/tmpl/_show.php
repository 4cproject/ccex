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
        <div class="pull-right">
            <form class="switchCollection">
                <div class="onoffswitch">
                    <input <?php echo (!isset($this->collection->final) || $this->collection->final ? 'checked="true"' : '') ?> type="checkbox" name="final" class="onoffswitch-checkbox" id="onoffswitch<?php echo $this->collection->collection_id ?>">
                    <label class="onoffswitch-label" for="onoffswitch<?php echo $this->collection->collection_id ?>">
                        <span class="onoffswitch-inner"></span>
                        <span class="onoffswitch-switch"></span>
                    </label>
                </div>
                <input type="hidden" name="collection_id" value="<?php echo $this->collection->collection_id ?>">
            </form>
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
