<form class="form-horizontal" id="costForm" role="form">
	<div class="form-group">
		<label for="cost_name" class="col-sm-2 control-label">Name</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="cost_name" name="cost[name]" value="<?php if(isset($this->cost->name)){ echo $this->cost->name; } ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="cost_description" class="col-sm-2 control-label">Description</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" id="cost_description" rows="3" name="cost[description]"><?php if(isset($this->cost->description)){ echo $this->cost->description; } ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="cost_value" class="col-sm-2 control-label">Cost</label>
		<div class="col-sm-2">
			<div class="input-group">
				<input id="cost_value" type="number" min="0" class="form-control" name="cost[cost]" value="<?php if(isset($this->cost->cost)){ echo $this->cost->cost; } ?>">
				<span class="input-group-addon"><?php echo $this->currency->symbol ?></span>
			</div>
		</div>
	</div>
	<br/>
	<h2>Financial accounting mapping</h2>
	<p>Map this cost to financial accounting categories from our framework of comparable costs. This will enable you to compare your costs with others.</p>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<div class="col-sm-4 text-right">
					<h3>Procurement</h3>
				</div>
			</div>
			<div class="form-group" data-toggle="tooltip" data-placement="left" data-container="body" title="Machines and media used throughout the whole digital asset lifecycle. Hardware may receive, store, validate, make copies, migrate and disseminate digital assets.">
				<label for="cat_hardware" class="col-sm-4 control-label">Hardware</label>
				<div class="col-sm-8">
					<input id="cat_hardware" name="cost[cat_hardware]" class="slider" data-slider-id='cat_hardware' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_hardware)){ echo $this->cost->cat_hardware; } ?>" value="<?php if(isset($this->cost->cat_hardware)){ echo $this->cost->cat_hardware; } ?>" data-slider-tooltip="hide"/>
					<span id="cat_hardware_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group" data-toggle="tooltip" data-placement="left" data-container="body" title="Programs used throughout the whole digital asset lifecycle. Software may receive, process, validate, create copies, migrate and disseminate digital assets.">
				<label for="cat_software" class="col-sm-4 control-label">Software</label>
				<div class="col-sm-8">
					<input id="cat_software" name="cost[cat_software]" class="slider" data-slider-id='cat_software' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_software)){ echo $this->cost->cat_software; } ?>" value="<?php if(isset($this->cost->cat_software)){ echo $this->cost->cat_software; } ?>" data-slider-tooltip="hide"/>
					<span id="cat_software_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group" data-toggle="tooltip" data-placement="left" data-container="body" title="Costs spent to buy services from 3rd party providers.
