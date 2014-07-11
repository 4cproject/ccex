<?php
/**
 * @package     pt.keep.joomla
 * @subpackage  templates.ccex
 *
 * @copyright   Copyright (C) 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;

$tpath = $this->baseurl.'/templates/'.$this->template;

$sitename = $app->getCfg('sitename');
$metadesc = $app->getCfg('MetaDesc');

$this->setGenerator(null);


# unset frameworks
JHtml::_('bootstrap.framework',false);
JHtml::_('jquery.framework',false);

# unset scripts
unset($doc->_scripts[$this->baseurl.'/media/jui/js/jquery.min.js']);
unset($doc->_scripts[$this->baseurl.'/media/jui/js/jquery-noconflict.js']);
unset($doc->_scripts[$this->baseurl.'/media/jui/js/jquery-migrate.min.js']);
unset($doc->_scripts[$this->baseurl.'/media/jui/js/bootstrap.min.js']);

$doc->addScript($tpath.'/libs/Chart.min.js');

$doc->addScript($tpath.'/libs/jquery/2.1.0/jquery.min.js');
$doc->addStyleSheet($tpath.'/libs/bootstrap/3.1.1/css/bootstrap.min.css');
$doc->addScript($tpath.'/libs/bootstrap/3.1.1/js/bootstrap.min.js');

$doc->addStyleSheet($tpath.'/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.min.css');
$doc->addScript($tpath.'/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js');

$doc->addStyleSheet($tpath.'/theme/bolt/css/main.css');
$doc->addStyleSheet($tpath.'/theme/bolt/css/font-awesome.min.css');


$doc->addStyleSheet($tpath.'/libs/bootstrap-slider/css/bootstrap-slider.min.css');
$doc->addScript($tpath.'/libs/modernizr/2.7.1/modernizr.min.js');
$doc->addScript($tpath.'/libs/bootstrap-slider/js/bootstrap-slider.min.js');
$doc->addScript($tpath.'/libs/humanize.min.js');
$doc->addScript($tpath.'/assets/js/ccex.js');
$doc->addStyleSheet($tpath.'/assets/css/ccex.css');

?>
<!doctype html>
<html>
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Curation Cost Exchange Platform">
      <meta name="author" content="4C project">
      <jdoc:include type="head" />
      <title><?php echo $sitename; ?></title>

      <script src="http://code.highcharts.com/highcharts.js"></script>
      <script src="http://code.highcharts.com/modules/exporting.js"></script>
    </head>
    <body style="margin: 0; background-color: white;">
        <div class="jumbotron"  style="background-color: #4e4e4e; color: #fafafa">
          <div class="container">
            <a href="<?php echo JRoute::_('index.php?option=com_content&view=article&id=1'); ?>">
              <img src="<?php echo $tpath; ?>/images/CCEx_logo_125_white.png" class="pull-left" style="margin: 15px 45px 0 0;"/>
            </a>
            <h1 style="font-weight: 600;"><?php echo $sitename; ?></h1>
            <p><?php echo $metadesc; ?></p>
          </div>
        </div>

        <div class="container-fluid" style="background-color: white;">
          <div class="container">
            <jdoc:include type="modules" name="menu" />

            <jdoc:include type="message" />
            <jdoc:include type="component" />
          </div>
        </div>
    </body>

    <script>
      $("[data-toggle='tooltip']").tooltip();
    </script>
    <script type="text/javascript">
      (function() {
      var s = document.createElement("script");
        s.type = "text/javascript";
        s.async = true;
        s.src = '//api.usersnap.com/load/'+
            '70f5a8e8-713e-4dd5-b907-e669bb6ed141.js';
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
      })();
    </script>
</html>
