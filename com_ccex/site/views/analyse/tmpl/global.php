<?php if($this->organization){ ?>
  <ul class="nav nav-pills nav-wizard" style="margin-bottom: 30px;">
      <li>
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
              Organization profile 
              <i class="fa fa-check icon-status"></i>
          </a>
          <div class="nav-arrow"></div>
      </li>
      <li>
          <div class="nav-wedge"></div>
          <a href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>" class="wizard-label">
              <span class="wizard-number">3</span> 
              Cost data sets 
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
    <li><a data-toggle="tooltip" data-placement="right" title="Click here to go back to the overview of all cost data sets you have submitted so far" href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>">Compare costs</a></li>
    <li class="active">Analyse and compare costs</li>
</ol> -->

<h1>Analyse and compare costs</h1>
<p>See the summary of your submitted costs and compare them with other organisations'.</p>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li><a href="<?php echo JRoute::_('index.php?view=analyse&layout=self') ?>">My costs</a></li>
  <li class="active"><a href="<?php echo JRoute::_('index.php?view=analyse&layout=global') ?>">Global comparison</a></li>
  <li><a href="<?php echo JRoute::_('index.php?view=analyse&layout=peer') ?>">Peer comparison</a></li>
</ul>
<br/>

<p>The global comparison enables you to see how your costs compare to the average of all other organisations who have submitted cost data sets to the CCEx.</p>

<div class="row">
  <form id="globalComparisonForm" class="form-inline">
    <div class="col-md-6">
      <?php if($this->organization){ ?>
        <h4>
          <?php echo htmlspecialchars($this->organization->name) ?>

          <a class="edit" href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>">
            edit
          </a>
        </h4>
        <p class="small" style="margin-bottom: 17px;">You can select which data sets to analyse, by selecting the options below:</p>
      <?php }else{ ?>
        <h4>Your organisation</h4>
      <?php } ?>
      <?php if($this->organization){ ?>
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
                        <select data-update="general" class="form-control input-xs generalCheck organizationSelectAll pull-right" name="organizationYearSelectedAll">
                          <option value="all">All years</option>
                          <?php foreach (array_keys($this->organization->years()) as $year) { ?>
                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                          <?php } ?>
                        </select>
                      </label>
                    <?php }else{ ?>
                      <label class="label-disabled">
                        <input data-update="general" class="generalCheck" type="radio" name="collectionsMode" id="combinedModeAll" value="combinedAll" disabled>
                        <span class="filter-title">All cost data sets combined</span>
                        <small><span class="label label-default label-draft"><?php echo count($this->collections); ?></span></small>
                        <select data-update="general" class="form-control input-xs generalCheck organizationSelectAll pull-right" name="organizationYearSelectedAll" disabled>
                          <option value="all">All years</option>
                          <?php foreach (array_keys($this->organization->years()) as $year) { ?>
                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                          <?php } ?>
                        </select>
                      </label>
                    <?php } ?>
                  </div>
                  <div class="radio">
                    <?php if($this->organization->readyForComparison()){ ?>
                      <label>
                        <input data-update="general" class="generalCheck" type="radio" name="collectionsMode" id="combinedModeFinal" value="combinedFinal">
                        <span class="filter-title">Final cost data sets combined</span>
                        <small><span class="label label-default label-draft"><?php echo count($this->collectionsFinal); ?></span></small>
                        <select data-update="general" class="form-control input-xs generalCheck organizationSelect organizationSelectFinal pull-right" name="organizationYearSelectedFinal">
                          <option value="all">All years</option>
                          <?php foreach (array_keys($this->organization->years("final")) as $year) { ?>
                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                          <?php } ?>
                        </select>
                      </label>
                    <?php }else{ ?>
                      <label class="label-disabled">
                        <input data-update="general" class="generalCheck" type="radio" name="collectionsMode" id="combinedModeFinal" value="combinedFinal" disabled="">
                        <span class="filter-title">Final cost data sets combined</span>
                        <small><span class="label label-default label-draft"><?php echo count($this->collectionsFinal); ?></span></small>
                        <select data-update="general" class="form-control input-xs generalCheck organizationSelect pull-right" name="organizationYearSelectedFinal" disabled>
                          <option value="all">All years</option>
                          <?php foreach (array_keys($this->organization->years("final")) as $year) { ?>
                            <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                          <?php } ?>
                        </select>
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
                              <input data-update="singular" class="collectionCheck" style="margin-top: 8px;" type="checkbox" name="collectionsSelected[]" disabled value="<?php echo $collection->collection_id ?>"  <?php if($i<=3){echo "checked";} ?>> 
                              <span class="badge">#<?php echo $i; ?></span> 
                              <span class="filter-title"><?php echo htmlspecialchars($collection->name) ; ?></span>
                              <?php if(!$collection->final){ ?>
                                  <small><span class="label label-default label-draft">Draft</span></small>
                              <?php } ?>  
                              <select data-update="singular" class="form-control input-xs collectionSelect generalCheck pull-right" name="yearsSelected[<?php echo $collection->collection_id ?>]">
                                <option value="all">All years</option>
                                  <?php foreach (array_keys($collection->years()) as $year) { ?>
                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                  <?php } ?>
                              </select>
 
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
      <a class="btn btn-primary btn-xs" href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>" style="margin-top: 15px">Manage cost data sets</a>
      <?php }else{ ?>
          <div class="alert alert-warning fade in" role="alert" style="padding: 12px;border-radius: 0; display: table">
            <p style="line-height: 20px"><a href="<?php echo JRoute::_('index.php?option=com_users&view=login&redirect_url=analyseglobal') ?>"><strong>Sign in</strong></a> to define your organisation costs. Don't have an account? <a href="<?php echo JRoute::_('index.php?option=com_users&view=signup&redirect_url=analyseglobal') ?>"><strong>Sign up</strong></a> now!</a></p>
            <div>
              <a href="<?php echo JRoute::_('index.php?option=com_users&view=login&redirect_url=analyseglobal') ?>" class="btn btn-default btn-xs pull-right">Sign in</a>
              <a href="<?php echo JRoute::_('index.php?option=com_users&view=signup&redirect_url=analyseglobal') ?>" class="btn btn-default btn-xs pull-right">Sign up</a>
            </div>
          </div>
      <?php } ?>
    </div>
    <div class="col-md-6">
      <h4>Other organisations</h4>
      <p class="small" style="line-height: 15px;margin-bottom: 15px">You can filter the characteristics of the organisations or data sets against which your data sets are compared, by selecting the options below:</p>
      <nav id="cbp-hrmenu" class="cbp-hrmenu">
        <ul>
          <li id="other-organisations-filters">
            <a href="javascript:void(0)">
              <div class="tagsinput">
                <?php $first = reset($this->options); ?>
                <?php if($first["enable"]) { ?>
                  <span class="tag selected-filter"><?php echo $first["title"]; ?></span>
                <?php } else { ?>
                  <span class="tag selected-filter">No selected organization</span>
                <?php } ?>
                <span class="tag pull-right"><i class="fa fa-angle-down"></i></span>
              </div>
            </a>
            <div class="cbp-hrsub">
              <div class="cbp-hrsub-inner" style="padding: 20px"> 
                <?php foreach ($this->options as $option) { ?>
                  <?php if($option["enable"]) { ?>
                    <div class="radio">
                      <label>
                        <input class="generalCheck" <?php if($option["active"]){ echo "checked"; } ?> type="radio" name="otherOrganisationsCosts" value="<?php echo $option["type"]; ?>|<?php echo $option["filter"]; ?>|<?php echo $option["value"]; ?>|<?php echo $option["title"]; ?>"> 
                        <span class="filter-title"><?php echo $option["title"]; ?></span> 
                        <small class="pull-right"><?php echo $option["number"]; ?></small>
                      </label>
                    </div>
                  <?php } else { ?>
                    <div class="radio">
                      <label  class="label-disabled" data-toggle="tooltip" data-placement="right" data-container="body" title="<?php echo $option["tooltip"]; ?>">
                        <input class="" type="radio" name="otherOrganisationsCosts" value="<?php echo $option["type"]; ?>|<?php echo $option["filter"]; ?>|<?php echo $option["value"]; ?>" disabled> 
                        <span class="filter-title"><?php echo $option["title"]; ?></span> 
                        <small class="pull-right"><?php echo $option["number"]; ?></small>
                      </label>
                    </div>
                  <?php } ?>
                <?php } ?>
              </div>
            </div>
          </li>
        </ul>
      </nav>
    </div>
  </form>
</div>


<?php echo $this->_financialAccounting->render(); ?>
<?php echo $this->_activities->render(); ?>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/serialize-all.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/compare-global.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/cbpHorizontalMenu.js') ?>"></script>
<script>
    $(function() {
        cbpHorizontalMenu.init();
    });
</script>
