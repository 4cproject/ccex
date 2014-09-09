<h1 style="margin-bottom: 20px">
    User profile
    <small class="edit">
        <a href="<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id='.(int) $this->user->id);?>">
            <span class="fa fa-edit"></span> 
            Edit profile
        </a>
    </small>
</h1>

<dl class="dl-horizontal">
    <dt>Name</dt>
    <dd><?php echo htmlspecialchars($this->user->name); ?></dd>
    <dt>Username</dt>
    <dd><?php echo htmlspecialchars($this->user->username); ?></dd>
</dl>

<h1>Organisation</h1>
<p></p>

<?php if(!$this->organization){  ?>
    <h3 style="margin-bottom: 5px;">
        <?php echo htmlspecialchars($this->organization->name); ?>
        <small class="edit">
            <a href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>">
                <span class="fa fa-edit"></span> 
                Edit organization
            </a>
        </small>
    </h3>

    <p class="description" style="margin-bottom: 10px;">
        <?php echo htmlspecialchars($this->organization->description); ?>
    </p>

    <dl class="dl-horizontal">
        <dt>Country</dt>
        <dd><?php echo htmlspecialchars($this->organization->country()->name); ?></dd>
        <dt>Currency</dt>
        <dd><?php echo htmlspecialchars($this->organization->currency()->name); ?></dd>
        <dt>Type(s)</dt>
        <dd><?php echo htmlspecialchars($this->organization->typesToString()); ?></dd>
    </dl>
<?php }else{ ?>
    <p>Your profile isn't associated with any organization, please set your organization in <a href="<?php echo JRoute::_('/compare-costs'); ?>">compare costs page</a>.</p>
<?php } ?>

    <div class="utils">
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
    </div>
