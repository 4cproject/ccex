<form class="form-horizontal" id="collectionForm" role="form">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="organisation_name">Name</label>
        <div class="col-sm-10">
            <input class="form-control" id="collection_name" name="collection[name]" type="text" value="<?php if(isset($this->collection->name)){ echo htmlspecialchars($this->collection->name) ; } ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="collection_description">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="collection_description" name="collection[description]" rows="3" type="text"><?php if(isset($this->collection->description)){ echo htmlspecialchars($this->collection->description) ; }?></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" for="collection_scope">Scope</label>
        <div class="col-sm-10" data-container="body" data-placement="right" data-toggle='tooltip' title="You may not want to give cost information about the whole organisation, but just for a single department, project or even cost data set. Please describe the scope here.">
            <select class="form-control" id="collection_scope" name="collection[scope]">
                <option <?php if(isset($this->collection->scope) && $this->collection->scope == 'The whole organisation'){ echo "selected=\"true\""; }?> value="The whole organisation">The whole organisation</option>
                <option <?php if(isset($this->collection->scope) && $this->collection->scope == 'A department'){ echo "selected=\"true\""; }?> value="A department">A department</option>
                <option <?php if(isset($this->collection->scope) && $this->collection->scope == 'A project'){ echo "selected=\"true\""; }?> value="A project">A project</option>
                <option <?php if(isset($this->collection->scope) && $this->collection->scope == 'A collection'){ echo "selected=\"true\""; }?> value="A collection">A collection</option>
                <option <?php if(isset($this->collection->scope) && $this->collection->scope == 'Other'){ echo "selected=\"true\""; }?> value="Other">Other</option>
            </select>
        </div>
    </div>
    <div class="form-group interval-tabs">
        <div class="col-sm-12">
            <ul class="nav nav-tabs" id="collection_year_tabs">
                <?php foreach ($this->intervals as $interval) { ?>
                    <?php $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval); ?>
                    
                    <?php if(isset($this->new_interval) || $this->active_interval->interval_id != $interval->interval_id){ ?>
                        <li><a class="year-tab" href="<?php echo JRoute::_('index.php?view=collection&layout=edit&collection_id=' . $this->collection->collection_id . '&active_interval=' . $interval->interval_id ); ?>"><?php echo $interval->toString();?>
                            <?php if(count($this->intervals)>1) { ?>
                                <span data-action="delete" data-type="interval" data-id="<?php echo $interval->interval_id; ?>" data-redirect="<?php echo JRoute::_('index.php?view=collection&layout=edit&collection_id=' . $this->collection->collection_id ); ?>" class="fa fa-times close-tab"></span>
                            <?php } ?>
                        </a></li>
                    <?php } else { ?>
                        <li class="active"><a href="javascript:void(0)"><?php echo $interval->toString();?> 
                            <?php if(count($this->intervals)>1) { ?>
                                 <span data-action="delete" data-type="interval" data-id="<?php echo $interval->interval_id; ?>" data-redirect="<?php echo JRoute::_('index.php?view=collection&layout=edit&collection_id=' . $this->collection->collection_id ); ?>" class="fa fa-times close-tab"></span>
                            <?php } ?>
                        </a></li>
                    <?php } ?>
                    
                <?php } ?>
                <?php if(isset($this->new_interval)) { ?>
                    <li class="active"><a href="javascript:void(0)"><?php echo $this->new_interval->toString();?>
                            <?php if(count($this->intervals)>0) { ?>
                                <span data-action="close" data-type="interval" data-id="<?php echo $interval->interval_id; ?>" data-redirect="<?php echo JRoute::_('index.php?view=collection&layout=edit&collection_id=' . $this->collection->collection_id ); ?>" class="fa fa-times close-tab"></span>
                            <?php } ?>
                        </a></a></li>
                <?php } ?>
                <?php if(isset($this->collection->collection_id)){ ?>
                    <li><a data-toggle="tooltip" data-placement="top" data-container="body" title="Click here to add new years to this cost data set" href="javascript:void(0)" onclick="<?php echo 'ccexUpdate(\'collection\', \'' . JRoute::_('index.php?view=collection&layout=edit&new_year=true&collection_id=' . $this->collection->collection_id ) . '\', true)'; ?>"><i class="fa fa-plus"></i></a></li>
                <?php } else { ?>
                    <li><a data-toggle="tooltip" data-placement="top" data-container="body" title="Click here to add new years to this cost data set" id="" href="javascript:void(0)" onclick="<?php echo 'ccexCreate(\'collection\', \'' . JRoute::_('index.php?view=collection&layout=edit&new_year=true&collection_id=' ) . '\', true, \'collection\')'; ?>"><i class="fa fa-plus"></i></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="tab-content interval-tab-content">
      <div class="tab-pane fade in active" id="current">
        <?php echo $this->_intervalFormView->render(); ?>
      </div>
    </div>
    <br/>
    <!-- Action -->
    <div class="form-group utils">
        <div class="col-sm-2">
            <input type="hidden" name="collection[organization_id]" value="<?php echo $this->organization->organization_id; ?>">
            <?php if(isset($this->collection->collection_id)){ ?>
                <input type="hidden" name="collection[collection_id]" value="<?php echo $this->collection->collection_id; ?>">
            <?php } ?>
            <?php if(isset($this->new_interval)) { ?>
                <a data-toggle="tooltip" data-placement="top" title="Click here to save your entries. You will remain on this page" class="btn btn-success btn-block" href="javascript:void(0)" onclick="<?php if(isset($this->collection->collection_id)){ echo 'ccexUpdate(\'collection\',  \'' . JRoute::_('index.php?view=comparecosts&view=collection&layout=edit&collection_id=' . $this->collection->collection_id . '&active_interval=') . '\' , false, \'interval\')'; }else{ echo 'ccexCreate(\'collection\',  \'' . JRoute::_('index.php?view=comparecosts&view=collection&layout=edit&collection_id=') . '\' , false, \'collection\')'; } ?>">Save</span></a>
            <?php } else { ?>
                <a data-toggle="tooltip" data-placement="top" title="Click here to save your entries. You will remain on this page" class="btn btn-success btn-block" href="javascript:void(0)" onclick="<?php if(isset($this->collection->collection_id)){ echo 'ccexUpdate(\'collection\', \'reload\')'; }else{ echo 'ccexCreate(\'collection\',  \'' . JRoute::_('index.php?view=comparecosts&view=collection&layout=edit&collection_id=') . '\' , false, \'collection\')'; } ?>">Save</span></a>
            <?php } ?>
        </div>
        <div class="col-sm-2">
            <a data-toggle="tooltip" data-placement="top" title="Click here to save your entries and go back to the overview of all cost data sets you have submitted so far" class="btn btn-success btn-block" href="javascript:void(0)" onclick="<?php if(isset($this->collection->collection_id)){ echo 'ccexUpdate(\'collection\', \'' . JRoute::_('index.php?view=comparecosts&layout=index#collection' . $this->collection->collection_id) . '\')'; }else{ echo 'ccexCreate(\'collection\', \'' . JRoute::_('index.php?view=comparecosts&layout=index#collection') . '\', false, \'collection\')'; } ?>">Save and close</span></a>
        </div>
        <div class="col-sm-2">
            <div class="alert alert-dismissable" id="_message_container" style="display: none;">
                <button aria-hidden="true" class="close" data-dismiss="alert" type="button">&times;</button>
                <p id="_message"></p>
                <p id="_description"></p>
            </div>
        </div>
        <?php if(isset($this->collection->collection_id)){ ?>
            <div class="col-sm-2 col-sm-offset-4">
                <a class="btn btn-danger btn-block" href="javascript:void(0)" id="delete-button" data-redirect="<?php echo JRoute::_('index.php?view=comparecosts&layout=index') ?>" data-type="collection" data-id="<?php echo $this->collection->collection_id; ?>">Delete</span></a>
            </div>
        <?php } else { ?>
            <div class="col-sm-2 col-sm-offset-4">
                <a class="btn btn-default btn-block btn-border" href="<?php echo JRoute::_('index.php?view=comparecosts&layout=index')?>">Cancel</span></a>
            </div>
        <?php } ?>
    </div>
</form>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/jquery.validate.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/exists.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/confirm-bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/form.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/collection.js') ?>"></script>
<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/interval.js') ?>"></script>
