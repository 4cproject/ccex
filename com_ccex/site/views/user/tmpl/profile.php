<?php if($this->wizard) { ?>
    <ul class="nav nav-pills nav-wizard" style="margin-bottom: 30px;">
        <li class="active">
            <a href="javascript:void(0)" class="wizard-label">
                <span class="wizard-number">1</span> 
                Edit my profile
                <i class="fa fa-check icon-status"></i>
            </a>
            <div class="nav-arrow"></div>
        </li>
        <?php if($this->organization){ ?> 
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
                  <?php if($this->organization->intervals()){ ?>
                      Edit cost data sets
                  <?php }else{ ?>
                      Add cost data sets
                  <?php } ?>
                  <i class="fa fa-check icon-status analyse-check-ready" style="<?php if(!$this->organization->readyForComparison()){ echo "display: none"; } ?>"></i>
              </a>
              <div class="nav-arrow"></div>
          </li>
          <li class="analyse-ready last-child" style="<?php if(!$this->organization->Intervals()){ echo "display: none"; } ?>">
              <div class="nav-wedge"></div>
              <a href="<?php echo JRoute::_('index.php?view=analyse&layout=self') ?>" class="wizard-label">
                  <span class="wizard-number">4</span> 
                  Compare costs 
              </a>
          </li>
          <li class="wizard-li-lock analyse-not-ready" style="<?php if($this->organization->Intervals()){ echo "display: none"; } ?>">
              <div class="nav-wedge"></div>
              <a href="javascript:void(0)" class="wizard-label wizard-label-lock">
                  <span class="wizard-number">4</span> 
                  Compare costs 
                  <i class="fa fa-lock icon-status"></i>
              </a>
          </li>
        <?php }else{ ?>
          <li>
              <div class="nav-wedge"></div>
              <a href="<?php echo JRoute::_('index.php?view=organization&layout=add') ?>" class="wizard-label">
                  <span class="wizard-number">2</span> 
                  Add organisation
              </a>
              <div class="nav-arrow"></div>
          </li>
          <li class="wizard-li-lock">
              <div class="nav-wedge"></div>
              <a href="javascript:void(0)" class="wizard-label wizard-label-lock">
                  <span class="wizard-number">3</span> 
                  Add cost data sets 
                  <i class="fa fa-lock icon-status"></i>
              </a>
              <div class="nav-arrow"></div>
          </li>
          <li class="wizard-li-lock">
              <div class="nav-wedge"></div>
              <a href="javascript:void(0)" class="wizard-label wizard-label-lock">
                  <span class="wizard-number">4</span> 
                  Compare costs 
                  <i class="fa fa-lock icon-status"></i>
              </a>
          </li>
        <?php } ?>
    </ul>
<?php } ?>

