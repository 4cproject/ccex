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
              <a href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>" class="wizard-label">
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

<ul class="media-list" style="margin-top: 40px"> 
  <li class="media"> 
    <a class="pull-left" href="javascript:void(0)"> 
      <img class="media-object" src="/templates/ccextemplate/images/icons/peppyicons/1405038774_user9_128.png" width="80" alt="User profile">
    </a> 
    <div class="media-body" style="padding-left: 10px;"> 
      <h3 class="media-heading">
        <?php echo htmlspecialchars($this->user->name); ?>
        <small class="edit">
            <a style="font-size: 11px" href="<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id='.(int) $this->user->id);?>">
              edit username or password
            </a>
        </small>
      </h3> 
      <div class="row" style="margin-top: 10px">
        <div class="col-sm-1"><strong>Username</strong></div>
        <div class="col-sm-11"><?php echo htmlspecialchars($this->user->username); ?></div>
        <div class="col-sm-1"><strong>Email</strong></div>
        <div class="col-sm-11"><?php echo htmlspecialchars($this->user->email); ?></div>
      </div>
    </div> 
  </li> 
  <li class="media" style="margin-top: 30px;"> 
    <a class="pull-left" href="javascript:void(0)"> 
      <img class="media-object" src="/templates/ccextemplate/images/icons/peppyicons/1405038976_Museum_128.png" width="80" alt="Organisation">
    </a> 
    <div class="media-body" style="padding-left: 10px;"> 
      <h3 class="media-heading">
        <?php if($this->organization){  ?>
          <?php echo htmlspecialchars($this->organization->name); ?>
          <small class="edit">
            <a style="font-size: 11px" href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>">
              edit organisation
            </a>     
          </small>   
        <?php }else{ ?>
          Your organisation
        <?php } ?>
      </h3> 
      <div class="row" style="martin-top: 10px">     
        <?php if($this->organization){  ?>
            <div class="col-sm-1"><strong>Country</strong></div>
            <div class="col-sm-11"><?php echo htmlspecialchars($this->organization->country()->name); ?></div>
            <div class="col-sm-1"><strong><?php echo ngettext('Type', 'Types', count($this->organization->types())) ?></strong></div>
            <div class="col-sm-11"><?php echo htmlspecialchars($this->organization->typesToString()); ?></div>
            <div class="col-sm-11"><a href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>" class="small">Manage cost data sets</a></div>
        <?php } else { ?>
            <div class="col-sm-12">
                Your profile isn't associated with any organisation, please <a href="<?php echo JRoute::_('index.php?view=organization&layout=add'); ?>">set your organisation</a>.</p>
            </div>
        <?php } ?>
      </div>
    </div> 
  </li> 
</ul>
<div class="utils" style="padding-top: 30px">
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
