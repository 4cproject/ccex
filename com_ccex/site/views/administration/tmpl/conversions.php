<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=index') ?>">Administration</a></li>
    <li class="active">Exchange Rates</li>
</ol>

<h1>Exchange Rates</h1>
<br/>

<div style="padding: 30px 0">
    <table id="tableConversions" class="table table-condensed table-font-small">
        <thead>
            <th>Currency Code</th>
            <th>Year</th>
            <th>Rate</th>
            <th style="text-align: right; width: 1px;" class="no-sort"></th>
        </thead>
        <tbody>
            <?php foreach ($this->conversions as $conversion) { ?>
                <?php $conversion = CCExHelpersCast::cast('CCExModelsEuroconvertionrate', $conversion); ?>
                <tr>
                    <td><?php echo $conversion->code ?></td>
                    <td><?php echo $conversion->year ?></td>
                    <td><?php echo $conversion->tax ?></td>
                    <td style="text-align: right"><a href="<?php echo JRoute::_('index.php?view=administration&layout=conversion&conversion_id=' . $conversion->euro_convertion_id ) ?>"><i class="fa fa-edit"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-md-3">
        <a href="<?php echo JRoute::_('index.php?view=administration&layout=conversion') ?>" class="btn btn-success btn-block">Add new exchange rate</a>
    </div>
</div>

<script type="text/javascript">
$(document).ready( function () {
    $('#tableConversions').dataTable( {
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
