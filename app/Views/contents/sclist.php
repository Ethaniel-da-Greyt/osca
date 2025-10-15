<?= $this->extend('layout/layout') ?>

<?= $this->section('sclist') ?>active<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex gap-2">
                <form action="" method="get">
                    <input placeholder="Search list" type="text" name="search" id="" class="form-control">
                    <label class="form-label text-muted" style="font-size: 12px;">Search lists here</label>
                </form>

                <form action="" onchange="this.form.submit()" method="get">
                    <select name="filter" id="filter" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Choose Barangay --</option>
                        <?php foreach ($barangay as $b): ?>
                            <option value="<?= esc($b['barangay']) ?>"
                                <?= ($filter === $b['barangay']) ? 'selected' : '' ?>>
                                <?= esc(ucwords($b['barangay'])) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label class="form-label text-muted" style="font-size: 12px;">Select Barangay to filter</label>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4 shadow-sm border-0 mb-5">
    <div class="card-header bg-white fw-bold">Senior Citizen Lists</div>
    <div class="card-body">
        <?php if (!empty($lists)) : ?>
            <table class="table table-responsive">
                <thead class=" table-dark">
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
                    <?php foreach ($lists as $n): ?>
                        <tr>
                            <td><?= esc($n['lastname']) ?></td>
                            <td><?= esc($n['firstname']) ?></td>
                            <td><?= esc($n['middle_name']) ?></td>
                            <td><?= esc($n['suffix']) ?></td>
                            <td><?= esc($n['sex']) ?></td>
                            <td><?= esc($n['barangay']) ?></td>
                            <td><?= esc($n['unit']) ?></td>
                            <td><?= esc(date('F d, Y', strtotime($n['birthdate']))) ?></td>
                            <td><?= esc($n['age']) ?></td>
                            <td><?= esc($n['osca_id']) ?></td>
                            <td><?= esc($n['remarks']) ?></td>
                            <td><?= esc(!empty($n['date_issued'])
                                    ? date('F d, Y', strtotime($n['date_issued']))
                                    : 'N/A') ?></td>
                            <td><?= esc(!empty($n['date_applied'])
                                    ? date('F d, Y', strtotime($n['date_issued']))
                                    : 'N/A') ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php else: ?>
            <h6 class="card-title text-muted text-center">No record found.</h6>
        <?php endif ?>
    </div>
</div>
<?= $this->endSection() ?>