<ul class="nav nav-pills nav-wizard" style="margin-bottom: 30px;">
    <li class="active">
        <a href="javascript:void(0)" class="wizard-label">
            <span class="wizard-number">1</span> 
            Create your organization 
            <i class="fa fa-check icon-status"></i>
        </a>
        <div class="nav-arrow"></div>
    </li>
    <li>
        <div class="nav-wedge"></div>
        <a href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>" class="wizard-label">
            <span class="wizard-number">2</span> 
            Add cost data sets 
            <i class="fa fa-check icon-status analyse-ready" style="<?php if(!$this->organization->readyForComparison()){ echo "display: none"; } ?>"></i>
        </a>
        <div class="nav-arrow"></div>
    </li>
    <li class="analyse-ready last-child" style="<?php if(!$this->organization->readyForComparison()){ echo "display: none"; } ?>">
        <div class="nav-wedge"></div>
        <a href="<?php echo JRoute::_('index.php?view=analyse&layout=self') ?>" class="wizard-label">
            <span class="wizard-number">3</span> 
            Analyse and compare costs 
        </a>
    </li>
    <li class="wizard-li-lock analyse-not-ready" style="<?php if($this->organization->readyForComparison()){ echo "display: none"; } ?>">
        <div class="nav-wedge"></div>
        <a href="javascript:void(0)" class="wizard-label wizard-label-lock">
            <span class="wizard-number">3</span> 
            Analyse and compare costs 
            <i class="fa fa-lock icon-status"></i>
        </a>
    </li>
</ul>

<!-- <ol class="breadcrumb">
	<li><a data-toggle="tooltip" data-placement="right" title="Click here to go back to the overview of all cost data sets you have submitted so far" href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>">Compare costs</a></li>
	<li class="active"><?php echo htmlspecialchars($this->organization->name ) ?></li>
</ol> -->

<h1>Edit your organization</h1>
<p>Please fill out the following profile information for your organisation to help identify your cost determinants and enable a comparison of costs against similar organisations. None of the information will be shared unless you explicitly allow this.</p>

<?php echo $this->_formView->render(); ?>
