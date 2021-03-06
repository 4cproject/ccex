<?php if($this->organization){ ?>
  <ul class="nav nav-pills nav-wizard" style="margin-bottom: 30px;">
      <li>
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
      <li>
          <div class="nav-wedge"></div>
          <a href="<?php echo JRoute::_('index.php?view=comparecosts&layout=datasets') ?>" class="wizard-label">
              <span class="wizard-number">3</span> 
              Edit cost data sets
              <i class="fa fa-check icon-status analyse-check-ready" style="<?php if(!$this->organization->readyForComparison()){ echo "display: none"; } ?>"></i>        </a>
          <div class="nav-arrow"></div>
      </li>
      <li class="active">
          <div class="nav-wedge"></div>
          <a href="javascript:void(0)" class="wizard-label">
              <span class="wizard-number">4</span> 
              Compare costs 
          </a>
      </li>
  </ul>
<?php } ?>

<!-- <ol class="breadcrumb">
    <li><a data-toggle="tooltip" data-placement="right" title="Click here to go back to the overview of all cost data sets you have submitted so far" href="<?php echo JRoute::_('index.php?view=comparecosts&layout=datasets') ?>">Compare costs</a></li>
    <li class="active">Analyse and compare costs</li>
</ol> -->

<h1>
    Analyse and compare costs
</h1>
<p>See the summary of your submitted costs and compare them with other organisations'. <?php if($this->organization){ ?> Please remember that others can only compare their costs with yours if your cost data sets are marked “Final”. <?php } ?></p> 

<!-- Nav tabs -->
<ul class="nav nav-tabs tour-step tour-step-self-tabs">
  <li class="active"><a href="<?php echo JRoute::_('index.php?view=analyse&layout=self') ?>">My costs</a></li>
  <li><a href="<?php echo JRoute::_('index.php?view=analyse&layout=global') ?>">Global comparison</a></li>
  <li><a href="<?php echo JRoute::_('index.php?view=analyse&layout=peer') ?>">Peer comparison</a></li>
