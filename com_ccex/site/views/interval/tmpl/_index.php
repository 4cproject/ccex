<ul class="nav nav-tabs">
    <?php foreach ($this->intervals as $interval) { ?>
        <?php $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval); ?>

        <li <?php if($this->lastInterval->interval_id == $interval->interval_id) { echo 'class="active"'; } ?>>
        	<a data-toggle="tab" href="#<?php echo $interval->toString();?>"><?php echo $interval->toString();?></a>
        </li>
        
    <?php } ?>
</ul>
<br/>
<div class="tab-content">
	<?php foreach ($this->intervals as $interval) { ?>
        <?php $interval = CCExHelpersCast::cast('CCExModelsInterval', $interval); ?>
		
		<div class="tab-pane fade <?php if($this->lastInterval->interval_id == $interval->interval_id) { echo 'in active'; } ?>" id="<?php echo $interval->toString();?>">

			<?php 
			$this->_showInterval->interval = $interval;
			echo $this->_showInterval->render();
			?>

		</div>
	<?php } ?>
</div>
