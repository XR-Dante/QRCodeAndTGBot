<?php

namespace App\Controllers;

use GuzzleHttp\Client;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use App\Contracts\GeneratorInterface;

class QrCodeGenerator implements GeneratorInterface {
    public $text;
    public $resault;

    function __construct($text){
        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
        ]);

        $this->text = $text;
        $qrCode = new QRCode($options);
        $this->resault = $qrCode->render($text); 
    }

    function generator(){
        return '<img src="' .$this->resault . '" alt="QR Code" width="200">';
    }

    function Tggenerator(){
        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
        ]);
	$qrPath = __DIR__ . '/qr.png';    
        return (new QRCode($options))->render($this->text, $qrPath);
    }
    

}

?>
