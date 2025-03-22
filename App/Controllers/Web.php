<?php
// ini_set('display_errors',1);
namespace App\Controllers;

require "vendor/autoload.php";

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Throwbale;
use App\Controllers\QrCodeInterface;

class Web implements QrCodeInterface{
  public function generatorQrCode(string $text){
      $options = new QROptions([
        'outputType'=>QRCode::OUTPUT_IMAGE_PNG,
      ]);
      $qrCode = (new QRCode($options))->render($text);
      
      return '<img src="' . $qrCode . '" alt = "QR Code" witdh="200">';
  }

  public function readqrCode($file){
    if(!file_exists($file)){
      return "Xatolik! fayil topilmadi.";
    }
    try{
      $result = (new QRCode)->readFromFile($file);
      return (string)$result;
    }catch(Throwable $e){
      return "Xatolik!".$e->getMessage();
    }
  }

}
?>

