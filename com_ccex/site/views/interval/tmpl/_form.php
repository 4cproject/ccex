    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="col-sm-6 control-label" for="interval_begin_year">Begin year</label>
                <div class="col-sm-6">
                    <input class="form-control" id="interval_begin_year" name="interval[begin_year]" type="text" value="<?php if(isset($this->interval->begin_year)){ echo $this->interval->begin_year; } ?>">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="interval_duration">Duration</label>
                <div class="col-sm-9 duration-slider">
                    <input class="slider" data-slider-id='interval_duration' data-slider-max="50" data-slider-min="1" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->duration) ? $this->interval->duration : 1) ?>" id="interval_duration" name="interval[duration]" type="text" value="<?php echo (isset($this->interval->duration) ? $this->interval->duration : 1) ?>"/>
                    <span class="slider-feedback" id="interval_duration_feedback"><?php echo (isset($this->interval->duration) ? $this->interval->duration : 1) ?></span> 
                    <span class="slider-feedback"> years</span> 
                    <input class="form-control" type="hidden" id="fake_interval_duration" name="fake_interval[duration]" value="<?php echo (isset($this->interval->duration) ? $this->interval->duration : 1) ?>"?/>      
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="interval_staff">Curation staff</label>
        <div class="col-sm-2">
            <div class="input-group">
                <input id="interval_staff" type="text" class="form-control" name="interval[staff]" value="<?php if(isset($this->interval->staff)){ echo $this->interval->staff; }else{ echo 0; }?>">
                <span class="input-group-addon" data-toggle="tooltip" data-placement="right" title="Full Time Equivalents">FTE</span>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="interval_data_volume">Data volume</label>
        <div class="col-sm-2">
            <input class="form-control" id="interval_data_volume_number" min="0" name="interval[data_volume_number]" type="text" value="<?php echo $this->interval->dataVolume()->value; ?>">
        </div>
        <div class="col-sm-2">
            <select class="form-control" id="interval_data_volume_unit" name="interval[data_volume_unit]" value="<?php echo $this->interval->dataVolume()->value; ?>">
                <option <?php if($this->interval->dataVolume()->format == "Gigabytes"){ echo "selected=\"true\""; }?> value="1">Gigabytes</option>
                <option <?php if($this->interval->dataVolume()->format == "Terabytes"){ echo "selected=\"true\""; }?> value="1024">Terabytes</option>
                <option <?php if($this->interval->dataVolume()->format == "Petabytes"){ echo "selected=\"true\""; }?> value="1048576">Petabytes</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="interval_copies">Number of copies</label>
        <div class="col-sm-10" data-container="body" data-placement="right" data-toggle='tooltip' title="Indicate the number of copies you have for each digital asset within the scope. The original does not count as a copy, only backup copies or replicas. If your organisation has a different number of copies policy dependending on the value of the assets, please provide the number closer to the average within the scope.">
            <select class="form-control" id="cintervaln_copies" name="interval[number_copies]">
                <option <?php if(isset($this->interval->number_copies) && $this->interval->number_copies == 0){ echo "selected=\"true\""; }?> value="0">One original, and no replicas</option>
                <option <?php if(isset($this->interval->number_copies) && $this->interval->number_copies == 1){ echo "selected=\"true\""; }?> value="1">One original, and one replica</option>
                <option <?php if(isset($this->interval->number_copies) && $this->interval->number_copies == 2){ echo "selected=\"true\""; }?> value="2">One original, and two replicas</option>
                <option <?php if(isset($this->interval->number_copies) && $this->interval->number_copies == 3){ echo "selected=\"true\""; }?> value="3">One original, and three replicas</option>
                <option <?php if(isset($this->interval->number_copies) && $this->interval->number_copies == -1){ echo "selected=\"true\""; }?> value="-1">One original, and more than three replicas</option>
            </select>
        </div>
    </div>
    <br/>
    <div class="form-group">
        <div class="col-sm-12">
            <h3>Asset types</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-info fade in small" role="alert">
              <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
              <strong>Tip: </strong> Use the slider or enter an amount clicking in the current value.
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="asset_unformatted_text">Unformatted text</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_unformatted_text' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_unformatted_text) ? $this->interval->asset_unformatted_text : 0) ?>" id="asset_unformatted_text" name="interval[asset_unformatted_text]" type="text" value="<?php echo (isset($this->interval->asset_unformatted_text) ? $this->interval->asset_unformatted_text : 0) ?>"/>
                    <span class="slider-feedback" id="asset_unformatted_text_feedback"><span class="feedback-value editable-field"></span>&nbsp;<span class="feedback-format-symbol"></span></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="asset_word_processing">Word processing</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_word_processing' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_word_processing) ? $this->interval->asset_word_processing : 0) ?>" id="asset_word_processing" name="interval[asset_word_processing]" type="text" value="<?php echo (isset($this->interval->asset_word_processing) ? $this->interval->asset_word_processing : 0) ?>"/>
                    <span class="slider-feedback" id="asset_word_processing_feedback"><span class="feedback-value editable-field"></span>&nbsp;<span class="feedback-format-symbol"></span></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="asset_spreadsheet">Spreadsheet</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_spreadsheet' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_spreadsheet) ? $this->interval->asset_spreadsheet : 0) ?>" id="asset_spreadsheet" name="interval[asset_spreadsheet]" type="text" value="<?php echo (isset($this->interval->asset_spreadsheet) ? $this->interval->asset_spreadsheet : 0) ?>"/>
                    <span class="slider-feedback" id="asset_spreadsheet_feedback"><span class="feedback-value editable-field"></span>&nbsp;<span class="feedback-format-symbol"></span></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="asset_graphics">
                <button type="button" class="popover-dismiss tooltip-button popup-marker" data-toggle="popover" title="Graphics" data-content="For example .jpg, .png, .bmp">Graphics </button>
                </label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_graphics' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_graphics) ? $this->interval->asset_graphics : 0) ?>" id="asset_graphics" name="interval[asset_graphics]" type="text" value="<?php echo (isset($this->interval->asset_graphics) ? $this->interval->asset_graphics : 0) ?>"/>
                    <span class="slider-feedback" id="asset_graphics_feedback"><span class="feedback-value editable-field"></span>&nbsp;<span class="feedback-format-symbol"></span></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="asset_audio">
                    <button type="button" class="popover-dismiss tooltip-button popup-marker" data-toggle="popover" title="Audio" data-content="For example .mp3, .wav, .m4a">Audio </button>
                </label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_audio' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_audio) ? $this->interval->asset_audio : 0) ?>" id="asset_audio" name="interval[asset_audio]" type="text" value="<?php echo (isset($this->interval->asset_audio) ? $this->interval->asset_audio : 0) ?>"/>
                    <span class="slider-feedback" id="asset_audio_feedback"><span class="feedback-value editable-field"></span>&nbsp;<span class="feedback-format-symbol"></span></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="asset_video">
                    <button type="button" class="popover-dismiss tooltip-button popup-marker" data-toggle="popover" title="Video" data-content="For example .mov, .avi, .wmv">Video </button>
                </label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_video' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_video) ? $this->interval->asset_video : 0) ?>" id="asset_video" name="interval[asset_video]" type="text" value="<?php echo (isset($this->interval->asset_video) ? $this->interval->asset_video : 0) ?>"/>
                    <span class="slider-feedback" id="asset_video_feedback"><span class="feedback-value editable-field"></span>&nbsp;<span class="feedback-format-symbol"></span></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="asset_hypertext">Hypertext</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_hypertext' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_hypertext) ? $this->interval->asset_hypertext : 0) ?>" id="asset_hypertext" name="interval[asset_hypertext]" type="text" value="<?php echo (isset($this->interval->asset_hypertext) ? $this->interval->asset_hypertext : 0) ?>"/>
                    <span class="slider-feedback" id="asset_hypertext_feedback"><span class="feedback-value editable-field"></span>&nbsp;<span class="feedback-format-symbol"></span></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="asset_geodata">Geodata</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_geodata' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_geodata) ? $this->interval->asset_geodata : 0) ?>" id="asset_geodata" name="interval[asset_geodata]" type="text" value="<?php echo (isset($this->interval->asset_geodata) ? $this->interval->asset_geodata : 0) ?>"/>
                    <span class="slider-feedback" id="asset_geodata_feedback"><span class="feedback-value editable-field"></span>&nbsp;<span class="feedback-format-symbol"></span></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="asset_email">E-mail</label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_email' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_email) ? $this->interval->asset_email : 0) ?>" id="asset_email" name="interval[asset_email]" type="text" value="<?php echo (isset($this->interval->asset_email) ? $this->interval->asset_email : 0) ?>"/>
                    <span class="slider-feedback" id="asset_email_feedback"><span class="feedback-value editable-field"></span>&nbsp;<span class="feedback-format-symbol"></span></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="asset_database_feedback">
                    <button type="button" class="popover-dismiss tooltip-button popup-marker" data-toggle="popover" title="Database" data-content="For example .fp7, .mdb, .sql">Database </button>
                </label>
                <div class="col-sm-8">
                    <input class="slider" data-slider-id='asset_database' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_database) ? $this->interval->asset_database : 0) ?>" id="asset_database" name="interval[asset_database]" type="text" value="<?php echo (isset($this->interval->asset_database) ? $this->interval->asset_database : 0) ?>"/>
                    <span class="slider-feedback" id="asset_database_feedback"><span class="feedback-value editable-field"></span>&nbsp;<span class="feedback-format-symbol"></span></span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <canvas height="400" id="pieChart" style="margin: 20px 50px 0px;" width="400"></canvas>
            <div class="caption text-center">
                <h2 id="assetTotalFeedback"></h2>
            </div>
        </div>
    </div>
    <a id="collectionCosts"></a>
    <div class="form-group">
        <div class="col-sm-3">
            <h3>
                Cost units

