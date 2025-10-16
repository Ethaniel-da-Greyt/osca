<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Senior Citizen Master List</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10pt;
            margin: 30px;
        }

        h2 {
            text-align: center;
            color: #198754;
            margin-bottom: 10px;
        }

        .barangay-header {
            background-color: #198754;
            color: white;
            font-weight: bold;
            text-align: center;
            padding: 6px;
            margin-top: 20px;
            border-radius: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #198754;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f6f6f6;
        }

        .margin-bottom {
            height: 25px;
        }
    </style>
</head>

<body>
    <h2>Senior Citizen Master List<br>Barangay Unit: <?= strtoupper($unit) ?></h2>

    <?php foreach ($grouped as $barangay => $records): ?>
        <div class="barangay-header">Barangay: <?= strtoupper($barangay) ?></div>

        <table>
            <thead>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Middle Name</th>
                    <th>Extension</th>
                    <th>Sex</th>
                    <th>Barangay</th>
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
                <?php foreach ($records as $n): ?>
                    <tr>
                        <td><?= strtoupper($n['lastname']) ?></td>
                        <td><?= strtoupper($n['firstname']) ?></td>
                        <td><?= strtoupper($n['middle_name']) ?></td>
                        <td><?= strtoupper($n['suffix']) ?></td>
                        <td><?= strtoupper($n['sex']) ?></td>
                        <td><?= strtoupper($n['barangay']) ?></td>
                        <td><?= strtoupper($n['unit']) ?></td>
                        <td><?= !empty($n['birthdate']) ? date('F d, Y', strtotime($n['birthdate'])) : 'N/A' ?></td>
                        <td><?= $n['age'] ?></td>
                        <td><?= strtoupper($n['osca_id']) ?></td>
                        <td><?= strtoupper($n['remarks']) ?></td>
                        <td><?= !empty($n['date_issued']) ? date('F d, Y', strtotime($n['date_issued'])) : 'N/A' ?></td>
                        <td><?= !empty($n['date_applied']) ? date('F d, Y', strtotime($n['date_applied'])) : 'N/A' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="margin-bottom"></div>
    <?php endforeach; ?>
</body>

</html>