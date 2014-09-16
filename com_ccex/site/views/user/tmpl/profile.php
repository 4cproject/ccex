<ul class="media-list"> 
  <li class="media"> 
    <a class="pull-left" href="javascript:void(0)"> 
      <img class="media-object" src="/4c/templates/ccextemplate/images/icons/peppyicons/1405038719_user_128.png" width="96" alt="User profile">
    </a> 
    <div class="media-body" style="padding-left: 10px;"> 
      <h2 class="media-heading">
        Profile
        <small class="edit">
            <a style="font-size: 11px" href="<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id='.(int) $this->user->id);?>">
                <span class="fa fa-edit"></span> 
                Edit profile
            </a>
        </small>
      </h2> 
      <div class="row" style="margin-top: 10px">
        <div class="col-sm-1"><strong>Name</strong></div>
        <div class="col-sm-11"><?php echo htmlspecialchars($this->user->name); ?></div>
        <div class="col-sm-1"><strong>Username</strong></div>
        <div class="col-sm-11"><?php echo htmlspecialchars($this->user->username); ?></div>
      </div>
    </div> 
  </li> 
  <li class="media" style="margin-top: 30px;"> 
    <a class="pull-left" href="javascript:void(0)"> 
      <img class="media-object" src="/4c/templates/ccextemplate/images/icons/peppyicons/1405039281_users_128.png" width="96" alt="Organisation">
    </a> 
    <div class="media-body" style="padding-left: 10px;"> 
      <h2 class="media-heading">Organisation</h2> 
      <h3 style="margin-top: 10px;">
        <?php echo htmlspecialchars($this->organization->name); ?>
        <small class="edit">
            <a style="font-size: 11px" href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>">
                <span class="fa fa-edit"></span> 
                Edit organization
            </a>
        </small>
      </h3>
      <div class="row" style="martin-top: 10px">     
        <?php if($this->organization){  ?>
            <div class="col-sm-12">
                <small class="information">
                    <i class="fa fa-globe fa-fw"></i> <?php echo htmlspecialchars($this->organization->country()->name ) ?>
                </small>
                <small class="information">
                    <i class="fa fa-money fa-fw"></i> <?php echo htmlspecialchars($this->organization->currency()->name ) ?>
                </small>
                <small class="information">
                    <i class="fa fa-tag fa-fw"></i> <?php echo htmlspecialchars($this->organization->typesToString() ) ?>
                </small>
            </div>
            <div class="col-sm-12">
                <?php echo htmlspecialchars($this->organization->description); ?>
            </div>
        <?php } else { ?>
            <div class="col-sm-12">
                Your profile isn't associated with any organization, please set your organization in <a href="<?php echo JRoute::_('/compare-costs'); ?>">compare costs page</a>.</p>
            </div>
        <?php } ?>
      </div>
    </div> 
  </li> 
</ul>
<!-- <div class="utils" style="padding-top: 30px">
    <div class="col-sm-2 col-sm-offset-10">
        <form action="<?php echo JRoute::_('index.php?option=com_users&task=user.logout'); ?>" method="post" class="form-horizontal">
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-danger btn-block"><span class="icon-arrow-left icon-white"></span> <?php echo JText::_('JLOGOUT'); ?></button>
                </div>
            </div>
            <input type="hidden" name="return" value="<?php echo base64_encode(JRoute::_('index.php?option=com_users&view=login')); ?>" />
            <?php echo JHtml::_('form.token'); ?>
        </form>
    </div>
</div> -->
