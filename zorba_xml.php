<?php 

//Include for the Object-Oriented API
require ‘zorba_api.php’;

//Initialization of Zorba store
$store = InMemoryStore::getInstance();
//Initialization of Zorba
$zorba = Zorba::getInstance($store);

$xquery = <<< EOT
let $message := ‘Hello World!’
return
<results>
   <message>{$message}</message>
</results>
EOT;

//Compile the query
$lQuery = $zorba->compileQuery($xquery);
//Run the query…
echo $lQuery->execute();
//…and destroy it
$lQuery->destroy();

//Shutdown of Zorba
$zorba->shutdown();
//Shutdown of Zorba store
InMemoryStore::shutdown($store);

?>