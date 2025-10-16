<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Barangay <?= strtoupper($barangay) ?> - Senior Citizen List</title>
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            /* Slightly smaller for fitting all columns */
            margin: 10px;
        }

        h2 {
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .barangay-title {
            margin-bottom: 10px;
            text-align: center;
            font-weight: bold;
            font-size: 12px;
        }

        /* Responsive Table Container */
        .table-container {
            width: 100%;
            overflow-x: auto;
            /* Allows horizontal scrolling if needed */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Prevents overflow & keeps structure aligned */
            word-wrap: break-word;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
            vertical-align: middle;
            font-size: 9px;
        }

        th {
            background-color: #198754;
            color: white;
            font-size: 9.5px;
        }

        /* Prevent table from breaking in middle of row */
        tr {
            page-break-inside: avoid;
        }

        /* Add page break after large sections if needed */
        .page-break {
            page-break-after: always;
        }

        /* Footer */
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 9px;
        }

        /* Optional scaling for Dompdf if the table is still wide */
        @page {
            margin: 10mm;
            size: A4 landscape;
            /* Landscape fits more columns horizontally */
        }

        /* Dompdf fix for long tables */
        table,
        th,
        td {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }
    </style>
</head>

<body>
    <h2>Senior Citizen Master List</h2>
    <div class="barangay-title">Barangay: <?= strtoupper($barangay) ?></div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Name Ext.</th>
                    <th>Sex</th>
                    <th>Barangay</th>
                    <th>Unit</th>
                    <th>Birthdate</th>
                    <th>Age</th>
                    <th>OSCA ID</th>
                    <th>Remarks</th>
                    <th>Date Issued</th>
                    <th>Date Applied</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($lists)): ?>
                    <?php foreach ($lists as $row): ?>
                        <tr>
                            <td><?= strtoupper($row['lastname']) ?></td>
                            <td><?= strtoupper($row['firstname']) ?></td>
                            <td><?= strtoupper($row['middle_name']) ?></td>
                            <td><?= strtoupper($row['suffix']) ?></td>
                            <td><?= strtoupper($row['sex']) ?></td>
                            <td><?= strtoupper($row['barangay']) ?></td>
                            <td><?= strtoupper($row['unit']) ?></td>
                            <td><?= date('F d, Y', strtotime($row['birthdate'])) ?></td>
                            <td><?= strtoupper($row['age']) ?></td>
                            <td><?= strtoupper($row['osca_id']) ?></td>
                            <td><?= strtoupper($row['remarks']) ?></td>
                            <td><?= !empty($row['date_issued']) ? date('F d, Y', strtotime($row['date_issued'])) : 'N/A' ?></td>
                            <td><?= !empty($row['date_applied']) ? date('F d, Y', strtotime($row['date_applied'])) : 'N/A' ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="13">No records found for this barangay.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <small>Generated on <?= date('F d, Y | h:i A') ?></small>
    </div>
</body>

</html>