<!doctype html>
<html>
<head>
    <title>DOMDocument</title>
    <link rel="stylesheet" type="text/css" href="input_table_styles.css">
</head>
<body>
    
<?php

$doc = new DOMDocument();
$doc->load( 'input_breakfast_menu.xml' );

$xsl = new DOMDocument();
$xsl->load( 'input_breakfast_menu.xsl' );

$xslt = new xsltProcessor;
$xslt->importStyleSheet($xsl);

echo $xslt->transformToXML($doc);

?>

</body>
</html>