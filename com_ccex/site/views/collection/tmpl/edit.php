<ul class="nav nav-pills nav-wizard" style="margin-bottom: 30px;">
    <li class="">
        <a href="<?php echo JRoute::_('/profile?wizard=true') ?>" class="wizard-label">
            <span class="wizard-number">1</span> 
            Edit my profile
            <i class="fa fa-check icon-status"></i>
        </a>
        <div class="nav-arrow"></div>
    </li>
    <li>
      <div class="nav-wedge"></div>
      <a href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>" class="wizard-label">
          <span class="wizard-number">2</span> 
          Edit organisation
          <i class="fa fa-check icon-status"></i>
      </a>
      <div class="nav-arrow"></div>
    </li>
    <li class="active">
        <div class="nav-wedge"></div>
        <a href="<?php echo JRoute::_('index.php?view=comparecosts&layout=datasets') ?>" class="wizard-label">
            <span class="wizard-number">3</span> 
            Edit cost data set
            <i class="fa fa-check icon-status analyse-check-ready" style="<?php if(!$this->organization->readyForComparison()){ echo "display: none"; } ?>"></i>
        </a>
        <div class="nav-arrow"></div>
    </li>
    <li class="analyse-ready last-child" style="<?php if(!$this->organization->Intervals()){ echo "display: none"; } ?>">
        <div class="nav-wedge"></div>
        <a href="<?php echo JRoute::_('index.php?view=analyse&layout=self') ?>" class="wizard-label">
            <span class="wizard-number">4</span> 
            Compare costs 
        </a>
    </li>
    <li class="wizard-li-lock analyse-not-ready" style="<?php if($this->organization->Intervals()){ echo "display: none"; } ?>">
        <div class="nav-wedge"></div>
        <a href="javascript:void(0)" class="wizard-label wizard-label-lock">
            <span class="wizard-number">4</span> 
            Compare costs 
            <i class="fa fa-lock icon-status"></i>
        </a>
    </li>
</ul>

<ol class="breadcrumb">
    <li><a data-toggle="tooltip" data-placement="right" title="Click here to go to your profile" href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>"><?php echo htmlspecialchars($this->organization->name ) ?></a></li>
    <li><a data-toggle="tooltip" data-placement="right" title="Click here to go back to the overview of all cost data sets you have submitted so far" href="<?php echo JRoute::_('index.php?view=comparecosts&layout=datasets') ?>">Cost data sets</a></li>
    <li class="active"><?php echo htmlspecialchars($this->collection->name ) ?></li>
</ol>

<h1>
    Edit cost data set
    <span class="pull-right">
        <a onclick="editCollectionTour.restart()" class="btn btn-default btn-help tour-step tour-step-help"><i class="fa fa-life-ring"></i> Show help</a>
    </span>
</h1>
<p>Please fill out the following information for your cost data set and your content to help identify your cost determinants and enable a comparison of costs against similar organisations. This information is used to nuance and give sense to the submitted cost data. For example, the information "Data volume" will enable the calculation of costs per gigabyte, terabyte, petabyte...</p>

<?php echo $this->_formView->render(); ?>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/collection_tour.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/help_tour.js') ?>"></script>
<script>
    if(<?php if(count($this->organization->costs()) == 1){ echo "true"; }else{ echo "false"; } ?> && newCollectionTour.tour.ended()){
        partialCollectionTour.start();
    }
</script>
