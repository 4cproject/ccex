<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=index') ?>">Administration</a></li>
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=organizationtypes') ?>">Organisation types</a></li>
    <?php if(isset($this->organizationType)) { ?>
        <li class="active"><?php echo $this->organizationType->name ?></li>
    <?php } else { ?>
        <li class="active">New organisation type</li>
    <?php } ?>
</ol>

<?php if(isset($this->organizationType)) { ?>
    <h1><?php echo $this->organizationType->name ?></h1>
<?php } else { ?>
    <h1>New organisation type</h1>
<?php } ?>
<br/>

<form class="form-horizontal" id="organizationtypeForm" role="form">
    <div class="row">
        <div class="form-group">
            <label style="text-align: right;" for="organizationtype_name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="organizationtype_name" name="organizationType[name]" value="<?php if(isset($this->organizationType->name)){ echo htmlspecialchars($this->organizationType->name) ; } ?>" />
            </div>
        </div>
    </div>

    <div class="form-group utils" style="margin-top:30px">
        <div class="col-sm-2">
            <?php if(isset($this->organizationType)){ ?>
                <input type="hidden" name="organizationType[org_type_id]" value="<?php echo $this->organizationType->org_type_id; ?>">
            <?php } ?>
            <a class="btn btn-success btn-block" href="javascript:void(0)" onclick="<?php if(isset($this->organizationType)){ echo 'ccexUpdate(\'organizationtype\', \'' . JRoute::_('index.php?view=administration&layout=organizationtypes') . '\', true)'; }else{ echo 'ccexCreate(\'organizationtype\', \'' . JRoute::_('index.php?view=administration&layout=organizationtypes') . '\', true)'; } ?>">Save</span></a>
        </div>
        <div class="col-sm-4">
            <div class="alert alert-dismissable" id="_message_container" style="display: none;">
                <button aria-hidden="true" class="close" data-dismiss="alert" type="button">&times;</button>
                <p id="_message"></p>
                <p id="_description"></p>
            </div>
        </div>
        <?php if(isset($this->organizationType)){ ?>
            <div class="col-sm-2 col-sm-offset-2">
                <a class="btn btn-default btn-block btn-border" href="<?php echo JRoute::_('index.php?view=administration&layout=organizationtypes') ?>">Cancel</span></a>
            </div>
            <?php if($this->existsOrganizationsOfType) { ?>
                <div class="col-sm-2" data-toggle="tooltip" data-placement="top" title="You can't delete the organisation types that are being used by organisations.">
                    <a class="btn btn-danger btn-block" href="javascript:void(0)" disabled >Delete</span></a>
                </div>
            <?php } else { ?>
                <div class="col-sm-2">
                    <a class="btn btn-danger btn-block" href="javascript:void(0)" id="delete-button" data-name="organisation type" data-redirect="<?php echo JRoute::_('index.php?view=administration&layout=organizationtypes') ?>" data-type="organizationtype" data-id="<?php echo $this->organizationType->org_type_id; ?>">Delete</span></a>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="col-sm-2 col-sm-offset-4">
                <a class="btn btn-default btn-block btn-border" href="<?php echo JRoute::_('index.php?view=administration&layout=organizationtypes') ?>">Cancel</span></a>
            </div>
        <?php } ?>
    </div>
</form>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/exists.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/confirm-bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/administration.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/adm_organizationtype.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/form.js') ?>"></script>
