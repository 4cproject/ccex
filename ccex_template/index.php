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

$doc->addScript($tpath.'/libs/Chart.min.js');

$doc->addScript($tpath.'/libs/jquery/2.1.0/jquery.min.js');
$doc->addStyleSheet($tpath.'/libs/bootstrap/3.1.1/css/bootstrap.min.css');
$doc->addScript($tpath.'/libs/bootstrap/3.1.1/js/bootstrap.min.js');

$doc->addStyleSheet($tpath.'/libs/bootstrap-formhelpers/2.3.0/css/bootstrap-formhelpers.min.css');
$doc->addScript($tpath.'/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js');

$doc->addStyleSheet($tpath.'/theme/bolt/css/main.css');
$doc->addStyleSheet($tpath.'/theme/bolt/css/font-awesome.min.css');

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
    </head>
    <body style="margin: 0; background-color: white;">
        <div class="jumbotron">
          <div class="container">
            <a href="index.html"><img src="<?php echo $tpath; ?>/images/CCEx_logo_125.png" class="pull-left" style="margin: 15px 45px 0 0;"/></a>
              <h1><?php echo $sitename; ?></h1>
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
</html>
