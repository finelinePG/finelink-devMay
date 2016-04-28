<?php
 
$proxy = new SoapClient('127.0.0.1/magento/api/v2_soap/?wsdl'); 
$sessionId = $proxy->login('soaper', 'F!neline25'); 

$result = $proxy->storeList($sessionId);
var_dump($result);

?>