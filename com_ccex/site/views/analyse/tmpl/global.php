<ul class="nav nav-pills nav-wizard" style="margin-bottom: 30px;">
    <li>
        <a href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>" class="wizard-label">
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
            <i class="fa fa-check icon-status"></i>
        </a>
        <div class="nav-arrow"></div>
    </li>
    <li class="active">
        <div class="nav-wedge"></div>
        <a href="javascript:void(0)" class="wizard-label">
            <span class="wizard-number">3</span> 
            Analyse and compare costs 
        </a>
    </li>
</ul>

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
  <form id ="globalComparisonForm">
    <div class="form-inline col-md-6">
      <h4>My costs</h4>
      <p class="small" style="margin-bottom: 5px">Select which data sets to analyse:</p>
      <label class="radio-inline">
        <input class="updateChartsOnChange" type="radio" name="collectionsMode" id="combinedMode" value="combined" checked>
        All cost data sets combined <small>(<?php echo count($this->collections); ?>)</small>
      </label>
      
      <select class="form-control input-xs updateChartsOnChange organizationSelect" style="margin-left: 5px;" name="organizationYearSelected">
        <option value="all">All years</option>
        <?php foreach (array_keys($this->organization->years()) as $year) { ?>
          <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
        <?php } ?>
      </select>
      <br/>
      <?php if(count($this->collections)) { ?>
        <label class="radio-inline col-xs-12">
            <input class="updateChartsOnChange" type="radio" name="collectionsMode" id="separatedMode" value="separated">
            Separate and select cost data sets:
        </label>

        <div class="radio" id="collectionsRadios">
          <?php $i = 1 ?>
          <?php foreach ($this->collections as $collection) { 
            $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection); ?>
            
            <div class="row" style="margin-left: 20px;">
              <label class="checkbox-inline">
                <input class="updateChartsOnChange collectionCheck" type="checkbox" name="collectionsSelected[]" disabled value="<?php echo $collection->collection_id ?>"  <?php if($i<=3){echo "checked";} ?>> 
                <span class="badge">#<?php echo $i; ?></span> 
                <?php echo htmlspecialchars($collection->name) ; ?>
              </label>
              <select class="form-control input-xs updateChartsOnChange collectionSelect" name="yearsSelected[<?php echo $collection->collection_id ?>]">
                <option value="all">All years</option>
                  <?php foreach (array_keys($collection->years()) as $year) { ?>
                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                  <?php } ?>
              </select>
            </div>

          <?php $i++; ?>
          <?php } ?>
        </div>
      <?php } ?>

    </div>
    <div class="col-md-6">
      <h4>Other organisations costs</h4>
      <p class="small" style="margin-bottom: 0px; line-height: 15px;">You can filter the characteristics of the organisations or data sets against which your data sets are compared, by selecting the options below:</p>
      <?php foreach (array_slice($this->options, 0, count($this->collections) + 2) as $option) { ?>
        <?php if($option["enable"]) { ?>
          <div class="radio">
            <label>
              <input class="updateChartsOnChange" <?php if($option["active"]){ echo "checked"; } ?> type="radio" name="otherOrganisationsCosts" value="<?php echo $option["type"]; ?>|<?php echo $option["filter"]; ?>|<?php echo $option["value"]; ?>|<?php echo $option["title"]; ?>">
                <?php echo $option["title"]; ?> <small>(<?php echo $option["number"]; ?>)</small>
            </label>
          </div>
        <?php } else { ?>
          <div class="radio">
            <label  style="color: #999" data-toggle="tooltip" data-placement="right" data-container="body" title="<?php echo $option["tooltip"]; ?>">
              <input class="updateChartsOnChange" type="radio" name="otherOrganisationsCosts" value="<?php echo $option["type"]; ?>|<?php echo $option["filter"]; ?>|<?php echo $option["value"]; ?>" disabled>
                <?php echo $option["title"]; ?> <small>(<?php echo $option["number"]; ?>)</small>
            </label>
          </div>
        <?php } ?>
      <?php } ?>
      <?php if(count($this->options) > count($this->collections) + 2) { ?>
        <div id="other-filters" class="other-filters" style="display:none">
          <?php foreach (array_slice($this->options, count($this->collections) + 2) as $option) { ?>
            <?php if($option["enable"]) { ?>
              <div class="radio">
                <label>
                  <input class="updateChartsOnChange" <?php if($option["active"]){ echo "checked"; } ?> type="radio" name="otherOrganisationsCosts" value="<?php echo $option["type"]; ?>|<?php echo $option["filter"]; ?>|<?php echo $option["value"]; ?>|<?php echo $option["title"]; ?>">
                    <?php echo $option["title"]; ?> <small>(<?php echo $option["number"]; ?>)</small>
                </label>
              </div>
            <?php } else { ?>
              <div class="radio">
                <label  style="color: #999" data-toggle="tooltip" data-placement="right" data-container="body" title="<?php echo $option["tooltip"]; ?>">
                  <input class="updateChartsOnChange" type="radio" name="otherOrganisationsCosts" value="<?php echo $option["type"]; ?>|<?php echo $option["filter"]; ?>|<?php echo $option["value"]; ?>" disabled>
                    <?php echo $option["title"]; ?> <small>(<?php echo $option["number"]; ?>)</small>
                </label>
              </div>
            <?php } ?>
          <?php } ?>
        </div>
        <div id="see-all-filters" class="see-all-filters">
          <i class="fa fa-angle-down"></i> 
          <small>See all filters</small>
        </div>
      <?php } ?>
    </div>
  </form>
</div>

<?php echo $this->_financialAccounting->render(); ?>
<?php echo $this->_activities->render(); ?>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/serialize-all.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/compare-global.js') ?>"></script>
