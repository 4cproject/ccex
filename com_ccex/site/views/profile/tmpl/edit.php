<h1>Profile</h1>
<p>Information about you, your organization and your content, that would allow us to find your cost determinants and allow us to show you which other organization your costs should be compared against. Please fill out the following information about your organisation. None of the information will be shared unless you explicitly allow this.</p>

<form class="form-horizontal" role="form">
	<h2>Organization</h2>
	<div class="form-group">
		<label for="organization_name" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="organization_name">
		</div>
	</div>
	<div class="form-group">
		<label for="organization_type" class="col-sm-2 control-label">Type</label>
		<div class="col-sm-10" data-toggle='tooltip' data-placement="right" data-container="body" title="If there is not a perfect match between your organisation and one of the options, similar is sufficient.">
			<select class="form-control" id="organization_type">
				<?php for($i=0, $n = count($this->orgTypes);$i<$n;$i++) { ?>
				    <option value="<?php echo $this->orgTypes[$i]->org_type_id; ?>"><?php echo $this->orgTypes[$i]->name; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="form-group has-feedback">
		<label for="organization_type_other" class="col-sm-2 control-label">Other type</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="organization_type_other">
			<span class="glyphicon glyphicon-info-sign form-control-feedback" data-toggle='tooltip'  data-container="body" data-placement="right" title="If you select 'Other' on the dropdown above, describe your organisation type here."></span>
		</div>
	</div>
	<div class="form-group">
		<label for="organization_description" class="col-sm-2 control-label">Description, purpose and mission</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" id="organization_description" rows="3"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="organization_country" class="col-sm-2 control-label">Country</label>
		<div class="col-sm-10" data-toggle='tooltip' data-placement="right" data-container="body" title="Indicate in which country where the organization's headquarters are located.">
			<select class="form-control" id="organization_country">
				<?php for($i=0, $n = count($this->countries);$i<$n;$i++) { ?>
				    <option value="<?php echo $this->countries[$i]->county_id; ?>"><?php echo $this->countries[$i]->name; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="collection_data_volume" class="col-sm-2 control-label">Currency</label>
		<div class="col-sm-10" data-toggle='tooltip' data-placement="right" data-container="body" title="Indicate the currency in which you would prefer to provide costs to the CCEx.">
			<select class="form-control" id="organization_currency">
				<?php for($i=0, $n = count($this->currencies);$i<$n;$i++) { ?>
				    <option value="<?php echo $this->currencies[$i]->currency_id; ?>"><?php echo $this->currencies[$i]->name; ?></option>
				<?php } ?>
			</select>
		</div>
	</div>

	<br/>
	<h2>Collection profile</h2>
	<p class="small">This information is used to nuance and give sense to the submitted cost data. For example, the information "Data volume" will allow us to calculate the costs per gigabyte, terabyte, petabyte...</p>
	<div class="form-group">
		<label for="collection_scope" class="col-sm-2 control-label">Scope</label>
		<div class="col-sm-10" data-toggle='tooltip' data-placement="right" data-container="body" title="You may not want to give cost information about the whole organization, but just for a single department, project or even collection. Please describe the scope here.">
			<select class="form-control" id="collection_scope">
				<option>The whole organization</option>
				<option>A department</option>
				<option>A project</option>
				<option>A collection</option>
				<option>Other</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="collection_staff" class="col-sm-2 control-label">Staff within scope</label>
		<div class="col-sm-10" data-toggle='tooltip' data-placement="right" data-container="body" title="Indicate the number of staff members working with digital curation within the scope defined above.">
			<select class="form-control" id="collection_staff">
				<option>Less than 10 people</option>
				<option>Less than 50 people</option>
				<option>Less than 100 people</option>
				<option>Less than 500 people</option>
				<option>Less than 1000 people</option>
				<option>Less than 10000 people</option>
				<option>More than 10000 people</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="collection_data_volume" class="col-sm-2 control-label">Data volume</label>
		<div class="col-sm-2">
			<input id="collection_data_volume_number" type="number" min="0" class="form-control">
		</div>
		<div class="col-sm-2">
			<select class="form-control" id="collection_data_volume_unit">
				<option value="1">Gigabytes</option>
				<option value="1024" selected="true">Terabytes</option>
				<option value="1048576">Petabytes</option>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="collection_copies" class="col-sm-2 control-label">Number of copies</label>
		<div class="col-sm-10" data-toggle='tooltip' data-placement="right" data-container="body" title="Indicate the number of copies you have for each digital asset within the scope. The original does not count as a copy, only backup copies or replicas. If your organization has a different number of copies policy dependending on the value of the assets, please provide the number closer to the average within the scope.">
			<select class="form-control" id="collection_copies">
				<option>No replicas</option>
				<option>One replica</option>
				<option>Two replicas</option>
				<option>Three replicas</option>
				<option>More than three replicas</option>
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
					<input id="asset_unformatted_text" class="slider" data-slider-id='asset_unformatted_text' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
					<span id="asset_unformatted_text_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Word processing</label>
				<div class="col-sm-8">
					<input id="asset_word_processing" class="slider" data-slider-id='asset_word_processing' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
					<span id="asset_word_processing_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Spreadsheet</label>
				<div class="col-sm-8">
					<input id="asset_spreadsheet" class="slider" data-slider-id='asset_spreadsheet' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
					<span id="asset_spreadsheet_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Graphics</label>
				<div class="col-sm-8">
					<input id="asset_graphics" class="slider" data-slider-id='asset_graphics' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
					<span id="asset_graphics_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Audio</label>
				<div class="col-sm-8">
					<input id="asset_audio" class="slider" data-slider-id='asset_audio' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
					<span id="asset_audio_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Video</label>
				<div class="col-sm-8">
					<input id="asset_video" class="slider" data-slider-id='asset_video' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
					<span id="asset_video_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Hypertext</label>
				<div class="col-sm-8">
					<input id="asset_hypertext" class="slider" data-slider-id='asset_hypertext' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
					<span id="asset_hypertext_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Geodata</label>
				<div class="col-sm-8">
					<input id="asset_geodata" class="slider" data-slider-id='asset_geodata' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
					<span id="asset_geodata_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">E-mail</label>
				<div class="col-sm-8">
					<input id="asset_email" class="slider" data-slider-id='asset_email' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
					<span id="asset_email_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Database</label>
				<div class="col-sm-8">
					<input id="asset_database" class="slider" data-slider-id='asset_database' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
					<span id="asset_database_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<label for="collection_data_volume" class="col-sm-4 control-label">Research data</label>
				<div class="col-sm-8">
					<input id="asset_research_data" class="slider" data-slider-id='asset_research_data' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="0"/>
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
							<a href="costs.html" class="btn btn-success btn-block">Define curation costs  <span class="fa fa-angle-right"></span></a>
						</div>
					</div>
				</form>
				<div class="alert alert-warning alert-dismissable col-md-offset-2 col-md-8">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				  <strong>Warning!</strong> This is a non-functioning mockup, no information will be saved.
				</div>
			</div>
		</div>
	</div>
</form>
<script>
$("[data-toggle='tooltip']").tooltip();

var sliderUtils = new SliderUtils("#pieChart", "#assetTotalFeedback", function(total) {
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
