<!doctype html>
<html>
<head>
    <title>DOMXPath</title>
</head>
<body>

<?php

// Instantiating DOMDocument Object
$doc = new DOMDocument();

// Loading and parsing specified file; building the DOM tree structure on memory
$doc->load( 'GioMovies.xml' );

// Instantiating DOMXpath Object
$xpath = new DOMXpath($doc);

// Selecting every element that has an id attribute
$elements = $xpath->query("//*[@id]");

if (!is_null($elements)) {
    foreach ($elements as $element) {
        echo "<h3>Nó selecionado => ". $element->nodeName. "</h3>";

        $nodes = $element->childNodes;
        for($i=0;$i<7;$i++){
            if(trim($nodes[$i]->nodeValue) != "")
                echo "<p style='padding-left: 2em'>" . $nodes[$i]->nodeValue . "</p>";
        }
        echo "<br/><br/>";
    }
}


?>

</body>
</html>