<!--                 <?php if(isset($this->interval->interval_id)){ ?>
                    <a class="edit" data-toggle="tooltip" data-placement="left" title="Click here to add curation costs to this cost data set" href="javascript:void(0)" onclick="<?php echo 'ccexUpdate(\'collection\', \'' . JRoute::_('index.php?option=com_ccex&view=cost&layout=add&interval_id=' . $this->interval->interval_id ) . '\', true)'; ?>">add cost unit</a>
                <?php } else { ?>
                    <a class="edit" data-toggle="tooltip" data-placement="left" title="Click here to add curation costs to this cost data set" href="javascript:void(0)" onclick="<?php echo 'ccexCreate(\'collection\', \'' . JRoute::_('index.php?option=com_ccex&view=cost&layout=add&interval_id=' ) . '\', true, \'interval\')'; ?>">add cost unit</a>
                <?php } ?> -->
            </h3>
        </div>
        <div style="padding: 75px 15px 10px 15px;">
            <?php if(isset($this->interval->interval_id)){ 
                $this->_indexCost->editable = true;
                $this->_indexCost->costs = $this->interval->costs();
                $this->_indexCost->interval = $this->interval;
                echo $this->_indexCost->render();
            } else {
                $this->_indexCost->editable = true;
                $this->_indexCost->costs = array();
                echo $this->_indexCost->render();           
            }
            ?>
        </div>
    </div>
    <div class="form-group">
        <?php if(isset($this->interval->interval_id)){ ?>
            <input type="hidden" name="interval[interval_id]" value="<?php echo $this->interval->interval_id; ?>">
        <?php } ?>
    </div>
    <br/>
