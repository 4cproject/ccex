<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=index') ?>">Administration</a></li>
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=costs') ?>">Costs</a></li>
    <li class="active"><?php echo htmlspecialchars($this->cost->name) ; ?></li>
</ol>

<h1>
    <?php echo htmlspecialchars($this->cost->name ) ?> 
</h1>

<p class="description"><?php echo htmlspecialchars($this->cost->description ) ?></p>

<div class="row">
    <div class="col-md-6">
        <dl class="dl-horizontal" >
            <dt>Value</dt>
            <dd><?php echo $this->currency->symbol ?><?php echo $this->cost->cost ?></dd>
            <dt>Organisation</dt>
            <dd><a href="<?php echo JRoute::_('index.php?view=administration&layout=organization&organization_id=' . $this->cost->interval()->collection()->organization()->organization_id) ?>"><?php echo htmlspecialchars($this->cost->interval()->collection()->organization()->name ) ?></a></dd>
            <dt>Years</dt>
            <dd><a href="<?php echo JRoute::_('index.php?view=administration&layout=interval&interval_id=' . $this->cost->interval()->interval_id) ?>"><?php echo htmlspecialchars($this->cost->interval()->toString() ) ?></a></dd>
        </dl>
    </div>
    <div class="col-md-6">
        <dl class="dl-horizontal" >
            <dt>Human Resources</dt>
            <dd><?php echo $this->cost->human_resources ?></dd>
            <dt>Cost data set</dt>
            <dd><a href="<?php echo JRoute::_('index.php?view=administration&layout=collection&collection_id=' . $this->cost->interval()->collection()->collection_id) ?>"><?php echo htmlspecialchars($this->cost->interval()->collection()->name ) ?></a></dd>
        </dl>
    </div>
</div>

