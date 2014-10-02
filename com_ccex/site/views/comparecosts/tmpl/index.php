<ul class="nav nav-pills nav-wizard" style="margin-bottom: 30px;">
    <li class="">
        <a href="<?php echo JRoute::_('/profile') ?>" class="wizard-label">
            <span class="wizard-number">1</span> 
            Sign in
            <i class="fa fa-check icon-status"></i>
        </a>
        <div class="nav-arrow"></div>
    </li>
    <li>
      <div class="nav-wedge"></div>
      <a href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>" class="wizard-label">
          <span class="wizard-number">2</span> 
          Organisation profile 
          <i class="fa fa-check icon-status"></i>
      </a>
      <div class="nav-arrow"></div>
    </li>
    <li class="active">
        <div class="nav-wedge"></div>
        <a href="javascript:void(0)" class="wizard-label">
            <span class="wizard-number">3</span> 
            Cost data sets 
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

<h1>Cost data sets</h1>
<p>Define your cost data sets, describe the associated curation costs and map them to the categories of our <a data-toggle="tooltip" data-placement="right" title="The framework of comparable costs is the template that was developed to make it easy for you to submit your cost data set information in order to make them comparable with others." href="<?php echo JRoute::_('/get-started/12-how-does-it-work-compare-costs') ?>">framework of comparable costs</a>.</p>

<?php echo $this->_indexCollection->render(); ?>
<?php echo $this->_utilitiesOrganization->render(); ?>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/compare_costs.js') ?>"></script>
