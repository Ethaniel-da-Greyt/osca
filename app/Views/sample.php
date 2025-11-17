<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>OSCA Purchase Booklet</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        /* --- GENERAL CARD SIZE --- */
        .id-card {
            width: 10cm;
            height: 12.5cm;
            border-bottom: 2px solid #000;
            border-top: 2px solid #000;
            border-left: 2px solid #000;
            /* black cutting stroke */
            padding: 6px;
            box-sizing: border-box;
            page-break-after: always;
        }

        .id-card-1 {
            width: 10cm;
            height: 12.5cm;
            border-bottom: 2px solid #000;
            border-top: 2px solid #000;
            border-right: 2px solid #000;
            /* black cutting stroke */
            padding: 6px;
            box-sizing: border-box;
            page-break-after: always;
        }

        /* --- RED BORDER --- */
        .red-border {
            border: 4px solid #e00000;
            padding: 15px;
            height: 100%;
            box-sizing: border-box;
            border-radius: 8px;
        }

        .center {
            text-align: center;
            font-size: 12px;
        }

        .purchase-header {
            background: #e00000;
            padding: 5px 0;
            text-align: center;
            color: #fff;
            font-weight: bold;
            margin: 8px 0;
            font-size: 18px;
        }

        /* --- PHOTO BOX (1x1 inch) --- */
        .photo-box {
            width: 96px;
            height: 96px;
            border: 2px dashed #444;
            margin: 0 auto 10px auto;
            background-size: cover;
            background-position: center;
        }

        .label {
            font-size: 10px;
            font-weight: bold;
            margin-top: 3px;
        }

        .input-box {
            width: 100%;
            border: 1px solid #000;
            padding: 4px;
            font-size: 10px;
            margin-bottom: 6px;
        }

        /* --- GRID ALIGNMENT FOR OSCA ID + SIGNATURE --- */
        .two-grid {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .grid-item {
            width: 50%;
        }

        .signature-box {
            width: 100%;
            height: 20px;
            margin-left: 5px;
            border: 1px solid #000;
        }

        /* --- SIGNATURES OF OFFICIALS (MUST BE SAME LEVEL) --- */
        .official-signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .official {
            width: 48%;
            text-align: center;
        }

        .sig-line {
            border-top: 1px solid #000;
            width: 100%;
            margin: 0 auto 3px auto;
        }

        small {
            font-size: 10px;
        }

        /* --- BACK PAGE TEXT --- */
        .justify {
            text-align: justify;
            font-size: 10px;
            line-height: 1.4;
            font-weight: calc();
        }

        .whole {
            display: flex;
            gap: 10px;
        }

        .par {
            font-size: 10px;
            margin-bottom: 15px;
        }

        .logos {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>

<body>

    <!-- ******************************************************* -->
    <!-- ***************     FRONT PAGE     ******************** -->
    <!-- ******************************************************* -->

    <div class="whole">
        <div class="id-card">

            <div class="red-border">

                <div class="logos">
                    <img src="<?= base_url('logo/DTI logo.png') ?>" width="30px" alt="OSCA Logo" class="logo">
                    <img src="<?= base_url('logo/DSWD logo.png') ?>" width="30px" alt="OSCA Logo" class="logo">
                    <img src="<?= base_url('logo/DapitanLogo.png') ?>" width="40px" alt="OSCA Logo" class="logo">
                    <img src="<?= base_url('logo/Bagong_Pilipinas_logo.png') ?>" width="30px" alt="OSCA Logo" class="logo">
                    <img src="<?= base_url('logo/Osca Logo.png') ?>" width="30px" alt="OSCA Logo" class="logo">
                </div>
                <div class="center">
                    Republic of the Philippines<br>
                    <b>City of Dapitan<br>
                        OFFICE OF SENIOR CITIZENS AFFAIRS</b>
                </div>

                <div class="purchase-header">PURCHASE BOOKLET</div>

                <div class="photo-box" style="background-image: url('');"></div>

                <div class="label">NAME:</div>
                <div class="input-box">jose Mari Chan</div>

                <div class="label">ADDRESS:</div>
                <div class="input-box">Dipolog City</div>

                <!-- GRID: OSCA ID + SIGNATURE -->
                <div class="two-grid">
                    <div class="grid-item">
                        <div class="label">OSCA I.D. NO.:</div>
                        <div class="input-box">OSCA-1920</div>
                    </div>

                    <div class="grid-item">
                        <div class="label" style="margin-left: 5px;">SIGNATURE:</div>
                        <div class="signature-box"></div>
                    </div>
                </div>

                <!-- OFFICIAL SIGNATURES SIDE BY SIDE -->
                <div class="official-signatures">
                    <div class="official">
                        <div class="sig-line"></div>
                        <small>DR. ELENA G. HAMOY<br>OSCA Head</small>
                    </div>

                    <div class="official">
                        <div class="sig-line"></div>
                        <small>HON. EVELYN T.<br>City Mayor</small>
                    </div>
                </div>

            </div>
        </div>

        <!-- ******************************************************* -->
        <!-- ***************      BACK PAGE      ******************** -->
        <!-- ******************************************************* -->

        <div class="id-card-1">
            <div class="red-border center">

                <h3>REPUBLIC ACT NO. 9994</h3>
                <small>LIC ACT NO. 9994, ALSO KNOWN AS THE
                    <b>"EXPANDED SENIOR CITEZENS ACT OF 2010"</b>
                    AN ACT GRANTING ADDITIONAL BENEFITS AND PRIVILEGES ACT
                    NO. 7432 OF THE 1992 AS AMENDED BY REPUBLIC ACT
                    NO. 9257 OF 2003</small>
                <br>
                <hr>

                <p class="justify">
                    (1) To the extent possible, the Government may grant
                    special discount in special programs for senior citizens
                    on purchase of basic commodities, subject to the
                    guidelines to be issued for the purpose of the
                    Department of the Trade and Industry (DTI) and the
                    Department of Agriculture (DA).
                </p>
                <hr>
                <br>
                <p class="par">
                    <b>City of Dapitan<br>
                        Office of the Senior Citizens Affairs</b><br>
                    Lawaan, Banonong, Dapitan City
                </p>
                <p class="par">
                    <b>Department of Social Welfare and Development<br>
                        (Regional Office)<br>
                        Office of the Senior Citizens Affairs</b> <br>
                    Zamboanga City
                </p>
                <p class="par">
                    <b>Department of Trade and Industry <br>
                        (Regional Office) </b><br>
                    Zamboanga City
                </p>

            </div>
        </div>
    </div>

</body>

</html>