<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class PdfController extends BaseController
{
    public function generate(
        $name,
        $address,
        $dob,
        $sex,
        $id_no,
        $issued,
        $profile,
        $qrcode,
        $signature = '',
    ) {
        // $name = 'JOSE MARI CHAN';
        // $address = 'BRGY. SICAYAB BUCANA, DAPITAN CITY, ZAMBOANGA DEL NORTE';
        // $dob = '01/01/1960';
        // $sex = 'MALE';
        // $id_no = 0012345;
        // $issued = '09/26/2025';
        // $profile = WRITEPATH . 'uploads/photo.jpg';
        // $qrcode = WRITEPATH . 'uploads/qr-code.png';
        // $signature = 'sample';
        // EXAMPLE DATA — replace with DB or form data
        $gender = '';
        switch ($sex) {
            case 'M':
                $gender = 'MALE';
            case 'F':
                $gender = 'FEMALE';
        }

        $data = [
            'name'       => $name, //JOSE MARI CHAN
            'address'    => strtoupper($address), // BRGY. DAWO, DAPITAN CITY, ZAMBOANGA DEL NORTE
            'dob'        => $dob, //01/01/1960
            'sex'        => $gender, //MALE
            'id_number'  => $id_no, //0012345
            'issued'     => $issued, //09/26/2025
            'photo'      => WRITEPATH . $profile, //IMAGE PROFILE PATH
            'qrcode'     => WRITEPATH . 'uploads/qrcodes/' . $qrcode, //GENERATED QR-CODE
            'signature'  => $signature, //SIGNATURE IMAGE PATH
        ];

        // Load ID template
        $template = imagecreatefrompng(WRITEPATH . 'uploads/template/osca-template-orig.png');

        // Text color
        $black = imagecolorallocate($template, 0, 0, 0);

        // Font file (TTF)
        $font = WRITEPATH . "fonts/Montserrat-Bold.ttf";

        // Write text on template (x,y positions placed according to your layout)
        imagettftext($template, 20, 0, 375, 230, $black, $font, $data['name']);
        imagettftext($template, 13, 0, 375, 290, $black, $font, $data['address']);
        imagettftext($template, 20, 0, 375, 360, $black, $font, $data['dob']);
        imagettftext($template, 20, 0, 375, 425, $black, $font, $data['sex']);
        imagettftext($template, 20, 0, 375, 485, $black, $font, $data['id_number']);
        imagettftext($template, 20, 0, 375, 550, $black, $font, $data['issued']);

        // Add Photo (left side)
        if (file_exists($data['photo'])) {
            $photo = imagecreatefromjpeg($data['photo']);
            imagecopyresampled($template, $photo, 90, 200, 0, 0, 240, 240, imagesx($photo), imagesy($photo));
        }

        // Signature
        if (file_exists($data['signature'])) {
            $sig = imagecreatefrompng($data['signature']);
            imagecopyresampled($template, $sig, 150, 700, 0, 0, 300, 120, imagesx($sig), imagesy($sig));
        }

        // QR Code (lower right)
        if (file_exists($data['qrcode'])) {
            $qr = imagecreatefrompng($data['qrcode']);
            imagecopyresampled($template, $qr, 790, 420, 0, 0, 170, 170, imagesx($qr), imagesy($qr));
        }

        // Save final output
        // $output = WRITEPATH . "generated/osca_id_" . time() . ".png";
        // imagepng($template, $output, 9);
        $outputDir = WRITEPATH . "Osca-ID/";

        // Create folder if it doesn't exist
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        $output = $outputDir . "osca_id_" . $id_no . ".png";

        // Save the image
        imagepng($template, $output, 9);

        // Free memory
        imagedestroy($template);

        // Download the file
        return true;
    }
}
