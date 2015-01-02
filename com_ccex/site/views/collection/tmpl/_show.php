<div class="row collection">
    <a name="collection<?php echo $this->collection->collection_id ?>"></a>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10 col-sm-10 col-xs-9">
                        <h2>
                            <?php echo htmlspecialchars($this->collection->name ) ?> 
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
                                <div class="onoffswitch" data-toggle="tooltip" data-container="body" data-placement="top" title="You cannot make a cost data set public that has no cost units. Please click the 'edit' link next to your cost data set to add cost units to your cost data set.">
                                    <input disabled name="final" id="onoffswitch<?php echo $this->collection->collection_id ?>" type="checkbox" <?php echo (!isset($this->collection->final) || $this->collection->final ? 'checked="true"' : '') ?>>
                                </div>
                            <?php } ?>
                            <input type="hidden" name="collection_id" value="<?php echo $this->collection->collection_id ?>">
                        </form>
                    </div>
                </div>
            </div>
            <?php if($this->collection->description){ ?>
                <div class="col-md-12">
                    <p><?php echo htmlspecialchars($this->collection->description ) ?></p>
                </div>
            <?php } ?>
        </div>
        <?php
            $this->_indexInterval->intervals = $this->collection->intervals();
            $this->_indexInterval->lastInterval = $this->collection->lastInterval();
            $this->_indexInterval->collection = $this->collection;
            echo $this->_indexInterval->render();
        ?>

        <div class="row">
            <div class="col-md-3 col-md-offset-9">
            <a class="btn btn-sm btn-block btn-success" href="<?php echo JRoute::_('index.php?view=collection&layout=edit&collection_id=' . $this->collection->collection_id) ?>"> Edit cost data set</a>
            </div>
        </div>
    </div>
</div>
<script>
    $.fn.bootstrapSwitch.defaults.onText = 'Final';
    $.fn.bootstrapSwitch.defaults.offText = 'Draft';
    $("[name='final']").bootstrapSwitch();
</script>
