<table class="table table-condensed">
    <thead>
        <th>Name</th>
        <th class="text-right">Cost</th>
        <th class="text-right">Cost per GB</th>
        <th class="text-right">Cost per Year</th>
        <th class="text-right">Cost per GB per Year</th>
        <th class="text-right">Map to activities</th>
        <th class="text-right">Map to financial accounting</th>
        <?php if(isset($this->editable) && $this->editable) { ?>
            <th class="text-right"></th>
        <?php } ?>    
    </thead>
	<tbody>
        <?php for($i=0, $n = count($this->costs);$i<$n;$i++) { ?>
        	<?php $cost = CCExHelpersCast::cast('CCExModelsCost', $this->costs[$i]); ?>
			<tr>
				<td><?php echo $cost->name ?></td>
				<td class="text-right"><?php echo $cost->formattedCost() ?></td>
				<td class="text-right"><?php echo $cost->formattedCostPerYear() ?></td>
				<td class="text-right"><?php echo $cost->formattedCostPerGB() ?></td>
				<td class="text-right"><?php echo $cost->formattedCostPerGBPerYear() ?></td>
				<td class="text-right"><?php echo $cost->percentageActivityMapping() ?>% mapped</td>
				<td class="text-right"><?php echo $cost->percentageFinancialAccountingMapping() ?>% mapped</td>
                <?php if(isset($this->editable) && $this->editable) { ?>
				    <td class="text-center"><a href="<?php echo JRoute::_('index.php?option=com_ccex&view=cost&layout=edit&cost_id=' . $cost->cost_id) ?>"><span class="fa fa-edit"></span></a></td>
			    <?php } ?>
            </tr>
        <?php } ?>
	</tbody>
	<tfoot>
		<tr style="color: #999">
			<?php if(count($this->costs) > 0) { ?>
				<td></td>
				<td class="text-right"><?php echo $this->interval->formattedSumCosts() ?></td>
				<td class="text-right"><?php echo $this->interval->formattedSumCostsPerYear() ?></td>
				<td class="text-right"><?php echo $this->interval->formattedSumCostsPerGB() ?></td>
				<td class="text-right"><?php echo $this->interval->formattedSumCostsPerGBPerYear() ?></td>
				<td class="text-right <?php if($this->interval->percentageActivityMapping() < 50){ echo 'danger'; } ?>"><?php echo $this->interval->percentageActivityMapping() ?>% mapped</td>
				<td class="text-right <?php if($this->interval->percentageFinancialAccountingMapping() < 50){ echo 'danger'; } ?>"><?php echo $this->interval->percentageFinancialAccountingMapping() ?>% mapped</td>
			<?php } else { ?>
                <?php if(isset($this->editable) && $this->editable) { ?>
				    <td class="text-right" colspan="7">Click here to add curation costs to this collection &nbsp; &rarr;</td>
                <?php } else { ?>
                <td class="text-left" colspan="7">To add costs, please <a href="<?php echo JRoute::_('index.php?view=collection&layout=edit&collection_id=' . $this->interval->collection()->collection_id) ?>">edit collection</a>.</td>
                <?php } ?>
			<?php } ?>
            <?php if(isset($this->editable) && $this->editable) { ?>
			    <?php if(isset($this->interval->interval_id)){ ?>
                    <td class="text-center">
                        <a href="javascript:void(0)" onclick="<?php echo 'ccexUpdate(\'collection\', \'' . JRoute::_('index.php?option=com_ccex&view=cost&layout=add&interval_id=' . $this->interval->interval_id ) . '\', true)'; ?>"><i class="fa fa-plus"></i></a>
                    </td>
                <?php } else { ?>
                    <td class="text-center">
                        <a href="javascript:void(0)" onclick="<?php echo 'ccexCreate(\'collection\', \'' . JRoute::_('index.php?option=com_ccex&view=cost&layout=add&interval_id=' ) . '\', true, \'interval\')'; ?>"><i class="fa fa-plus"></i></a>
                    </td>
                <?php } ?>
		    <?php } ?>
        </tr>
	</tfoot>
</table>
