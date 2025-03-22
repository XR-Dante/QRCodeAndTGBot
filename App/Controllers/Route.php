<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Controllers\Bot;

class Route  {
	public static $test = 'test';
  public static function handleBot(): void{
      $update=file_get_contents('php://input');

      $token=$_ENV['BOT_TOKEN'];
      file_put_contents('log.php', $update);
      if($update){
        (new Bot($token))->handle($update);
      }
  }
  public static function handleWeb(): void{
      require_once __DIR__ . "/../Views/Web.php";
  }
}
