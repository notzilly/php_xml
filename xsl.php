<!doctype html>
<html>
<head>
    <title>DOMDocument</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    
<?php

$doc = new DOMDocument();
$doc->load( 'breakfast_menu.xml' );

$xsl = new DOMDocument();
$xsl->load( 'breakfast_menu.xsl' );

$xslt = new xsltProcessor;
$xslt->importStyleSheet($xsl);

echo $xslt->transformToXML($doc);

?>

</body>
</html>