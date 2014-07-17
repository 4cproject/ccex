<ol class="breadcrumb">
  <li><a href="costs.html">Compare costs</a></li>
  <li class="active">Analyse and compare costs</li>
</ol>
<h1>Analyse and compare costs</h1>
<p>See the summary of your submitted costs and compare them with other organisations'.</p>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="active"><a href="#">My costs</a></li>
  <li><a href="#">Global comparison</a></li>
  <li><a href="#">Peer comparison</a></li>
</ul>
<br/>

<p>Analyse how your collections perform throughout time and compare with each other can be a valuable insight.</p>

<form id ="collectionsSelectedForm">
    <div class="radio">
      <label>
        <input class="updateChartsOnChange" type="radio" name="collectionsMode" id="combinedMode" value="combined" checked>
        All collections combined <small>(<?php echo count($this->collections); ?>)</small>
      </label>
    </div>
    <div class="radio">
      <label>
        <input class="updateChartsOnChange" type="radio" name="collectionsMode" id="separatedMode" value="separated">
        Separate and select collections:
        <div class="radio" id="collectionsRadios">
        <?php $i = 1 ?>
        <?php foreach ($this->collections as $collection) { ?>
            <div class="checkbox">
                <label>
                    <input class="updateChartsOnChange collectionCheck" type="checkbox" name="collectionsSelected[]" disabled value="<?php echo $collection->collection_id ?>" <?php if($i<=3){echo "checked";} ?>>
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
</form>

<?php echo $this->_financialAccounting->render(); ?>
<?php echo $this->_activities->render(); ?>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/serialize-all.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/compare-self.js') ?>"></script>
