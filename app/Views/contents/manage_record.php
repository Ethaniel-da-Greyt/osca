<?= $this->extend('layout/layout') ?>

<?= $this->section('sclist') ?>active<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="card mt-4 shadow-sm border-0 mb-5">
        <div class="card-header bg-dark text-white fw-bold fs-5"><?= esc($n['firstname'] . " " . $n['lastname']) ?>'s Profile</div>
        <div class="card-body">
            <form action="/osca/manage-record" method="POST">
                <input type="hidden" name="id" value="<?= esc($n['id']) ?>">
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="" class="form-label fw-semibold">Last Name</label>
                        <input type="text" name="lastname" value="<?= esc($n['lastname']) ?>" class="form-control" placeholder="Last Name*" required>
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label fw-semibold">First Name</label>
                        <input type="text" name="firstname" value="<?= esc($n['firstname']) ?>" class="form-control" placeholder="First Name*" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <label for="" class="form-label fw-semibold">Middle Name</label>
                        <input type="text" name="middle_name" class="form-control" value="<?= esc($n['middle_name']) ?>" placeholder="Middle Name">
                    </div>
                    <div class="col-4">
                        <label for="" class="form-label fw-semibold">Name Extension</label>
                        <input type="text" name="suffix" class="form-control" value="<?= esc($n['suffix']) ?>" placeholder="ex. Jr. Sr. III">
                    </div>
                    <div class="col-4">
                        <label for="" class="form-label fw-semibold">Sex</label>
                        <select name="sex" id="" class="form-select" required>
                            <option <?= $n['sex'] == 'M' ? 'selected' : '' ?> value="M">Male</option>
                            <option value="F" <?= $n['sex'] == 'F' ? 'selected' : '' ?>>Female</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label for="barangay<?= esc($n['id']) ?>" class="form-label fw-semibold">Barangay</label>
                        <select name="barangay" id="barangay<?= esc($n['id']) ?>" class="form-select barangay-select text-center" required>
                            <option value="">-- Choose Barangay --</option>
                            <?php foreach ($barangay as $b) : ?>
                                <option value="<?= esc($b['barangay']) ?>"
                                    data-unit="<?= esc($b['unit']) ?>"
                                    <?= ($b['barangay'] == $n['barangay']) ? 'selected' : '' ?>>
                                    <?= esc($b['barangay']) ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="col-6">
                        <label for="barangay_unit<?= esc($n['id']) ?>" class="form-label fw-semibold">Barangay Unit</label>
                        <input type="text" name="unit" id="barangay_unit<?= esc($n['id']) ?>"
                            class="form-control barangay-unit text-muted"
                            placeholder="Auto-filled Barangay Unit"
                            value="<?= esc($n['unit']) ?>" readonly>
                    </div>
                </div>

                <script>
                    $(function() {
                        // Initialize all Select2 dropdowns
                        $('.barangay-select').each(function() {
                            $(this).select2({
                                placeholder: '-- Choose Barangay --',
                                allowClear: true,
                                width: '100%',
                                dropdownParent: $(this).closest('.modal').length ? $(this).closest('.modal') : $(document.body)
                            });
                        });

                        // Auto-fill Barangay Unit when selected
                        $('.barangay-select').on('change', function() {
                            let unit = $(this).find(':selected').data('unit') || '';
                            let id = $(this).attr('id').replace('barangay', '');
                            $('#barangay_unit' + id).val(unit);
                        });
                    });
                </script>



                <div class="row mb-3">
                    <div class="col-4">
                        <label for="" class="form-label fw-semibold">Birthdate</label>
                        <input type="date"
                            name="birthdate"
                            class="form-control"
                            value="<?= !empty($n['birthdate']) ? esc(date('Y-m-d', strtotime($n['birthdate']))) : '' ?>"
                            required>
                    </div>
                    <div class="col-4">
                        <label for="" class="form-label fw-semibold">Age</label>
                        <input type="text" name="age" class="form-control" placeholder="<?= esc($n['age']) ?>" readonly>
                        <label for="" class="text-muted" style="font-size:smaller;">Auto-calculated based on birthdate</label>
                    </div>
                    <div class="col-4">
                        <label for="" class="form-label fw-semibold">OSCA ID No.</label>
                        <input type="text" name="osca_id" value="<?= $n['osca_id'] ?>" class="form-control" placeholder="OSCA ID*" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label for="" class="form-label fw-semibold">Date Applied</label>
                        <input type="date" value="<?= esc(!empty($n['date_applied']) ? date('Y-m-d', strtotime($n['date_applied'])) : '') ?>" name="date_applied" class="form-control">
                    </div>
                    <div class="col-6">
                        <label for="" class="form-label fw-semibold">Date Issued</label>
                        <input type="date" name="date_issued" class="form-control" value="<?= esc(!empty($n['date_issued']) ? date('Y-m-d', strtotime($n['date_issued'])) : '') ?>">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label fw-semibold">Remarks</label>
                    <textarea name="remarks" value="<?= esc($n['remarks']) ?>" class="form-control" placeholder="Remarks here*"><?= esc($n['remarks']) ?></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button class="btn btn-primary" type="submit">Update Record</button>
                    <a href="<?= base_url('osca/sc-list') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>

        </div>
    </div>

</div>
<?= $this->endSection() ?>