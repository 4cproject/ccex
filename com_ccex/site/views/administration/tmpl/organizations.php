<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=index') ?>">Administration</a></li>
    <li class="active">Organisations</li>
</ol>

<h1>Organisations</h1>
<br/>

<?php 
$orgWithoutResponsible = array();
foreach ($this->organizations as $organization) {
    $organization = CCExHelpersCast::cast('CCExModelsOrganization', $organization);
    if(!$organization->user()){
        array_push($orgWithoutResponsible, $organization);
    }
}
?>

<?php if(count($orgWithoutResponsible)) { ?>
    <div class="alert alert-warning fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h4>Organizations without responsible</h4>
        <p class="small" style="line-height:20px">Currently there are <?php echo count($orgWithoutResponsible); ?> organizations without responsible.<br/>
        These organizations are still available for global and peer comparison. Please check their status, since your data may be unrealistic or outdated.<br/>
        This situation occurs when a user account is deleted before your data has been cleared.<br/>
        Currently the organizations without responsible are:</p>
        <ul>
            <?php foreach ($orgWithoutResponsible as $organization) { ?>
                <li>
                    <a class="small" href="<?php echo JRoute::_('index.php?view=administration&layout=organization&organization_id=' . $organization->organization_id) ?>"><?php echo htmlspecialchars($organization->name ) ?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>

<div style="padding: 30px 0">
    <table id="tableOrganizations" class="table table-condensed table-font-small">
        <thead>
            <th>Organisation</th>
            <th>User</th>
            <th>Email</th>
            <th>AU</th>
            <th>Country</th>
            <th>Currency</th>
            <th>Types</th>
            <th>GC</th>
            <th>PC</th>
            <th>LD</th>
            <th>CS</th>
            <th>SP</th>
        </thead>
        <tbody>
            <?php foreach ($this->organizations as $organization) { ?>
                <?php $organization = CCExHelpersCast::cast('CCExModelsOrganization', $organization); ?>
                <tr>
                    <td><a href="<?php echo JRoute::_('index.php?view=administration&layout=organization&organization_id=' . $organization->organization_id) ?>"><?php echo htmlspecialchars($organization->name ) ?></a></td>
                    <td><?php if($organization->user()){ echo "<a href=\"administrator/index.php?option=com_users&view=users\">" . htmlspecialchars($organization->user()->name) . "</a>"; } ?></td>
                    <td><?php if($organization->user()){ echo "<a href=\"mailto:" . htmlspecialchars($organization->user()->email) . "\">" . htmlspecialchars($organization->user()->email) . "</a>"; } ?></td>
                    <td><?php if($organization->user()){ echo "&#x2713;"; }else{ echo "&#xd7;"; } ?></td>
                    <td><?php echo $organization->country()->name ?></td>
                    <td><?php echo $organization->currency()->code ?></td>
                    <td><?php echo htmlspecialchars($organization->typesToString()) ?></td>
                    <td><?php if($organization->global_comparison){ echo "&#x2713;"; }else{ echo "&#xd7;"; } ?></td>
                    <td><?php if($organization->peer_comparison){ echo "&#x2713;"; }else{ echo "&#xd7;"; } ?></td>
                    <td><?php if($organization->organization_linked){ echo "&#x2713;"; }else{ echo "&#xd7;"; } ?></td>
                    <td><?php if($organization->contact_and_sharing){ echo "&#x2713;"; }else{ echo "&#xd7;"; } ?></td>
                    <td><?php if($organization->snapshots){ echo "&#x2713;"; }else{ echo "&#xd7;"; } ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<h4>Legend</h4>
<dl class="dl-horizontal table-legend">
    <dt>AU</dt>
        <dd>Active user</dd>
    <dt>GC</dt>
        <dd>Allow the use of my anonymised cost data to calculate averages in the global comparison result.</dd>
    <dt>PC</dt>
        <dd>Allow the use of my anonymised cost data for peer comparisons.</dd>
    <dt>LD</dt>
        <dd>Allow my organisation to be linked to the cost data I provide.</dd>
    <dt>CS</dt>
        <dd>Allow registered users to contact me and allow my cost data to be shared with them.</dd>
    <dt>SP</dt>
        <dd>Allow snapshots of my anonymised cost data to be collected periodically.</dd>
    <br/>
    <dt>&#x2713;</dt>
        <dd>Yes</dd>
    <dt>&#xd7;</dt>
        <dd>No</dd>
</dl>

<script type="text/javascript">
$(document).ready( function () {
    $('#tableOrganizations').dataTable( {
        "dom": 'T<"clear">lfrtip',
        "tableTools": {
            "sSwfPath": "/templates/ccextemplate/libs/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
        }
    } );
} );
</script>
