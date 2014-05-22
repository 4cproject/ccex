<h1>Profile</h1>
<p>Please fill out the following profile information for your organisation and your content to help identify your cost determinants and enable a comparison of costs against similar organisations. None of the information will be shared unless you explicitly allow this.</p>

<form class="form-horizontal" role="form" id="profileForm">
	<h2>Organisation</h2>
	<div class="form-group">
		<label for="organisation_name" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="organisation_name" name="organization[name]" value="<?php echo (isset($this->organization->name) ? $this->organization->name : '' ); ?>">
		</div>
	</div>

	<div class="form-group">
		<label for="organization_type" class="col-sm-2 control-label">Type</label>
		<div class="col-sm-10" data-toggle='tooltip' data-placement="right" data-container="body" title="If there is not a perfect match between your organisation and one of the options, similar is sufficient.">
			<select class="form-control" id="organization_type" name="organization[org_type_id]" onChange="changeOrganizationTpe()">
				<?php for($i=0, $n = count($this->orgTypes);$i<$n;$i++) { ?>
				    <option <?php 
						if($this->orgTypes[$i]->name == $this->organization->org_type->name){ 
				    		echo "selected=\"true\"";
				    	}?> value="<?php echo $this->orgTypes[$i]->org_type_id; ?>"><?php echo $this->orgTypes[$i]->name; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="form-group has-feedback" id="organisation_type_other_container" <?php
		if($this->organization->org_type->name != "Other"){ 
			echo "style=\"display: none;\"";
		}
	?> >
		<label for="organisation_type_other" class="col-sm-2 control-label">Other type</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="organisation_type_other" name="organization[other_org_type]" >
			<span class="glyphicon glyphicon-info-sign form-control-feedback" data-toggle='tooltip'  data-container="body" data-placement="right" title="If you select 'Other' on the dropdown above, describe your organisation type here."></span>
		</div>
	</div>
	<div class="form-group">
		<label for="organisation_description" class="col-sm-2 control-label">Description, purpose and mission</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" id="organisation_description" name="organization[description]" rows="3"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="organization_country" class="col-sm-2 control-label">Country</label>
		<div class="col-sm-10" data-toggle='tooltip' data-placement="right" data-container="body" title="Indicate in which country where the organization's headquarters are located.">
			<select class="form-control" id="organization_country" name="organization[country_id]">
				<?php for($i=0, $n = count($this->countries);$i<$n;$i++) { ?>
				    <option <?php 
						if(isset($this->organization->country_id) && $this->countries[$i]->country_id == $this->organization->country_id){ 
				    		echo "selected=\"true\"";
				    	}?> value="<?php echo $this->countries[$i]->country_id; ?>"><?php echo $this->countries[$i]->name; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="collection_data_volume" class="col-sm-2 control-label">Currency</label>
		<div class="col-sm-10" data-toggle='tooltip' data-placement="right" data-container="body" title="Indicate the currency in which you would prefer to provide costs to the CCEx.">
			<select class="form-control" id="organization_currency">
				<?php for($i=0, $n = count($this->currencies);$i<$n;$i++) { ?>
				    <option <?php 
						if(isset($this->organization->currency_id) && $this->currencies[$i]->currency_id == $this->organization->currency_id){ 
				    		echo "selected=\"true\"";
				    	}?> value="<?php echo $this->currencies[$i]->currency_id; ?>"><?php echo $this->currencies[$i]->name; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<br/>
	<h2>Collection profile</h2>
	<p class="small">This information is used to nuance and give sense to the submitted cost data. For example, the information "Data volume" will enable the calculation of costs per gigabyte, terabyte, petabyte...</p>
	<div class="form-group">
		<label for="collection_scope" class="col-sm-2 control-label">Scope</label>
		<div class="col-sm-10" data-toggle='tooltip' data-placement="right" data-container="body" title="You may not want to give cost information about the whole organisation, but just for a single department, project or even collection. Please describe the scope here.">
			<select class="form-control" id="collection_scope" name="scope[name]">
				<option  <?php 
						if(isset($this->scope->name) && $this->scope->name == 'The whole organisation'){ 
				    		echo "selected=\"true\"";
				    	}?>  value="The whole organisation">The whole organisation</option>
				<option <?php 
						if(isset($this->scope->name) && $this->scope->name == 'A department'){ 
				    		echo "selected=\"true\"";
				    	}?> value="A department">A department</option>
				<option <?php 
						if(isset($this->scope->name) && $this->scope->name == 'A project'){ 
				    		echo "selected=\"true\"";
				    	}?> value="A project">A project</option>
				<option <?php 
						if(isset($this->scope->name) && $this->scope->name == 'A collection'){ 
				    		echo "selected=\"true\"";
				    	}?> value="A collection">A collection</option>
				<option <?php 
						if(isset($this->scope->name) && $this->scope->name == 'Other'){ 
				    		echo "selected=\"true\"";
				    	}?> value="Other">Other</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="collection_staff" class="col-sm-2 control-label">Curation staff in scope</label>
		<div class="col-sm-10" data-toggle='tooltip' data-placement="right" data-container="body" title="Indicate the number of staff members working with digital curation within the scope defined above.">
			<select class="form-control" id="collection_staff" name="scope[staff]">
				<option <?php 
						if(isset($this->scope->max_size) && $this->scope->max_size == 10){ 
				    		echo "selected=\"true\"";
				    	}?> value="0|10">Less than 10 people</option>
				<option <?php 
						if(isset($this->scope->max_size) && $this->scope->max_size == 50){ 
				    		echo "selected=\"true\"";
				    	}?> value="10|50">Less than 50 people</option>
				<option <?php 
						if(isset($this->scope->max_size) && $this->scope->max_size == 100){ 
				    		echo "selected=\"true\"";
				    	}?> value="50|100">Less than 100 people</option>
				<option <?php 
						if(isset($this->scope->max_size) && $this->scope->max_size == 500){ 
				    		echo "selected=\"true\"";
				    	}?> value="100|500">Less than 500 people</option>
				<option <?php 
						if(isset($this->scope->max_size) && $this->scope->max_size == 1000){ 
				    		echo "selected=\"true\"";
				    	}?> value="500|1000">Less than 1000 people</option>
				<option <?php 
						if(isset($this->scope->max_size) && $this->scope->max_size == 10000){ 
				    		echo "selected=\"true\"";
				    	}?> value="1000|10000">Less than 10000 people</option>
				<option <?php 
						if(isset($this->scope->min_size) && $this->scope->min_size == 10000){ 
				    		echo "selected=\"true\"";
				    	}?> value="10000|0">More than 10000 people</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="collection_data_volume" class="col-sm-2 control-label">Data volume</label>
		<div class="col-sm-2">
			<input id="collection_data_volume_number" type="number" min="0" class="form-control" value="<?php echo $this->org_profile->dataVolume()->value; ?>" name="profile[data_volume_number]">
		</div>
		<div class="col-sm-2">
			<select class="form-control" id="collection_data_volume_unit" name="profile[data_volume_unit]" value="<?php echo $this->org_profile->dataVolume()->value; ?>">
				<option <?php 
						if($this->org_profile->dataVolume()->format == "Gigabytes"){ 
				    		echo "selected=\"true\"";
				    	}?> value="1">Gigabytes</option>
				<option <?php 
						if($this->org_profile->dataVolume()->format == "Terabytes"){ 
				    		echo "selected=\"true\"";
				    	}?> value="1024" selected="true">Terabytes</option>
				<option <?php 
						if($this->org_profile->dataVolume()->format == "Petabytes"){ 
				    		echo "selected=\"true\"";
				    	}?> value="1048576">Petabytes</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="collection_copies" class="col-sm-2 control-label">Number of copies</label>
		<div class="col-sm-10" data-toggle='tooltip' data-placement="right" data-container="body" title="Indicate the number of copies you have for each digital asset within the scope. The original does not count as a copy, only backup copies or replicas. If your organisation has a different number of copies policy dependending on the value of the assets, please provide the number closer to the average within the scope.">
			<select class="form-control" id="collection_copies" name="profile[number_copies]">
				<option <?php 
						if(isset($this->org_profile->number_copies) && $this->org_profile->number_copies == 0){ 
				    		echo "selected=\"true\"";
				    	}?> value="0">No replicas</option>
				<option <?php 
						if(isset($this->org_profile->number_copies) && $this->org_profile->number_copies == 1){ 
				    		echo "selected=\"true\"";
				    	}?> value="1">One replica</option>
				<option <?php 
						if(isset($this->org_profile->number_copies) && $this->org_profile->number_copies == 2){ 
				    		echo "selected=\"true\"";
				    	}?> value="2">Two replicas</option>
				<option <?php 
						if(isset($this->org_profile->number_copies) && $this->org_profile->number_copies == 3){ 
				    		echo "selected=\"true\"";
				    	}?> value="3">Three replicas</option>
				<option <?php 
						if(isset($this->org_profile->number_copies) && $this->org_profile->number_copies == -1){ 
				    		echo "selected=\"true\"";
				    	}?> value="-1">More than three replicas</option>
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
				<label for="collection_data_volume" class="col-sm-4 control-label">Unformatted text</label>
				<div class="col-sm-8">
					<input id="asset_unformatted_text" class="slider" data-slider-id='asset_unformatted_text' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0" data-slider-tooltip="hide" name="test"/>
					<span id="asset_unformatted_text_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Word processing</label>
				<div class="col-sm-8">
					<input id="asset_word_processing" class="slider" data-slider-id='asset_word_processing' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0" data-slider-tooltip="hide"/>
					<span id="asset_word_processing_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Spreadsheet</label>
				<div class="col-sm-8">
					<input id="asset_spreadsheet" class="slider" data-slider-id='asset_spreadsheet' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0" data-slider-tooltip="hide"/>
					<span id="asset_spreadsheet_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Graphics</label>
				<div class="col-sm-8">
					<input id="asset_graphics" class="slider" data-slider-id='asset_graphics' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0" data-slider-tooltip="hide"/>
					<span id="asset_graphics_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Audio</label>
				<div class="col-sm-8">
					<input id="asset_audio" class="slider" data-slider-id='asset_audio' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0" data-slider-tooltip="hide"/>
					<span id="asset_audio_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Video</label>
				<div class="col-sm-8">
					<input id="asset_video" class="slider" data-slider-id='asset_video' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0" data-slider-tooltip="hide"/>
					<span id="asset_video_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Hypertext</label>
				<div class="col-sm-8">
					<input id="asset_hypertext" class="slider" data-slider-id='asset_hypertext' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0" data-slider-tooltip="hide"/>
					<span id="asset_hypertext_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Geodata</label>
				<div class="col-sm-8">
					<input id="asset_geodata" class="slider" data-slider-id='asset_geodata' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0" data-slider-tooltip="hide"/>
					<span id="asset_geodata_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">E-mail</label>
				<div class="col-sm-8">
					<input id="asset_email" class="slider" data-slider-id='asset_email' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0" data-slider-tooltip="hide"/>
					<span id="asset_email_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Database</label>
				<div class="col-sm-8">
					<input id="asset_database" class="slider" data-slider-id='asset_database' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0" data-slider-tooltip="hide"/>
					<span id="asset_database_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Research data</label>
				<div class="col-sm-8">
					<input id="asset_research_data" class="slider" data-slider-id='asset_research_data' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0" data-slider-tooltip="hide"/>
					<span id="asset_research_data_feedback" class="slider-feedback"></span>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<canvas id="pieChart" width="400" height="400" style="margin: 20px 90px 0px;" ></canvas>
			<div class="caption text-center" >
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
					<input type="checkbox" checked="true">
					Allow my organisation to be listed as a data provider
				</label>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<div class="checkbox">
				<label>
					<input type="checkbox" checked="true">
					Allow my organisation to be linked to the cost data I provide
				</label>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label for="collection_data_volume" class="col-sm-2 control-label">Share information with</label>
		<div class="col-sm-10">
			<label class="radio-inline">
				<input type="radio" id="inlineRadio1" name="shareContactInfoWithRadios" value="option1" checked="true">Everyone</label>
				<label class="radio-inline">
					<input type="radio" id="inlineRadio2" name="shareContactInfoWithRadios" value="option2">Trusted users</label>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-2 control-label">Share data with</label>
				<div class="col-sm-10">
					<label class="radio-inline">
						<input type="radio" id="inlineRadio1" name="shareContactDataWithRadios" value="option1" checked="true">Everyone</label>
						<label class="radio-inline">
							<input type="radio" id="inlineRadio2" name="shareContactDataWithRadios" value="option2">Trusted users</label>
						</div>
					</div>
					<br/>
					
					<!-- Action -->
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-3">
							<a href="javascript:void(0)" onclick="updateProfile()" class="btn btn-success btn-block">Update Profile</span></a>
						</div>
						<div id="_message_container" class="alert alert-dismissable col-md-7" style="display: none;">
						  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						  <p id="_message"></p>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</form>
<script>
$("[data-toggle='tooltip']").tooltip();

var sliderUtils = new SliderUtils("#pieChart", 400, 400, "#assetTotalFeedback", function(total) {
	var volume_number = +($("#collection_data_volume_number").val());
	var volume_unit = +($("#collection_data_volume_unit").val());

	if(isNaN(volume_number) || isNaN(volume_unit) || volume_number <= 0) {
		return total + "%";
	} else {
		var volume = volume_number * volume_unit*1073741824 * total / 100.0;
		return humanFileSize(volume) +" &nbsp; <small>| "+total+"%</small>";
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

$("#collection_data_volume_number").keyup(function() {
	sliderUtils.updateLabels();
});
$("#collection_data_volume_number").change(function() {
	sliderUtils.updateLabels();
});
$("#collection_data_volume_unit").change(function() {
	sliderUtils.updateLabels();
});


</script>
