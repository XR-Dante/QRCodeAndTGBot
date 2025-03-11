<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';
require_once 'controllers/Bot.php';
require_once 'controllers/Web.php';

class Route{
  public static function handleBot(): void{
      $update=file_get_contents('php://input');

      $token=$_ENV['BOT_TOKEN'];
      if($update){
        (new Bot($token))->handle($update);
      }
  }
  public static function handleWeb(): void{
      require_once 'controllers/Web.php';
  }

}
