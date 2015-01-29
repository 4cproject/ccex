<?php 
  $comparePeer = new CCExModelsComparepeer(); 

  if($this->currentPeer){
    $currentPeerSimilarity = $comparePeer->similarity($this->organizationsScore[$this->currentPeer->organization_id]);
  }
?>

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
    <span class="pull-right">
        <a onclick="analysePeerTour.restart()" class="btn btn-default btn-help tour-step tour-step-help"><i class="fa fa-life-ring"></i> Show help</a>
    </span>
</h1>
<p>See the summary of your submitted costs and compare them with other organisations'. <?php if($this->organization){ ?> Please remember that others can only compare their costs with yours if your cost data sets are marked “Final”. <?php } ?></p> 

<!-- Nav tabs -->
<ul class="nav nav-tabs tour-step tour-step-peer-tabs">
  <li><a href="<?php echo JRoute::_('index.php?view=analyse&layout=self') ?>">My costs</a></li>
  <li><a href="<?php echo JRoute::_('index.php?view=analyse&layout=global') ?>">Global comparison</a></li>
  <li class="active"><a href="<?php echo JRoute::_('index.php?view=analyse&layout=peer') ?>">Peer comparison</a></li>
</ul>
<div class="comparison-tab-container">
  <p>The peer comparison enables you to see how your costs compare to cost data sets from organisations similar to yours. Use this comparison to pin-point challenges and get in contact with organisations that can help you learn from their experiences.</p>

  <?php if($this->currentPeer){ ?>
    <div class="row">
      <form id="peerComparisonForm" class="form-inline">
        <div class="col-md-6">
          <?php if($this->organization){ ?>
            <h4>
              <?php echo htmlspecialchars($this->organization->name) ?>
            </h4>
            <p class="small" style="margin-bottom: 17px;">You can select which data sets to analyse, by selecting the options below:</p>
          <?php }else{ ?>
            <h4>Your organisation</h4>
          <?php } ?>
          <?php if($this->organization){ ?>
            <div class="tour-step tour-step-peer-select-set">
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
                                    <?php }else{ ?>  
                                        <small><span class="label label-default label-draft">Final</span></small>
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
          </div>
          <div style="margin-top: 15px">
            <div class="tour-step tour-step-peer-manage-costs" style="display: inline-block">
              <a class="btn btn-success btn-xs" href="<?php echo JRoute::_('index.php?view=comparecosts&layout=datasets') ?>">Manage cost data sets</a>
            </div>
            <div class="tour-step tour-step-peer-edit-organization" style="display: inline-block">
              <a class="btn btn-primary btn-xs" href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>">
                Edit organisation
              </a>
            </div>
          </div>
          <?php }else{ ?>
            <div class="alert alert-warning fade in" role="alert" style="padding: 12px;border-radius: 0; display: table">
              <p><a href="<?php echo JRoute::_('index.php?option=com_users&view=login&redirect_url=analysepeer') ?>"><strong>Sign in</strong></a> to define your organisation costs. With this, we will provide you with the peers that are most alike you and show how you compare to them. Don't have an account? <a href="<?php echo JRoute::_('index.php?option=com_users&view=registration&redirect_url=analysepeer') ?>"><strong>Sign up</strong></a> now!</a></p>
              <div>
                <a href="<?php echo JRoute::_('index.php?option=com_users&view=login&redirect_url=analysepeer') ?>" class="btn btn-default btn-xs pull-right">Sign in</a>
                <a href="<?php echo JRoute::_('index.php?option=com_users&view=registration&redirect_url=analysepeer') ?>" class="btn btn-default btn-xs pull-right">Sign up</a>
              </div>
            </div>
          <?php } ?>
        </div>
        <div class="col-md-6">
          <h4>
            <?php if($this->currentPeer->organization_linked){ echo htmlspecialchars($this->currentPeer->name) ; }else{ echo "Anonymous Organisation"; } ?>

            <?php if($this->organization){ ?>
              <span class="label label-similarity pull-right <?php echo $currentPeerSimilarity['class']; ?>"><?php echo $currentPeerSimilarity["level"]; ?> similarity</span>
            <?php } ?>
          </h4>
          <p style="margin-bottom: 10px;font-size: 15px">
            <?php if($this->currentPeer->organization_linked){ echo htmlspecialchars($this->currentPeer->name) ; }else{ echo "Anonymous Organisation"; } ?> is a <b><?php echo htmlspecialchars($this->currentPeer->typesToString() ) ?></b> from <b><?php echo htmlspecialchars($this->currentPeer->country()->name ) ?></b> with a digital curation staff of average <b><?php echo round($this->currentPeer->staffPonderedAverage(), 1) ?> people</b> and a data volume of average <b><?php echo $this->currentPeer->dataVolumeToString() ?></b>. It has a number of copies policy of average <b><?php echo round($this->currentPeer->numberOfCopiesPonderedAverage(), 1) ?> replicas</b>.
          </p>
          <?php if(trim($this->currentPeer->description) != "" && $this->currentPeer->organization_linked){ ?>
            <p style="line-height: 20px;margin-bottom: 15px" class="small vertical-ellipsis-2l">
              <?php echo htmlspecialchars(mb_strimwidth($this->currentPeer->description, 0, 170, "...")) ?>
              <?php if(strlen($this->currentPeer->description) > 170){ ?>
                <a href="#readMore" data-toggle="modal">read more</a>
              <?php } ?>
            </p>
          <?php } ?>
          <div class="tour-step tour-step-peer-compare-other" style="display: inline-block">
            <a href="#completeListPeers" data-toggle="modal" class="btn btn-success btn-xs">Compare with other peers</a>
          </div>
          <div class="tour-step tour-step-peer-contact" style="display: inline-block">
            <?php if($this->currentPeer->contact_and_sharing && $this->currentPeer->user()) { ?>
              <a class="btn btn-success btn-xs"  href="#contactModal" data-toggle="modal">Request contact</a>
            <?php } ?>
          </div>
        </div>
      <input type="hidden" name="currentPeer" value="<?php echo $this->currentPeer->organization_id; ?>"/>
      </form>
    </div>

    <?php echo $this->_activities->render(); ?>
    <?php echo $this->_financialAccounting->render(); ?>


    <!-- Action -->
    <!-- Action -->
    <div class="form-group utils">
      <div class="col-sm-3 tour-step tour-step-peer-go-global">
          <a class="btn btn-success btn-block btn-border" href="<?php echo JRoute::_('index.php?view=analyse&layout=global') ?>"><i class="fa fa-fw fa-angle-left"></i> Global comparison</span></a>
      </div>
      <div class="col-sm-3 col-sm-offset-6 tour-step tour-step-peer-go-understand">
          <a class="btn btn-success btn-block btn-border" href="/make-the-case">Understand Costs</span></a>
      </div>
    </div>

    <div class="clearfix"></div>
  <?php }else{ ?>
    <div class="alert alert-info">
      <div class="row">
        <div class="col-xs-12">
          At this point, there are no organisations available for comparison.
          <br/>
          Please, try again later.
        </div>
      </div>
    </div>
  <?php } ?>
