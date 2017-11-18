<!doctype html>
<html>
<head>
    <title>DOMDocument</title>
    <link rel="stylesheet" type="text/css" href="input_table_styles.css">
</head>
<body>

<?php

// Instantiating DOMDocument Object
$doc = new DOMDocument();

// Loading and parsing specified file; building the DOM tree structure on memory
$doc->load( 'input_GioMovies.xml' );

// Selecting every 'filme' element from the DOM tree
$filmes = $doc->getElementsByTagName( "filme" );

echo "
    <table>
    <tr>
    <th>Título</th>
    <th>Ano</th>
    <th>Direção</th>
    </tr>";

// iterating through the DOM tree
foreach( $filmes as $filme ) {

    // selecting specific nodes of each movie
    $title = $filme->getElementsByTagName( "tituloEN" )->item(0)->nodeValue;
    $year = $filme->getElementsByTagName( "ano" )->item(0)->nodeValue;
    $director = $filme->getElementsByTagName( "direcao" )->item(0)->nodeValue;
    
    echo "<tr>";
    echo "<td>$title</td><td>$year</td><td>$director</td>";
    echo "</tr>";

}

echo "</table>";

// Validating xml against DTD
if ($doc->validate()) {
    echo "<h3>O documento 'GioMovies.xml' foi validado em relação ao DTD 'GioMovies.dtd'</h3>";
} else {
    echo "<br/><br/>";
}

// Validating xml against Schema
if ($doc->schemaValidate("input_GioMovies.xsd")) {
    echo "<h3>O documento 'GioMovies.xml' foi validado em relação ao Schema 'GioMovies.xsd'</h3>";
} else {
    echo "<br/><br/>";
}

?>

</body>
</html>