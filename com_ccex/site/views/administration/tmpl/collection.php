<ol class="breadcrumb">
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=index') ?>">Administration</a></li>
    <li><a href="javascript:void(0)">Organisations</a></li>
    <li><a href="<?php echo JRoute::_('index.php?view=administration&layout=organization&organization_id=' . $this->collection->organization_id) ?>"><?php echo htmlspecialchars($this->collection->organization()->name) ; ?></a></li>
    <li class="active"><?php echo htmlspecialchars($this->collection->name) ; ?></li>
</ol>

<h1>
    <?php echo htmlspecialchars($this->collection->name ) ?> 
</h1>

<p class="description"><?php echo htmlspecialchars($this->collection->description ) ?></p>

<div class="row">
    <div class="col-md-6">
        <dl class="dl-horizontal" >
            <dt>Scope</dt>
            <dd><?php echo $this->collection->scope ?></dd>
        </dl>
    </div>
    <div class="col-md-6">
        <dl class="dl-horizontal" >
            <dt>Status</dt>
            <dd><?php if($this->collection->final){ echo "Final"; }else{ echo "Draft"; } ?></dd>
        </dl>
    </div>
</div>
