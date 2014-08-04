</div>
<div class="container">
    <h1>Compare costs</h1>
    <p>Define your organisation profile, your cost data sets, describe the associated curation costs and map them to the categories of our framework of comparable costs.</p>
</div>           

<?php echo $this->_showOrganization->render(); ?>
<?php echo $this->_indexCollection->render(); ?>
<?php echo $this->_utilitiesOrganization->render(); ?>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/compare_costs.js') ?>"></script>
