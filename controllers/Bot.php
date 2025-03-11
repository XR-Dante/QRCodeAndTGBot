<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';
// require_once 'QrCodeGenerator.php';

use GuzzleHttp\Client;
use App\QrCodeGenerator\QrCodeGenerator;


class Bot{
	public string       $text;
	public float|string $chatId;
	public string       $firstName;

	private string $api;
	private        $http;
	public         $token;

	
	public function __construct(){
	  $this->token = $_ENV['BOT_TOKEN'];
	  $this->api   = "https://api.telegram.org/bot{$this->token}/";
	  $this->http  = new Client(['base_uri' => $this->api]);

	}
	
	public function handle(string $update){
	  $update = json_decode($update);
	  
	  $this->text  	   = $update->message->text;
	  $this->chatId    = $update->message->chat->id;
	  $this->firstName = $update->message->chat->first_name;

	  match($this->text){
	       	"/start" => $this->handleStartCommand(),
	      	default  => $this->qrCodeGenerator(),
	  };
	}


	public function handleStartCommand(){
	  $text  = "Salom {$this->firstName}";
	  $this->http->post('sendMessage',[
	  	'form_params' => [
		    'chat_id' => $this->chatId,
		    'text'    => $text
		]   
	  ]);
	}

	public function qrCodeGenerator(){
	    $text = $this->text;
	    $qrCodeGenerator = new QrCodeGenerator($text);
	    $imageData = $qrCodeGenerator->Tggenerator();
	
	    $tempFile = tmpfile();
	    $tempFilePath = stream_get_meta_data($tempFile)['uri'];
	    file_put_contents($tempFilePath, $imageData);
	
	    $this->http->post('sendPhoto', [
		'multipart' => [
		    [
			'name'     => 'chat_id',
			'contents' => $this->chatId
		    ],
		    [
			'name'     => 'photo',
			'contents' => fopen($tempFilePath, 'r'),
		    ]
		    ]
		]);
	
	    fclose($tempFile);
	}
	
}
