<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=index') ?>">Administration</a></li>
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=organizations') ?>">Organisations</a></li>
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=organization&organization_id=' . $this->collection->organization_id) ?>"><?php echo htmlspecialchars($this->collection->organization()->name) ; ?></a></li>
    <li class="active"><?php echo htmlspecialchars($this->collection->name) ; ?></li>
</ol>

<h1>
    <?php echo htmlspecialchars($this->collection->name ) ?> 
</h1>

<p class="description"><?php echo htmlspecialchars($this->collection->description ) ?></p>

<div class="row">
    <div class="col-md-6">
        <dl class="dl-horizontal" >
            <dt>Scope</dt>
            <dd><?php echo $this->collection->scope ?></dd>
            <dt>Organization</dt>
            <dd><a href="<?php echo JRoute::_('index.php?view=administration&layout=organization&organization_id=' . $this->collection->organization()->organization_id) ?>"><?php echo htmlspecialchars($this->collection->organization()->name ) ?></a></dd>
        </dl>
    </div>
    <div class="col-md-6">
        <dl class="dl-horizontal" >
            <dt>Status</dt>
            <dd><?php if($this->collection->final){ echo "Final"; }else{ echo "Draft"; } ?></dd>
        </dl>
    </div>
</div>

<h2>Years</h2>

<div style="padding: 20px 0">
    <table id="tableIntervals" class="table table-condensed table-font-small">
        <thead>
            <th>Begin Year</th>
            <th>Duration</th>
            <th>Data Volume</th>
            <th>Number copies</th>
            <th>Staff</th>
            <th>UT</th>
            <th>WP</th>
            <th>Ss</th>
            <th>Gr</th>
            <th>Au</th>
            <th>Vi</th>
            <th>Ht</th>
            <th>Gd</th>
            <th>Em</th>
            <th>Db</th>
        </thead>
        <tbody>
            <?php foreach ($this->collection->intervals() as $interval) { ?>
                <?php $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval); ?>
                <tr>
                    <td><a href="<?php echo JRoute::_('index.php?view=administration&layout=interval&interval_id=' . $interval->interval_id) ?>"><?php echo $interval->begin_year ?></a></td>
                    <td><?php echo $interval->duration ?></td>
                    <td><?php echo $interval->data_volume ?></td>
                    <td><?php echo $interval->number_copies ?></td>
                    <td><?php echo $interval->staff ?></td>
                    <td><?php echo $interval->asset_unformatted_text ?></td>
                    <td><?php echo $interval->asset_word_processing ?></td>
                    <td><?php echo $interval->asset_spreadsheet ?></td>
                    <td><?php echo $interval->asset_graphics ?></td>
                    <td><?php echo $interval->asset_audio ?></td>
                    <td><?php echo $interval->asset_video ?></td>
                    <td><?php echo $interval->asset_hypertext ?></td>
                    <td><?php echo $interval->asset_geodata ?></td>
                    <td><?php echo $interval->asset_email ?></td>
                    <td><?php echo $interval->asset_database ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<h2>Costs</h2>

<div style="padding: 20px 0">
    <table id="tableCosts" class="table table-condensed table-font-small">
        <thead>
            <th>BY</th>
            <th>Du</th>
            <th>DV</th>
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
            <?php foreach ($this->collection->costs() as $cost) { ?>
                <?php $cost = CCExHelpersCast::cast('CCExModelsCost', $cost); ?>
                <tr>
                    <td><a href="<?php echo JRoute::_('index.php?view=administration&layout=interval&interval_id=' . $cost->interval()->interval_id) ?>"><?php echo $cost->interval()->begin_year ?></a></td>
                    <td><?php echo $cost->interval()->duration ?></td>
                    <td><?php echo $cost->interval()->data_volume ?></td>
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
<div class="row">
    <div class="col-md-4">
        <dl class="dl-horizontal table-legend">
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
        </dl>
    </div>
    <div class="col-md-4">
        <dl class="dl-horizontal table-legend">
            <dt>UT</dt>
                <dd>% Unformatted text</dd>
            <dt>WP</dt>
                <dd>% Word processing</dd>
            <dt>Ss</dt>
                <dd>% Spreadsheet</dd>
            <dt>Gr</dt>
                <dd>% Graphics</dd>
            <dt>Au</dt>
                <dd>% Audio</dd>
            <dt>Vi</dt>
                <dd>% Video</dd>
            <dt>Ht</dt>
                <dd>% Hypertext</dd>
            <dt>Gd</dt>
                <dd>% Geodata</dd>
            <dt>Em</dt>
                <dd>% Email</dd>
            <dt>Db</dt>
                <dd>% Database</dd>
        </dl>
    </div>
    <div class="col-md-4">
        <dl class="dl-horizontal table-legend">
            <dt>BY</dt>
                <dd>Begin Year</dd>
            <dt>Du</dt>
                <dd>Duration</dd>
            <dt>DV</dt>
                <dd>Data volume (GB)</dd>
            <dt>Fl</dt>
                <dd>Final</dd>
            <dt>CC</dt>
                <dd>Currency code</dd>
            <dt>NC</dt>
                <dd>Number of copies</dd>
            <dt>St</dt>
                <dd>Staff</dd>
            <br/>
            <dt>&#x2713;</dt>
                <dd>Yes</dd>
            <dt>&#xd7;</dt>
                <dd>No</dd>
        </dl>
    </div>
</div>

<div class="row">
    <div class="col-sm-2 col-md-offset-10">
        <input type="hidden" value="<?php echo $this->collection->collection_id ?>" name="organization_id">
        <button type="button" class="btn btn-danger btn-block" id="delete-button" data-id="<?php echo $this->collection->collection_id ?>" data-type="collection" data-redirect="<?php echo JRoute::_('index.php?view=administration&layout=organization&organization_id=' . $this->collection->organization_id ) ?>">Delete</button>
    </div>
</div>

<script type="text/javascript">
$(document).ready( function () {
    $('#tableCosts, #tableIntervals').dataTable( {
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "/templates/ccextemplate/libs/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
        }
    } );
} );


</script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/exists.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/confirm-bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/administration.js') ?>"></script>
