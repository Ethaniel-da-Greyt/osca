<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MasterListModel;


class PdfController extends BaseController
{
    public function makeNewRecord()
    {
        $batchPath = WRITEPATH . 'Osca-ID/batch-4/';

        $files = glob($batchPath . '*.png');

        $ids = [];

        foreach ($files as $file) {
            $filename = basename($file);

            if (preg_match('/osca_id_(\d+)\.png$/', $filename, $match)) {
                $ids[] = $match[1];
            }
        }



        $model = new MasterListModel();

        $records = $model->whereIn('osca_id', $ids)->findAll();

        foreach ($records as $rec) {
            $Qr = new QrCodeGenerator();
            $qrcode = $Qr->generateQr(md5(SALT . $rec['osca_id']));
            
            $model->update($rec['osca_id'], ['qrcode' => $qrcode]);
            $this->generate(
                $rec['firstname'] . ' ' . $rec['middle_name'] . ' ' . $rec['lastname'],
                'BRGY. ' . strtoupper($rec['barangay']),
                $rec['birthdate'],
                $rec['sex'],
                $rec['osca_id'],   // ID NO
                $rec['photo'],    // profile image
                $qrcode,    // QR
                ''
            );
        }
        return $this->response->setJSON(['message' => 'Done']);
    }


    public function generate(
        $name,
        $address,
        $dob,
        $sex,
        $id_no,
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
                break;
            case 'F':
                $gender = 'FEMALE';
                break;
        }

        $data = [
            'name'       => $name, //JOSE MARI CHAN
            'address'    => strtoupper($address), // BRGY. DAWO, DAPITAN CITY, ZAMBOANGA DEL NORTE
            'dob'        => $dob, //01/01/1960
            'sex'        => $gender, //MALE
            'id_number'  => $id_no, //0012345
            'photo'      => WRITEPATH . $profile, //IMAGE PROFILE PATH
            'qrcode'     => WRITEPATH . 'uploads/qrcodes/' . $qrcode, //GENERATED QR-CODE
            'signature'  => $signature, //SIGNATURE IMAGE PATH
        ];

        // Load ID template
        // $template = imagecreatefrompng(FCPATH . 'template/osca-adjusted-new.png');
        set_error_handler(function () {
        // do nothing (ignore warnings)
        }, E_WARNING);

        $Imgdata = file_get_contents(FCPATH . 'template/osca-adjusted-new.png');
        $template = imagecreatefromstring($Imgdata);

        // Restore normal error handling
        restore_error_handler();

        // Text color
        $black = imagecolorallocate($template, 0, 0, 0);

        // Font file (TTF)
        $font = WRITEPATH . "fonts/Montserrat-Bold.ttf";

        // Write text on template (x,y positions placed according to your layout)
        imagettftext($template, 21, 0, 375, 230, $black, $font, $data['name']);
        imagettftext($template, 18, 0, 375, 310, $black, $font, $data['address']);
        imagettftext($template, 18, 0, 375, 333, $black, $font, 'DAPITAN CITY, ZAMBOANGA DEL NORTE');
        imagettftext($template, 20, 0, 375, 400, $black, $font, $data['dob']);
        imagettftext($template, 20, 0, 375, 475, $black, $font, $data['sex']);
        imagettftext($template, 20, 0, 375, 545, $black, $font, $data['id_number']);
        // imagettftext($template, 20, 0, 375, 550, $black, $font, $data['issued']);

        // Add Photo (left side)
        // if (file_exists($data['photo'])) {
        //     $photo = imagecreatefromjpeg($data['photo']);
        //     imagecopyresampled($template, $photo, 90, 200, 0, 0, 240, 240, imagesx($photo), imagesy($photo));
        // }

        $createImageFromFile = function ($file) {
            if (!file_exists($file)) return false;
            $info = getimagesize($file);
            if (!$info) return false;
            switch ($info['mime']) {
                case 'image/jpeg':
                    return imagecreatefromjpeg($file);
                case 'image/png':
                    return imagecreatefrompng($file);
                case 'image/gif':
                    return imagecreatefromgif($file);
                default:
                    return false;
            }
        };

        // Add photo
        if ($photo = $createImageFromFile($data['photo'])) {
            imagecopyresampled($template, $photo, 90, 200, 0, 0, 240, 240, imagesx($photo), imagesy($photo));
            imagedestroy($photo);
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

        //
        $outputDir = $this->getBatchFolder();

        // final output path
        $output = $outputDir . "osca_id_" . $id_no . ".png";

        // Save the image
        imagepng($template, $output, 9);

        // Free memory
        imagedestroy($template);

        // Download the file
        return true;
    }




    private function getBatchFolder()
    {
        $basePath = WRITEPATH . 'Osca-ID/';
        $maxFiles = 20;

        // Ensure base folder exists
        if (!is_dir($basePath)) {
            mkdir($basePath, 0777, true);
        }

        $batchNumber = 1;

        // Find the highest existing batch folder
        while (is_dir($basePath . 'batch-' . $batchNumber)) {
            $batchNumber++;
        }

        $lastBatch = $batchNumber - 1;
        $lastBatchPath = $basePath . 'batch-' . $lastBatch;

        // If no batch exists yet, create batch-1
        if ($lastBatch == 0) {
            mkdir($basePath . 'batch-1', 0777, true);
            return $basePath . 'batch-1/';
        }

        // Count files inside the last batch folder
        $files = glob($lastBatchPath . '/*');
        $fileCount = $files ? count($files) : 0;

        // If full, create next batch
        if ($fileCount >= $maxFiles) {
            $newBatchPath = $basePath . 'batch-' . $batchNumber;
            mkdir($newBatchPath, 0777, true);
            return $newBatchPath . '/';
        }

        // Otherwise, return the existing not-full batch folder
        return $lastBatchPath . '/';
    }
}