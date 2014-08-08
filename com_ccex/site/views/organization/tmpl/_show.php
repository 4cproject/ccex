<div class="row organization">
	<div class="container">
		<h1>
			<?php echo htmlspecialchars($this->organization->name ) ?> 
			<small>
				<a href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>"><span class="fa fa-edit"></span></a>
			</small>
		</h1>
		
		<p class="description"><?php echo htmlspecialchars($this->organization->description ) ?></p>
		<div class="row">
			<div class="col-md-6">
				<dl class="dl-horizontal" >
					<dt>Country</dt>
					<dd><?php echo htmlspecialchars($this->organization->country()->name ) ?></dd>
					<dt>Currency</dt>
					<dd><?php echo htmlspecialchars($this->organization->currency()->name ) ?></dd>
					<dt>Type(s)</dt>
					<dd><?php echo htmlspecialchars($this->organization->typesToString() ) ?></dd>
					<dt></dt>
					<dd></dd>
					<dt></dt>
					<dd></dd>
				</dl>
			</div>
			<div class="col-md-6">
				<dl class="dl-horizontal" >
					<dt class="dt-large">Include costs in global comparison</dt>
					<dd><?php echo $this->organization->globalComparison() ?></dd>
					<dt class="dt-large">Include costs in peer comparison</dt>
					<dd><?php echo $this->organization->peerComparison() ?></dd>
					<dt class="dt-large">Allow organisation to be linked to the cost data</dt>
					<dd><?php echo $this->organization->organizationLinked() ?></dd>
					<dt class="dt-large">Allow contact and share cost data</dt>
					<dd><?php echo $this->organization->contactAndSharing() ?></dd>
					<dt class="dt-large">Allow snapshots of cost data</dt>
					<dd><?php echo $this->organization->snapshots() ?></dd>
				</dl>
			</div>
		</div>
	</div>
</div>
