<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .id-card {
            width: 85.60mm;
            height: 53.98mm;
            margin: 0;
            overflow: hidden;
            page-break-after: always;
            margin-bottom: 10px;
        }

        .full-id {
            width: 85.60mm;
            height: 53.98mm;
            object-fit: cover;
            display: block;
        }

        @page {
            size: 88mm 60mm;
            margin: 0;
        }
    </style>
</head>

<body onload="window.print()">

    <?php
    // Folder path for selected batch
    $batchPath = WRITEPATH . 'Osca-ID/' . $batch . '/';

    // All PNG files inside that batch
    $idFiles = glob($batchPath . '*.png');

    foreach ($idFiles as $file) {

        // Convert to base64 for inline display
        $imgBase64 = base64_encode(file_get_contents($file));
        $imgSrc = 'data:image/png;base64,' . $imgBase64;
    ?>
        <div class="id-card">
            <img src="<?= $imgSrc ?>" class="full-id">
        </div>
    <?php } ?>

</body>

</html>