<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Print OSCA ID</title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">

    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f0f0f0;
        }

        .id-card {
            width: 85.60mm;
            height: 53.98mm;
            margin: 0;
            padding: 0;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .full-id {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        @media print {
            body {
                background: white;
                margin: 0;
                padding: 0;
            }

            .id-card {
                box-shadow: none;
                margin: 0;
                padding: 0;
            }

            @page {
                size: 88mm 60mm;
                margin: 0;
            }
        }

        .no-print {
            text-align: center;
            margin-bottom: 20px;
        }

        @media screen {
            .no-print {
                display: block;
            }
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center flex-column">
        <?php if (!empty($idCardBase64)): ?>
            <div class="id-card">
                <img src="data:image/png;base64,<?= $idCardBase64 ?>" class="full-id">
            </div>
        <?php else: ?>
            <div style="color: red; text-align: center;">Error: Failed to generate ID card</div>
        <?php endif; ?>

        <div class="no-print mt-5 d-flex justify-content-center align-items-center gap-2">
            <button class="btn btn-primary" onclick="window.print()" style="">
                🖨️ Print ID Card
            </button>

            <button onclick="window.history.back()" class="btn btn-secondary">Cancel</button>
        </div>
        <br>
        <small class="fw-semibold">Preview ID - Click print button when ready</small>
    </div>


    <script>
        // Auto-print when page loads (optional)
        // window.onload = function() {
        //     window.print();
        // }


        // Or after a short delay to ensure image is loaded
        window.addEventListener('load', function () {
            // Optional: auto-print after 1 second
            // setTimeout(() => { window.print(); }, 1000);
        });
    </script>
</body>

</html>