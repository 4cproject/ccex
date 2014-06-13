<div class="row">
	<div class="col-md-6">
		<dl class="dl-horizontal dl-org-info">
	        <dt>Data volume</dt>
	        <dd><?php echo $this->interval->formattedDataVolume() ?></dd>	        
	        <dt>Number of copies</dt>
	        <dd><?php echo $this->interval->formattedNumberOfCopies() ?></dd>	     
	     </dl>
	</div>
	<div class="col-md-6">
		<dl class="dl-horizontal dl-org-info">
	        <dt>Curation staff in scope</dt>
	        <dd><?php echo $this->interval->formattedStaff() ?></dd>
	        <dt>Years</dt>
	        <dd><?php echo $this->interval->toString() ?></dd>  	  
	     </dl>
	</div>
</div>

<?php 
	$this->_indexCost->costs = $this->interval->costs();
	$this->_indexCost->interval = $this->interval;
	echo $this->_indexCost->render();
?>
