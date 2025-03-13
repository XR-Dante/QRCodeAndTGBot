<?php
namespace App\Contracts;

interface BotInterface{
    public function handle(): string;
    public function handleStartCommand(): string; //Start button command.
    public function handleGenerateCommand(): string; //Qr code Generator command.
    public function setWebhook(): string;
}
