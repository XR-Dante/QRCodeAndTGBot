<?php

namespace App\QrCodeGenerator;

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class QrCodeGenerator {
    public $text;
    public $resault;

    function __construct($text){
        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => QRCode::ECC_L,
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
            'eccLevel' => QRCode::ECC_L,
        ]);
    
        $qrCode = new QRCode($options);
        return $qrCode->render($this->text); // PNG formatda rasm qaytaradi
    }
    

}

?>
