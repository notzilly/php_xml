<?php
// Leitura de XML usando a biblioteca SAX do PHP (XML Parser)

// Seta charset do navegador para IS0-8859-1
echo '<meta charset="ISO-8859-1"/>';

// CSS
echo '<link rel="stylesheet" href="input_sax_styles.css">';

// Array global para o filme
$filme = [];
// Tag XML selecionada
$elementos = null;
// Tags XML esperadas
$elementosPossiveis = [
    'TITULOEN',
    'TITULOBR',
    'GENERO',
    'DURACAO',
    'ANO',
    'SITE',
    'DISTRIBUICAO',
    'DIRECAO',
    'ELENCO',
    'ELENCOAPOIO',
    'SINOPSE'
];

// Função chamada quando uma tag é aberta
function abreTag($parser, $nome, $attrs) {
    global $filme, $elementos;

    if (!empty($nome)) {
        if ($nome == 'FILME') {
            // Cria array vazio para filmes
            $filme = [];
        }
        $elementos = $nome;
    }
}

// Função chamada quando uma tag é fechada
function fechaTag($parser, $nome) {
    global $elementos, $filme;

    if (!empty($nome)) {
        $elementos = null;
    }
    if($nome == 'SINOPSE') imprime();
}

// Função chamada entre a abertura e o fechamento da tag (texto interno)
function dataHandler($parser, $data) {
    global $filme, $elementos, $elementosPossiveis;
    if (!empty($data)) {
        if (in_array($elementos, $elementosPossiveis)) {
            if($elementos == 'ELENCO' || $elementos == 'ELENCOAPOIO'){
                if(isset($filme[$elementos]) && !is_array($filme[$elementos])){
                    $filme[$elementos] = [];
                    $filme[$elementos][] = $data;
                } else {
                    $filme[$elementos][] = $data;
                }
            } else {
                if(isset($filme[$elementos])){
                    $filme[$elementos] .= $data;
                } else {
                    $filme[$elementos] = $data;
                }   
            }
        }
    }
}

// Imprime dados dos filmes como HTML
function imprime() {
    global $filme;
    echo "<article>
        <header>
            <h1>" . $filme['TITULOBR'] . "</h1>
            <h3>" . $filme['TITULOEN'] . "</h3>
            <h4>Detalhes:</h4><ul>"
            . (isset($filme['GENERO']) ? '<li>Gênero: ' . $filme['GENERO'] . '</li>' : '')
            . (isset($filme['ANO']) ? '<li>Ano: ' . $filme['ANO'] . '</li>' : '')
            . (isset($filme['DURACAO']) ? '<li>Duração: ' . $filme['DURACAO'] . '</li>' : '')
            . (isset($filme['SITE']) ? '<li>Site: ' . $filme['SITE'] . '</li>' : '')
            . (isset($filme['DISTRIBUICAO']) ? '<li>Distribuição: ' . $filme['DISTRIBUICAO'] . '</li>' : '')
            . " </ul>
        </header>
    </article>";
    if(isset($filme['SINOPSE'])){
        echo "<h4>Sinopse:</h4>";
        echo "<p>" . $filme['SINOPSE'] . "</p>";
    }
    if(isset($filme['ELENCO'])){
        echo "<h4>Elenco:</h4><ul>"; 
        foreach ($filme['ELENCO'] as $elenco) {
            echo "<li>" . $elenco . "</li>";
        }
        echo "</ul>";
    }
    if(isset($filme['ELENCOAPOIO'])){
        echo "<h4>Elenco de Apoio:</h4><ul>";
        foreach ($filme['ELENCOAPOIO'] as $elencoApoio) {
            echo "<li>" . $elencoApoio . "</li>";
        }
        echo "</ul>";
    }
    echo '<hr/>';
}

// Cria um novo XML Parser com encoding ISO-8859-1 de saída
$parser = xml_parser_create('ISO-8859-1');

// Seta o handler para abertura e fechamento de tags
xml_set_element_handler($parser, "abreTag", "fechaTag");
// Seta o handler de dados
xml_set_character_data_handler($parser, "dataHandler");

// Abre o arquivo XML
if (!($handle = fopen('input_GioMovies_EncodingISO88591.xml', "r"))) {
    die("could not open XML input");
}
// Lê o arquivo e manda a string lida para o parser
while ($data = fread($handle, 8192)) {
    xml_parse($parser, html_entity_decode($data));
}
// Fecha o arquivo XML
fclose($handle);
// Deleta o parser
xml_parser_free($parser);
