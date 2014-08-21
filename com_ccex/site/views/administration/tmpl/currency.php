<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=index') ?>">Administration</a></li>
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=currencies') ?>">Currencies</a></li>
    <?php if(isset($this->currency)) { ?>
        <li class="active"><?php echo $this->currency->name ?></li>
    <?php } else { ?>
        <li class="active">New currency</li>
    <?php } ?>
</ol>

<?php if(isset($this->currency)) { ?>
    <h1><?php echo $this->currency->name ?></h1>
<?php } else { ?>
    <h1>New currency</h1>
<?php } ?>

<form class="form-horizontal" id="currencyForm" role="form">
    <div class="row">
        <div class="form-group">
            <label style="text-align: right;" for="currency_name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="currency_name" name="currency[name]" value="<?php if(isset($this->currency->name)){ echo htmlspecialchars($this->currency->name) ; } ?>" />
            </div>
        </div>
        <div class="form-group">
            <label style="text-align: right;" for="currency_symbol" class="col-sm-3 control-label">Symbol</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="currency_symbol" name="currency[symbol]" value="<?php if(isset($this->currency->symbol)){ echo htmlspecialchars($this->currency->symbol) ; } ?>" />
            </div>
        </div>
        <div class="form-group">
            <label style="text-align: right;" for="currency_code" class="col-sm-3 control-label">Code</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" id="currency_code" name="currency[code]" value="<?php if(isset($this->currency->code)){ echo htmlspecialchars($this->currency->code) ; } ?>" />
            </div>
        </div>
    </div>

    <div class="form-group utils" style="margin-top:30px">
        <div class="col-sm-2">
            <?php if(isset($this->currency)){ ?>
                <input type="hidden" name="currency[currency_id]" value="<?php echo $this->currency->currency_id; ?>">
            <?php } ?>
            <a class="btn btn-success btn-block" href="javascript:void(0)" onclick="<?php if(isset($this->currency)){ echo 'ccexUpdate(\'currency\', \'' . JRoute::_('index.php?view=administration&layout=currencies') . '\', true)'; }else{ echo 'ccexCreate(\'currency\', \'' . JRoute::_('index.php?view=administration&layout=currencies') . '\', true)'; } ?>">Save</span></a>
        </div>
        <div class="col-sm-4">
            <div class="alert alert-dismissable" id="_message_container" style="display: none;">
                <button aria-hidden="true" class="close" data-dismiss="alert" type="button">&times;</button>
                <p id="_message"></p>
                <p id="_description"></p>
            </div>
        </div>
        <?php if(isset($this->currency)){ ?>
            <div class="col-sm-2 col-sm-offset-2">
                <a class="btn btn-default btn-block btn-border" href="<?php echo JRoute::_('index.php?view=administration&layout=currencies') ?>">Cancel</span></a>
            </div>
            <?php if($this->existsOrganizationsWithCurrency) { ?>
                <div class="col-sm-2" data-toggle="tooltip" data-placement="top" title="You can't delete the currencies that are being used by organizations.">
                    <a class="btn btn-danger btn-block" href="javascript:void(0)" disabled >Delete</span></a>
                </div>
            <?php } else { ?>
                <div class="col-sm-2">
                    <a class="btn btn-danger btn-block" href="javascript:void(0)" id="delete-button" data-redirect="<?php echo JRoute::_('index.php?view=administration&layout=currencies') ?>" data-type="currency" data-id="<?php echo $this->currency->currency_id; ?>">Delete</span></a>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="col-sm-2 col-sm-offset-4">
                <a class="btn btn-default btn-block btn-border" href="<?php echo JRoute::_('index.php?view=administration&layout=currencies') ?>">Cancel</span></a>
            </div>
        <?php } ?>
    </div>
</form>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/exists.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/confirm-bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/administration.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/adm_currency.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/form.js') ?>"></script>