Includes outsourcing, renting and leasing of hardware and software.">
				<label for="cat_external" class="col-sm-4 control-label">External or 3<sup>rd</sup> party services</label>
				<div class="col-sm-8">
					<input id="cat_external" name="cost[cat_external]" class="slider" data-slider-id='cat_external' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_external)){ echo $this->cost->cat_external; } ?>" value="<?php if(isset($this->cost->cat_external)){ echo $this->cost->cat_external; } ?>" data-slider-tooltip="hide"/>
					<span id="cat_external_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4 text-right">
					<h3>Staff</h3>
				</div>
			</div>
			<div class="form-group" data-toggle="tooltip" data-placement="left" data-container="body" title="Any individual involved in creating digital content. This may include for example researchers generating and managing digital research data or aggregating new subsets of existing data for new analysis; government employees undertaking data collection and analysis. Producers may also include software developers and vendors who are producing code to enable analysis, manipulation and visualisation of digital content.">
				<label for="cat_producer" class="col-sm-4 control-label">Producer</label>
				<div class="col-sm-8">
					<input id="cat_producer" name="cost[cat_producer]" class="slider" data-slider-id='cat_producer' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_producer)){ echo $this->cost->cat_producer; } ?>" value="<?php if(isset($this->cost->cat_producer)){ echo $this->cost->cat_producer; } ?>" data-slider-tooltip="hide"/>
					<span id="cat_producer_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group" data-toggle="tooltip" data-placement="left" data-container="body" title="Staff members who develop software. Software engineers, programmers, system developers, coders.">
				<label for="cat_it-developer" class="col-sm-4 control-label">IT-developer</label>
				<div class="col-sm-8">
					<input id="cat_it-developer" name="cost[cat_it_developer]" class="slider" data-slider-id='cat_it-developer' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_it_developer)){ echo $this->cost->cat_it_developer; } ?>" value="<?php if(isset($this->cost->cat_it_developer)){ echo $this->cost->cat_it_developer; } ?>" data-slider-tooltip="hide"/>
					<span id="cat_it-developer_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group" data-toggle="tooltip" data-placement="left" data-container="body" title="Staff members who execute technical tasks, for example testing digital material at ingest, operating the computers when migration occurs, burning optical disks, setting up robots, etc.">
				<label for="cat_support" class="col-sm-4 control-label">Support/operations</label>
				<div class="col-sm-8">
					<input id="cat_support" name="cost[cat_support]" class="slider" data-slider-id='cat_support' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_support)){ echo $this->cost->cat_support; } ?>" value="<?php if(isset($this->cost->cat_support)){ echo $this->cost->cat_support; } ?>" data-slider-tooltip="hide"/>
					<span id="cat_support_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group" data-toggle="tooltip" data-placement="left" data-container="body" title="Staff members who execute the preservation planning of the managers; archivists who appraise digital assets, consult at access, execute administrative tasks.">
				<label for="cat_analyst" class="col-sm-4 control-label">Preservation analyst</label>
				<div class="col-sm-8">
					<input id="cat_analyst" name="cost[cat_analyst]" class="slider" data-slider-id='cat_analyst' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_analyst)){ echo $this->cost->cat_analyst; } ?>" value="<?php if(isset($this->cost->cat_analyst)){ echo $this->cost->cat_analyst; } ?>" data-slider-tooltip="hide"/>
					<span id="cat_analyst_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group" data-toggle="tooltip" data-placement="left" data-container="body" title="Staff members who organise and plan the work of digital curation in their organisation. Make tactical and strategic decisions, have staff responsibility and do budgeting.">
				<label for="cat_manager" class="col-sm-4 control-label">Manager</label>
				<div class="col-sm-8">
					<input id="cat_manager" name="cost[cat_manager]" class="slider" data-slider-id='cat_manager' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_manager)){ echo $this->cost->cat_manager; } ?>" value="<?php if(isset($this->cost->cat_manager)){ echo $this->cost->cat_manager; } ?>" data-slider-tooltip="hide"/>
					<span id="cat_manager_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-4 text-right">
					<h3>Overhead</h3>
				</div>
			</div>
			<div class="form-group" data-toggle="tooltip" data-placement="left" data-container="body" title="All costs pertaining to overhead costs such as building costs, electricity, water, etc.">
				<label for="cat_overhead" class="col-sm-4 control-label">Overhead</label>
				<div class="col-sm-8">
					<input id="cat_overhead" name="cost[cat_overhead]" class="slider" data-slider-id='cat_overhead' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_overhead)){ echo $this->cost->cat_overhead; } ?>" value="<?php if(isset($this->cost->cat_overhead)){ echo $this->cost->cat_overhead; } ?>" data-slider-tooltip="hide"/>
					<span id="cat_overhead_feedback" class="slider-feedback"></span>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<canvas id="faChart" width="400" height="400" style="margin: 20px 90px 0px;" ></canvas>
			<div class="caption text-center" >
				<h2 id="faTotalFeedback"></h2>
			</div>
		</div>
	</div>
	<br/>
	<h2>Activities mapping</h2>
	<p>Map this cost to activity categories from our framework of comparable costs. This will enable you to compare your costs with others.</p>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group" data-toggle="tooltip" data-placement="left" data-container="body" title="Digital content production involves any activity related to planning, creation, management, preservation and adding value to digital assets throughout their lifecycle.">
				<label for="cat_production" class="col-sm-4 control-label">Production</label>
				<div class="col-sm-8">
					<input id="cat_production" name="cost[cat_production]" class="slider" data-slider-id='cat_production' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_production)){ echo $this->cost->cat_production; } ?>" value="<?php if(isset($this->cost->cat_production)){ echo $this->cost->cat_production; } ?>" data-slider-tooltip="hide"/>
					<span id="cat_production_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group" data-toggle="tooltip" data-placement="left" data-container="body" title="This activity covers processes related to receiving digital assets from an external source and preparing them for storage. Examples of activities that could fit into this activity category are: appraisal, submission agreement, validation of digital assets, metadata enrichment, preparing digital assets for storage within the archive.">
				<label for="cat_ingest" class="col-sm-4 control-label">Ingest</label>
				<div class="col-sm-8">
					<input id="cat_ingest" name="cost[cat_ingest]" class="slider" data-slider-id='cat_ingest' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_ingest)){ echo $this->cost->cat_ingest; } ?>" value="<?php if(isset($this->cost->cat_ingest)){ echo $this->cost->cat_ingest; } ?>" data-slider-tooltip="hide"/>
					<span id="cat_ingest_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group" data-toggle="tooltip" data-placement="left" data-container="body" title="This activity covers processes related to storing, maintaining and retrieving the digital assets.Examples of activities that could fit into this activity category are: error checking, media migration, storage hierarchy management, providing disaster recovery capabilities.">
				<label for="cat_storage" class="col-sm-4 control-label">Archival storage</label>
				<div class="col-sm-8">
					<input id="cat_storage" name="cost[cat_storage]" class="slider" data-slider-id='cat_storage' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_storage)){ echo $this->cost->cat_storage; } ?>" value="<?php if(isset($this->cost->cat_storage)){ echo $this->cost->cat_storage; } ?>" data-slider-tooltip="hide"/>
					<span id="cat_storage_feedback" class="slider-feedback"></span>
				</div>
			</div>
			<div class="form-group" data-toggle="tooltip" data-placement="left" data-container="body" title="This activity covers processes related to accessing the stored digitial assets. Examples of activities that could fit into this activity category are: providing access to digital assets and describing them meaningfully by adding relevant metadata to them.">
				<label for="cat_access" class="col-sm-4 control-label">Access</label>
				<div class="col-sm-8">
					<input id="cat_access" name="cost[cat_access]" class="slider" data-slider-id='cat_access' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_access)){ echo $this->cost->cat_access; } ?>" value="<?php if(isset($this->cost->cat_access)){ echo $this->cost->cat_access; } ?>" data-slider-tooltip="hide"/>
					<span id="cat_access_feedback" class="slider-feedback"></span>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<canvas id="activitiesChart" width="400" height="400" style="margin: 20px 90px 0px;" ></canvas>
			<div class="caption text-center" >
				<h2 id="activitiesTotalFeedback"></h2>
			</div>
		</div>
	</div>

	<br/>
	<div class="form-group">
		<div class="col-sm-2">
			<div class="alert alert-dismissable" id="_message_container" style="display: none;">
	        	<button aria-hidden="true" class="close" data-dismiss="alert" type="button">&times;</button>
	        	<p id="_message"></p>
	        	<p id="_description"></p>
	    	</div>
	    </div>
		<div class="col-sm-2">
			<input type="hidden" name="cost[collection_id]" value="<?php echo $this->collection->collection_id; ?>">
			<?php if(isset($this->cost->cost_id)){ ?>
				<input type="hidden" name="cost[cost_id]" value="<?php echo $this->cost->cost_id; ?>">
			<?php } ?>
			<a href="javascript:void(0)" onclick="<?php if(isset($this->cost->cost_id)){ echo 'updateCost(\'' . JRoute::_('index.php?option=com_ccex&view=cost&layout=index') .  '\')'; }else{ echo 'createCost()'; } ?>" class="btn btn-success btn-block">Save</a>		
		</div>
		<div class="col-sm-2">
			<a href="<?php echo JRoute::_('index.php?option=com_ccex&view=cost&layout=index') ?>" class="btn btn-danger btn-block">Cancel</a>
		</div>
	</div>
