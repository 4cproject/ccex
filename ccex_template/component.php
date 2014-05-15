<?php defined( '_JEXEC' ) or die; 

$doc = JFactory::getDocument(); 
$tpath = $this->baseurl.'/templates/'.$this->template;

$this->setGenerator(null);

$doc->addStyleSheet($tpath.'/theme/blank/css/print.css?v=1'); 

?>
<!doctype html>

<html lang="<?php echo $this->language; ?>">

<head>
  <jdoc:include type="head" />
</head>

<body id="print">
  <div id="overall">
    <jdoc:include type="message" />
    <jdoc:include type="component" />
  </div>
  <?php if ($_GET['print'] == '1') echo '<script type="text/javascript">window.print();</script>'; ?>
</body>

</html>
