<?= $this->extend('layout/layout') ?>

<?= $this->section('manage') ?>active<?= $this->endSection() ?>


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
            <table class="table table-responsive table-bordered">
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
                        <th>Action</th>
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
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#update_<?= esc($n['id']) ?>"><i class="fa fa-pen fa-sm"></i> Update</button>
                            </td>
                        </tr>

                        <div class="modal fade" id="update_<?= esc($n['id']) ?>">
                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h4 class="text-white"><?= esc($n['lastname'] . ", " . $n['firstname']) ?></h4>
                                        <span class="btn btn-close" data-bs-dismiss="modal"></span>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST">
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <label for="" class="form-label fw-semibold">Last Name</label>
                                                    <input type="text" name="lastname" class="form-control" placeholder="Last Name*" required>
                                                </div>
                                                <div class="col-6">
                                                    <label for="" class="form-label fw-semibold">First Name</label>
                                                    <input type="text" name="firstname" class="form-control" placeholder="First Name*" required>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-4">
                                                    <label for="" class="form-label fw-semibold">Middle Name</label>
                                                    <input type="text" name="middle_name" class="form-control" placeholder="Middle Name">
                                                </div>
                                                <div class="col-4">
                                                    <label for="" class="form-label fw-semibold">Name Extension</label>
                                                    <input type="text" name="" class="form-control" placeholder="ex. Jr. Sr. III">
                                                </div>
                                                <div class="col-4">
                                                    <label for="" class="form-label fw-semibold">Sex</label>
                                                    <select name="sex" id="" class="form-select" required>
                                                        <option value="M">Male</option>
                                                        <option value="F">Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <label for="barangay" class="form-label fw-semibold">Barangay</label>
                                                    <select name="barangay" id="barangay<?= esc($n['id']) ?>" class="form-select text-center" required>
                                                        <option value="">-- Choose Barangay --</option>
                                                        <?php foreach ($barangay as $b) : ?>
                                                            <!-- Store barangay unit as a data attribute -->
                                                            <option value="<?= esc($b['barangay']) ?>" data-unit="<?= esc($b['unit']) ?>">
                                                                <?= esc($b['barangay']) ?>
                                                            </option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </div>
                                                <div class="col-6">
                                                    <label for="barangay_unit<?= esc($n['id']) ?>" class="form-label fw-semibold">Barangay Unit</label>
                                                    <input type="text" name="unit" id="barangay_unit<?= esc($n['id']) ?>" class="form-control" placeholder="Auto-filled Barangay Unit" readonly>
                                                </div>
                                            </div>

                                            <script>
                                                $(document).ready(function() {
                                                    // Activate Select2 on the barangay dropdown
                                                    $('#barangay<?= esc($n['id']) ?>').select2({
                                                        placeholder: '-- Choose Barangay --',
                                                        allowClear: true,
                                                        width: '100%'
                                                    });

                                                    // Auto-fill Barangay Unit when Barangay is selected
                                                    $('#barangay<?= esc($n['id']) ?>').on('change', function() {
                                                        var unit = $(this).find(':selected').data('unit'); // get data-unit attribute
                                                        $('#barangay_unit<?= esc($n['id']) ?>').val(unit || ''); // set input value
                                                    });
                                                });
                                            </script>

                                            <div class="row mb-3">
                                                <div class="col-4">
                                                    <label for="" class="form-label fw-semibold">Birthdate</label>
                                                    <input type="date" name="birthdate" class="form-control" required>
                                                </div>
                                                <div class="col-4">
                                                    <label for="" class="form-label fw-semibold">Age</label>
                                                    <input type="text" name="" class="form-control" placeholder="Auto-calculated by based on birthdate" readonly>
                                                </div>
                                                <div class="col-4">
                                                    <label for="" class="form-label fw-semibold">OSCA ID No.</label>
                                                    <input type="text" name="osca_id" class="form-control" placeholder="OSCA ID*" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <label for="" class="form-label fw-semibold">Date Applied</label>
                                                    <input type="date" name="date_applied" class="form-control">
                                                </div>
                                                <div class="col-6">
                                                    <label for="" class="form-label fw-semibold">Date Issued</label>
                                                    <input type="date" name="date_issued" class="form-control">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label fw-semibold">Remarks</label>
                                                <textarea name="remarks" id="" class="form-control" placeholder="Remarks here*"></textarea>
                                            </div>

                                            <div class="d-flex justify-content-end gap-2">
                                                <button class="btn btn-success">Submit Record</button>
                                                <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php else: ?>
            <h6 class="card-title text-muted text-center">No record found.</h6>
        <?php endif ?>
    </div>
    <div class="d-flex justify-content-center">
        <?= $pager->links('default', 'bootstrap_full') ?>
    </div>
</div>
<?= $this->endSection() ?>