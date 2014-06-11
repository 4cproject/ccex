    <div class="form-group">
        <label class="col-sm-2 control-label" for="interval_begin_year">Begin year</label>
        <div class="col-sm-3">
            <input class="form-control" id="interval_begin_year" name="interval[begin_year]" type="number" value="<?php if(isset($this->interval->begin_year)){ echo $this->interval->begin_year; } ?>">
        </div>
        <label class="col-sm-1 control-label" for="interval_duration">Duration</label>
        <div class="col-sm-4">
            <input class="slider" data-slider-id='interval_duration' data-slider-max="20" data-slider-min="1" data-slider-step="1" data-slider-value="<?php echo (isset($this->interval->duration) ? $this->interval->duration : 1) ?>" id="interval_duration" name="interval[duration]" type="text" value="<?php echo (isset($this->interval->duration) ? $this->interval->duration : 1) ?>"/>
            <span class="slider-feedback" id="interval_duration_feedback"><?php echo (isset($this->interval->duration) ? $this->interval->duration : 1) ?></span> 
            <span class="slider-feedback"> years</span>       
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="interval_staff">Curation
            staff in scope</label>
        <div class="col-sm-10" data-container="body" data-placement="right" data-toggle='tooltip' title="Indicate the number of staff members working with digital curation within the scope defined above.">
            <select class="form-control" id="interval_staff" name="interval[staff]">
                <option <?php if(isset($this->interval->staff_max_size) && $this->interval->staff_max_size == 10){ echo "selected=\"true\""; }?> value="0|10">Less than 10 people</option>
                <option <?php if(isset($this->interval->staff_max_size) && $this->interval->staff_max_size == 50){ echo "selected=\"true\""; }?> value="10|50">Less than 50 people</option>
                <option <?php if(isset($this->interval->staff_max_size) && $this->interval->staff_max_size == 100){ echo "selected=\"true\""; }?> value="50|100">Less than 100 people</option>
                <option <?php if(isset($this->interval->staff_max_size) && $this->interval->staff_max_size == 500){ echo "selected=\"true\""; }?> value="100|500">Less than 500 people</option>
                <option <?php if(isset($this->interval->staff_max_size) && $this->interval->staff_max_size == 1000){ echo "selected=\"true\""; }?> value="500|1000">Less than 1000 people</option>
                <option <?php if(isset($this->interval->staff_max_size) && $this->interval->staff_max_size == 10000){ echo "selected=\"true\""; }?> value="1000|10000">Less than 10000 people</option>
                <option <?php if(isset($this->interval->staff_min_size) && $this->interval->staff_min_size == 10000){ echo "selected=\"true\""; }?> value="10000|0">More than 10000 people</option>
            </select>
        </div>
    </div>
