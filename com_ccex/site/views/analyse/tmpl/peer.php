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

<?php if($this->currentPeer){ ?>
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
        <h3><?php echo $this->currentPeer->name; ?></h3>
        <p>
          The <?php echo $this->currentPeer->name ?> is a <b><?php echo $this->currentPeer->typesToString() ?></b> from <b><?php echo $this->currentPeer->country()->name ?></b> with a digital curation staff of average <b><?php echo round($this->currentPeer->staffPonderedAverage(), 1) ?> people</b> and a data volume of average <b><?php echo $this->currentPeer->dataVolumeToString() ?></b>. It has a number of copies policy of average <b><?php echo round($this->currentPeer->numberOfCopiesPonderedAverage(), 1) ?> replicas</b>.
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
  <?php if($this->currentPeer->contact_and_sharing) { ?>
    <a href="#contactModal" style="margin-bottom: 20px" class="btn btn-primary" data-toggle="modal">Request contact with <?php echo $this->currentPeer->name ?></a>
  <?php }else{ ?>
    <div class="row">
      <div class="col-md-6">
        <div class="alert alert-danger">
          This organization doesn't want to receive contact requests.
        </div>
      </div>
    </div>
  <?php } ?>
  <br/>

  <h4>Other peers like you</h4>
  <?php if(count($this->peersLikeYou)){ ?>
    <ul>
      <?php foreach ($this->peersLikeYou as $peer) { ?>
        <li><a href="<?php echo JRoute::_('index.php?view=analyse&layout=peer&organization=' . $peer->organization_id) ?>"><?php echo $peer->name ?>, <?php echo $peer->typesToString() ?>, <?php echo $peer->country()->name ?></a></li>
      <?php } ?>
    </ul> 
  <?php }else{ ?>
    <p>There are no more peers available for comparison. Please, try again later.</p>
  <?php } ?>

  <p>Choose from the <a href="#">complete list of peers</a> which have allowed sharing of their information.</p>
  </div>
<?php }else{ ?>
<div class="alert alert-info">
  <div class="row">
    <div class="col-xs-12">
      At this point, there are no organizations available for comparison.
      <br/>
      Please, try again later.
    </div>
  </div>
</div>
<?php } ?>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/serialize-all.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/compare-peer.js') ?>"></script>

<?php if($this->currentPeer->contact_and_sharing) { ?>
  <div id="contactModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="contactForm" action="index.php?option=com_ccex&controller=contact" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Request contact with <?php echo $this->currentPeer->name ?></h3>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label>Include a personal note</label>
                <textarea name="message" rows="5" class="form-control">
I'd like to contact you to exchange information, experiences and more details about <?php echo $this->currentPeer->name ?> curation costs.

- <?php echo JFactory::getUser()->name ?>
                </textarea>
                <input type="hidden" name="recipient_organization_id" value="<?php echo $this->currentPeer->organization_id ?>">
              </div>
          </div>
          <div class="modal-footer" style="clear: both;">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button type="submit" class="btn btn-success">Send</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>
