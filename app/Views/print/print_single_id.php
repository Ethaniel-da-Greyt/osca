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
        padding: 0;
        overflow: hidden;
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

    <div class="id-card">
        <img src="data:image/png;base64,<?= base64_encode(file_get_contents($imgFile)) ?>" class="full-id">
    </div>

</body>

</html>