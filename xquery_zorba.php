<?php 

// Para esse algoritmo executar é necessário ter a API do Zorba instalada
// http://www.zorba.io/documentation/latest/zorba/install

require 'zorba_api.php';

// Inicialização da conexão com a API do Zorba
$store = InMemoryStore::getInstance();
$zorba = Zorba::getInstance($store);

// Definição da Query
$xquery = <<< EOT
let $henlo := 'Henlo Uorld!'
return
<mensagem>
    {$henlo}
</mensagem>
EOT;

// Compilação da query para uma sintaxe PHP e execução dela
$lQuery = $zorba->compileQuery($xquery);
echo $lQuery->execute();

// Destruição da estrutura criada pelo compileQuery()
$lQuery->destroy();

// Finalização da conexão com a API do Zorba
$zorba->shutdown();
InMemoryStore::shutdown($store);

?>