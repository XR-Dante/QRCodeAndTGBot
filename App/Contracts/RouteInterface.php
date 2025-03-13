<?php
namespace App\Contracts;

interface RouteInterface {
  public static function handleBot(): void; // Request check bot.
  public static function handleWeb(): void; // Request check web.
}
