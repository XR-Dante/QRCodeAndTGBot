<?php
namespace App\Contracts;

interface GeneratorInterface{
    public function generator(); // Qr code generator in Web.
    public function Tggenerator(); // Qr code generator in Telegram bot.
}