</div>

<?php if($this->currentPeer && $this->currentPeer->contact_and_sharing && $this->currentPeer->user()) { ?>
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
               <p style="margin-bottom: 0px"><a href="<?php echo JRoute::_('index.php?option=com_users&view=login&redirect_url=analysepeer') ?>"><strong>Sign in</strong></a> to request contact with <?php if($this->currentPeer->organization_linked){ echo htmlspecialchars($this->currentPeer->name) ; }else{ echo "Anonymous Organisation"; } ?>.</p>
               <p>Don't have an account? <a href="<?php echo JRoute::_('index.php?option=com_users&view=registration&redirect_url=analysepeer') ?>"><strong>Sign up</strong></a> now!</a></p>
            </div>
            <div class="modal-footer" style="clear: both;">
              <button class="btn pull-left" data-dismiss="modal" aria-hidden="true">Cancel</button>

              <a href="<?php echo JRoute::_('index.php?option=com_users&view=registration&redirect_url=analysepeer') ?>" class="btn btn-primary">Sign up</a>
              <a href="<?php echo JRoute::_('index.php?option=com_users&view=login&redirect_url=analysepeer') ?>" class="btn btn-primary">Sign in</a>
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
        <table class="table table-hover small table-peers" style="margin-bottom: 0px;">
          <thead>
            <tr>
              <th>Name</th>
              <th>Country</th>
              <th>Types</th>
              <?php if($this->organization){ ?>
                <th>Similarity</th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($this->complete as $peer) { ?>
              <tr style="cursor: pointer" onclick="document.location = '<?php echo JRoute::_('index.php?view=analyse&layout=peer&organization=' . $peer->organization_id) ?>';">
                <td><a style="color: #555" href="<?php echo JRoute::_('index.php?view=analyse&layout=peer&organization=' . $peer->organization_id) ?>"><?php if($peer->organization_linked){ echo htmlspecialchars($peer->name) ; }else{ echo "Anonymous Organisation"; } ?></a></td>
                <td><?php echo htmlspecialchars($peer->country()->name ) ?></td>
                <td><?php echo htmlspecialchars($peer->typesToString() ) ?></td>
                <?php if($this->organization){ ?>
                  <td>
                    <?php 
                      $peerSimilarity = $comparePeer->similarity($this->organizationsScore[$peer->organization_id]);
                      echo $peerSimilarity["level"]; 
                    ?>
                  </td>
                <?php } ?>
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

<?php if($this->currentPeer && (trim($this->currentPeer->description) != "" && $this->currentPeer->organization_linked)){ ?>
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
<?php } ?>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/serialize-all.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/compare-peer.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/contact.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/cbpHorizontalMenu.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/analyse_peer_tour.js') ?>"></script>
<script>
    $(function() {
        cbpHorizontalMenu.init();
    });
</script>
