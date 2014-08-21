<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=index') ?>">Administration</a></li>
    <li class="active">Contact requests</li>
</ol>

<h1>Contact requests</h1>

<div style="padding: 30px 0">
    <table id="tableContact" class="table table-condensed table-font-small">
        <thead>
            <th>Sender email</th>
            <th>Sender organisation</th>
            <th>Recipient email</th>
            <th>Recipient organisation</th>
            <th>Message</th>
        </thead>
        <tbody>
            <?php foreach ($this->contacts as $contact) { ?>
                <?php
                    $organizationModel = new CCExModelsOrganization();
                    
                    $recipientOrganizations = $organizationModel->listItemsBy("_organization_id", $contact->recipient_organization_id);
                    $recipientOrganization = array_shift($recipientOrganizations);

                    $senderOrganizations = $organizationModel->listItemsBy("_organization_id", $contact->sender_organization_id);
                    $senderOrganization = array_shift($senderOrganizations);
                ?>
                <tr>
                    <td><a href="mailto:<?php echo $contact->sender_email ?>"><?php echo $contact->sender_email ?></a></td>
                    <td>
                        <?php if($senderOrganization) { ?>
                            <a href="<?php echo JRoute::_('index.php?view=administration&layout=organization&organization_id=' . $senderOrganization->organization_id) ?>"><?php echo htmlspecialchars($senderOrganization->name ) ?></a>
                        <?php } ?>
                    </td>
                    <td><a href="mailto:<?php echo $contact->recipient_email ?>"><?php echo $contact->recipient_email ?></td></td>
                    <td>
                        <?php if($recipientOrganization) { ?>
                            <a href="<?php echo JRoute::_('index.php?view=administration&layout=organization&organization_id=' . $recipientOrganization->organization_id) ?>"><?php echo htmlspecialchars($recipientOrganization->name ) ?></a>
                        <?php } ?>
                    </td>
                    <td><?php echo $contact->message ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
$(document).ready( function () {
    $('#tableContact').dataTable( {
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
