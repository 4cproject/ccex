<div class="row collection">
    <a name="collection<?php echo $this->collection->collection_id ?>"></a>
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-sm-10 col-xs-9">
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
            <div class="col-md-1 col-sm-2 col-xs-3">
                <form class="switchCollection">
                    <?php if($this->collection->haveCosts()){ ?>
                        <div class="onoffswitch">
                            <input <?php echo (!isset($this->collection->final) || $this->collection->final ? 'checked="true"' : '') ?> type="checkbox" name="final" class="onoffswitch-checkbox" id="onoffswitch<?php echo $this->collection->collection_id ?>">
                            <label class="onoffswitch-label" for="onoffswitch<?php echo $this->collection->collection_id ?>">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    <?php } else { ?>
                        <div class="onoffswitch" style="opacity: 0.6;" data-toggle="tooltip" data-placement="top" title="Please add costs to be able to finalize this cost data set">
                            <input disabled="" <?php echo (!isset($this->collection->final) || $this->collection->final ? 'checked="true"' : '') ?> type="checkbox" name="final" class="onoffswitch-checkbox" id="onoffswitch<?php echo $this->collection->collection_id ?>">
                            <label class="onoffswitch-label" for="onoffswitch<?php echo $this->collection->collection_id ?>">
                                <span class="onoffswitch-inner"></span>
                                <span class="onoffswitch-switch"></span>
                            </label>
                        </div>
                    <?php } ?>
                    <input type="hidden" name="collection_id" value="<?php echo $this->collection->collection_id ?>">
                </form>
            </div>
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
