<!-- <div class="row"> -->
    <div class="row">
        <div class="col-md-3">
            <div class="tour-step tour-step-man-add-cost">
                <a href="<?php echo JRoute::_('index.php?view=collection&layout=add') ?>" class="btn btn-success btn-block btn-add-coll">Add new cost data set</a>
            </div>
        </div>
        <div class="col-md-3 col-md-offset-6">
            <div class="tour-step tour-step-man-analyse">
                <div id="analyse-btn-ready" class="analyse-ready analyse-check-ready" style="<?php if(!$this->organization->numberIntervals() || !$this->organization->readyForComparison()){ echo "display: none"; } ?>" data-toggle="tooltip" data-placement="top" title="Click here to see the summary of your submitted costs and compare them with other organisations">
                    <a href="<?php echo JRoute::_('index.php?view=analyse&layout=self') ?>" class="btn btn-success btn-block btn-analyse">
                        Analyse and compare costs
                        <i class="fa fa-angle-right" style="padding-left: 10px"></i>
                    </a>
                </div>
                <div id="analyse-btn-ready" class="analyse-ready analyse-check-not-ready" style="<?php if(!$this->organization->numberIntervals() || $this->organization->readyForComparison()){ echo "display: none"; } ?>" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Thank you for allowing the sharing of your information. To do this, switch your cost data set(s) from Draft to Final mode. You can return to Draft mode anytime you want to update your cost information.">
                    <a href="<?php echo JRoute::_('index.php?view=analyse&layout=self') ?>" class="btn btn-success btn-block btn-analyse">
                        Analyse and compare costs
                        <i class="fa fa-angle-right" style="padding-left: 10px"></i>
                    </a>
                </div>
                <div id="analyse-btn-not-ready" class="analyse-not-ready" style="<?php if($this->organization->numberIntervals()){ echo "display: none"; } ?>" data-toggle="tooltip" data-placement="top" title="Please add cost data sets to be able to analyse and compare costs.">
                    <a id="analyse-btn-disabled" disabled href="<?php echo JRoute::_('index.php?view=analyse&layout=self') ?>" class="btn btn-success btn-block btn-analyse">
                        Analyse and compare costs
                        <i class="fa fa-angle-right" style="padding-left: 10px"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->
