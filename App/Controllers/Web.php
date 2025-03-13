<?php
// ini_set('display_errors',1);
namespace App\Controllers;

require "vendor/autoload.php";

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use App\Controllers\QrCodeGenerator;
use App\ReadQrCode;

$natija = "";
$file = null;

if(isset($_POST['text'])){
    $text = $_POST["text"]; 
    $resault = new QrCodeGenerator($text);  
    $natija = $resault->generator();
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])){
    if($_FILES['file']['error'] === UPLOAD_ERR_OK){
        $filePath = $_FILES['file']['tmp_name']; 
        $file = (new ReadQrCode())->ReadQr($filePath);
    } else {
        echo "Fayl yuklashda xatolik yuz berdi!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <title>QR Code Generator</title>
   <style>
      .button {
  	   background-color: DodgerBlue;
 	   border: none;
  	   color: white;
  	   padding: 3px 14px;
  	   font-size: 16px;
  	   cursor: pointer;
      }
   </style>
</head>
<body>
   <form action="index.php" method="POST">
        <input type="text" name="text" class="input">
	<button type="submit" >Generation</button><br><br>
   </form>

   <form action="index.php" method="POST" enctype="multipart/form-data">
	<input type="file" name="file">
	<button type="submit" class="button">Save</button>
   </form>
      <h3>QR Kod</h3>
      <?= $natija; ?>
      <?php 
          if(!empty($file)){
              echo $file;
	  }else{
	      echo "";
	  }
      ?>
</body>
</html>
