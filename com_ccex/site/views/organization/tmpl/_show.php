<div class="row organization">
	<div class="container">
		<h1>
			<?php echo $this->organization->name ?> 
			<small>
				<a href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>"><span class="glyphicon glyphicon-edit"></span></a>
			</small>
		</h1>
		
		<p class="description"><?php echo $this->organization->description ?></p>
		<div class="row">
			<div class="col-md-6">
				<dl class="dl-horizontal" >
					<dt>Country</dt>
					<dd><?php echo $this->organization->country()->name ?></dd>
					<dt>Currency</dt>
					<dd><?php echo $this->organization->currency()->name ?></dd>
					<dt>Type(s)</dt>
					<dd><?php echo $this->organization->typesToString() ?></dd>
				</dl>
			</div>
			<div class="col-md-6">
				<dl class="dl-horizontal" >
					<dt>Global comparison</dt>
					<dd><?php echo $this->organization->globalComparison() ?></dd>
					<dt>Peer comparison</dt>
					<dd><?php echo $this->organization->peerComparison() ?></dd>
					<dt>Publish my raw data</dt>
					<dd><?php echo $this->organization->publishRawData() ?></dd>
				</dl>
			</div>
		</div>
	</div>
</div>
