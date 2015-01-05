<table class="table table-condensed tour-step tour-step-coll-cost-view">
    <thead>
        <th>Name</th>
        <th class="text-right">Cost</th>
        <th class="text-right">Cost per GB</th>
        <th class="text-right">Cost per Year</th>
        <th class="text-right">Cost per GB per Year</th>
        <th class="text-right">Map to activities</th>
        <th class="text-right">Map to purchases and staff</th>
        <?php if(isset($this->editable) && $this->editable) { ?>
            <th class="text-right"></th>
        <?php } ?>    
    </thead>
	<tbody>
        <?php for($i=0, $n = count($this->costs);$i<$n;$i++) { ?>
        	<?php $cost = CCExHelpersCast::cast('CCExModelsCost', $this->costs[$i]); ?>
			<tr>
				<td><?php echo htmlspecialchars($cost->name ) ?></td>
				<td class="text-right nowrap"><?php echo $cost->formattedCost() ?></td>
				<td class="text-right nowrap"><?php echo $cost->formattedCostPerGB() ?></td>
				<td class="text-right nowrap"><?php echo $cost->formattedCostPerYear() ?></td>
				<td class="text-right nowrap"><?php echo $cost->formattedCostPerGBPerYear() ?></td>
				<td class="text-right nowrap"><?php echo $cost->percentageActivityMapping() ?>%</td>
				<td class="text-right nowrap"><?php echo $cost->percentageFinancialAccountingMapping() ?>%</td>
                <?php if(isset($this->editable) && $this->editable) { ?>
				    <td class="text-center tour-step tour-step-coll-cost-edit"><a  data-toggle="tooltip" data-placement="left" title="Click here to edit the cost unit of your cost data set" href="<?php echo JRoute::_('index.php?option=com_ccex&view=cost&layout=edit&cost_id=' . $cost->cost_id) ?>">edit</a></td>
			    <?php } ?>
            </tr>
        <?php } ?>
	</tbody>
	<tfoot>
		<tr style="color: #999">
			<?php if(count($this->costs) > 0) { ?>
				<td></td>
				<td class="text-right nowrap"><?php echo $this->interval->formattedSumCosts() ?></td>
				<td class="text-right nowrap"><?php echo $this->interval->formattedSumCostsPerGB() ?></td>
				<td class="text-right nowrap"><?php echo $this->interval->formattedSumCostsPerYear() ?></td>
				<td class="text-right nowrap"><?php echo $this->interval->formattedSumCostsPerGBPerYear() ?></td>
				<td class="text-right nowrap <?php if($this->interval->percentageActivityMapping() < 75){ echo 'danger'; } ?>"><?php echo $this->interval->percentageActivityMapping() ?>%</td>
				<td class="text-right nowrap <?php if($this->interval->percentageFinancialAccountingMapping() < 75){ echo 'danger'; } ?>"><?php echo $this->interval->percentageFinancialAccountingMapping() ?>%</td>
			<?php } else { ?>
                <?php if(isset($this->editable) && $this->editable) { ?>
				    <td class="text-right" colspan="7"></td>
                <?php } else { ?>
                <td class="text-left" colspan="7">To add costs, please <a href="<?php echo JRoute::_('index.php?view=collection&layout=edit&collection_id=' . $this->interval->collection()->collection_id) ?>">edit cost data sets</a>.</td>
                <?php } ?>
			<?php } ?>
            <?php if(isset($this->editable) && $this->editable) { ?>
			    <td class="text-center"></td>
		    <?php } ?>
        </tr>
	</tfoot>
</table>

<div style="margin-right: 10px">
    <?php if(isset($this->editable) && $this->editable) { ?>
        <span class="tour-step tour-step-coll-add-cost-unit pull-right">
            <?php if(isset($this->interval->interval_id)){ ?>
                <a class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="left" title="Click here to add curation costs to this cost data set" href="javascript:void(0)" onclick="<?php echo 'ccexUpdate(\'collection\', \'' . JRoute::_('index.php?option=com_ccex&view=cost&layout=add&interval_id=' . $this->interval->interval_id ) . '\', true)'; ?>">Add new cost unit</a>
            <?php } else { ?>
                <a class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="left" title="Click here to add curation costs to this cost data set" href="javascript:void(0)" onclick="<?php echo 'ccexCreate(\'collection\', \'' . JRoute::_('index.php?option=com_ccex&view=cost&layout=add&interval_id=' ) . '\', true, \'interval\')'; ?>">Add new cost unit</a>
            <?php } ?>
        </span>
    <?php } ?>
</div>
