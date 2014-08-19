<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=index') ?>">Administration</a></li>
    <li class="active">Costs</li>
</ol>

<h1>Costs</h1>
<h3>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h3>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

<div style="padding: 30px 0">
    <table id="tableCosts" class="table table-condensed table-font-small">
        <thead>
            <th>Organisation</th>
            <th>Cost data set</th>
            <th>BY</th>
            <th>Du</th>
            <th>DV</th>
            <th>Fl</th>
            <th>Cost</th>
            <th>Value</th>
            <th>CC</th>
            <th>Hw</th>
            <th>Sw</th>
            <th>ES</th>
            <th>Pr</th>
            <th>IT</th>
            <th>Op</th>
            <th>PS</th>
            <th>Ma</th>
            <th>Ov</th>
            <th>PI</th>
            <th>In</th>
            <th>AS</th>
            <th>Ac</th>
        </thead>
        <tbody>
            <?php foreach ($this->costs as $cost) { ?>
                <?php $cost = CCExHelpersCast::cast('CCExModelsCost', $cost); ?>
                <tr>
                    <td><a href="<?php echo JRoute::_('index.php?view=administration&layout=organization&organization_id=' . $cost->interval()->collection()->organization()->organization_id) ?>"><?php echo htmlspecialchars($cost->interval()->collection()->organization()->name ) ?></a></td>
                    <td><a href="<?php echo JRoute::_('index.php?view=administration&layout=collection&collection_id=' . $cost->interval()->collection()->collection_id) ?>"><?php echo htmlspecialchars($cost->interval()->collection()->name ) ?></a></td>
                    <td><a href="<?php echo JRoute::_('index.php?view=administration&layout=interval&interval_id=' . $cost->interval()->interval_id) ?>"><?php echo $cost->interval()->begin_year ?></a></td>
                    <td><?php echo $cost->interval()->duration ?></td>
                    <td><?php echo $cost->interval()->data_volume ?></td>
                    <td><?php if($cost->interval()->collection()->final){ echo "&#x2713;"; }else{ echo "&#xd7;"; } ?></td>
                    <td><a href="<?php echo JRoute::_('index.php?view=administration&layout=cost&cost_id=' . $cost->cost_id) ?>"><?php echo htmlspecialchars($cost->name ) ?></a></td>
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
    <dt>Du</dt>
        <dd>Duration</dd>
    <dt>DV</dt>
        <dd>Data Volume (GB)</dd>
    <dt>Fl</dt>
        <dd>Final</dd>
    <dt>CC</dt>
        <dd>Currency code</dd>
    <br/>
    <dt>Hw</dt>
        <dd>% Hardware</dd>
    <dt>Sw</dt>
        <dd>% Software</dd>
    <dt>ES</dt>
        <dd>% External or 3rd party services</dd>
    <dt>Pr</dt>
        <dd>% Producer</dd>
    <dt>IT</dt>
        <dd>% IT-developer</dd>
    <dt>Op</dt>
        <dd>% Operations</dd>
    <dt>PS</dt>
        <dd>% Preservation specialist</dd>
    <dt>Ma</dt>
        <dd>% Manager</dd>
    <dt>Ov</dt>
        <dd>% Overhead</dd>
    <dt>PI</dt>
        <dd>% Pre-Ingest</dd>
    <dt>In</dt>
        <dd>% Ingest</dd>
    <dt>AS</dt>
        <dd>% Archival storage</dd>
    <dt>Ac</dt>
        <dd>% Access</dd>
    <br/>
    <dt>&#x2713;</dt>
        <dd>Yes</dd>
    <dt>&#xd7;</dt>
        <dd>No</dd>
</dl>

<script type="text/javascript">
$(document).ready( function () {
    $('#tableCosts').dataTable( {
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "/templates/ccextemplate/libs/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
        }
    } );
} );
</script>
