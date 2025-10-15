<?= $this->extend('layout/layout') ?>
<?= $this->section('dashboard') ?>active<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row g-4">
        <?php foreach ($units as $unit => $count): ?>
            <div class="col-md-2">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="card-title text-muted"><?= esc(ucwords($unit)) ?></h6>
                        <h2 class="fw-bold"><?= esc($count) ?></h2>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <div class="card mt-4 shadow-sm border-0">
        <div class="card-header bg-white fw-bold">Recently Added</div>
        <div class="card-body">
            <?php if (empty($new_add)): ?>
                <h6 class="card-title text-muted text-center">No records found.</h6>
            <?php else: ?>

                <table class="table table-responsive table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Name Extension</th>
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
                        <?php foreach ($new_add as $n): ?>
                            <tr>
                                <td><?= esc($n['lastname']) ?></td>
                                <td><?= esc($n['firstname']) ?></td>
                                <td><?= esc($n['middle_name']) ?></td>
                                <td><?= esc($n['suffix']) ?></td>
                                <td><?= esc($n['sex']) ?></td>
                                <td><?= esc($n['barangay']) ?></td>
                                <td><?= esc($n['unit']) ?></td>
                                <td><?= esc($n['birthdate']) ?></td>
                                <td><?= esc($n['age']) ?></td>
                                <td><?= esc($n['osca_id']) ?></td>
                                <td><?= esc($n['remarks']) ?></td>
                                <td><?= esc($n['date_issued']) ?></td>
                                <td><?= esc($n['date_applied']) ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            <?php endif ?>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <?= $pager->links('default', 'bootstrap_full') ?>
    </div>
</div>

<?= $this->endSection() ?>