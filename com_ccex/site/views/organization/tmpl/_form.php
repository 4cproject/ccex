<form class="form-horizontal" id="organizationForm" role="form">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="organisation_name">Name</label>
        <div class="col-sm-10">
            <input class="form-control" id="organisation_name" name="organization[name]" type="text" value="<?php if(isset($this->organization->name)){ echo $this->organization->name; } ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="organisation_description">Description, purpose and mission</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="organisation_description" name="organization[description]" rows="3" type="text"><?php if(isset($this->organization->description)){ echo $this->organization->description; }?></textarea>
        </div>
    </div>
    <div class="form-group" id="organisation_type_container">
        <label class="col-sm-2 control-label" for="organization_type">Type</label>
        <div class="col-sm-10">
            <div class="input-group">
                <?php for($i=0, $n = count($this->orgTypes);$i<$n;$i++) { ?>
                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label>
                              <input class="org-type-checkbox" <?php if(isset($this->organization->organization_id) && $this->organization->isOfType($this->orgTypes[$i]->org_type_id)){ echo 'checked'; } ?> type="checkbox" name="org_type[]" value="<?php echo $this->orgTypes[$i]->org_type_id; ?>">
                                <?php echo $this->orgTypes[$i]->name ?>
                            </label>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="form-group has-feedback" id="organisation_type_other_container" <?php if(!$this->organization->haveOtherType()){ echo "style=\"display: none;\""; } ?>>
        <label class="col-sm-2 control-label" for="organisation_type_other">Other type</label>
        <div class="col-sm-10">
            <input <?php if(isset($this->organization->other_org_type)){ echo "value=\"" . $this->organization->other_org_type . "\""; }?> class="form-control" id="organisation_type_other" name="organization[other_org_type]" type="text" >
            <span class="help-block"><small>If you select the 'Other' type, describe your organisation type here.</small></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="organization_country">Country</label>
        <div class="col-sm-10">
            <select class="form-control" id="organization_country" name="organization[country_id]">
                <option <?php if(!isset($this->organization->country_id)){ echo "selected=\"true\""; }?> value="">Select your country</option>
                <?php for($i=0, $n = count($this->countries);$i<$n;$i++) { ?>
                    <option <?php if(isset($this->organization->country_id) && $this->countries[$i]->country_id == $this->organization->country_id){ echo "selected=\"true\""; }?> value="<?php echo $this->countries[$i]->country_id; ?>"><?php echo $this->countries[$i]->name; ?></option>
                <?php } ?>
            </select>
            <span class="help-block"><small>Indicate in which country where the organisation's headquarters are located.</small></span>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="collection_data_volume">Currency</label>
        <div class="col-sm-10">
            <select class="form-control" id="organization_currency" name="organization[currency_id]">
                <option <?php if(!isset($this->organization->currency_id)){ echo "selected=\"true\""; }?> value="">Select your currency</option>
                <?php for($i=0, $n = count($this->currencies);$i<$n;$i++) { ?>
                    <option <?php if(isset($this->organization->currency_id) && $this->currencies[$i]->currency_id == $this->organization->currency_id){ echo "selected=\"true\""; }?> value="<?php echo $this->currencies[$i]->currency_id; ?>"><?php echo $this->currencies[$i]->name; ?></option>
                <?php } ?>
            </select>
            <span class="help-block"><small>Indicate the currency in which you would prefer to provide costs.</small></span>
        </div>
    </div>
    <br/>
    <h2>Information sharing</h2>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input name="organization[global_comparison]" <?php echo (!isset($this->organization->global_comparison) || $this->organization->global_comparison ? 'checked="true"' : '') ?> type="checkbox" value="1"> 
                    Allow the use of my anonymised cost data to calculate averages in the global comparison result.
                </label>
                <span class="help-block"><small>Averages will always have at least 5 organisations.</small></span>
            </div>
        </div>
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input name="organization[peer_comparison]" <?php echo (!isset($this->organization->peer_comparison) || $this->organization->peer_comparison ? 'checked="true"' : '') ?> type="checkbox" value="1"> 
                    Allow the use of my anonymised cost data for peer comparisons.
                </label>
                <span class="help-block"><small>Only mappings to the framework of comparable costs will be shown with this option.</small></span>
            </div>
        </div>
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input name="organization[contact_and_sharing]" <?php echo (isset($this->organization->contact_and_sharing) && $this->organization->contact_and_sharing ? 'checked="true"' : '') ?> type="checkbox" value="1"> 
                    Allow registered users to contact me and allow my cost data to be shared with them
                </label>
                <span class="help-block"><small>Your email is kept private at all times and contact requests can be ignored.</small></span>
            </div>
        </div>
        <div class="col-sm-offset-2 col-sm-10">
            <div class="checkbox">
                <label>
                    <input name="organization[snapshots]" <?php echo (isset($this->organization->snapshots) && $this->organization->snapshots ? 'checked="true"' : '') ?> type="checkbox" value="1">
                    Allow snapshots of my anonymised cost data to be collected periodically.
                </label>
                <span class="help-block"><small>Snapshots are taken for the sole purpose of contributing towards the development future research and helping to improve and refine tools and services.</small></span>
            </div>
        </div>
    </div>
    <br/>
    <!-- Action -->
    <div class="form-group utils">
        <div class="col-sm-2">
            <?php if(isset($this->organization->organization_id)){ ?>
                <input type="hidden" name="organization[organization_id]" value="<?php echo $this->organization->organization_id; ?>">
            <?php } ?>
            <a class="btn btn-success btn-block" href="javascript:void(0)" onclick="<?php if(isset($this->organization->organization_id)){ echo 'ccexUpdate(\'organization\', \'' . JRoute::_('index.php?view=comparecosts&layout=index') . '\')'; }else{ echo 'ccexCreate(\'organization\', \'' . JRoute::_('index.php?view=comparecosts&layout=index') . '\')'; } ?>">Save</span></a>
        </div>
		<div class="col-sm-2">
			<div class="alert alert-dismissable" id="_message_container" style="display: none;">
	        	<button aria-hidden="true" class="close" data-dismiss="alert" type="button">&times;</button>
	        	<p id="_message"></p>
	        	<p id="_description"></p>
	    	</div>
	    </div>
        <?php if(isset($this->organization->organization_id)){ ?>
            <div class="col-sm-2 col-sm-offset-4">
                <a class="btn btn-default btn-block btn-border" href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>">Cancel</span></a>
            </div>
            <div class="col-sm-2">
                <button class="btn btn-danger btn-block" disabled>Clear all data</button>
            </div>
        <?php } ?>
    </div>
    
</form>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/form.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/organization.js') ?>"></script>
