<div class="row collection">
    <a name="collection<?php echo $this->collection->collection_id ?>"></a>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10 col-sm-10 col-xs-9">
                        <h2>
                            <?php echo htmlspecialchars($this->collection->name ) ?> 
                            <small class="edit"><a href="<?php echo JRoute::_('index.php?view=collection&layout=edit&collection_id=' . $this->collection->collection_id) ?>"> edit</a></small>
                            <br>
                            <small><?php echo $this->collection->scope ?></small>
                        </h2>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-3">
                        <form class="switchCollection pull-right">
                            <?php if($this->collection->haveCosts()){ ?>
                                <div class="onoffswitch">
                                    <input name="final" id="onoffswitch<?php echo $this->collection->collection_id ?>" type="checkbox" <?php echo (!isset($this->collection->final) || $this->collection->final ? 'checked="true"' : '') ?>>
                                </div>
                            <?php } else { ?>
                                <div class="onoffswitch">
                                    <input disabled name="final" id="onoffswitch<?php echo $this->collection->collection_id ?>" type="checkbox" <?php echo (!isset($this->collection->final) || $this->collection->final ? 'checked="true"' : '') ?>>
                                </div>
                            <?php } ?>
                            <input type="hidden" name="collection_id" value="<?php echo $this->collection->collection_id ?>">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <p><?php echo htmlspecialchars($this->collection->description ) ?></p>
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
<script>
    $.fn.bootstrapSwitch.defaults.onText = 'Final';
    $.fn.bootstrapSwitch.defaults.offText = 'Draft';
    $("[name='final']").bootstrapSwitch();
</script>
