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
            <?php if($this->organization->intervals()){ ?>
                Edit cost data sets
            <?php }else{ ?>
                Add cost data sets
            <?php } ?>
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
    <li class="active">Add cost data set</li>
</ol>

<h1 style="display: inline-block">Add cost data set </h1>
<!-- <span class="tour-step tour-step-org-help">
    <a onclick="collectionTour.restart()" style="cursor: pointer">
         Need help? Start Tour 
        <i style="font-size: 12px" class="fa fa-play"></i>
    </a>
</span> -->

<p class="no-margin">You now start a two-step process. On this page you enter information about your costs. On the next page, you enter the costs themselves.</p>

<p>Please fill out the following information for your costs and your digital material (‘Asset types’) to enable a comparison of costs against similar organisations. You can either add costs for the whole organisation or for smaller parts such as a department, a collection or a project (‘Scope’). </p>

<?php echo $this->_formView->render(); ?>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/collection_tour.js') ?>"></script>
