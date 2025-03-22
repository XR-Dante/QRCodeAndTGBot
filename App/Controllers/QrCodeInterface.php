<?php
namespace App\Controllers;

interface QrCodeInterface{
    public function generatorQrCode(); // Qr code generator in Web.
    public function readQrCode(); //Read qr Code file.
}


