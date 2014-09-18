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
  <li><a href="<?php echo JRoute::_('index.php?view=analyse&layout=global') ?>">Global comparison</a></li>
  <li class="active"><a href="<?php echo JRoute::_('index.php?view=analyse&layout=peer') ?>">Peer comparison</a></li>
</ul>
<br/>

<p>The peer comparison enables you to see how your costs compare to cost data sets from organisations similar to yours. Use this comparison to pin-point challenges and get in contact with organisations that can help you learn from their experiences.</p>

<?php if($this->currentPeer){ ?>
  <div class="row">
    <form id="globalComparisonForm" class="form-inline">
      <div class="col-md-6">
        <?php if($this->organization){ ?>
          <h4>
            <?php echo htmlspecialchars($this->organization->name) ?>

            <a class="edit" href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>">
              Edit
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
        <p class="small" style="margin-bottom: 0px"><a href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>">Manage cost data sets.</a></p>
        <?php }else{ ?>
          <div class="alert alert-warning fade in" role="alert" style="padding: 12px;border-radius: 0; display: table">
            <p><a href="<?php echo JRoute::_('index.php?option=com_users&view=login&redirect_url=analyseglobal') ?>"><strong>Sign in</strong></a> to define your organisation costs.</p>
            <p style="line-height: 20px">With this, we will provide you with the peers that are most alike you and show how you compare to them.</p>
            <p>Don't have an account? <a href="<?php echo JRoute::_('index.php?option=com_users&view=signup&redirect_url=analyseglobal') ?>"><strong>Sign up</strong></a> now!</a></p>
            <div>
              <a href="<?php echo JRoute::_('index.php?option=com_users&view=login&redirect_url=analyseglobal') ?>" class="btn btn-default btn-xs pull-right">Sign in</a>
              <a href="<?php echo JRoute::_('index.php?option=com_users&view=signup&redirect_url=analyseglobal') ?>" class="btn btn-default btn-xs pull-right">Sign up</a>
            </div>
          </div>
        <?php } ?>
      </div>
      <div class="col-md-6">
        <h4><?php if($this->currentPeer->organization_linked){ echo htmlspecialchars($this->currentPeer->name) ; }else{ echo "Anonymous Organisation"; } ?></h4>
        <p style="line-height: 22px;margin-bottom: 10px">
          The <?php if($this->currentPeer->organization_linked){ echo htmlspecialchars($this->currentPeer->name) ; }else{ echo "Anonymous Organisation"; } ?> is a <b><?php echo htmlspecialchars($this->currentPeer->typesToString() ) ?></b> from <b><?php echo htmlspecialchars($this->currentPeer->country()->name ) ?></b> with a digital curation staff of average <b><?php echo round($this->currentPeer->staffPonderedAverage(), 1) ?> people</b> and a data volume of average <b><?php echo $this->currentPeer->dataVolumeToString() ?></b>. It has a number of copies policy of average <b><?php echo round($this->currentPeer->numberOfCopiesPonderedAverage(), 1) ?> replicas</b>.
        </p>
        <?php if(trim($this->currentPeer->description) != ""){ ?>
          <p style="line-height: 20px;margin-bottom: 15px" class="small vertical-ellipsis-2l">
            The organisation is described as: 
            <?php echo htmlspecialchars(mb_strimwidth($this->currentPeer->description, 0, 140, "...")) ?>
            <?php if(strlen($this->currentPeer->description) > 140){ ?>
              <a href="#readMore" data-toggle="modal">read more</a>
            <?php } ?>
          </p>
        <?php } ?>


        <a href="#completeListPeers" data-toggle="modal" href="<?php echo JRoute::_('index.php?option=com_users&view=login&redirect_url=analyseglobal') ?>" class="btn btn-default btn-xs btn-border-green">Compare with other peers</a>
      </div>
    </form>
  </div>

  <?php echo $this->_financialAccounting->render(); ?>
  <?php echo $this->_activities->render(); ?>

  <h3>More information</h3>
  <p>If you want to know more about <?php if($this->currentPeer->organization_linked){ echo htmlspecialchars($this->currentPeer->name) ; }else{ echo "Anonymous Organisation"; } ?> you can request direct contact through the CCEx, to exchange information, experiences and more details about their curation costs.</p>

  <?php if(!$this->currentPeer->contact_and_sharing) { ?>
    <div class="row">
      <div class="col-md-6">
        <div class="alert alert-danger">
          This organization doesn't want to receive contact requests.
        </div>
      </div>
    </div>
  <?php }else if(!$this->currentPeer->user()){ ?>
    <div class="row">
      <div class="col-md-6">
        <div class="alert alert-danger">
          The user responsible for this organization isn't available for contact requests.
        </div>
      </div>
    </div>
  <?php }else{ ?>
    <a href="#contactModal" style="margin-bottom: 20px" class="btn btn-primary" data-toggle="modal">Request contact with <?php if($this->currentPeer->organization_linked){ echo htmlspecialchars($this->currentPeer->name) ; }else{ echo "Anonymous Organisation"; } ?></a>
  <?php } ?>
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

<?php if($this->currentPeer->contact_and_sharing && $this->currentPeer->user()) { ?>
  <div id="contactModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="contactForm" action="index.php?option=com_ccex&controller=contact" method="post">
        <div class="modal-content">
          <?php if($this->user->isGuest()){ ?>
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 id="contactModalLabel">Sign in to request contact with <?php if($this->currentPeer->organization_linked){ echo htmlspecialchars($this->currentPeer->name) ; }else{ echo "Anonymous Organisation"; } ?></h3>
            </div>
            <div class="modal-body">
               <p style="margin-bottom: 0px"><a href="<?php echo JRoute::_('index.php?option=com_users&view=login&redirect_url=analyseglobal') ?>"><strong>Sign in</strong></a> to request contact with <?php if($this->currentPeer->organization_linked){ echo htmlspecialchars($this->currentPeer->name) ; }else{ echo "Anonymous Organisation"; } ?>.</p>
               <p>Don't have an account? <a href="<?php echo JRoute::_('index.php?option=com_users&view=signup&redirect_url=analyseglobal') ?>"><strong>Sign up</strong></a> now!</a></p>
            </div>
            <div class="modal-footer" style="clear: both;">
              <button class="btn pull-left" data-dismiss="modal" aria-hidden="true">Cancel</button>

              <a href="<?php echo JRoute::_('index.php?option=com_users&view=signup&redirect_url=analyseglobal') ?>" class="btn btn-primary">Sign up</a>
              <a href="<?php echo JRoute::_('index.php?option=com_users&view=login&redirect_url=analyseglobal') ?>" class="btn btn-primary">Sign in</a>
            </div>
          <?php }else{ ?>
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 id="contactModalLabel">Request contact with <?php if($this->currentPeer->organization_linked){ echo htmlspecialchars($this->currentPeer->name) ; }else{ echo "Anonymous Organisation"; } ?></h3>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Include a personal note</label>
                <textarea name="message" rows="5" class="form-control">
I'd like to contact you to exchange information, experiences and more details about your organisation curation costs.

- <?php echo htmlspecialchars(JFactory::getUser()->name ) ?>
                </textarea>
                <input type="hidden" name="recipient_organization_id" value="<?php echo $this->currentPeer->organization_id ?>">
              </div>
            </div>
            <div class="modal-footer" style="clear: both;">
              <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
              <button type="submit" class="btn btn-success">Send</button>
            </div>
          <?php } ?>
        </div>
      </form>
    </div>
  </div>
<?php } ?>

<div id="completeListPeers" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="completeListPeersLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="completeListPeersLabel">Compare with other peers</h3>
      </div>
      <div class="modal-body">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Name</th>
              <th>Country</th>
              <th>Types</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($this->complete as $peer) { ?>
              <tr style="cursor: pointer" onclick="document.location = '<?php echo JRoute::_('index.php?view=analyse&layout=peer&organization=' . $peer->organization_id) ?>';">
                <td style="white-space: nowrap "><?php if($peer->organization_linked){ echo htmlspecialchars($peer->name) ; }else{ echo "Anonymous Organisation"; } ?></td>
                <td><?php echo htmlspecialchars($peer->country()->name ) ?></td>
                <td><?php echo htmlspecialchars($peer->typesToString() ) ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer" style="clear: both;">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
      </div>
    </div>
  </div>
</div>

<div id="readMore" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="readMore" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="readMoreLabel"><?php if($this->currentPeer->organization_linked){ echo htmlspecialchars($this->currentPeer->name) ; }else{ echo "Anonymous Organisation"; } ?></h3>
      </div>
      <div class="modal-body">
        <?php echo $this->currentPeer->description ?>
      </div>
      <div class="modal-footer" style="clear: both;">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/serialize-all.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/compare-peer.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/contact.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/cbpHorizontalMenu.js') ?>"></script>
<script>
    $(function() {
        cbpHorizontalMenu.init();
    });
</script>
