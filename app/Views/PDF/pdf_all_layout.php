<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= esc($title) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 20px;
        }

        h2,
        h3 {
            text-align: center;
            margin: 0;
        }

        .barangay {
            margin-top: 20px;
            font-weight: bold;
            font-size: 14px;
            color: #198754;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 4px;
            text-align: center;
        }

        th {
            background-color: #198754;
            color: #fff;
        }

        .footer {
            text-align: right;
            font-size: 10px;
            margin-top: 20px;
            color: #555;
        }
    </style>
</head>

<body>
    <h2><?= esc($title) ?></h2>
    <h3>As of <?= esc($dateGenerated) ?></h3>

    <?php foreach ($grouped as $barangay => $members): ?>
        <div class="barangay">Barangay: <?= strtoupper(esc($barangay)) ?></div>
        <table>
            <thead>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Name Extension</th>
                    <th>Sex</th>
                    <th>Unit</th>
                    <th>Birthdate</th>
                    <th>Age</th>
                    <th>OSCA ID No.</th>
                    <th>Remarks</th>
                    <th>Date Issued</th>
                    <th>Date Applied</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $n): ?>
                    <tr>
                        <td><?= strtoupper(esc($n['lastname'])) ?></td>
                        <td><?= strtoupper(esc($n['firstname'])) ?></td>
                        <td><?= strtoupper(esc($n['middle_name'])) ?></td>
                        <td><?= strtoupper(esc($n['suffix'])) ?></td>
                        <td><?= strtoupper(esc($n['sex'])) ?></td>
                        <td><?= strtoupper(esc($n['unit'])) ?></td>
                        <td><?= date('F d, Y', strtotime($n['birthdate'])) ?></td>
                        <td><?= esc($n['age']) ?></td>
                        <td><?= strtoupper(esc($n['osca_id'])) ?></td>
                        <td><?= strtoupper(esc($n['remarks'])) ?></td>
                        <td><?= !empty($n['date_issued']) ? date('F d, Y', strtotime($n['date_issued'])) : 'N/A' ?></td>
                        <td><?= !empty($n['date_applied']) ? date('F d, Y', strtotime($n['date_applied'])) : 'N/A' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div style="margin-bottom: 30px;"></div> <!-- ✅ adds bottom margin between barangays -->
    <?php endforeach; ?>

    <div class="footer">
        Generated on <?= esc($dateGenerated) ?> by OSCA Management System
    </div>
</body>

</html>