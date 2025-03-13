<?php
declare(strict_types=1);

namespace App;
use App\Controllers\Bot;
use App\Contracts\RouteInterface;

class Route implements RouteInterface {
	public static $test = 'test';
  public static function handleBot(): void{
      $update=file_get_contents('php://input');

      $token=$_ENV['BOT_TOKEN'];
      if($update){
        (new Bot($token))->handle($update);
      }
  }
  public static function handleWeb(): void{
      require_once 'Controllers/Web.php';
  }
}
