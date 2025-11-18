<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;

class QrCodeGenerator extends BaseController
{
    public function generateQr($data)
    {
        $writer = new PngWriter();

        $builder = new Builder(
            writer: $writer,
            writerOptions: [],
            validateResult: false,
            data: $data,
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::Low,  // use this
            size: 200,
            margin: 10,
            roundBlockSizeMode: RoundBlockSizeMode::Margin
        );

        $result = $builder->build();

        // Save image etc.
        $path = WRITEPATH . 'uploads/qrcodes/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $filename = uniqid() . '.png';
        $result->saveToFile($path . $filename);

        return $filename;
    }
}
