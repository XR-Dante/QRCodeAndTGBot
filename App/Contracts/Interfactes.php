<?php
namespace App\Contracts;

interface QrGeneratorInterface{
  public function generator(): string; // Qr code generator in Web.
  public function Tggenerator(): string; // Qr code generator in Telegram bot.
}

interface BotInterface{
  public function handle(): string;
  public function handleStartCommand(): string; //Start button command.
  public function handleGenerateCommand(): string; //Qr code Generator command.
  public function setWebhook(): string;
}

interface ReadQrCodeInterface{
  public function ReadQr(): string; //Read qr Code file.
}

interface RouteInterface {
  public static function handleBot(): void; // Request check bot.
  public static function handleWEb(): void; // Request check web.
}
