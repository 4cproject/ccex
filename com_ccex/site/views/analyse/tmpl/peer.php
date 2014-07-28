<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>">Compare costs</a></li>
    <li class="active">Analyse and compare costs</li>
</ol>

<h1>Analyse and compare costs</h1>
<p>See the summary of your submitted costs and compare them with other organisations'.</p>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li><a href="<?php echo JRoute::_('index.php?view=analyse&layout=self') ?>">My costs</a></li>
  <li><a href="<?php echo JRoute::_('index.php?view=analyse&layout=global') ?>">Global comparison</a></li>
  <li class="active"><a href="<?php echo JRoute::_('index.php?view=analyse&layout=peer') ?>">Peer comparison</a></li>
</ul>
<br/>

<p>Compare your costs with another organisation to pin-point challenges and get in contact with organizations that can help you learn from their experiences.</p>

<div class="row">
  <form id ="peerComparisonForm">
    <div class="form-inline col-md-6">
      <h3>My costs</h3>
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

    </div>
    <div class="col-md-6">
      <h3>Universidade do Minho</h3>
      <p>
        The Universidade do Minho is a <b>University</b> from <b>Portugal</b> with a digital curation staff of <b>less than 50 people</b> and a data volume of more than <b>10 Terabytes</b>. It has mainly <b>Unformatted text</b>, <b>word processing</b> and <b>research data</b> assets and has a number of copies policy of <b>one replica</b>.
      </p>
    </div>
  </form>
</div>

<div class="row">
<h2>Analysis</h2>

<?php echo $this->_financialAccounting->render(); ?>
<?php echo $this->_activities->render(); ?>
</div>

<div class="row">
<h2>More information</h2>
<p>If you want to know more about Universidade do Minho you can request direct contact to exchange information, experiences and more details about their curation costs.</p>
<button style="margin-bottom: 20px" class="btn btn-primary">Request contact with Universidade do Minho</button>
<br/>

<h4>Other peers like you</h4>
<ul>
  <li><a href="#">INESC, University, Portugal</a></li>
  <li><a href="#">University of Edinburg, University, United Kingdom</a></li>
  <li><a href="#">University of Glagow, University, United Kingdom</a></li>
  <li><a href="#">University of Essex, University, United Kingdom</a></li>
</ul> 

<p>Choose from the <a href="#">complete list of peers</a> which have allowed sharing of their information.</p>
</div>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/serialize-all.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/compare-peer.js') ?>"></script>
