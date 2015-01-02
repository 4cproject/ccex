<ul class="nav nav-pills nav-wizard" style="margin-bottom: 30px;">
    <li class="">
        <a href="<?php echo JRoute::_('/profile?wizard=true') ?>" class="wizard-label">
            <span class="wizard-number">1</span> 
            Edit my profile
            <i class="fa fa-check icon-status"></i>
        </a>
        <div class="nav-arrow"></div>
    </li>
    <li class="active">
        <div class="nav-wedge"></div>
        <a href="javascript:void(0)" class="wizard-label">
            <span class="wizard-number">2</span> 
            Add organisation
        </a>
        <div class="nav-arrow"></div>
    </li>
    <li class="wizard-li-lock">
        <div class="nav-wedge"></div>
        <a href="javascript:void(0)" class="wizard-label wizard-label-lock">
            <span class="wizard-number">3</span> 
            Add cost data sets
            <i class="fa fa-lock icon-status"></i>
        </a>
        <div class="nav-arrow"></div>
    </li>
    <li class="wizard-li-lock">
        <div class="nav-wedge"></div>
        <a href="javascript:void(0)" class="wizard-label wizard-label-lock">
            <span class="wizard-number">4</span> 
            Compare costs 
            <i class="fa fa-lock icon-status"></i>
        </a>
    </li>
</ul>

<!-- 
<ol class="breadcrumb">
	<li><a data-toggle="tooltip" data-placement="right" title="Click here to go back to the overview of all cost data sets you have submitted so far" href="<?php echo JRoute::_('index.php?view=comparecosts&layout=datasets') ?>">Compare costs</a></li>
	<li class="active">Create profile</li>
</ol> -->

<h1>
    Create your organisation
    <span class="pull-right">
        <a onclick="organizationTour.restart()" class="btn btn-default btn-help tour-step tour-step-help"><i class="fa fa-life-ring"></i> Show help</a>
        <!-- <i title="Need help? Start tour" onclick="organizationTour.restart()" class="fa fa-question-circle text-primary icon-link"></i> -->
    </span> 
</h1>

<p>Please fill out the following profile information for your organisation to help identify your cost determinants and enable a comparison of costs against similar organisations. None of the information will be shared unless you explicitly allow this.</p>

<?php echo $this->_formView->render(); ?>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/organization_tour.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/help_tour.js') ?>"></script>
<script>
    helpTour.restart();
</script>
