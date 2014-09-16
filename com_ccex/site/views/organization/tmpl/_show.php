<ul class="media-list">  
  <li class="media" style="margin-top: 30px;"> 
    <a class="pull-left" href="javascript:void(0)"> 
      <img class="media-object" src="/4c/templates/ccextemplate/images/icons/peppyicons/1405039281_users_128.png" width="96" alt="Organisation">
    </a> 
    <div class="media-body" style="padding-left: 10px;"> 
      <h3 style="margin-top: 0;margin-bottom: 5px;">
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

<!-- <div class="row organization">
	<div class="container">
		<h1><?php echo htmlspecialchars($this->organization->name ) ?> </h1>
		<small class="edit">
			<a href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>">
				<span class="fa fa-edit"> Edit organization</span>
			</a>
		</small>
		<p style="margin-bottom: 5px">
			<small class="information">
				<i class="fa fa-globe fa-fw"></i> <?php echo htmlspecialchars($this->organization->country()->name ) ?>
			</small>
			<small class="information">
				<i class="fa fa-money fa-fw"></i> <?php echo htmlspecialchars($this->organization->currency()->name ) ?>
			</small>
			<small class="information">
				<i class="fa fa-tag fa-fw"></i> <?php echo htmlspecialchars($this->organization->typesToString() ) ?>
			</small>
		</p>	
		<small class="description" style="font-weight: 400;"><?php echo htmlspecialchars($this->organization->description ) ?></small>
	</div>
</div> -->