<form class="form-horizontal">
    <input id="cost_value" type="hidden" min="0" class="form-control" name="cost[cost]" value="<?php if(isset($this->cost->cost)){ echo $this->cost->cost; } ?>">
    <h2>Financial accounting mapping</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <div class="col-sm-4 text-right">
                    <h3>Procurement</h3>
                </div>
            </div>
            <div class="form-group">
                <label for="cat_hardware" class="col-sm-4 control-label"><button type="button" class="popover-dismiss tooltip-button" data-toggle="popover" title="Hardware" data-content="Machines and media used throughout the whole digital asset lifecycle. Hardware may receive, store, validate, make copies, migrate and disseminate digital assets.">Hardware </button></label>
                <div class="col-sm-8">
                    <input id="cat_hardware" name="cost[cat_hardware]" class="slider" data-slider-id='cat_hardware' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_hardware)){ echo $this->cost->cat_hardware; } ?>" value="<?php if(isset($this->cost->cat_hardware)){ echo $this->cost->cat_hardware; } ?>"/>
                    <span id="cat_hardware_feedback" class="slider-feedback" data-category="financial-accounting"><span class="feedback-currency-symbol"></span><span class="feedback-value editable-field"><span class="feedback-percentage-symbol"></span></span></span>
                </div>
            </div>
            <div class="form-group">
                <label for="cat_software" class="col-sm-4 control-label"><button type="button" class="popover-dismiss tooltip-button" data-toggle="popover" title="Software" data-content="Programs used throughout the whole digital asset lifecycle. Software may receive, process, validate, create copies, migrate and disseminate digital assets.">Software </button></label>
                <div class="col-sm-8">
                    <input id="cat_software" name="cost[cat_software]" class="slider" data-slider-id='cat_software' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_software)){ echo $this->cost->cat_software; } ?>" value="<?php if(isset($this->cost->cat_software)){ echo $this->cost->cat_software; } ?>"/>
                    <span id="cat_software_feedback" class="slider-feedback" data-category="financial-accounting"><span class="feedback-currency-symbol"></span><span class="feedback-value editable-field"><span class="feedback-percentage-symbol"></span></span></span>
                </div>
            </div>
            <div class="form-group">
                <label for="cat_external" class="col-sm-4 control-label"><button style="text-align: right" type="button" class="popover-dismiss tooltip-button" data-toggle="popover" title="External or 3rd party services" data-content="Costs spent to buy services from 3rd party providers. Includes outsourcing, renting and leasing of hardware and software.">External or 3<sup>rd</sup> party services </button></label>
                <div class="col-sm-8">
                    <input id="cat_external" name="cost[cat_external]" class="slider" data-slider-id='cat_external' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_external)){ echo $this->cost->cat_external; } ?>" value="<?php if(isset($this->cost->cat_external)){ echo $this->cost->cat_external; } ?>"/>
                    <span id="cat_external_feedback" class="slider-feedback" data-category="financial-accounting"><span class="feedback-currency-symbol"></span><span class="feedback-value editable-field"><span class="feedback-percentage-symbol"></span></span></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 text-right">
                    <h3>Staff</h3>
                </div>
            </div>
            <div class="form-group">
                <label for="cat_producer" class="col-sm-4 control-label"><button type="button" class="popover-dismiss tooltip-button" data-toggle="popover" title="Producer" data-content="Any individual involved in preparing digital content for archiving. This may include researchers who generate and manage digital research data, or aggregate new subsets of existing data for new analysis; or government employees undertaking data collection and analysis. Producers may also include software developers and vendors producing code to enable analysis, manipulation and visualisation of digital content.">Producer </button></label>
                <div class="col-sm-8">
                    <input id="cat_producer" name="cost[cat_producer]" class="slider" data-slider-id='cat_producer' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_producer)){ echo $this->cost->cat_producer; } ?>" value="<?php if(isset($this->cost->cat_producer)){ echo $this->cost->cat_producer; } ?>"/>
                    <span id="cat_producer_feedback" class="slider-feedback" data-category="financial-accounting"><span class="feedback-currency-symbol"></span><span class="feedback-value editable-field"><span class="feedback-percentage-symbol"></span></span></span>
                </div>
            </div>
            <div class="form-group">
                <label for="cat_it-developer" class="col-sm-4 control-label"><button type="button" class="popover-dismiss tooltip-button" data-toggle="popover" title="IT-developer" data-content="Staff members who develop software. Software engineers, programmers, system developers, coders.">IT-developer </button></label>
                <div class="col-sm-8">
                    <input id="cat_it-developer" name="cost[cat_it_developer]" class="slider" data-slider-id='cat_it-developer' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_it_developer)){ echo $this->cost->cat_it_developer; } ?>" value="<?php if(isset($this->cost->cat_it_developer)){ echo $this->cost->cat_it_developer; } ?>"/>
                    <span id="cat_it-developer_feedback" class="slider-feedback" data-category="financial-accounting"><span class="feedback-currency-symbol"></span><span class="feedback-value editable-field"><span class="feedback-percentage-symbol"></span></span></span>
                </div>
            </div>
            <div class="form-group">
                <label for="cat_operations" class="col-sm-4 control-label"><button type="button" class="popover-dismiss tooltip-button" data-toggle="popover" title="Operations" data-content="Staff members who execute technical tasks, for example testing digital material, operating the computers when migration occurs, burning optical disks, setting up robots, etc.), or administrative tasks, for example secretarial work, correspondence with content producers, execution of user requests at Access, etc.).">Operations </button></label>
                <div class="col-sm-8">
                    <input id="cat_operations" name="cost[cat_operations]" class="slider" data-slider-id='cat_operations' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_operations)){ echo $this->cost->cat_operations; } ?>" value="<?php if(isset($this->cost->cat_operations)){ echo $this->cost->cat_operations; } ?>"/>
                    <span id="cat_operations_feedback" class="slider-feedback" data-category="financial-accounting"><span class="feedback-currency-symbol"></span><span class="feedback-value editable-field"><span class="feedback-percentage-symbol"></span></span></span>
                </div>
            </div>
            <div class="form-group" data-toggle="tooltip">
                <label for="cat_specialist" class="col-sm-4 control-label"><button type="button" class="popover-dismiss tooltip-button" data-toggle="popover" title="Preservation specialist" data-content="Staff members who perform preservation actions and analyses, and provide specialist advice in relation to the digital repository, such as appraisal of digital material, execution of the preservation planning tasks, consultancy with users at Access, and other tasks requiring specialist preservation knowledge and academic skills.">Preservation specialist </button></label>
                <div class="col-sm-8">
                    <input id="cat_specialist" name="cost[cat_specialist]" class="slider" data-slider-id='cat_specialist' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_specialist)){ echo $this->cost->cat_specialist; } ?>" value="<?php if(isset($this->cost->cat_specialist)){ echo $this->cost->cat_specialist; } ?>"/>
                    <span id="cat_specialist_feedback" class="slider-feedback" data-category="financial-accounting"><span class="feedback-currency-symbol"></span><span class="feedback-value editable-field"><span class="feedback-percentage-symbol"></span></span></span>
                </div>
            </div>
            <div class="form-group">
                <label for="cat_manager" class="col-sm-4 control-label"><button type="button" class="popover-dismiss tooltip-button" data-toggle="popover" title="Manager" data-content="Staff members who organise and plan the work of digital curation in their organisation. Make tactical and strategic decisions, have staff responsibility and do budgeting.">Manager </button></label>
                <div class="col-sm-8">
                    <input id="cat_manager" name="cost[cat_manager]" class="slider" data-slider-id='cat_manager' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_manager)){ echo $this->cost->cat_manager; } ?>" value="<?php if(isset($this->cost->cat_manager)){ echo $this->cost->cat_manager; } ?>"/>
                    <span id="cat_manager_feedback" class="slider-feedback" data-category="financial-accounting"><span class="feedback-currency-symbol"></span><span class="feedback-value editable-field"><span class="feedback-percentage-symbol"></span></span></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 text-right">
                    <h3>Overhead</h3>
                </div>
            </div>
            <div class="form-group">
                <label for="cat_overhead" class="col-sm-4 control-label"><button type="button" class="popover-dismiss tooltip-button" data-toggle="popover" title="Overhead" data-content="All costs pertaining to overhead costs such as building costs, electricity, water, etc.">Overhead </button></label>
                <div class="col-sm-8">
                    <input id="cat_overhead" name="cost[cat_overhead]" class="slider" data-slider-id='cat_overhead' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_overhead)){ echo $this->cost->cat_overhead; } ?>" value="<?php if(isset($this->cost->cat_overhead)){ echo $this->cost->cat_overhead; } ?>"/>
                    <span id="cat_overhead_feedback" class="slider-feedback" data-category="financial-accounting"><span class="feedback-currency-symbol"></span><span class="feedback-value editable-field"><span class="feedback-percentage-symbol"></span></span></span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <canvas id="faChart" width="400" height="400" style="margin: 20px 90px 0px;" ></canvas>
            <div class="caption text-center" >
                <h2 id="faTotalFeedback"><span class="feedback-currency-symbol"></span><span class="feedback-value"></span><span class="feedback-percentage-symbol"></span></h2>
            </div>
        </div>
    </div>
    <br/>
    <h2>Activities mapping</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="cat_pre_ingest" class="col-sm-4 control-label"><button type="button" class="popover-dismiss tooltip-button" data-toggle="popover" title="Production" data-content="Digital content production involves any activity related to the preparation of digital assets for archiving. This might encompass digitisation, extraction of data from databases, metadata enrichment, migration of production formats to preservation formats, etc.">Pre-Ingest </button></label>
                <div class="col-sm-8">
                    <input id="cat_pre_ingest" name="cost[cat_pre_ingest]" class="slider" data-slider-id='cat_pre_ingest' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_pre_ingest)){ echo $this->cost->cat_pre_ingest; } ?>" value="<?php if(isset($this->cost->cat_pre_ingest)){ echo $this->cost->cat_pre_ingest; } ?>"/>
                    <span id="cat_pre_ingest_feedback" class="slider-feedback" data-category="activities"><span class="feedback-currency-symbol"></span><span class="feedback-value editable-field"><span class="feedback-percentage-symbol"></span></span></span>
                </div>
            </div>
            <div class="form-group">
                <label for="cat_ingest" class="col-sm-4 control-label"><button type="button" class="popover-dismiss tooltip-button" data-toggle="popover" title="Ingest" data-content="This activity covers processes related to receiving digital assets from an external source and preparing them for storage. Examples of activities that could fit into this activity category are: appraisal, submission agreement, validation of digital assets, metadata enrichment, preparing digital assets for storage within the archive.">Ingest </button></label>
                <div class="col-sm-8">
                    <input id="cat_ingest" name="cost[cat_ingest]" class="slider" data-slider-id='cat_ingest' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_ingest)){ echo $this->cost->cat_ingest; } ?>" value="<?php if(isset($this->cost->cat_ingest)){ echo $this->cost->cat_ingest; } ?>"/>
                    <span id="cat_ingest_feedback" class="slider-feedback" data-category="activities"><span class="feedback-currency-symbol"></span><span class="feedback-value editable-field"><span class="feedback-percentage-symbol"></span></span></span>
                </div>
            </div>
            <div class="form-group">
                <label for="cat_storage" class="col-sm-4 control-label"><button type="button" class="popover-dismiss tooltip-button" data-toggle="popover" title="Archival storage" data-content="This activity covers processes related to storing, maintaining and retrieving the digital assets.Examples of activities that could fit into this activity category are: error checking, media migration, storage hierarchy management, providing disaster recovery capabilities.">Archival storage </button></label>
                <div class="col-sm-8">
                    <input id="cat_storage" name="cost[cat_storage]" class="slider" data-slider-id='cat_storage' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_storage)){ echo $this->cost->cat_storage; } ?>" value="<?php if(isset($this->cost->cat_storage)){ echo $this->cost->cat_storage; } ?>"/>
                    <span id="cat_storage_feedback" class="slider-feedback" data-category="activities"><span class="feedback-currency-symbol"></span><span class="feedback-value editable-field"><span class="feedback-percentage-symbol"></span></span></span>
                </div>
            </div>
            <div class="form-group">
                <label for="cat_access" class="col-sm-4 control-label"><button type="button" class="popover-dismiss tooltip-button" data-toggle="popover" title="Access" data-content="This activity covers processes related to accessing the stored digitial assets. Examples of activities that could fit into this activity category are: providing access to digital assets and describing them meaningfully by adding relevant metadata to them.">Access </button></label>
                <div class="col-sm-8">
                    <input id="cat_access" name="cost[cat_access]" class="slider" data-slider-id='cat_access' type="text" data-slider-min="0" data-slider-max="100" data-slider-step="1" data-slider-value="<?php if(isset($this->cost->cat_access)){ echo $this->cost->cat_access; } ?>" value="<?php if(isset($this->cost->cat_access)){ echo $this->cost->cat_access; } ?>"/>
                    <span id="cat_access_feedback" class="slider-feedback" data-category="activities"><span class="feedback-currency-symbol"></span><span class="feedback-value editable-field"><span class="feedback-percentage-symbol"></span></span></span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <canvas id="activitiesChart" width="400" height="400" style="margin: 20px 90px 0px;" ></canvas>
            <div class="caption text-center" >
                <h2 id="activitiesTotalFeedback"><span class="feedback-currency-symbol"></span><span class="feedback-value"></span><span class="feedback-percentage-symbol"></span></h2>
            </div>
        </div>
    </div>
