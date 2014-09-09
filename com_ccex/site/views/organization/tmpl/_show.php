<div class="row organization">
	<div class="container">
		<h1><?php echo htmlspecialchars($this->organization->name ) ?> </h1>
		<small class="edit">
			<a href="<?php echo JRoute::_('index.php?view=organization&layout=edit&organization_id=' . $this->organization->organization_id) ?>">
				<span class="fa fa-edit"> Edit organization</span>
			</a>
		</small>
		<p style="margin-bottom: 5px">
			<small class="information">
				<i class="fa fa-globe fa-fw"></i> <?php echo htmlspecialchars($this->organization->country()->name ) ?>
			</small>
			<small class="information">
				<i class="fa fa-money fa-fw"></i> <?php echo htmlspecialchars($this->organization->currency()->name ) ?>
			</small>
			<small class="information">
				<i class="fa fa-tag fa-fw"></i> <?php echo htmlspecialchars($this->organization->typesToString() ) ?>
			</small>
		</p>	
		<small class="description" style="font-weight: 400;"><?php echo htmlspecialchars($this->organization->description ) ?></small>
	</div>
</div>
