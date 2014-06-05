<form class="form-horizontal" id="organizationForm" role="form">
    <h2>Organisation</h2>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="organisation_name">Name</label>
        <div class="col-sm-10">
            <input class="form-control" id="organisation_name" name="organization[name]" type="text" value="<?php if(isset($this->organization->name)){ echo $this->organization->name; } ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="organization_type">Type</label>
        <div class="col-sm-10" data-container="body" data-placement="right" data-toggle='tooltip' title="If there is not a perfect match between your organisation and one of the options, similar is sufficient.">
            <select class="form-control" id="organization_type" name="organization[org_type_id]" onChange="changeOrganizationTpe()">
                <?php for($i=0, $n = count($this->orgTypes);$i<$n;$i++) { ?>
                <option <?php if($this->orgTypes[$i]->name == $this->organization->organizationTypeOrOther()->name){ echo "selected=\"true\""; }?> value="<?php echo $this->orgTypes[$i]->org_type_id; ?>"><?php echo $this->orgTypes[$i]->name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group has-feedback" id="organisation_type_other_container" <?php if($this->organization->organizationTypeOrOther()->name != "Other"){ echo "style=\"display: none;\""; } ?>>
        <label class="col-sm-2 control-label" for="organisation_type_other">Other type</label>
        <div class="col-sm-10">
            <input <?php if(isset($this->organization->other_org_type)){ echo "value=\"" . $this->organization->other_org_type . "\""; }?> class="form-control" id="organisation_type_other" name="organization[other_org_type]" type="text" >
            <span class="glyphicon glyphicon-info-sign form-control-feedback" data-container="body" data-placement="right" data-toggle='tooltip' title="If you select 'Other' on the dropdown above, describe your organisation type here."></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="organisation_description">Description, purpose and mission</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="organisation_description" name="organization[description]" rows="3" type="text"><?php if(isset($this->organization->description)){ echo $this->organization->description; }?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="organization_country">Country</label>
        <div class="col-sm-10" data-container="body" data-placement="right" data-toggle='tooltip' title="Indicate in which country where the organization's headquarters are located.">
            <select class="form-control" id="organization_country" name="organization[country_id]">
                <?php for($i=0, $n = count($this->countries);$i<$n;$i++) { ?>
                <option <?php if(isset($this->organization->country_id) && $this->countries[$i]->country_id == $this->organization->country_id){ echo "selected=\"true\""; }?> value="<?php echo $this->countries[$i]->country_id; ?>"><?php echo $this->countries[$i]->name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="collection_data_volume">Currency</label>
        <div class="col-sm-10" data-container="body" data-placement="right" data-toggle='tooltip' title="Indicate the currency in which you would prefer to provide costs to the CCEx.">
            <select class="form-control" id="organization_currency" name="organization[currency_id]">
                <?php for($i=0, $n = count($this->currencies);$i<$n;$i++) { ?>
                <option <?php if(isset($this->organization->currency_id) && $this->currencies[$i]->currency_id == $this->organization->currency_id){ echo "selected=\"true\""; }?> value="<?php echo $this->currencies[$i]->currency_id; ?>"><?php echo $this->currencies[$i]->name; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <br/>
    <h2>Information sharing</h2>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input name="organization[linked_data_provider]" <?php echo (isset($this->organization->linked_data_provider) && $this->organization->linked_data_provider ? 'checked="true"' : '') ?> type="checkbox"> Allow my organisation to be listed as a data provider
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input name="organization[linked_cost_data]" <?php echo (isset($this->organization->linked_cost_data) && $this->organization->linked_cost_data ? 'checked="true"' : '') ?> type="checkbox"> Allow my organisation to be linked to the cost data I provide
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="collection_data_volume">Share information with</label>
        <div class="col-sm-10">
            <label class="radio-inline">
                <input <?php if(!isset($this->organization->share_information) || $this->organization->share_information == "everyone"){ echo 'checked="true"'; } ?> id="inlineRadio1" name="organization[share_information]" type="radio" value="everyone">Everyone</label>
            <label class="radio-inline">
                <input <?php if(isset($this->organization->share_information) && $this->organization->share_information == "trusted"){ echo 'checked="true"'; } ?> id="inlineRadio2" name="organization[share_information]" type="radio" value="trusted">Trusted users</label>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="collection_data_volume">Share data with</label>
        <div class="col-sm-10">
            <label class="radio-inline">
                <input <?php if(!isset($this->organization->share_data) || $this->organization->share_data == "everyone"){ echo 'checked="true"'; } ?> id="inlineRadio1" name="organization[share_data]" type="radio" value="everyone">Everyone</label>
            <label class="radio-inline">
                <input <?php if(isset($this->organization->share_data) && $this->organization->share_data == "trusted"){ echo 'checked="true"'; } ?> id="inlineRadio2" name="organization[share_data]" type="radio" value="trusted">Trusted users</label>
        </div>
    </div>
    <br/>
    <!-- Action -->
    <div class="form-group">
		<div class="col-sm-2">
			<div class="alert alert-dismissable" id="_message_container" style="display: none;">
	        	<button aria-hidden="true" class="close" data-dismiss="alert" type="button">&times;</button>
	        	<p id="_message"></p>
	        	<p id="_description"></p>
	    	</div>
	    </div>
        <div class="col-sm-2">
            <?php if(isset($this->organization->organization_id)){ ?>
                <input type="hidden" name="organization[organization_id]" value="<?php echo $this->organization->organization_id; ?>">
            <?php } ?>
            <a class="btn btn-success btn-block" href="javascript:void(0)" onclick="<?php if(isset($this->organization->organization_id)){ echo 'ccexUpdate(\'organization\', \'' . JRoute::_('index.php?view=comparecosts&layout=index') . '\')'; }else{ echo 'ccexCreate(\'organization\', \'' . JRoute::_('index.php?view=comparecosts&layout=index') . '\')'; } ?>">Save Profile</span></a>
        </div>
        <?php if(isset($this->organization->organization_id)){ ?>
            <div class="col-sm-2">
                <a class="btn btn-danger btn-block" href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>">Cancel</span></a>
            </div>
        <?php } ?>
    </div>
    
</form>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/form.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/organization.js') ?>"></script>
