<?php
    $configurationModel = new CCExModelsConfiguration();
?>

<form class="form-horizontal" id="organizationForm" role="form">
    <div class="form-group tour-step tour-step-org-name">
        <label  data-toggle="tooltip" data-placement="right" title="Please add the name of your organisation, institution, employer here" class="col-sm-2 control-label" for="organisation_name">Name</label>
        <div class="col-sm-10">
            <input class="form-control" id="organisation_name" name="organization[name]" type="text" value="<?php if(isset($this->organization->name)){ echo htmlspecialchars($this->organization->name) ; } ?>">
        </div>
    </div>
    <div class="form-group tour-step tour-step-org-description">
        <label data-toggle="tooltip" data-placement="right" title="Is your organisation for example a National Library, an archive or a data centre? You can also add a mission statement or other background information you would like to share/provide" class="col-sm-2 control-label" for="organisation_description">Description, purpose and mission</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="organisation_description" name="organization[description]" rows="3" type="text"><?php if(isset($this->organization->description)){ echo htmlspecialchars($this->organization->description) ; }?></textarea>
        </div>
    </div>
    <div class="form-group tour-step tour-step-org-type" style="padding-bottom: 8px;" id="organisation_type_container">
        <label data-toggle="tooltip" data-placement="right" title="Please select your organization types" class="col-sm-2 control-label" for="organization_type">Type</label>
        <div class="col-sm-10">
            <div class="input-group">
                <?php for($i=0, $n = count($this->orgTypes);$i<$n;$i++) { ?>
                    <?php if($this->orgTypes[$i]->name == "Other"){ ?>
                        <?php $other = $this->orgTypes[$i]; ?> 
                    <?php }else{ ?>
                        <div class="col-sm-6">
                            <div class="checkbox">
                                <label>
                                  <input class="org-type-checkbox" <?php if(isset($this->organization->organization_id) && $this->organization->isOfType($this->orgTypes[$i]->org_type_id)){ echo 'checked'; } ?> type="checkbox" name="org_type[]" value="<?php echo $this->orgTypes[$i]->org_type_id; ?>">
                                    <?php echo htmlspecialchars($this->orgTypes[$i]->name ) ?>
                                </label>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
                <?php if(isset($other)){ ?>
                    <div class="col-sm-6">
                        <div class="checkbox">
                            <label>
                              <input class="org-type-checkbox" <?php if(isset($this->organization->organization_id) && $this->organization->isOfType($other->org_type_id)){ echo 'checked'; } ?> type="checkbox" name="org_type[]" value="<?php echo $other->org_type_id; ?>">
                                <?php echo htmlspecialchars($other->name ) ?>
                            </label>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="form-group has-feedback tour-step tour-step-org-type-other" id="organisation_type_other_container" <?php if(!$this->organization->haveOtherType()){ echo "style=\"display: none;\""; } ?>>
        <label class="col-sm-2 control-label" for="organisation_type_other">Other type</label>
        <div class="col-sm-10">
            <input value="<?php if(isset($this->organization->other_org_type)){ echo htmlspecialchars($this->organization->other_org_type) ; }?>" class="form-control" id="organisation_type_other" name="organization[other_org_type]" type="text" >
            <!-- <span class="description-block"><small>If you select the 'Other' type, describe your organisation type here.</small></span> -->
        </div>
    </div>
    <div class="form-group tour-step tour-step-org-country">
        <label class="col-sm-2 control-label" for="organization_country">Country</label>
        <div class="col-sm-10">
            <select class="form-control" id="organization_country" name="organization[country_id]">
                <option <?php if(!isset($this->organization->country_id)){ echo "selected=\"true\""; }?> value="">Select your country</option>
                <?php for($i=0, $n = count($this->countries);$i<$n;$i++) { ?>
                    <option <?php if(isset($this->organization->country_id) && $this->countries[$i]->country_id == $this->organization->country_id){ echo "selected=\"true\""; }?> value="<?php echo $this->countries[$i]->country_id; ?>"><?php echo htmlspecialchars($this->countries[$i]->name) ; ?></option>
                <?php } ?>
            </select>
<!--             <span class="description-block"><small>Indicate in which country where the organisation's headquarters are located.</small></span>
 -->        </div>
    </div>
    <div class="form-group tour-step tour-step-org-currency">
        <label data-toggle="tooltip" data-placement="right" title="For global and peer-to-peer comparison all information on this website will be expressed in Euro. This is done by using the average exchange rate for the year the expenditures were made" class="col-sm-2 control-label" for="collection_data_volume">Currency</label>
        <div class="col-sm-10">
            <select class="form-control" id="organization_currency" name="organization[currency_id]">
                <option <?php if(!isset($this->organization->currency_id)){ echo "selected=\"true\""; }?> value="">Select your currency</option>
                <?php for($i=0, $n = count($this->currencies);$i<$n;$i++) { ?>
                    <option <?php if(isset($this->organization->currency_id) && $this->currencies[$i]->currency_id == $this->organization->currency_id){ echo "selected=\"true\""; }?> value="<?php echo $this->currencies[$i]->currency_id; ?>"><?php echo htmlspecialchars($this->currencies[$i]->name) ; ?></option>
                <?php } ?>
            </select>
<!--             <span class="description-block"><small>Indicate the currency in which you would prefer to provide costs.</small></span>
 -->        </div>
    </div>
    <br/>
    <div class="tour-step tour-step-org-sharing">
        <h2>Information sharing</h2>
        <p>When you register you give us some basic information about yourself.  We won’t abuse that information and we’d like to take this opportunity to draw your attention to our <a href="<?php echo JRoute::_('/60-privacy-policy'); ?>">privacy policy</a>.</p>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input name="organization[global_comparison]" <?php echo (!isset($this->organization->global_comparison) || $this->organization->global_comparison ? 'checked="true"' : '') ?> type="checkbox" value="1"> 
                        Allow the use of my anonymised cost data to calculate averages in the global comparison result.
                    </label>
                    <span class="description-block"><small>Averages will always have at least <?php echo $configurationModel->configurationValue("minimum_organizations_global_comparison", 5) ?> organisations.</small></span>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input name="organization[peer_comparison]" <?php echo (!isset($this->organization->peer_comparison) || $this->organization->peer_comparison ? 'checked="true"' : '') ?> type="checkbox" value="1"> 
                        Allow the use of my anonymised cost data for peer comparisons.
                    </label>
                    <span class="description-block"><small>Your cost data will be used in peer-to-peer comparisons, but your organisation will not be disclosed. Likewise, the peer organisation might be anonymous</small></span>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input name="organization[organization_linked]" <?php echo (!isset($this->organization->organization_linked) || $this->organization->organization_linked ? 'checked="true"' : '') ?> type="checkbox" value="1"> 
                         Allow the use of my non-anonymised cost data for peer comparisons.
                    </label>
                    <span class="description-block"><small>Your organisation name will be shown linked to your cost data in peer-to-peer comparisons.</small></span>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input name="organization[contact_and_sharing]" <?php echo (!isset($this->organization->contact_and_sharing) || $this->organization->contact_and_sharing ? 'checked="true"' : '') ?> type="checkbox" value="1"> 
                        Allow registered users to contact me through the site.
                    </label>
                    <span class="description-block"><small>Your email is kept private at all times and contact requests can be ignored.</small></span>
                </div>
            </div>
<!--             <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        <input name="organization[snapshots]" <?php echo (!isset($this->organization->snapshots) || $this->organization->snapshots ? 'checked="true"' : '') ?> type="checkbox" value="1">
                        Allow snapshots of my anonymised cost data to be collected periodically.
                    </label>
                    <span class="description-block"><small>Snapshots are taken for the sole purpose of contributing towards the development future research and helping to improve and refine tools and services.</small></span>
                </div>
            </div> -->
        </div>
    </div>
    <br/>
    <!-- Action -->
    <div class="form-group utils">
        <div class="col-sm-2">
            <div class="tour-step tour-step-org-save">
                <?php if(isset($this->organization->organization_id)){ ?>
                    <input type="hidden" name="organization[organization_id]" value="<?php echo $this->organization->organization_id; ?>">
                <?php } ?>
                <a class="btn btn-success btn-block btn-save-org" href="javascript:void(0)" onclick="<?php if(isset($this->organization->organization_id)){ echo 'ccexUpdate(\'organization\', \'' . JRoute::_('index.php?view=comparecosts&layout=datasets') . '\')'; }else{ echo 'ccexCreate(\'organization\', \'' . JRoute::_('index.php?view=comparecosts&layout=datasets') . '\')'; } ?>">Save and next</span></a>
            </div>
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
                <a class="btn btn-default btn-block btn-border" href="<?php echo JRoute::_('index.php?view=comparecosts&layout=datasets') ?>">Cancel</span></a>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-danger btn-block" id="clear-all-data">Clear all data</button>
            </div>
        <?php } ?>
    </div>
    
</form>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/exists.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/confirm-bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/form.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/organization.js') ?>"></script>
