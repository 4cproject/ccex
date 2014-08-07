<div class="container">
    <div class="row">
        <div class="col-md-3">
            <a href="<?php echo JRoute::_('index.php?view=collection&layout=add') ?>" class="btn btn-success btn-block">Add new cost data set</a>
        </div>
        <div class="col-md-3 col-md-offset-6">
            <a id="analyse-btn-ready" style="<?php if(!$this->organization->readyForComparison()){ echo "display: none"; } ?>" href="<?php echo JRoute::_('index.php?view=analyse&layout=self') ?>" class="btn btn-info btn-block">
                Analyse and compare costs
                <i class="fa fa-angle-right" style="padding-left: 10px"></i>
            </a>
            <div id="analyse-btn-not-ready" style="<?php if($this->organization->readyForComparison()){ echo "display: none"; } ?>" data-toggle="tooltip" data-placement="top" title="Please add cost data sets to be able to analyse and compare costs. Draft costs data sets are ignored in the comparison">
                <a id="analyse-btn-disabled" disabled href="<?php echo JRoute::_('index.php?view=analyse&layout=self') ?>" class="btn btn-info btn-block">
                    Analyse and compare costs
                    <i class="fa fa-angle-right" style="padding-left: 10px"></i>
                </a>
            </div>
        </div>
    </div>
</div>
