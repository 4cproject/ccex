<h1>Current costs analysis<br/>
	<small>Input cost data</small></h1>
<p>Define your curation costs and map them to the categories of our framework of comparable costs.</p>

<table class="table table-condensed">
	<thead>
		<th>Name</th>
		<th class="text-right">Cost</th>
		<th class="text-right" data-toggle="tooltip" data-placement="top" data-container="body" title="A relative cost calculted by dividing the cost by the total data volume in Gigabytes. You can change the data volume in your profile.">Cost per GB</th>
		<th class="text-right">Map to activities</th>
		<th class="text-right">Map to financial accounting</th>
		<th class="text-right"></th>
	</thead>
	<tbody>
        <?php for($i=0, $n = count($this->costs);$i<$n;$i++) { ?>
        	<?php $cost = CCExHelpersCast::cast('CCExModelsCost', $this->costs[$i]); ?>
			<tr>
				<td><?php echo $cost->name ?></td>
				<td class="text-right"><?php echo $cost->formattedCost() ?></td>
				<td class="text-right" data-toggle="tooltip" data-placement="right" data-container="body" title="You have defined your data volume to be 10 Terabytes"><?php echo $cost->formattedCostPerGB() ?></td>
				<td class="text-right"><?php echo $cost->percentageActivityMapping() ?>% mapped</td>
				<td class="text-right"><?php echo $cost->percentageFinancialAccountingMapping() ?>% mapped</td>
				<td class="text-right"><a href="<?php echo JRoute::_('index.php?option=com_ccex&view=cost&layout=edit&cost_id=' . $cost->cost_id) ?>"><span class="fa fa-edit"></span></a></td>
			</tr>
        <?php } ?>
	</tbody>
	<tfoot>
		<tr style="color: #999">
			<td></td>
			<td class="text-right"><?php echo $this->collection->formattedSumCosts() ?></td>
			<td class="text-right" data-toggle="tooltip" data-placement="right" data-container="body" title="You have defined your data volume to be 10 Terabytes"><?php echo $this->collection->formattedSumCostsPerGB() ?></td>
			<td class="text-right <?php if($this->collection->percentageActivityMapping() < 50){ echo 'danger'; } ?>"><?php echo $this->collection->percentageActivityMapping() ?>% mapped</td>
			<td class="text-right <?php if($this->collection->percentageFinancialAccountingMapping() < 50){ echo 'danger'; } ?>"><?php echo $this->collection->percentageFinancialAccountingMapping() ?>% mapped</td>
			<td class="text-right"></td>
		</tr>
	</tfoot>
</table>

<div class="row">
	<div class="col-md-2">
		<a href="<?php echo JRoute::_('index.php?option=com_ccex&view=cost&layout=add') ?>" class="btn btn-primary btn-block">Add cost unit</a>
	</div>
	<div class="col-md-2 col-md-offset-8">
		<a href="<?php echo JRoute::_('#RESULTS') ?>" class="btn btn-success btn-block">See results <span class="fa fa-angle-right"></span></a>
	</div>
</div>

<br/><br/>
<div class="alert alert-info">
	<div class="row">
		<div class="col-md-9"> 
		<span><strong>Please note</strong><br/>
		Your costs per GB are calculated with your profile, you can change it at any time.</span>
		</div>
		<div class="col-md-2 col-md-offset-1">
			<a href="<?php echo JRoute::_('#PROFILE') ?>" class="btn btn-info btn-block"> Go to profile</span></a>
		</div>
	</div>
</div>
<script>
$("[data-toggle='tooltip']").tooltip();
</script>
