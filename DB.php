<?php
declaire(strict_types=1);

class DB{

$dbName     = $_ENV['DB_NAME'];
$dbPassword = $_ENV['DB_PASSWORD'];

$conn = new mysqli("localhost", "root", $dbPassword, $dbName);
if($conn->connect_error){
   die("Ulanish xatosi: " . $conn->connect_error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
