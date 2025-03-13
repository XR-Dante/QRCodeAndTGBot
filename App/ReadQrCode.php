<?php 
namespace App;

require_once 'vendor/autoload.php';

use chillerlan\QRCode\QRCode;
use App\Contracts\ReadQrCodeInterface;
use Throwable;

class ReadQrCode implements ReadQrCodeInterface {

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
