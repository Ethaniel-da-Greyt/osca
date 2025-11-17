<!DOCTYPE html>
<html>

<head>
    <style>
        @page {
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .id-wrapper {
            width: 16cm;
            height: 10cm;
            border: 2px solid #000;
            position: relative;
            box-sizing: border-box;
        }

        /* background gradient */
        .bg-gradient {
            width: 100%;
            height: 100%;
            padding: 20px;
            background: radial-gradient(circle at left, #ffe8df, #d7e5f5, #ffb5b5);
            box-sizing: border-box;
        }

        /* Logos row */
        .logo-row {
            display: flex;
            gap: 12px;
            margin-bottom: 5px;
            align-items: center;
        }

        .logo-row img {
            height: 55px;
        }

        /* Header */
        .header {
            text-align: center;
            font-size: 18px;
            font-weight: 900;
            margin-top: -50px;
        }

        .header-small {
            font-size: 14px;
            font-weight: bold;
        }

        .main-content {
            display: grid;
            grid-template-columns: 170px auto 130px;
            margin-top: 10px;
            gap: 10px;
        }

        /* Photo box */
        .photo-box {
            border: 3px solid #000;
            width: 120px;
            height: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Info text */
        .info {
            font-size: 13px;
            line-height: 1;
        }

        .label {
            font-weight: bold;
            font-size: 10px;
        }

        /* QR */
        .qr-box {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .qr-box img {
            width: 120px;
            height: 120px;
        }

        /* Signature line */
        .signature {
            margin-top: 10px;
            width: 230px;
            border-top: 2px solid #000;
            text-align: center;
            font-size: 11px;
            padding-top: 3px;
        }

        /* Footer text */
        .footer {
            text-align: center;
            font-size: 11px;
            margin-top: 10px;
            font-style: italic;
        }
    </style>
</head>

<body>

    <div class="id-wrapper">
        <div class="bg-gradient">

            <!-- Top Logos -->
            <div class="logo-row">
                <img src="<?= base_url('images/logo1.png') ?>">
                <img src="<?= base_url('images/logo2.png') ?>">
                <img src="<?= base_url('images/logo3.png') ?>">
            </div>

            <!-- Header -->
            <div class="header">
                REPUBLIC OF THE PHILIPPINES<br>
                <span class="header-small">OFFICE OF THE SENIOR CITIZENS AFFAIR (OSCA)</span><br>
                <span class="header-small">DAPITAN CITY</span>
            </div>

            <!-- Main Content Grid -->
            <div class="main-content">

                <!-- Photo -->
                <div class="photo-box">
                    <img src="<?= base_url('images/sample_photo.jpg') ?>">
                </div>

                <!-- Info -->
                <div class="info">
                    <span class="label">NAME</span><br>
                    LORENZO B. RECELLA<br>

                    <span class="label">ADDRESS</span><br>
                    BRGY. DAWO, DAPITAN, ZAMBO. DEL NORTE<br>

                    <span class="label">DATE OF BIRTH</span><br>
                    01/01/1960<br>

                    <span class="label">SEX</span><br>
                    MALE<br>

                    <span class="label">ID NUMBER</span><br>
                    0012345<br>

                    <span class="label">DATE ISSUED</span><br>
                    09/26/2025<br>

                    <div class="signature">SIGNATURE</div>
                </div>

                <!-- QR -->
                <div class="qr-box">
                    <img src="<?= base_url('images/qr.png') ?>">
                </div>

            </div>

            <!-- Footer -->
            <div class="footer">
                This card is non-transferable and valid anywhere in the country.
            </div>

        </div>
    </div>

</body>

</html>