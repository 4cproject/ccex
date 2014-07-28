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
      <h3><?php echo $this->currentPeer->name; ?></h3>
      <p>
        The <?php echo $this->currentPeer->name ?> is a <b><?php echo $this->currentPeer->typesToString() ?></b> from <b><?php echo $this->currentPeer->country()->name ?></b> with a digital curation staff of <b>XXXX people</b> and a data volume of <b>XXXX</b>. It has mainly <b>XXXX</b>, <b>XXXX</b> and <b>XXXX</b> assets and has a number of copies policy of <b>XXXX replica</b>.
      </p>
    </div>
    <input type="hidden" name="currentPeer" value="<?php echo $this->currentPeer->organization_id; ?>"/>
  </form>
</div>

<div class="row">
<h2>Analysis</h2>

<?php echo $this->_financialAccounting->render(); ?>
<?php echo $this->_activities->render(); ?>
</div>

<div class="row">
<h2>More information</h2>
<p>If you want to know more about <?php echo $this->currentPeer->name ?> you can request direct contact to exchange information, experiences and more details about their curation costs.</p>
<button style="margin-bottom: 20px" class="btn btn-primary">Request contact with <?php echo $this->currentPeer->name ?></button>
<br/>

<h4>Other peers like you</h4>
<ul>
  <?php foreach ($this->peersLikeYou as $peer) { ?>
    <li><a href="<?php echo JRoute::_('index.php?view=analyse&layout=peer&organization=' . $peer->organization_id) ?>"><?php echo $peer->name ?>, <?php echo $peer->typesToString() ?>, <?php echo $peer->country()->name ?></a></li>
  <?php } ?>
</ul> 

<p>Choose from the <a href="#">complete list of peers</a> which have allowed sharing of their information.</p>
</div>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/serialize-all.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/compare-peer.js') ?>"></script>
