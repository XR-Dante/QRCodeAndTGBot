<?php
namespace App\Contracts;

interface ReadInterface{
    public function ReadQr(string $file): string; //Read qr Code file.
}
