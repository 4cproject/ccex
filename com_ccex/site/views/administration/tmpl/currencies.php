<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=index') ?>">Administration</a></li>
    <li class="active">Currencies</li>
</ol>

<h1>Currencies</h1>

<div style="padding: 30px 0">
    <table id="tableCurrency" class="table table-condensed table-font-small">
        <thead>
            <th>Name</th>
            <th>Symbol</th>
            <th>Code</th>
            <th style="text-align: right; width: 1px;" class="no-sort"></th>
        </thead>
        <tbody>
            <?php foreach ($this->currencies as $currency) { ?>
                <tr>
                    <td><?php echo $currency->name ?></td>
                    <td><?php echo $currency->symbol ?></td>
                    <td><?php echo $currency->code ?></td>
                    <td style="text-align: right"><a href="<?php echo JRoute::_('index.php?view=administration&layout=currency&currency_id=' . $currency->currency_id ) ?>"><i class="fa fa-edit"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-md-3">
        <a href="<?php echo JRoute::_('index.php?view=administration&layout=currency') ?>" class="btn btn-success btn-block">Add new currency</a>
    </div>
</div>

<script type="text/javascript">
$(document).ready( function () {
    $('#tableCurrency').dataTable( {
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