</ul>
<div class="comparison-tab-container">
  <div class="row">
    <div class="col-md-10">
      <p>The graphs below represent a summary of your submitted costs. Analyse and compare your own cost data sets to see how they vary over time and understand spending patterns within your organisation.</p>
    </div>
    <div class="col-md-2">
      <span class="pull-right">
          <a onclick="analyseSelfTour.restart()" class="btn btn-default btn-help tour-step tour-step-help"><i class="fa fa-life-ring"></i> Show help</a>
      </span>
    </div>
  </div>

  <?php if($this->organization){ ?>
    <p style="margin-bottom: 10px">Select which data sets to analyse:</p>
    <div>
      <div class="row">
        <form id ="selfComparisonForm" class="form-inline">
          <div class="col-md-6 tour-step tour-step-self-select-set">
              <nav id="cbp-hrmenu" class="cbp-hrmenu">
                <ul>
                  <li id="my-costs-filters">
                    <a href="javascript:void(0)">
                      <div class="tagsinput">
                        <?php if(count($this->collections)){ ?>
                          <span class="tag selected-filter">All cost data sets combined</span>
                        <?php }else{ ?>
                          <span class="tag selected-filter">No cost data sets</span>
                        <?php } ?>
                        <span class="tag pull-right"><i class="fa fa-angle-down"></i></span>
                      </div>
                    </a>
                    <div class="cbp-hrsub">
                      <div class="cbp-hrsub-inner"> 
                        <div class="radio">
                          <?php if(count($this->collections)){ ?>
                            <label>
                              <input data-update="general" class="generalCheck" type="radio" name="collectionsMode" id="combinedModeAll" value="combinedAll" checked>
                              <span class="filter-title">All cost data sets combined</span>
                              <small><span class="label label-default label-draft"><?php echo count($this->collections); ?></span></small>
                            </label>
                          <?php }else{ ?>
                            <label class="label-disabled">
                              <input data-update="general" class="generalCheck" type="radio" name="collectionsMode" id="combinedModeAll" value="combinedAll" disabled>
                              <span class="filter-title">All cost data sets combined</span>
                              <small><span class="label label-default label-draft"><?php echo count($this->collections); ?></span></small>
                            </label>
                          <?php } ?>
                        </div>
                        <div class="radio">
                          <?php if($this->organization->readyForComparison()){ ?>
                            <label>
                              <input data-update="general" class="generalCheck" type="radio" name="collectionsMode" id="combinedModeFinal" value="combinedFinal">
                              <span class="filter-title">Final cost data sets combined</span>
                              <small><span class="label label-default label-draft"><?php echo count($this->collectionsFinal); ?></span></small>
                            </label>
                          <?php }else{ ?>
                            <label class="label-disabled">
                              <input data-update="general" class="generalCheck" type="radio" name="collectionsMode" id="combinedModeFinal" value="combinedFinal" disabled="">
                              <span class="filter-title">Final cost data sets combined</span>
                              <small><span class="label label-default label-draft"><?php echo count($this->collectionsFinal); ?></span></small>
                            </label>
                          <?php } ?>
                        </div>
                        <div>
                          <?php if(count($this->collections)) { ?>
                            <div class="radio">
                              <label>
                                  <input data-update="singular" class="generalCheck" type="radio" name="collectionsMode" id="separatedMode" value="separated">
                                  Separate and select cost data sets:
                              </label>
                            </div>
                            <div class="radio" id="collectionsRadios" style="margin-right: 15px">
                              <?php $i = 1 ?>
                              <?php foreach ($this->collections as $collection) { 
                                $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection); ?>
                                
                                <div class="row" style="margin-left: 20px;">
                                  <label>
                                    <input data-update="singular" class="collectionCheck" style="margin-top: 8px;" type="checkbox" name="collectionsSelected[]" disabled value="<?php echo $collection->collection_id ?>"  checked> 
                                    <span class="badge">#<?php echo $i; ?></span> 
                                    <span class="filter-title"><?php echo htmlspecialchars($collection->name) ; ?></span>
                                    <?php if(!$collection->final){ ?>
                                        <small><span class="label label-default label-draft">Draft</span></small>
                                    <?php }else{ ?>  
                                        <small><span class="label label-default label-draft">Final</span></small>
                                    <?php } ?>  
                                  </label>          
                              </div>
                              <?php $i++; ?>
                              <?php } ?>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </nav>
          </div>
        </form>
      </div>
      <div style="margin-top: 15px; margin-bottom: 35px;">
        <div class="tour-step tour-step-self-manage-costs" style="display: inline-block">
          <a class="btn btn-success btn-xs" href="<?php echo JRoute::_('index.php?view=comparecosts&layout=datasets') ?>">Manage cost data sets</a>
        </div>
      </div>
    </div>
    <?php echo $this->_activities->render(); ?>
    <?php echo $this->_financialAccounting->render(); ?>


    <!-- Action -->
    <div class="form-group utils">
      <div class="col-sm-3 col-sm-offset-9 tour-step tour-step-self-go-global">
          <a class="btn btn-success btn-block btn-border btn-go" href="<?php echo JRoute::_('index.php?view=analyse&layout=global') ?>">Global comparison <i class="fa fa-fw fa-angle-right"></i></span></a>
      </div>
    </div>

    <div class="clearfix"></div>
  <?php }else{ ?>
    <div class="alert alert-warning fade in" role="alert" style="padding: 12px;border-radius: 0; display: table; width: 100%">
      <p><a href="<?php echo JRoute::_('index.php?option=com_users&view=login&redirect_url=analyseself') ?>"><strong>Sign in</strong></a> to define your organisation costs. Don't have an account? <a href="<?php echo JRoute::_('index.php?option=com_users&view=registration&redirect_url=analyseself') ?>"><strong>Sign up</strong></a> now!</a></p>
      <div>
        <a href="<?php echo JRoute::_('index.php?option=com_users&view=login&redirect_url=analyseself') ?>" class="btn btn-default btn-xs pull-right">Sign in</a>
        <a href="<?php echo JRoute::_('index.php?option=com_users&view=registration&redirect_url=analyseself') ?>" class="btn btn-default btn-xs pull-right">Sign up</a>
      </div>
    </div>
  <?php } ?>
</div>

<input type="hidden" id="configuration_max_years" name="configuration_max_years" value="<?php echo $this->configuration_max_years; ?>">

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/serialize-all.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/compare-self.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/cbpHorizontalMenu.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/analyse_self_tour.js') ?>"></script>
<script>
    $(function() {
        cbpHorizontalMenu.init();
    });
</script>
