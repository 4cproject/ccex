<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=index') ?>">Administration</a></li>
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=countries') ?>">Countries</a></li>
    <?php if(isset($this->country)) { ?>
        <li class="active"><?php echo $this->country->name ?></li>
    <?php } else { ?>
        <li class="active">New country</li>
    <?php } ?>
</ol>

<?php if(isset($this->country)) { ?>
    <h1><?php echo $this->country->name ?></h1>
<?php } else { ?>
    <h1>New country</h1>
<?php } ?>
<br/>

<form class="form-horizontal" id="countryForm" role="form">
    <div class="row">
        <div class="form-group">
            <label style="text-align: right;" for="country_name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="country_name" name="country[name]" value="<?php if(isset($this->country->name)){ echo htmlspecialchars($this->country->name) ; } ?>" />
            </div>
        </div>
    </div>

    <div class="form-group utils" style="margin-top:30px">
        <div class="col-sm-2">
            <?php if(isset($this->country)){ ?>
                <input type="hidden" name="country[country_id]" value="<?php echo $this->country->country_id; ?>">
            <?php } ?>
            <a class="btn btn-success btn-block" href="javascript:void(0)" onclick="<?php if(isset($this->country)){ echo 'ccexUpdate(\'country\', \'' . JRoute::_('index.php?view=administration&layout=countries') . '\', true)'; }else{ echo 'ccexCreate(\'country\', \'' . JRoute::_('index.php?view=administration&layout=countries') . '\', true)'; } ?>">Save</span></a>
        </div>
        <div class="col-sm-4">
            <div class="alert alert-dismissable" id="_message_container" style="display: none;">
                <button aria-hidden="true" class="close" data-dismiss="alert" type="button">&times;</button>
                <p id="_message"></p>
                <p id="_description"></p>
            </div>
        </div>
        <?php if(isset($this->country)){ ?>
            <div class="col-sm-2 col-sm-offset-2">
                <a class="btn btn-default btn-block btn-border" href="<?php echo JRoute::_('index.php?view=administration&layout=countries') ?>">Cancel</span></a>
            </div>
            <?php if($this->existsOrganizationsOfCountry) { ?>
                <div class="col-sm-2" data-toggle="tooltip" data-placement="top" title="You can't delete the countries that are being used by organizations.">
                    <a class="btn btn-danger btn-block" href="javascript:void(0)" disabled >Delete</span></a>
                </div>
            <?php } else { ?>
                <div class="col-sm-2">
                    <a class="btn btn-danger btn-block" href="javascript:void(0)" id="delete-button" data-redirect="<?php echo JRoute::_('index.php?view=administration&layout=countries') ?>" data-type="country" data-id="<?php echo $this->country->country_id; ?>">Delete</span></a>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="col-sm-2 col-sm-offset-4">
                <a class="btn btn-default btn-block btn-border" href="<?php echo JRoute::_('index.php?view=administration&layout=countries') ?>">Cancel</span></a>
            </div>
        <?php } ?>
    </div>
</form>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/exists.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/confirm-bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/administration.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/adm_country.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/form.js') ?>"></script>