<div class="row">
  <div class="col-md-6">
    <div class="row">
      <div class="profile-container small-profile-container">
        <div class="col-sm-4 text-center">
          <div class="vcenter">
            <img class="icon" src="/templates/ccextemplate/images/icons/peppyicons/1405038774_user9_128.png" width="80" alt="User profile">
          </div>
        </div>
        <div class="col-sm-8">
            <div class="vcenter">
              <h3>
                <?php echo htmlspecialchars($this->user->name); ?>
              </h3> 
              <div class="row" style="margin-top: 10px">
                <div class="col-sm-3"><strong>Username</strong></div>
                <div class="col-sm-9"><?php echo htmlspecialchars($this->user->username); ?></div>
                <div class="col-sm-3"><strong>Email</strong></div>
                <div class="col-sm-9"><?php echo htmlspecialchars($this->user->email); ?></div>
              </div>
            </div>
        </div>
        <div class="col-sm-12">
          <div style="padding-top:30px">
            <button class="btn btn-primary btn-lg btn-block">Edit username or password</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="profile-container small-profile-container">
        <div class="col-sm-4 text-center">
          <div class="vcenter">
            <img class="icon" src="/templates/ccextemplate/images/icons/peppyicons/1405038976_Museum_128.png" width="80" alt="Organisation">
          </div>
        </div>
        <div class="col-sm-8">
          <div class="vcenter">
            <h3>
              <?php if($this->organization){  ?>
                <?php echo htmlspecialchars($this->organization->name); ?> 
              <?php }else{ ?>
                Your organisation
              <?php } ?>
            </h3> 
            <div class="row" style="martin-top: 10px">     
              <?php if($this->organization){  ?>
                  <div class="col-sm-3"><strong>Country</strong></div>
                  <div class="col-sm-9"><?php echo htmlspecialchars($this->organization->country()->name); ?></div>
                  <div class="col-sm-3"><strong><?php echo ngettext('Type', 'Types', count($this->organization->types())) ?></strong></div>
                  <div class="col-sm-9"><?php echo htmlspecialchars($this->organization->typesToString()); ?></div>
              <?php } else { ?>
                  <div class="col-sm-12">
                      Your profile isn't associated with any organisation.
                  </div>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div style="padding-top:30px">
            <?php if($this->organization){  ?>
              <a class="btn btn-primary btn-lg btn-block" href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>">
                Edit organisation
              </a>
            <?php }else{ ?>
              <a class="btn btn-primary btn-lg btn-block" href="<?php echo JRoute::_('index.php?view=organization&layout=add'); ?>">Set your organisation</a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="profile-container big-profile-container">
        <div class="col-sm-4 text-center">
          <div class="vcenter">
            <img class="icon" src="/templates/ccextemplate/images/icons/peppyicons/1405039249_statistics_128.png" width="80" alt="Cost data sets">
          </div>
        </div>
        <div class="col-sm-8">
            <div class="vcenter">
              <h3>
                Cost data sets
              </h3> 
              <div class="row" style="margin-top: 10px">
                <?php if($this->organization){  ?>
                  <?php if($this->organization->numberCollections() > 0){  ?>
                    <div class="col-sm-12"><strong><?php echo $this->organization->numberCollections() ?></strong> cost data sets</div>
                    <div class="col-sm-12"><strong><?php echo $this->organization->numberOfCosts() ?></strong> cost units in total</div>
                    <div class="col-sm-12"><strong><?php echo $this->organization->numberIntervals() ?></strong> year spans</div>                  <?php }else{ ?>
                    <div class="col-sm-12">
                        You don't have any cost data set, please create the first on manage cost data sets.
                    </div>            
                  <?php } ?>
                <?php }else{ ?>
                  <div class="col-sm-12">
                      You don't have any cost data set, please set your organisation and manage its cost data sets.
                  </div>
                <?php } ?>
              </div>
            </div>
        </div>
        <?php if($this->organization && $this->organization->numberCollections() > 0){  ?>
          <div class="col-sm-12" style="margin: 35px 0 20px;">
            <div class="col-sm-7"><strong>Cost</strong></div>
            <div class="col-sm-5"><?php echo $this->organization->formattedTotalCost() ?></div>
            <div class="col-sm-7"><strong>Cost per GB</strong></div>
            <div class="col-sm-5"><?php echo $this->organization->formattedSumCostPerGB() ?></div>
            <div class="col-sm-7"><strong>Cost per Year</strong></div>
            <div class="col-sm-5"><?php echo $this->organization->formattedTotalCostPerYear() ?></div>
            <div class="col-sm-7"><strong>Cost per GB per Year</strong></div>
            <div class="col-sm-5"><?php echo $this->organization->formattedTotalCostPerGBPerYear() ?></div>
            <div class="col-sm-12 sep"></div>
            <div class="col-sm-7"><strong>Map to activities</strong></div>
            <div class="col-sm-5"><?php echo $this->organization->percentageActivityMapping() ?>%</div>
            <div class="col-sm-7"><strong>Map to purchases and staff</strong></div>
            <div class="col-sm-5"><?php echo $this->organization->percentageFinancialAccountingMapping() ?>%</div>
            <div class="col-sm-12 sep"></div>
            <div class="col-sm-7"><strong>Data volume weighted average</strong></div>
            <div class="col-sm-5"><?php echo $this->organization->dataVolumeToString() ?></div>
            <div class="col-sm-7"><strong>Curation staff weighted average</strong></div>
            <div class="col-sm-5"><?php echo $this->organization->staffPonderedAverage() ?></div>        
            <div class="col-sm-7"><strong>Number of copies weighted average</strong></div>
            <div class="col-sm-5"><?php echo $this->organization->numberOfCopiesPonderedAverage() ?></div>  
          </div>
        <?php } ?>
        <?php if($this->organization){  ?>
          <?php if($this->organization->numberCollections() > 0){ ?>
            <div class="col-sm-12">
              <div style="padding-top:30px">
                <a href="<?php echo JRoute::_('index.php?view=comparecosts&layout=datasets') ?>" class="btn btn-primary btn-lg btn-block">Manage cost data sets</a>
              </div>
            </div>
          <?php }else{ ?>
            <div class="col-sm-12">
              <div style="padding-top:325px">
                <a href="<?php echo JRoute::_('index.php?view=comparecosts&layout=datasets') ?>" class="btn btn-primary btn-lg btn-block">Manage cost data sets</a>
              </div>
            </div>
          <?php } ?>
        <?php }else{ ?>
          <div class="col-sm-12">
            <div style="padding-top:325px">
              <a href disabled class="btn btn-primary btn-lg btn-block">Manage cost data sets</a>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<!-- <div class="utils" style="padding-top: 30px">
    <div class="col-sm-2 col-sm-offset-10">
        <form action="<?php echo JRoute::_('index.php?option=com_users&task=user.logout'); ?>" method="post" class="form-horizontal">
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-danger btn-block"><span class="icon-arrow-left icon-white"></span> Sign out</button>
                </div>
            </div>
            <input type="hidden" name="return" value="<?php echo base64_encode(JRoute::_('index.php?option=com_users&view=login')); ?>" />
            <?php echo JHtml::_('form.token'); ?>
        </form>
    </div>
</div>
 -->
