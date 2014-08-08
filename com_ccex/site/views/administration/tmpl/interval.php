<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=index') ?>">Administration</a></li>
    <li><a href="javascript:void(0)">Organisations</a></li>
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=organization&organization_id=' . $this->interval->collection()->organization_id) ?>"><?php echo htmlspecialchars($this->interval->collection()->organization()->name) ; ?></a></li>
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=collection&collection_id=' . $this->interval->collection()->collection_id) ?>"><?php echo htmlspecialchars($this->interval->collection()->name) ; ?></a></li>
    <li class="active"><?php echo $this->interval->toString(); ?></li>
</ol>

<h1>
    <?php echo htmlspecialchars($this->interval->collection()->name ) ?> <?php echo $this->interval->toString(); ?>
</h1>
<br/>
<div class="row">
    <div class="col-md-6">
        <dl class="dl-horizontal">
            <dt>Begin Year</dt>
            <dd><?php echo $this->interval->begin_year ?></dd>
            <dt>Data volume</dt>
            <dd><?php echo $this->interval->formattedDataVolume() ?></dd>           
            <dt>Number of copies</dt>
            <dd><?php echo $this->interval->formattedNumberOfCopies() ?></dd>        
         </dl>
    </div>
    <div class="col-md-6">
        <dl class="dl-horizontal">
            <dt>Duration</dt>
            <dd><?php echo $this->interval->duration ?></dd>
            <dt>Curation staff in scope</dt>
            <dd><?php echo $this->interval->formattedStaff() ?></dd>
            <dt>Years</dt>
            <dd><?php echo $this->interval->toString() ?></dd>        
         </dl>
    </div>
</div>
<br/>
<form class="form-horizontal">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="interval_data_volume">Unformatted text</label>
                <div class="col-sm-8">
                    <input disabled class="slider" data-slider-id='asset_unformatted_text' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_unformatted_text) ? $this->interval->asset_unformatted_text : 0) ?>" id="asset_unformatted_text" name="interval[asset_unformatted_text]" type="text" value="<?php echo (isset($this->interval->asset_unformatted_text) ? $this->interval->asset_unformatted_text : 0) ?>"/>
                    <span class="slider-feedback" id="asset_unformatted_text_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="interval_data_volume">Word processing</label>
                <div class="col-sm-8">
                    <input disabled class="slider" data-slider-id='asset_word_processing' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_word_processing) ? $this->interval->asset_word_processing : 0) ?>" id="asset_word_processing" name="interval[asset_word_processing]" type="text" value="<?php echo (isset($this->interval->asset_word_processing) ? $this->interval->asset_word_processing : 0) ?>"/>
                    <span class="slider-feedback" id="asset_word_processing_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="interval_data_volume">Spreadsheet</label>
                <div class="col-sm-8">
                    <input disabled class="slider" data-slider-id='asset_spreadsheet' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_spreadsheet) ? $this->interval->asset_spreadsheet : 0) ?>" id="asset_spreadsheet" name="interval[asset_spreadsheet]" type="text" value="<?php echo (isset($this->interval->asset_spreadsheet) ? $this->interval->asset_spreadsheet : 0) ?>"/>
                    <span class="slider-feedback" id="asset_spreadsheet_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="interval_data_volume">Graphics</label>
                <div class="col-sm-8">
                    <input disabled class="slider" data-slider-id='asset_graphics' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_graphics) ? $this->interval->asset_graphics : 0) ?>" id="asset_graphics" name="interval[asset_graphics]" type="text" value="<?php echo (isset($this->interval->asset_graphics) ? $this->interval->asset_graphics : 0) ?>"/>
                    <span class="slider-feedback" id="asset_graphics_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="interval_data_volume">Audio</label>
                <div class="col-sm-8">
                    <input disabled class="slider" data-slider-id='asset_audio' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_audio) ? $this->interval->asset_audio : 0) ?>" id="asset_audio" name="interval[asset_audio]" type="text" value="<?php echo (isset($this->interval->asset_audio) ? $this->interval->asset_audio : 0) ?>"/>
                    <span class="slider-feedback" id="asset_audio_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="interval_data_volume">Video</label>
                <div class="col-sm-8">
                    <input disabled class="slider" data-slider-id='asset_video' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_video) ? $this->interval->asset_video : 0) ?>" id="asset_video" name="interval[asset_video]" type="text" value="<?php echo (isset($this->interval->asset_video) ? $this->interval->asset_video : 0) ?>"/>
                    <span class="slider-feedback" id="asset_video_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="interval_data_volume">Hypertext</label>
                <div class="col-sm-8">
                    <input disabled class="slider" data-slider-id='asset_hypertext' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_hypertext) ? $this->interval->asset_hypertext : 0) ?>" id="asset_hypertext" name="interval[asset_hypertext]" type="text" value="<?php echo (isset($this->interval->asset_hypertext) ? $this->interval->asset_hypertext : 0) ?>"/>
                    <span class="slider-feedback" id="asset_hypertext_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="interval_data_volume">Geodata</label>
                <div class="col-sm-8">
                    <input disabled class="slider" data-slider-id='asset_geodata' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_geodata) ? $this->interval->asset_geodata : 0) ?>" id="asset_geodata" name="interval[asset_geodata]" type="text" value="<?php echo (isset($this->interval->asset_geodata) ? $this->interval->asset_geodata : 0) ?>"/>
                    <span class="slider-feedback" id="asset_geodata_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="interval_data_volume">E-mail</label>
                <div class="col-sm-8">
                    <input disabled class="slider" data-slider-id='asset_email' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_email) ? $this->interval->asset_email : 0) ?>" id="asset_email" name="interval[asset_email]" type="text" value="<?php echo (isset($this->interval->asset_email) ? $this->interval->asset_email : 0) ?>"/>
                    <span class="slider-feedback" id="asset_email_feedback"></span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="interval_data_volume">Database</label>
                <div class="col-sm-8">
                    <input disabled class="slider" data-slider-id='asset_database' data-slider-max="100" data-slider-min="0" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->asset_database) ? $this->interval->asset_database : 0) ?>" id="asset_database" name="interval[asset_database]" type="text" value="<?php echo (isset($this->interval->asset_database) ? $this->interval->asset_database : 0) ?>"/>
                    <span class="slider-feedback" id="asset_database_feedback"></span>
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
</form>
<script>
$("[data-toggle='tooltip']").tooltip();

var sliderUtils = new SliderUtils("#pieChart", 400, 400, "#assetTotalFeedback", function (total) {
        var volume_number = +($("#interval_data_volume_number").val());
        var volume_unit = +($("#interval_data_volume_unit").val());

        if (isNaN(volume_number) || isNaN(volume_unit) || volume_number <= 0) {
            return total + "%";
        } else {
            var volume = volume_number * volume_unit * 1073741824 * total / 100.0;
            
            if(volume>0){
                return humanFileSize(volume);
            }
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

sliderUtils.sliders.forEach(function(slider) {
    slider.slider('disable');
});

</script>