</form>

<br/>
<div class="row">
    <div class="col-sm-2 col-md-offset-10">
        <input type="hidden" value="<?php echo $this->cost->cost_id ?>" name="cost_id">
        <button type="button" class="btn btn-danger btn-block" id="delete-button" data-id="<?php echo $this->cost->cost_id ?>" data-type="cost" data-redirect="<?php echo JRoute::_('index.php?view=administration&layout=interval&interval_id=' . $this->cost->interval_id ) ?>">Delete</button>
    </div>
</div>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/exists.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/confirm-bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/administration.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/form.js') ?>"></script>

<script>
$("[data-toggle='tooltip']").tooltip();

var value_formatter = function(total) {
    var cost = +($("#cost_value").val());
    
    if(!isNaN(cost) && cost > 0) {
        return Humanize.formatNumber((cost * total) / 100.0, 0);
    }

    if(total){
        total = Math.round(total);
    };

    return total;
};

var symbol_formatter = function(total) {
    var cost = +($("#cost_value").val());
    
    if(isNaN(cost) || cost <= 0) {
        return "%";
    } else {
        return <?php echo '"' . $this->currency->symbol . '"'; ?>;
    }

    return "%";
};

var faSliderUtils = new SliderUtils("#faChart", 400, 400, "#faTotalFeedback", value_formatter, symbol_formatter, $(".editable-field"));
faSliderUtils.addSlider("#cat_hardware", "#00b050", "Hardware", "#cat_hardware_feedback");
faSliderUtils.addSlider("#cat_software", "#006fc0", "Software", "#cat_software_feedback");
faSliderUtils.addSlider("#cat_external", "#ff0000", "External or third party services", "#cat_external_feedback");

