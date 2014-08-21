<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=index') ?>">Administration</a></li>
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=conversions') ?>">Exchange Rates</a></li>
    <?php if(isset($this->conversion)) { ?>
        <li class="active"><?php echo $this->conversion->code ?> to EUR in <?php echo $this->conversion->year ?></li>
    <?php } else { ?>
        <li class="active">New exchange rate</li>
    <?php } ?>
</ol>

<?php if(isset($this->conversion)) { ?>
    <h1><?php echo $this->conversion->code ?> to EUR in <?php echo $this->conversion->year ?></h1>
<?php } else { ?>
    <h1>New exchange rate</h1>
<?php } ?>
<br/>

<form class="form-horizontal" id="euroconvertionrateForm" role="form">
    <div class="row">
        <div class="form-group">
            <label style="text-align: right;" for="conversion_code" class="col-sm-3 control-label">Currency Code</label>
            <div class="col-sm-4">
                <select class="form-control" id="conversion_code" name="conversion[code]" <?php if(isset($this->conversion)){ echo "disabled"; } ?>>
                    <?php foreach($this->currencies as $currency) { 
                        if ($currency->code != "EUR") { ?>
                            <option <?php if(isset($this->conversion->code) && $this->conversion->code == $currency->code){ echo "selected=\"true\""; }?> value="<?php echo $currency->code; ?>"><?php echo htmlspecialchars($currency->code) ; ?></option>
                    <?php } 
                    }?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <label style="text-align: right;" for="conversion_year" class="col-sm-3 control-label">Year</label>
            <div class="col-sm-4">
                <input type="number" <?php if(isset($this->conversion)){ echo "disabled"; } ?> class="form-control" id="conversion_year" name="conversion[year]" value="<?php if(isset($this->conversion->year)){ echo htmlspecialchars($this->conversion->year) ; } ?>" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <label style="text-align: right;" for="conversion_tax" class="col-sm-3 control-label">Rate</label>
            <div class="col-sm-4">
                <input type="number" step="any" class="form-control" id="conversion_tax" name="conversion[tax]" value="<?php if(isset($this->conversion->tax)){ echo htmlspecialchars($this->conversion->tax) ; } ?>" />
            </div>
        </div>
    </div>

    <div class="form-group utils" style="margin-top:30px">
        <div class="col-sm-2">
            <?php if(isset($this->conversion)){ ?>
                <input type="hidden" name="conversion[euro_convertion_id]" value="<?php echo $this->conversion->euro_convertion_id; ?>">
            <?php } ?>
            <a class="btn btn-success btn-block" href="javascript:void(0)" onclick="<?php if(isset($this->conversion)){ echo 'ccexUpdate(\'euroconvertionrate\', \'' . JRoute::_('index.php?view=administration&layout=conversions') . '\', true)'; }else{ echo 'ccexCreate(\'euroconvertionrate\', \'' . JRoute::_('index.php?view=administration&layout=conversions') . '\', true)'; } ?>">Save</span></a>
        </div>
        <div class="col-sm-4">
            <div class="alert alert-dismissable" id="_message_container" style="display: none;">
                <button aria-hidden="true" class="close" data-dismiss="alert" type="button">&times;</button>
                <p id="_message"></p>
                <p id="_description"></p>
            </div>
        </div>
        <?php if(isset($this->conversion)){ ?>
            <div class="col-sm-2 col-sm-offset-2">
                <a class="btn btn-default btn-block btn-border" href="<?php echo JRoute::_('index.php?view=administration&layout=conversions') ?>">Cancel</span></a>
            </div>
            <div class="col-sm-2">
                <a class="btn btn-danger btn-block" href="javascript:void(0)" id="delete-button" data-redirect="<?php echo JRoute::_('index.php?view=administration&layout=conversions') ?>" data-type="euroconvertionrate" data-name="exchange rate" data-id="<?php echo $this->conversion->euro_convertion_id; ?>">Delete</span></a>
            </div>
        <?php } else { ?>
            <div class="col-sm-2 col-sm-offset-4">
                <a class="btn btn-default btn-block btn-border" href="<?php echo JRoute::_('index.php?view=administration&layout=conversions') ?>">Cancel</span></a>
            </div>
        <?php } ?>
    </div>
</form>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/exists.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/confirm-bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/administration.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/adm_conversion.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/form.js') ?>"></script>
