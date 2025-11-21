<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MasterListModel;


class PdfController extends BaseController
{

    public function printID($id)
    {
        $model = new MasterListModel();
        $user = $model->find($id);

        if (!$user) {
            return "User not found.";
        }

        // Call direct-image output generator
        return $this->idGenerator(
            $user['name'],
            $user['address'],
            $user['dob'],
            $user['sex'],
            $user['id_no'],
            $user['profile'],   // path inside WRITEPATH
            $user['qrcode'],    // filename only
            $user['signature']  // signature path
        );
    }

    /**
     * DIRECT OUTPUT GENERATOR
     * NO SAVE ● NO BASE64 ● PRINT READY
     */
    public function idGenerator(
        $name,
        $address,
        $dob,
        $sex,
        $id_no,
        $profile,
        $qrcode,
        $signature = ''
    ) {
        // Gender conversion
        $gender = ($sex === 'M') ? 'MALE' : (($sex === 'F') ? 'FEMALE' : '');

        // Paths
        $data = [
            'name'      => $name,
            'address'   => strtoupper($address),
            'dob'       => $dob,
            'sex'       => $gender,
            'id_number' => $id_no,
            'photo'     => WRITEPATH . $profile,
            'qrcode'    => WRITEPATH . 'uploads/qrcodes/' . $qrcode,
            'signature' => $signature,
        ];

        // Load template (PNG background)
        set_error_handler(function () {}, E_WARNING);
        $imgData = file_get_contents(FCPATH . 'template/osca-adjusted-new.png');
        restore_error_handler();

        $template = imagecreatefromstring($imgData);

        // Text color
        $black = imagecolorallocate($template, 0, 0, 0);

        // Font
        $font = WRITEPATH . "fonts/Montserrat-Bold.ttf";

        // Text placements
        imagettftext($template, 21, 0, 375, 230, $black, $font, $data['name']);
        imagettftext($template, 18, 0, 375, 310, $black, $font, $data['address']);
        imagettftext($template, 18, 0, 375, 333, $black, $font, "DAPITAN CITY, ZAMBOANGA DEL NORTE");
        imagettftext($template, 20, 0, 375, 400, $black, $font, $data['dob']);
        imagettftext($template, 20, 0, 375, 475, $black, $font, $data['sex']);
        imagettftext($template, 20, 0, 375, 545, $black, $font, $data['id_number']);

        // Universal image loader
        $loadImage = function ($file) {
            if (!file_exists($file)) return false;
            $info = getimagesize($file);
            if (!$info) return false;

            return match ($info['mime']) {
                'image/jpeg' => imagecreatefromjpeg($file),
                'image/png'  => imagecreatefrompng($file),
                'image/gif'  => imagecreatefromgif($file),
                default      => false,
            };
        };

        // Profile photo
        if ($photo = $loadImage($data['photo'])) {
            imagecopyresampled($template, $photo, 90, 200, 0, 0, 240, 240, imagesx($photo), imagesy($photo));
            imagedestroy($photo);
        }

        // Signature
        if (!empty($data['signature']) && file_exists($data['signature'])) {
            if ($sig = $loadImage($data['signature'])) {
                imagecopyresampled($template, $sig, 150, 700, 0, 0, 300, 120, imagesx($sig), imagesy($sig));
                imagedestroy($sig);
            }
        }

        // QR Code
        if ($qr = $loadImage($data['qrcode'])) {
            imagecopyresampled($template, $qr, 790, 420, 0, 0, 170, 170, imagesx($qr), imagesy($qr));
            imagedestroy($qr);
        }

        // DIRECT OUTPUT — NO SAVE
        header("Content-Type: image/png");
        header("Content-Disposition: inline; filename=\"osca_id.png\"");

        imagepng($template);  // Stream to browser
        imagedestroy($template);

        exit;
    }

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
                $rec['firstname'] . ' ' . $rec['middle_name'] . ' ' . $rec['lastname'] . '' . ' ' . $rec['suffix'],
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

    public function generateBooklet(
        $name,
        $address,
        $id_no,
        $profile
    ) {
        // SAMPLE DATA — delete these overrides when using real data
        // $name    = 'JOSE MARI CHAN';
        // $address = 'SICAYAB BUCANA';
        // $id_no   = '0012345';
        // $profile = WRITEPATH . 'uploads/photo.jpg';

        // Prepare Data
        $data = [
            'name' => strtoupper($name),
            'address' => 'BRGY. ' . strtoupper($address) . ', DAPITAN CITY, ZAMBOANGA DEL NORTE',
            'id_number' => $id_no,
            'photo' => $profile,
        ];

        // Ignore warnings from imagecreate
        set_error_handler(function () {}, E_WARNING);

        // Load booklet template
        $Imgdata = file_get_contents(WRITEPATH . 'template/booklet-template.png');
        $template = imagecreatefromstring($Imgdata);

        restore_error_handler();

        // Colors
        $black = imagecolorallocate($template, 0, 0, 0);

        // Font
        $font = WRITEPATH . "fonts/Montserrat-Bold.ttf";

        // Write text
        imagettftext($template, 21, 0, 375, 230, $black, $font, $data['name']);
        imagettftext($template, 18, 0, 375, 310, $black, $font, $data['address']);
        imagettftext($template, 20, 0, 375, 545, $black, $font, $data['id_number']);

        // Universal image loader
        $createImageFromFile = function ($file) {
            if (!file_exists($file))
                return false;
            $info = getimagesize($file);
            if (!$info)
                return false;

            return match ($info['mime']) {
                'image/jpeg' => imagecreatefromjpeg($file),
                'image/png' => imagecreatefrompng($file),
                'image/gif' => imagecreatefromgif($file),
                default => false,
            };
        };

        // Add Photo (1x1)
        if ($photo = $createImageFromFile($data['photo'])) {
            imagecopyresampled($template, $photo, 90, 200, 0, 0, 240, 240, imagesx($photo), imagesy($photo));
            imagedestroy($photo);
        }

        // Output directory (creates it if missing)
        $outputDir = WRITEPATH . "booklets/";
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        // Final output filename
        $output = $outputDir . "booklet_" . $id_no . ".png";

        // Save
        imagepng($template, $output, 9);

        // Cleanup
        imagedestroy($template);

        return $output; // return path of generated booklet
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
            'name' => $name, //JOSE MARI CHAN
            'address' => strtoupper($address), // BRGY. DAWO, DAPITAN CITY, ZAMBOANGA DEL NORTE
            'dob' => $dob, //01/01/1960
            'sex' => $gender, //MALE
            'id_number' => $id_no, //0012345
            'photo' => WRITEPATH . $profile, //IMAGE PROFILE PATH
            'qrcode' => WRITEPATH . 'uploads/qrcodes/' . $qrcode, //GENERATED QR-CODE
            'signature' => $signature, //SIGNATURE IMAGE PATH
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
            if (!file_exists($file))
                return false;
            $info = getimagesize($file);
            if (!$info)
                return false;
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