faSliderUtils.addSlider("#cat_producer", "#e46c0a", "Producer", "#cat_producer_feedback");
faSliderUtils.addSlider("#cat_it-developer", "#E80796", "IT-developer", "#cat_it-developer_feedback");
faSliderUtils.addSlider("#cat_operations", "#5D07E8", "Operations", "#cat_operations_feedback");
faSliderUtils.addSlider("#cat_specialist", "#11FFF7", "Preservation specialist", "#cat_specialist_feedback");
faSliderUtils.addSlider("#cat_manager", "#8DFF1E", "Manager", "#cat_manager_feedback");
    
faSliderUtils.addSlider("#cat_overhead", "#71A7FF", "Overhead", "#cat_overhead_feedback");

faSliderUtils.init();
faSliderUtils.updateLabels();

var activitiesSliderUtils = new SliderUtils("#activitiesChart", 400, 400, "#activitiesTotalFeedback", value_formatter, symbol_formatter, $(".editable-field"));
activitiesSliderUtils.addSlider("#cat_pre_ingest", "#00b050", "Pre-Ingest","#cat_pre_ingest_feedback");
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

$('.popover-dismiss').popover({
  trigger: 'focus',
  template: '<div class="popover" role="tooltip" style="width: 500px;"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"><div class="data-content"></div></div></div>'
});

faSliderUtils.sliders.forEach(function(slider) {
    slider.slider('disable');
});

activitiesSliderUtils.sliders.forEach(function(slider) {
    slider.slider('disable');
});

</script>
