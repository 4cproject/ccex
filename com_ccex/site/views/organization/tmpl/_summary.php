<div class="row summary">
    <div class="container">
        <h2>Summary</h2><br/>
        <div class="row">
            <div class="col-md-6">
                <dl class="dl-horizontal" >
                    <dt>Number of collections</dt>
                    <dd><?php echo $this->organization->numberCollections() ?></dd>          
                    <dt>Number of year spans</dt>
                    <dd><?php echo $this->organization->numberIntervals() ?></dd>
                    <dt>Duration</dt>
                    <dd><?php echo $this->organization->totalDuration() ?></dd>
                    <dt>Cost</dt>
                    <dd><?php echo $this->organization->formattedTotalCost() ?></dd>
                    <dt>Cost per GB</dt>
                    <dd><?php echo $this->organization->formattedSumCostPerGB() ?></dd>
                    <dt>Cost per Year</dt>
                    <dd><?php echo $this->organization->formattedTotalCostPerYear() ?></dd>
                    <dt>Cost per GB per Year</dt>
                    <dd><?php echo $this->organization->formattedTotalCostPerGBPerYear() ?></dd>
                    <dt>Map to activities</dt>
                    <dd><?php echo $this->organization->percentageActivityMapping() ?>%</dd>
                    <dt style='white-space: normal;'>Map to financial accounting</dt>
                    <dd><?php echo $this->organization->percentageFinancialAccountingMapping() ?>%</dd>
                </dl>
            </div>
            <div class="col-md-6">
                <a href="<?php echo JRoute::_('index.php?view=collection&layout=add') ?>" class="btn btn-default btn-block">Add new collection</a>
                <a href="<?php echo JRoute::_('#RESULTS') ?>" class="btn btn-danger btn-block">Compare costs with other organisations</a>
            </div>
        </div>
    </div>
    <br/><br/>
</div>
