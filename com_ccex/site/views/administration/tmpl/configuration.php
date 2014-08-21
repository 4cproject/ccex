<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=index') ?>">Administration</a></li>
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=configurations') ?>">Configurations</a></li>
    <?php if(isset($this->configuration)) { ?>
        <li class="active"><?php echo $this->configuration->name ?></li>
    <?php } else { ?>
        <li class="active">New configuration</li>
    <?php } ?>
</ol>

<?php if(isset($this->configuration)) { ?>
    <h1><?php echo $this->configuration->name ?></h1>
<?php } else { ?>
    <h1>New configuration</h1>
<?php } ?>
<br/>

<form class="form-horizontal" id="configurationForm" role="form">
    <div class="row">
        <div class="form-group">
            <label style="text-align: right;" for="configuration_name" class="col-sm-3 control-label">Configuration</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="configuration_name" name="configuration[name]" value="<?php if(isset($this->configuration->name)){ echo htmlspecialchars($this->configuration->name) ; } ?>" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <label style="text-align: right;" for="configuration_identifier" class="col-sm-3 control-label">Identifier</label>
            <div class="col-sm-4">
                <input type="text" <?php if(isset($this->configuration)){ echo "disabled"; } ?> class="form-control" id="configuration_identifier" name="configuration[identifier]" value="<?php if(isset($this->configuration->identifier)){ echo htmlspecialchars($this->configuration->identifier) ; } ?>" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <label style="text-align: right;" for="configuration_value" class="col-sm-3 control-label">Value</label>
            <div class="col-sm-4">
                <input type="<?php if(isset($this->configuration->data_type)){ echo htmlspecialchars($this->configuration->data_type) ; }else{ echo "text"; } ?>" step="any" class="form-control" id="configuration_value" name="configuration[value]" value="<?php if(isset($this->configuration->value)){ echo htmlspecialchars($this->configuration->value) ; } ?>" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <label style="text-align: right;" for="configuration_data_type" class="col-sm-3 control-label">Data type</label>
            <div class="col-sm-4">
                <select class="form-control" id="configuration_data_type" name="configuration[data_type]" <?php if(isset($this->configuration)){ echo "disabled"; } ?>>
                    <option <?php if(isset($this->configuration->data_type) && $tthis->configuration->data_type == "text"){ echo "selected=\"true\""; }?> value="text">text</option>
                    <option <?php if(isset($this->configuration->data_type) && $tthis->configuration->data_type == "number"){ echo "selected=\"true\""; }?> value="number">number</option>
                </select>
            </div>
        </div>
    </div>

    <div class="form-group utils" style="margin-top:30px">
        <div class="col-sm-2">
            <?php if(isset($this->configuration)){ ?>
                <input type="hidden" name="configuration[configuration_id]" value="<?php echo $this->configuration->configuration_id; ?>">
            <?php } ?>
            <a class="btn btn-success btn-block" href="javascript:void(0)" onclick="<?php if(isset($this->configuration)){ echo 'ccexUpdate(\'configuration\', \'' . JRoute::_('index.php?view=administration&layout=configurations') . '\', true)'; }else{ echo 'ccexCreate(\'configuration\', \'' . JRoute::_('index.php?view=administration&layout=configurations') . '\', true)'; } ?>">Save</span></a>
        </div>
        <div class="col-sm-4">
            <div class="alert alert-dismissable" id="_message_container" style="display: none;">
                <button aria-hidden="true" class="close" data-dismiss="alert" type="button">&times;</button>
                <p id="_message"></p>
                <p id="_description"></p>
            </div>
        </div>
        <div class="col-sm-2 col-sm-offset-4">
            <a class="btn btn-default btn-block btn-border" href="<?php echo JRoute::_('index.php?view=administration&layout=configurations') ?>">Cancel</span></a>
        </div>
    </div>
</form>

<script type="text/javascript">
$(document).ready( function () {
    $('#tableConfigurations').dataTable( {
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "/templates/ccextemplate/libs/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
        },
        "aoColumnDefs" : [ {
            "bSortable" : false,
            "aTargets" : [ "no-sort" ]
        } ]
    } );
} );
</script>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/exists.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/confirm-bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/administration.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/configuration.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/form.js') ?>"></script>