<script>
$("[data-toggle='tooltip']").tooltip();

var value_formatter = function(total) {
        var volume_number = +($("#interval_data_volume_number").val());
        var volume_unit = +($("#interval_data_volume_unit").val());

        if (isNaN(volume_number) || isNaN(volume_unit) || volume_number <= 0) {
            return total;
        } else {
            var volume = volume_number * volume_unit * 1073741824 * total / 100.0;
            
            if(volume>0){
                return humanFileSize(volume, 2).volume;
            }
        }

        return total;
};

var format_formatter = function(total) {
        var volume_number = +($("#interval_data_volume_number").val());
        var volume_unit = +($("#interval_data_volume_unit").val());

        if (isNaN(volume_number) || isNaN(volume_unit) || volume_number <= 0) {
            return "%";
        } else {
            var volume = volume_number * volume_unit * 1073741824 * total / 100.0;
            
            if(volume>0){
                return humanFileSize(volume, 2).format;
            }
        }

        return "%";
};

var sliderUtils = new SliderUtils("#pieChart", 400, 400, "#assetTotalFeedback", value_formatter, format_formatter, $(".editable-field"));
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
sliderUtils.init();
sliderUtils.updateLabels();

$("#interval_data_volume_number").keyup(function () {
    sliderUtils.updateLabels();
});
$("#interval_data_volume_number").change(function () {
    sliderUtils.updateLabels();
});
$("#interval_data_volume_unit").change(function () {
    sliderUtils.updateLabels();
});
</script>
