<?php

require_once 'vendor/autoload.php';

use chillerlan\QRCode\QRCode;

  try{
    $result = (new QRCode())->readFromFile('nimadur.png');
    $natija = $result->data;
    var_dump($natija);
  }
  catch(Throwable $e){
    print_r($e->getMessage());
  }
?>