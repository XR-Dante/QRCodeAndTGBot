<?php
declare(strict_types=1);
namespace App\Controllers;

use GuzzleHttp\Client;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use App\Controllers\QrCodeInterface;

class Bot implements QrCodeInterface {
  public  ?string $text = null;
  public  int    $chatId;
  public  string $firstName;
  public  string $command;

  private string $api;
  private        $http;
  private        $img;
  //private        $other;

  public function __construct(string $token){
	  $this->token = $_ENV['BOT_TOKEN'];
    $this->api   = "https://api.telegram.org/bot$token/";
    $this->http  = new Client(['base_uri' => $this->api]);
  }

  public function handle(string $update){
    $update = json_decode($update); 



    if(isset($update->message->text)){
      $this->text = $update->message->text;
    }
    $this->chatId    = $update->message->chat->id;
    $this->firstName = $update->message->chat->first_name;

    if(isset($update->message->photo)){
      $this->img = end($update->message->photo)->file_id;
    }

    #if(!isset($this->text) && !isset($this->img)){
    #  $this->otherMsg();
    #}

    if(isset($this->text)){
      if(strpos($this->text, '/') === 0) {
        $string        = explode(' ', $this->text, 2);
        $this->text    = $string[1] ?? $string[0];
        $this->command = $string[0];
      }
    }else{
      if(!empty($this->img)){
        $this->readQrCode();
      }
    }

    if($this->text === "/start"){
      $this->handleStartCommand();
    }elseif($this->command === "/generate" && isset($this->text)){
      $this->generatorQrCode();
    }
  }

  public function handleStartCommand(){
      $text = "Salom $this->firstName";
      $text.= "\n/generate";
      
      
      $this->http->post('sendMessage', [
        'form_params' => [
            'chat_id' => $this->chatId,
            'text'    => $text
        ]
      ]);
  }

  public function generatorQrCode(){
    $options = new QROptions([
        'outputType' => QRCode::OUTPUT_IMAGE_PNG,
    ]); 
    (new QRCode($options))->render($this->text, 'qr.png');

    $qrPath = __DIR__ . '/qr.png';
    $this->http->post('sendPhoto', [
      'multipart' => [
        [
          'name' => 'chat_id',
          'contents' => $this->chatId
        ],
        [
          'name' => 'photo',
          'contents' => fopen($qrPath, 'r'),
        ] 
      ]
    ]);

  }

  public function readQrCode(){
    if(!$this->img){
      return;
    }
    $getFile  = $this->api . "getFile?file_id=" . $this->img;
    $readFile = file_get_contents($getFile);
    $fileInfo = json_decode($readFile);
    $filePath = $fileInfo->result->file_path;
    $fileUrl  = "https://api.telegram.org/file/bot$this->token/" . $filePath;
    $image    = file_get_contents($fileUrl);
    file_put_contents('qr.png', $image);
    try{
      $result = (new QRCode)->readFromFile("qr.png");
    
    }catch(Exception $e){
      $result = "Qr kodni uqib bulmadi: " . $e->sendMessage();
    }
    
    $this->http->post('sendMessage', [
        'form_params' => [
            'chat_id' => $this->chatId,
            'text'    => (string)$result
        ]
    ]);


  }

  public function otherMsg(){
     $this->http->post('sendMessage', [
        'form_params' => [
          'chat_id'   => $this->chatId,
          'text'      => "❌No'malum xabar!"
        ]
     ]);
  }

  
  public function setWebhook(string $url): string {
    try{
      $response = $this->http->post('setWebhook', [
        'form_params' => [
          'url'                  => $url,
          'drop_pending_updates' => true
        ]
      ]);

      $response = json_decode($response->getBody()->getContents());
    
      return $response->description;
    } catch(Exception $e){
      return $e->getMessage();
    }
  }
   
}
