<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=index') ?>">Administration</a></li>
    <li class="active">Configurations</li>
</ol>

<h1>Configurations</h1>

<div style="padding: 30px 0">
    <table id="tableConfigurations" class="table table-condensed table-font-small">
        <thead>
            <th>Configuration</th>
            <th>Identifier</th>
            <th>Value</th>
            <th>Data type</th>
            <th style="text-align: right; width: 1px;" class="no-sort"></th>
        </thead>
        <tbody>
            <?php foreach ($this->configurations as $configuration) { ?>
                <?php $configuration = CCExHelpersCast::cast('CCExModelsConfiguration', $configuration); ?>
                <tr>
                    <td><?php echo $configuration->name ?></td>
                    <td><?php echo $configuration->identifier ?></td>
                    <td><?php echo $configuration->value ?></td>
                    <td><?php echo $configuration->data_type ?></td>
                    <td style="text-align: right"><a href="<?php echo JRoute::_('index.php?view=administration&layout=configuration&configuration_id=' . $configuration->configuration_id ) ?>"><i class="fa fa-edit"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-md-3">
        <a href="<?php echo JRoute::_('index.php?view=administration&layout=configuration') ?>" class="btn btn-success btn-block">Add new configuration</a>
    </div>
</div>

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

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/exists.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/confirm-bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/administration.js') ?>"></script>
