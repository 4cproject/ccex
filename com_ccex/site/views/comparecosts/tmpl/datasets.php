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
        <a href="javascript:void(0)" class="wizard-label">
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

    <li class="analyse-ready analyse-check-ready last-child" style="<?php if(!$this->organization->Intervals() || !$this->organization->readyForComparison()){ echo "display: none"; } ?>" >
        <div class="nav-wedge"></div>
        <a href="<?php echo JRoute::_('index.php?view=analyse&layout=self') ?>" class="wizard-label">
            <span class="wizard-number">4</span> 
            Compare costs 
        </a>
    </li>
    <li class="analyse-ready analyse-check-not-ready last-child" style="<?php if(!$this->organization->Intervals() || $this->organization->readyForComparison()){ echo "display: none"; } ?>" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Thank you for allowing the sharing of your information. To do this, switch your cost data set(s) from Draft to Final mode. You can return to Draft mode anytime you want to update your cost information.">
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

<h1>
    Manage cost data sets
    <span class="pull-right">
        <?php if($this->organization->collections()){ ?>
            <a onclick="notEmptyManageTour.restart()" class="btn btn-default btn-help tour-step tour-step-help"><i class="fa fa-life-ring"></i> Show help</a>
        <?php }else{ ?>
            <a onclick="emptyManageTour.restart()" class="btn btn-default btn-help tour-step tour-step-help"><i class="fa fa-life-ring"></i> Show help</a>
        <?php } ?>
    </span>
</h1>
<p>
    <?php if($this->organization->collections()){ ?>
        Please remember to add cost units to your cost data set(s) by clicking ‘Edit cost data set’. When your cost data set is complete, remember to switch it from Draft to Final mode to share your information and enable comparisons.
    <?php }else{ ?>
        A cost data set covers the curation costs of an organisation, a department, a collection or a project. Each cost data set normally consists of a total cost and detailed costs. For example, the total cost of a digitisation project includes detailed costs for hardware, software, scanning, quality assurance, etc.
    <?php } ?>
</p>

<?php echo $this->_indexCollection->render(); ?>
<?php echo $this->_utilitiesOrganization->render(); ?>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/compare_costs.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/manage_tour.js') ?>"></script>
<script>
    if(<?php if($this->organization->collections()){ echo "true"; }else{ echo "false"; } ?> && emptyManageTour.tour.ended()){
        notEmptyManageTour.start();
    }
</script>
