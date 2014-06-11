<form class="form-horizontal" id="collectionForm" role="form">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="organisation_name">Name</label>
        <div class="col-sm-10">
            <input class="form-control" id="collection_name" name="collection[name]" type="text" value="<?php if(isset($this->collection->name)){ echo $this->collection->name; } ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="collection_description">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="collection_description" name="collection[description]" rows="3" type="text"><?php if(isset($this->collection->description)){ echo $this->collection->description; }?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="collection_scope">Scope</label>
        <div class="col-sm-10" data-container="body" data-placement="right" data-toggle='tooltip' title="You may not want to give cost information about the whole organisation, but just for a single department, project or even collection. Please describe the scope here.">
            <select class="form-control" id="collection_scope" name="collection[scope]">
                <option <?php if(isset($this->collection->scope) && $this->collection->scope == 'The whole organisation'){ echo "selected=\"true\""; }?> value="The whole organisation">The whole organisation</option>
                <option <?php if(isset($this->collection->scope) && $this->collection->scope == 'A department'){ echo "selected=\"true\""; }?> value="A department">A department</option>
                <option <?php if(isset($this->collection->scope) && $this->collection->scope == 'A project'){ echo "selected=\"true\""; }?> value="A project">A project</option>
                <option <?php if(isset($this->collection->scope) && $this->collection->scope == 'A collection'){ echo "selected=\"true\""; }?> value="A collection">A collection</option>
                <option <?php if(isset($this->collection->scope) && $this->collection->scope == 'Other'){ echo "selected=\"true\""; }?> value="Other">Other</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="collection_yaers">Years</label>
        <div class="col-sm-10">
            <ul class="nav nav-tabs">
                <?php foreach ($this->collection->intervalsOrNewWithCurrentYear() as $interval) { ?>
                    <li <?php if($this->collection->activeInterval()->begin_year == $interval->begin_year){ echo "class=\"active\""; } ?>><a href="#<?php echo $interval->toString(); ?>" data-toggle="tab"><?php echo $interval->toString(); ?></a></li>
                <?php } ?>
              <li><a href=""><i class="fa fa-plus"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="tab-content">
        <?php foreach ($this->collection->intervalsOrNewWithCurrentYear() as $interval) { ?>
          <div class="tab-pane fade in active" id="<?php echo $interval->toString(); ?>">
            <?php $this->_intervalFormView->interval = $interval ?>
            <?php echo $this->_intervalFormView->render(); ?>
          </div>
        <?php } ?>
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
        <div class="col-sm-2">
            <input type="hidden" name="collection[organization_id]" value="<?php echo $this->organization->organization_id; ?>">
            <?php if(isset($this->collection->collection_id)){ ?>
                <input type="hidden" name="collection[collection_id]" value="<?php echo $this->collection->collection_id; ?>">
            <?php } ?>
            <a class="btn btn-success btn-block" href="javascript:void(0)" onclick="<?php if(isset($this->collection->collection_id)){ echo 'ccexUpdate(\'collection\', \'' . JRoute::_('index.php?view=comparecosts&layout=index') . '\')'; }else{ echo 'ccexCreate(\'collection\', \'' . JRoute::_('index.php?view=comparecosts&layout=index') . '\')'; } ?>">Save</span></a>
        </div>
        <div class="col-sm-2">
            <a class="btn btn-danger btn-block" href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>">Cancel</span></a>
        </div>
    </div>
</form>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/form.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/collection.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/interval.js') ?>"></script>
