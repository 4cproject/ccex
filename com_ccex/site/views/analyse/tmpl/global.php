<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>">Compare costs</a></li>
    <li class="active">Analyse and compare costs</li>
</ol>

<h1>Analyse and compare costs</h1>
<p>See the summary of your submitted costs and compare them with other organisations'.</p>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li><a href="<?php echo JRoute::_('index.php?view=analyse&layout=self') ?>">My costs</a></li>
  <li class="active"><a href="<?php echo JRoute::_('index.php?view=analyse&layout=global') ?>">Global comparison</a></li>
  <li><a href="<?php echo JRoute::_('index.php?view=analyse&layout=peer') ?>">Peer comparison</a></li>
</ul>
<br/>

<p>Comparing your costs with a group of organisations shows how well you are performing against the average. You can filter the comparison to show only organisations which have similar characteristics to yours.</p>
<div class="row">
  <form id ="globalComparisonForm">
    <div class="form-inline col-md-6">
      <h4>My costs</h4>
      <label class="radio-inline">
        <input class="updateChartsOnChange" type="radio" name="collectionsMode" id="combinedMode" value="combined" checked>
        All collections combined <small>(<?php echo count($this->collections); ?>)</small>
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
            Separate and select collections:
        </label>

        <div class="radio" id="collectionsRadios">
          <?php $i = 1 ?>
          <?php foreach ($this->collections as $collection) { 
            $collection = CCExHelpersCast::cast('CCExModelsCollection',  $collection); ?>
            
            <div class="row" style="margin-left: 20px;">
              <label class="checkbox-inline">
                <input class="updateChartsOnChange collectionCheck" type="checkbox" name="collectionsSelected[]" disabled value="<?php echo $collection->collection_id ?>"  <?php if($i<=3){echo "checked";} ?>> 
                <span class="badge">#<?php echo $i; ?></span> 
                <?php echo $collection->name; ?>
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
      <?php foreach ($this->options as $option) { ?>
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
  </form>
</div>

<?php echo $this->_financialAccounting->render(); ?>
<?php echo $this->_activities->render(); ?>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/serialize-all.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/compare-global.js') ?>"></script>
