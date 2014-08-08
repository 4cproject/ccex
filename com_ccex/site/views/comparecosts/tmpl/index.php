</div>
<div class="container">
    <h1>Compare costs</h1>
    <p>Define your organisation profile, your cost data sets, describe the associated curation costs and map them to the categories of our <a data-toggle="tooltip" data-placement="right" title="The framework of comparable costs is the template that was developed to make it easy for you to submit your cost data set information in order to make them comparable with others. Click here to go back to the overview of all cost data sets you have submitted so far" href="<?php echo JRoute::_('/get-started/12-how-does-it-work-compare-costs') ?>">framework of comparable costs</a>.</p>
</div>           

<?php echo $this->_showOrganization->render(); ?>
<?php echo $this->_indexCollection->render(); ?>
<?php echo $this->_utilitiesOrganization->render(); ?>

<script type="text/javascript" src="<?php echo (JURI::base().'components/com_ccex/assets/js/compare_costs.js') ?>"></script>
