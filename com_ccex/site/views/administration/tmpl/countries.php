<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=index') ?>">Administration</a></li>
    <li class="active">Countries</li>
</ol>

<h1>Countries</h1>

<div style="padding: 30px 0">
    <table id="tableCountry" class="table table-condensed table-font-small">
        <thead>
            <th>Country</th>
            <th style="text-align: right; width: 1px;" class="no-sort"></th>
        </thead>
        <tbody>
            <?php foreach ($this->countries as $country) { ?>
                <tr>
                    <td><?php echo $country->name ?></td>
                    <td style="text-align: right"><a href="<?php echo JRoute::_('index.php?view=administration&layout=country&country_id=' . $country->country_id ) ?>"><i class="fa fa-edit"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-md-3">
        <a href="<?php echo JRoute::_('index.php?view=administration&layout=country') ?>" class="btn btn-success btn-block">Add new country</a>
    </div>
</div>

<script type="text/javascript">
$(document).ready( function () {
    $('#tableCountry').dataTable( {
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
