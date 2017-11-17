<!doctype html>
<html>
<head>
    <title>DOMDocument</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<?php

// Instantiating DOMDocument Object
$doc = new DOMDocument();

// Loading and parsing specified file; building the DOM tree structure on memory
$doc->load( 'GioMovies.xml' );

$xpath = new DOMXpath($doc);
$elements = $xpath->query("//*[@id]");

echo "<table>";

if (!is_null($elements)) {
    foreach ($elements as $element) {
        echo "<tr>";
        echo "<td>" . $element->nodeName. "</td>";

        $nodes = $element->childNodes;

        for($i=0;$i<7;$i++){
            if(trim($nodes[$i]->nodeValue) != "")
                echo "<td>" . $nodes[$i]->nodeValue . "</td>";
        }

        echo "</tr>";
    }
}


?>

</body>
</html>