</form>

<script>
$("[data-toggle='tooltip']").tooltip();

var formatter = function(total) {
	var cost = +($("#cost_value").val());
	if(isNaN(cost) || cost <= 0) {
		return total + "%";
	} else {
		return Humanize.formatNumber((cost * total) / 100.0, 0) +" € &nbsp; <small>| "+total+"%</small>";
	}

	return total + "%";
};

var faSliderUtils = new SliderUtils("#faChart", 400, 400, "#faTotalFeedback", formatter);
faSliderUtils.addSlider("#cat_hardware", "#00b050", "Hardware", "#cat_hardware_feedback");
faSliderUtils.addSlider("#cat_software", "#006fc0", "Software", "#cat_software_feedback");
faSliderUtils.addSlider("#cat_external", "#ff0000", "External or third party services", "#cat_external_feedback");

faSliderUtils.addSlider("#cat_producer", "#e46c0a", "Producer", "#cat_producer_feedback");
faSliderUtils.addSlider("#cat_it-developer", "#E80796", "IT-developer", "#cat_it-developer_feedback");
faSliderUtils.addSlider("#cat_support", "#5D07E8", "Support/operations", "#cat_support_feedback");
faSliderUtils.addSlider("#cat_analyst", "#11FFF7", "Preservation analyst", "#cat_analyst_feedback");
faSliderUtils.addSlider("#cat_manager", "#8DFF1E", "Manager", "#cat_manager_feedback");
	
faSliderUtils.addSlider("#cat_overhead", "#71A7FF", "Overhead", "#cat_overhead_feedback");

faSliderUtils.init();
faSliderUtils.updateLabels();

var activitiesSliderUtils = new SliderUtils("#activitiesChart", 400, 400, "#activitiesTotalFeedback", formatter);
activitiesSliderUtils.addSlider("#cat_production", "#00b050", "Production","#cat_production_feedback");
activitiesSliderUtils.addSlider("#cat_ingest", "#006fc0", "Ingest", "#cat_ingest_feedback");
activitiesSliderUtils.addSlider("#cat_storage", "#ff0000", "Archival storage", "#cat_storage_feedback");
activitiesSliderUtils.addSlider("#cat_access", "#e46c0a", "Access", "#cat_access_feedback");
activitiesSliderUtils.init();
activitiesSliderUtils.updateLabels();

$("#cost_value").keyup(function() {
	faSliderUtils.updateLabels();
	activitiesSliderUtils.updateLabels();
});

$("#cost_value").change(function() {
	faSliderUtils.updateLabels();
	activitiesSliderUtils.updateLabels();
});

</script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/cost.js') ?>"></script>
