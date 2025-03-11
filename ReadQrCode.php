<?php 

namespace App\ReadQrCode; 

require_once 'vendor/autoload.php';

use chillerlan\QRCode\QRCode;
use Throwable;

class ReadQrCode {

    public function ReadQr(string $file): string {
        if (!file_exists($file)) {    
            return "Xatolik: Fayl topilmadi!";
        }

        try {
            $result = (new QRCode)->readFromFile($file);
            return (string)$result;
        } catch (Throwable $e) {
            return "Xatolik: " . $e->getMessage();
        }
    }
}
?>
