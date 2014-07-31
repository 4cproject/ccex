<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>">Compare costs</a></li>
    <li class="active">Analyse and compare costs</li>
</ol>

<h1>Analyse and compare costs</h1>
<p>See the summary of your submitted costs and compare them with other organisations'.</p>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="active"><a href="<?php echo JRoute::_('index.php?view=analyse&layout=self') ?>">My costs</a></li>
  <li><a href="<?php echo JRoute::_('index.php?view=analyse&layout=global') ?>">Global comparison</a></li>
  <li><a href="<?php echo JRoute::_('index.php?view=analyse&layout=peer') ?>">Peer comparison</a></li>
</ul>
<br/>

<p>Analyse how your cost data sets perform throughout time and compare with each other can be a valuable insight.</p>

<form id ="selfComparisonForm">
    <div class="radio">
      <label>
        <input class="updateChartsOnChange" type="radio" name="collectionsMode" id="combinedMode" value="combined" checked>
        All cost data sets combined <small>(<?php echo count($this->collections); ?>)</small>
      </label>
    </div>
    <?php if(count($this->collections)) { ?>
      <div class="radio">
        <label>
          <input class="updateChartsOnChange" type="radio" name="collectionsMode" id="separatedMode" value="separated">
          Separate and select cost data sets:
          <div class="radio" id="collectionsRadios">
          <?php $i = 1 ?>
          <?php foreach ($this->collections as $collection) { ?>
              <div class="checkbox">
                  <label>
                      <input class="updateChartsOnChange collectionCheck" type="checkbox" name="collectionsSelected[]" disabled value="<?php echo $collection->collection_id ?>" checked>
                      <span class="badge">
                          #<?php echo $i; ?>
                      </span> 
                      <?php echo $collection->name; ?>
                  </label>
              </div>
          <?php $i++; ?>
          <?php } ?>
          </div>
        </label>
      </div>
    <?php } ?>
</form>

<?php echo $this->_financialAccounting->render(); ?>
<?php echo $this->_activities->render(); ?>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/serialize-all.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/compare-self.js') ?>"></script>
