<h1>Administration</h1>
<h2>All costs</h2>

<div class="" style="padding: 30px 0">
    <table id="tableCosts" class="table table-condensed table-font-small">
        <thead>
            <th>Organisation</th>
            <th>Cost data set</th>
            <th>BY</th>
            <th>D</th>
            <th>Cost</th>
            <th>Value</th>
            <th>C</th>
            <th>H</th>
            <th>S</th>
            <th>E</th>
            <th>P</th>
            <th>IT</th>
            <th>O</th>
            <th>PS</th>
            <th>M</th>
            <th>Ov</th>
            <th>PI</th>
            <th>I</th>
            <th>AS</th>
            <th>A</th>
        </thead>
        <tbody>
            <?php foreach ($this->costs as $cost) { ?>
                <?php $cost = CCExHelpersCast::cast('CCExModelsCost', $cost); ?>
                <tr>
                    <td><?php echo $cost->interval()->collection()->organization()->name ?></td>
                    <td><?php echo $cost->interval()->collection()->name ?></td>
                    <td><?php echo $cost->interval()->begin_year ?></td>
                    <td><?php echo $cost->interval()->duration ?></td>
                    <td><?php echo $cost->name ?></td>
                    <td><?php echo $cost->cost ?></td>
                    <td><?php echo $cost->interval()->collection()->organization()->currency()->code ?></td>
                    <td><?php echo $cost->cat_hardware ?></td>
                    <td><?php echo $cost->cat_software ?></td>
                    <td><?php echo $cost->cat_external ?></td>
                    <td><?php echo $cost->cat_producer ?></td>
                    <td><?php echo $cost->cat_it_developer ?></td>
                    <td><?php echo $cost->cat_operations ?></td>
                    <td><?php echo $cost->cat_specialist ?></td>
                    <td><?php echo $cost->cat_manager ?></td>
                    <td><?php echo $cost->cat_overhead ?></td>
                    <td><?php echo $cost->cat_pre_ingest ?></td>
                    <td><?php echo $cost->cat_ingest ?></td>
                    <td><?php echo $cost->cat_storage ?></td>
                    <td><?php echo $cost->cat_access ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<h4>Legend</h4>
<dl class="dl-horizontal table-legend">
    <dt>BY</dt>
        <dd>Begin Year</dd>
    <dt>D</dt>
        <dd>Duration</dd>
    <dt>C</dt>
        <dd>Currency code</dd>
    <dt>H</dt>
        <dd>% Hardware</dd>
    <dt>S</dt>
        <dd>% Software</dd>
    <dt>E</dt>
        <dd>% External or 3rd party services</dd>
    <dt>P</dt>
        <dd>% Producer</dd>
    <dt>IT</dt>
        <dd>% IT-developer</dd>
    <dt>O</dt>
        <dd>% Operations</dd>
    <dt>PS</dt>
        <dd>% Preservation specialist</dd>
    <dt>M</dt>
        <dd>% Manager</dd>
    <dt>Ov</dt>
        <dd>% Overhead</dd>
    <dt>PI</dt>
        <dd>% Pre-Ingest</dd>
    <dt>I</dt>
        <dd>% Ingest</dd>
    <dt>AS</dt>
        <dd>% Archival storage</dd>
    <dt>A</dt>
        <dd>% Access</dd>
</dl>

<script type="text/javascript">
$(document).ready( function () {
    $('#tableCosts').dataTable( {
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "/4c/templates/ccextemplate/libs/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
        }
    } );
} );
</script>
