<h1>
	<?php echo $this->organization->name ?> 
	<small><a style="opacity:0.6" href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>"><span class="glyphicon glyphicon-edit"></span></a></small>
</h1>
<p><?php echo $this->organization->description ?></p>
<div class="row">
	<div class="col-md-12">
		<dl class="dl-horizontal dl-org-info" style="margin-bottom:0px">
			<dt>Type</dt>
	        <dd><?php echo $this->organization->typesToString() ?></dd>
		</dl>
	</div>
	<div class="col-md-6">
		<dl class="dl-horizontal dl-org-info">
	        <dt>Country</dt>
	        <dd><?php echo $this->organization->country()->name ?></dd>	        
	        <dt>Share information with</dt>
	        <dd><?php echo $this->organization->share_information ?></dd>	     
	     </dl>
	</div>
	<div class="col-md-6">
		<dl class="dl-horizontal dl-org-info">
	        <dt>Currency</dt>
	        <dd><?php echo $this->organization->currency()->name ?></dd>
	        <dt>Share data with</dt>
	        <dd><?php echo $this->organization->share_data ?></dd>  	  
	     </dl>
	</div>
</div>
