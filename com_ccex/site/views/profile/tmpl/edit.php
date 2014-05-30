<h1>Profile</h1>
<p>Please fill out the following profile information for your organisation and your content to help identify your cost determinants and enable a comparison of costs against similar organisations. None of the information will be shared unless you explicitly allow this.</p>
<form class="form-horizontal" id="profileForm" role="form">
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
    <h2>Collection profile</h2>
    <p class="small">This information is used to nuance and give sense to the submitted cost data. For example, the information "Data volume" will enable the calculation of costs per gigabyte, terabyte, petabyte...</p>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="collection_scope">Scope</label>
        <div class="col-sm-10" data-container="body" data-placement="right" data-toggle='tooltip' title="You may not want to give cost information about the whole organisation, but just for a single department, project or even collection. Please describe the scope here.">
            <select class="form-control" id="collection_scope" name="profile[scope]">
                <option <?php if(isset($this->collection->scope) && $this->collection->scope == 'The whole organisation'){ echo "selected=\"true\""; }?> value="The whole organisation">The whole organisation</option>
                <option <?php if(isset($this->collection->scope) && $this->collection->scope == 'A department'){ echo "selected=\"true\""; }?> value="A department">A department</option>
                <option <?php if(isset($this->collection->scope) && $this->collection->scope == 'A project'){ echo "selected=\"true\""; }?> value="A project">A project</option>
                <option <?php if(isset($this->collection->scope) && $this->collection->scope == 'A collection'){ echo "selected=\"true\""; }?> value="A collection">A collection</option>
                <option <?php if(isset($this->collection->scope) && $this->collection->scope == 'Other'){ echo "selected=\"true\""; }?> value="Other">Other</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="collection_staff">Curation
            staff in scope</label>
        <div class="col-sm-10" data-container="body" data-placement="right" data-toggle='tooltip' title="Indicate the number of staff members working with digital curation within the scope defined above.">
            <select class="form-control" id="collection_staff" name="profile[staff]">
                <option <?php if(isset($this->collection->staff_max_size) && $this->collection->staff_max_size == 10){ echo "selected=\"true\""; }?> value="0|10">Less than 10 people</option>
                <option <?php if(isset($this->collection->staff_max_size) && $this->collection->staff_max_size == 50){ echo "selected=\"true\""; }?> value="10|50">Less than 50 people</option>
                <option <?php if(isset($this->collection->staff_max_size) && $this->collection->staff_max_size == 100){ echo "selected=\"true\""; }?> value="50|100">Less than 100 people</option>
                <option <?php if(isset($this->collection->staff_max_size) && $this->collection->staff_max_size == 500){ echo "selected=\"true\""; }?> value="100|500">Less than 500 people</option>
                <option <?php if(isset($this->collection->staff_max_size) && $this->collection->staff_max_size == 1000){ echo "selected=\"true\""; }?> value="500|1000">Less than 1000 people</option>
                <option <?php if(isset($this->collection->staff_max_size) && $this->collection->staff_max_size == 10000){ echo "selected=\"true\""; }?> value="1000|10000">Less than 10000 people</option>
                <option <?php if(isset($this->collection->staff_min_size) && $this->collection->staff_min_size == 10000){ echo "selected=\"true\""; }?> value="10000|0">More than 10000 people</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="collection_data_volume">Data volume</label>
        <div class="col-sm-2">
            <input class="form-control" id="collection_data_volume_number" min="0" name="profile[data_volume_number]" type="number" value="<?php echo $this->collection->dataVolume()->value; ?>">
        </div>
        <div class="col-sm-2">
            <select class="form-control" id="collection_data_volume_unit" name="profile[data_volume_unit]" value="<?php echo $this->collection->dataVolume()->value; ?>">
                <option <?php if($this->collection->dataVolume()->format == "Gigabytes"){ echo "selected=\"true\""; }?> value="1">Gigabytes</option>
                <option <?php if($this->collection->dataVolume()->format == "Terabytes"){ echo "selected=\"true\""; }?> value="1024" selected="true">Terabytes</option>
                <option <?php if($this->collection->dataVolume()->format == "Petabytes"){ echo "selected=\"true\""; }?> value="1048576">Petabytes</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="collection_copies">Number of
            copies</label>
        <div class="col-sm-10" data-container="body" data-placement="right" data-toggle='tooltip' title="Indicate the number of copies you have for each digital asset within the scope. The original does not count as a copy, only backup copies or replicas. If your organisation has a different number of copies policy dependending on the value of the assets, please provide the number closer to the average within the scope.">
            <select class="form-control" id="collection_copies" name="profile[number_copies]">
                <option <?php if(isset($this->collection->number_copies) && $this->collection->number_copies == 0){ echo "selected=\"true\""; }?> value="0">No replicas</option>
                <option <?php if(isset($this->collection->number_copies) && $this->collection->number_copies == 1){ echo "selected=\"true\""; }?> value="1">One replica</option>
                <option <?php if(isset($this->collection->number_copies) && $this->collection->number_copies == 2){ echo "selected=\"true\""; }?> value="2">Two replicas</option>
                <option <?php if(isset($this->collection->number_copies) && $this->collection->number_copies == 3){ echo "selected=\"true\""; }?> value="3">Three replicas</option>
                <option <?php if(isset($this->collection->number_copies) && $this->collection->number_copies == -1){ echo "selected=\"true\""; }?> value="-1">More than three replicas</option>
            </select>
        </div>
    </div>
    <br/>
    <div class="form-group">
        <div class="col-sm-2 text-right">
            <h4>Asset types</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="collection_data_volume">Unformatted text</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_unformatted_text' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-tooltip="hide" data-slider-value="<?php echo (isset($this->collection->asset_unformatted_text) ? $this->collection->asset_unformatted_text : 0) ?>" id="asset_unformatted_text" name="profile[asset_unformatted_text]" type="text" value="<?php echo (isset($this->collection->asset_unformatted_text) ? $this->collection->asset_unformatted_text : 0) ?>"/>
                    <span class="slider-feedback" id="asset_unformatted_text_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="collection_data_volume">Word processing</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_word_processing' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-tooltip="hide" data-slider-value="<?php echo (isset($this->collection->asset_word_processing) ? $this->collection->asset_word_processing : 0) ?>" id="asset_word_processing" name="profile[asset_word_processing]" type="text" value="<?php echo (isset($this->collection->asset_word_processing) ? $this->collection->asset_word_processing : 0) ?>"/>
                    <span class="slider-feedback" id="asset_word_processing_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="collection_data_volume">Spreadsheet</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_spreadsheet' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-tooltip="hide" data-slider-value="<?php echo (isset($this->collection->asset_spreadsheet) ? $this->collection->asset_spreadsheet : 0) ?>" id="asset_spreadsheet" name="profile[asset_spreadsheet]" type="text" value="<?php echo (isset($this->collection->asset_spreadsheet) ? $this->collection->asset_spreadsheet : 0) ?>"/>
                    <span class="slider-feedback" id="asset_spreadsheet_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="collection_data_volume">Graphics</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_graphics' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-tooltip="hide" data-slider-value="<?php echo (isset($this->collection->asset_graphics) ? $this->collection->asset_graphics : 0) ?>" id="asset_graphics" name="profile[asset_graphics]" type="text" value="<?php echo (isset($this->collection->asset_graphics) ? $this->collection->asset_graphics : 0) ?>"/>
                    <span class="slider-feedback" id="asset_graphics_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="collection_data_volume">Audio</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_audio' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-tooltip="hide" data-slider-value="<?php echo (isset($this->collection->asset_audio) ? $this->collection->asset_audio : 0) ?>" id="asset_audio" name="profile[asset_audio]" type="text" value="<?php echo (isset($this->collection->asset_audio) ? $this->collection->asset_audio : 0) ?>"/>
                    <span class="slider-feedback" id="asset_audio_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="collection_data_volume">Video</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_video' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-tooltip="hide" data-slider-value="<?php echo (isset($this->collection->asset_video) ? $this->collection->asset_video : 0) ?>" id="asset_video" name="profile[asset_video]" type="text" value="<?php echo (isset($this->collection->asset_video) ? $this->collection->asset_video : 0) ?>"/>
                    <span class="slider-feedback" id="asset_video_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="collection_data_volume">Hypertext</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_hypertext' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-tooltip="hide" data-slider-value="<?php echo (isset($this->collection->asset_hypertext) ? $this->collection->asset_hypertext : 0) ?>" id="asset_hypertext" name="profile[asset_hypertext]" type="text" value="<?php echo (isset($this->collection->asset_hypertext) ? $this->collection->asset_hypertext : 0) ?>"/>
                    <span class="slider-feedback" id="asset_hypertext_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="collection_data_volume">Geodata</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_geodata' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-tooltip="hide" data-slider-value="<?php echo (isset($this->collection->asset_geodata) ? $this->collection->asset_geodata : 0) ?>" id="asset_geodata" name="profile[asset_geodata]" type="text" value="<?php echo (isset($this->collection->asset_geodata) ? $this->collection->asset_geodata : 0) ?>"/>
                    <span class="slider-feedback" id="asset_geodata_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="collection_data_volume">E-mail</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_email' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-tooltip="hide" data-slider-value="<?php echo (isset($this->collection->asset_email) ? $this->collection->asset_email : 0) ?>" id="asset_email" name="profile[asset_email]" type="text" value="<?php echo (isset($this->collection->asset_email) ? $this->collection->asset_email : 0) ?>"/>
                    <span class="slider-feedback" id="asset_email_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="collection_data_volume">Database</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_database' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-tooltip="hide" data-slider-value="<?php echo (isset($this->collection->asset_database) ? $this->collection->asset_database : 0) ?>" id="asset_database" name="profile[asset_database]" type="text" value="<?php echo (isset($this->collection->asset_database) ? $this->collection->asset_database : 0) ?>"/>
                    <span class="slider-feedback" id="asset_database_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="collection_data_volume">Research data</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_research_data' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-tooltip="hide" data-slider-value="<?php echo (isset($this->collection->asset_research_data) ? $this->collection->asset_research_data : 0) ?>" id="asset_research_data" name="profile[asset_research_data]" type="text" value="<?php echo (isset($this->collection->asset_research_data) ? $this->collection->asset_research_data : 0) ?>"/>
                    <span class="slider-feedback" id="asset_research_data_feedback"></span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <canvas height="400" id="pieChart" style="margin: 20px 90px 0px;" width="400"></canvas>
            <div class="caption text-center">
                <h2 id="assetTotalFeedback"></h2>
            </div>
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
        <div class="col-sm-3">
            <a class="btn btn-success btn-block" href="javascript:void(0)" onclick="updateProfile()">Save Profile</span></a>
    </div>
    
