<?= $this->extend('layout/layout') ?>

<?= $this->section('addrecord') ?>active<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="card border-0 shadow-sm p-4">
    <div class="">
        <h4>Add SC Record</h4>
    </div>

    <hr>

    <div class="">
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
                    <input type="text" name="suffix" class="form-control" placeholder="ex. Jr. Sr. III">
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
                    <select name="barangay" id="barangay" class="form-select text-center" required>
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
                    <label for="barangay_unit" class="form-label fw-semibold">Barangay Unit</label>
                    <input type="text" name="unit" id="barangay_unit" class="form-control" placeholder="Auto-filled based on selected barangay" readonly>
                </div>
            </div>

            <script>
                $(document).ready(function() {
                    // Activate Select2 on the barangay dropdown
                    $('#barangay').select2({
                        placeholder: '-- Choose Barangay --',
                        allowClear: true,
                        width: '100%'
                    });

                    // Auto-fill Barangay Unit when Barangay is selected
                    $('#barangay').on('change', function() {
                        var unit = $(this).find(':selected').data('unit'); // get data-unit attribute
                        $('#barangay_unit').val(unit || ''); // set input value
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

            <div class="d-flex justify-content-end">
                <button class="btn btn-success">Submit Record</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>