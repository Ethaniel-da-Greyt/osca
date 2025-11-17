<!DOCTYPE html>
<html>

<head>
    <title>Senior Citizen ID Preview</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
            font-family: "Arial", sans-serif;
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .preview-container {
            width: 8.5in;
            height: 5.5in;
            background: white;
            border: 1px solid #ccc;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .id-card {
            width: 100%;
            height: 100%;
            padding: 20px;
            box-sizing: border-box;
            border: 2px solid #000;
            position: relative;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .republic {
            font-size: 22px;
            font-weight: bold;
            margin: 0;
            line-height: 1.2;
            text-transform: uppercase;
        }

        .osca {
            font-size: 18px;
            font-weight: bold;
            margin: 5px 0;
            line-height: 1.2;
            text-transform: uppercase;
        }

        .city {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
            line-height: 1.2;
            text-transform: uppercase;
        }

        .field-container {
            margin-bottom: 15px;
        }

        .field-label {
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 3px;
            text-transform: uppercase;
        }

        .field-value {
            font-size: 14px;
            border-bottom: 1px solid #000;
            padding: 4px 8px;
            min-height: 20px;
            text-transform: uppercase;
            font-weight: bold;
        }

        .disclaimer {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 11px;
            font-style: italic;
            padding: 0 20px;
        }

        .id-number-container {
            position: absolute;
            top: 20px;
            right: 20px;
            text-align: right;
        }

        .id-number-label {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .id-number-value {
            font-size: 14px;
            font-weight: bold;
            border: 1px solid #000;
            padding: 4px 8px;
            background: #f0f0f0;
        }

        .actions {
            text-align: center;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 10px;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <div>
        <div class="preview-container">
            <div class="id-card">
                <div class="id-number-container">
                    <div class="id-number-label">ID NUMBER</div>
                    <div class="id-number-value"><?= $id_number ?></div>
                </div>

                <div class="header">
                    <h1 class="republic">REPUBLIC OF THE PHILIPPINES</h1>
                    <h2 class="osca">OFFICE OF THE SENIOR CITIZENS AFFAIR (OSCA)</h2>
                    <h3 class="city">DAPITAN CITY</h3>
                </div>

                <div class="field-container">
                    <div class="field-label">NAME</div>
                    <div class="field-value"><?= $name ?></div>
                </div>

                <div class="field-container">
                    <div class="field-label">ADDRESS</div>
                    <div class="field-value"><?= $address ?></div>
                </div>

                <div class="field-container">
                    <div class="field-label">DATE OF BIRTH</div>
                    <div class="field-value"><?= $date_of_birth ?></div>
                </div>

                <div class="field-container">
                    <div class="field-label">SEX</div>
                    <div class="field-value"><?= $sex ?></div>
                </div>

                <div class="field-container">
                    <div class="field-label">DATE ISSUED</div>
                    <div class="field-value"><?= $date_issued ?></div>
                </div>

                <div class="disclaimer">
                    *This card is non-transferable and valid anywhere in the country.
                </div>
            </div>
        </div>

        <div class="actions">
            <a href="/id-card/generate" class="btn">Generate PDF</a>
            <a href="/id-card/preview" class="btn">Refresh Preview</a>
        </div>
    </div>
</body>

</html>