</form>
<script>
$("[data-toggle='tooltip']").tooltip();

var sliderUtils = new SliderUtils("#pieChart", 400, 400, "#assetTotalFeedback", function (total) {
        var volume_number = +($("#collection_data_volume_number").val());
        var volume_unit = +($("#collection_data_volume_unit").val());

        if (isNaN(volume_number) || isNaN(volume_unit) || volume_number <= 0) {
            return total + "%";
        } else {
            var volume = volume_number * volume_unit * 1073741824 * total / 100.0;
            return humanFileSize(volume) + " &nbsp; <small>| " + total + "%</small>";
        }

        return total + "%";
    });
sliderUtils.addSlider("#asset_unformatted_text", "#00b050", "Unformatted text", "#asset_unformatted_text_feedback");
sliderUtils.addSlider("#asset_word_processing", "#006fc0", "Word processing", "#asset_word_processing_feedback");
sliderUtils.addSlider("#asset_spreadsheet", "#ff0000", "Spreadsheet", "#asset_spreadsheet_feedback");
sliderUtils.addSlider("#asset_graphics", "#e46c0a", "Graphics", "#asset_graphics_feedback");
sliderUtils.addSlider("#asset_audio", "#E80796", "Audio", "#asset_audio_feedback");
sliderUtils.addSlider("#asset_video", "#5D07E8", "Video", "#asset_video_feedback");
sliderUtils.addSlider("#asset_hypertext", "#11FFF7", "Hypertext", "#asset_hypertext_feedback");
sliderUtils.addSlider("#asset_geodata", "#8DFF1E", "Geodata", "#asset_geodata_feedback");
sliderUtils.addSlider("#asset_email", "#71A7FF", "E-mail", "#asset_email_feedback");
sliderUtils.addSlider("#asset_database", "#FFF493", "Database", "#asset_database_feedback");
sliderUtils.addSlider("#asset_research_data", "#FFB271", "Research data", "#asset_research_data_feedback");
sliderUtils.init();
sliderUtils.updateLabels();

$("#collection_data_volume_number").keyup(function () {
    sliderUtils.updateLabels();
});
$("#collection_data_volume_number").change(function () {
    sliderUtils.updateLabels();
});
$("#collection_data_volume_unit").change(function () {
    sliderUtils.updateLabels();
});
</script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/profile.js') ?>"></script>
