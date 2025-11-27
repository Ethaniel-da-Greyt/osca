<?= $this->extend('layout/layout') ?>
<?= $this->section('sclist') ?>active<?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php
// Prepare Photo
$imgPath = WRITEPATH . $n['photo'];
$photoImg = (!empty($n['photo']) && file_exists($imgPath))
    ? 'data:image/png;base64,' . base64_encode(file_get_contents($imgPath))
    : '';

// Prepare QR Code
$qrPath = WRITEPATH . 'uploads/qrcodes/' . $n['qrcode'] . '.png';
$qrImg = (file_exists($qrPath))
    ? 'data:image/png;base64,' . base64_encode(file_get_contents($qrPath))
    : '';
?>

<div class="container-fluid py-3">

    <!-- FIXED PHOTO and QR SECTION -->
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">

            <div class="bg-dark rounded d-flex align-items-center p-3 mb-4">
                <!-- Back Button -->
                <button class="btn btn-light btn-sm text-dark me-3" onclick="window.history.back()">
                    <i class="fa-solid fa-arrow-left me-1"></i>
                </button>

                <!-- Title -->
                <div class="flex-grow-1">
                    <h3 class="fw-bold text-white mb-0">
                        <?= esc(strtoupper($n['firstname'] . ' ' . $n['lastname'])) ?>
                    </h3>
                </div>
            </div>

            <div class="row">

                <!-- PHOTO -->
                <div class="d-flex justify-content-center flex-column align-items-center col-4 text-center">
                    <img src="<?= $photoImg ?>" class="img-fluid rounded shadow mb-2" style="max-width:260px;"
                        alt="Photo">
                    <!-- QRCODE image -->
                    <div class="d-flex text-center align-items-center">
                        <img src="<?= $qrImg ?>" class="img-fluid" style="max-width:200px;" alt="QR Code">
                    </div>

                    <div class="d-flex allign-items-center position-relative mx-auto">
                        <button class="btn btn-primary btn-full" data-bs-toggle="modal" data-bs-target="#updateModal"><i
                                class="fa fa-pencil me-2"></i> Update</button>
                    </div>

                    <div class="mt-4">
                        <h4>Mark as Deceased</h4>
                        <form id="deceasedForm" action="<?= base_url('/osca/isDeceased/' . $n['osca_id']) ?>"
                            method="POST">
                            <?= csrf_field() ?>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="is_deceased" id="is_deceased"
                                    value="1" <?= $n['isDeceased'] ? 'checked' : '' ?> onchange="this.form.submit()">
                                <label class="form-check-label" for="is_deceased">
                                    Is Deceased?
                                </label>
                            </div>
                        </form>
                    </div>

                </div>


                <div class="col-8 card shadow-sm border-0">
                    <div class="card-body">

                        <!-- TABS -->
                        <ul class="nav nav-tabs" id="profileTabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tabProfile">Profile Info</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabPrint">Print ID</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#tabLogs">Activity Logs</a>
                            </li>
                        </ul>

                        <!-- TAB CONTENT -->
                        <div class="tab-content mt-4">

                            <!-- PROFILE INFO -->
                            <div class="tab-pane fade show active" id="tabProfile">

                                <h5 class="fw-bold mb-4">Profile Information</h5>

                                <div class="p-3 rounded border bg-light">

                                    <div class="row py-2 border-bottom">
                                        <div class="col-4 fw-bold text-muted">Full Name</div>
                                        <div class="col-8"><?= esc($n['firstname'] . ' ' . $n['lastname']) ?></div>
                                    </div>

                                    <div class="row py-2 border-bottom">
                                        <div class="col-4 fw-bold text-muted">Osca Id</div>
                                        <div class="col-8"><?= esc($n['osca_id']) ?></div>
                                    </div>

                                    <div class="row py-2 border-bottom">
                                        <div class="col-4 fw-bold text-muted">Birthdate</div>
                                        <div class="col-8"><?= esc(date('m/d/Y', strtotime($n['birthdate']))) ?></div>
                                    </div>

                                    <div class="row py-2 border-bottom">
                                        <div class="col-4 fw-bold text-muted">Age</div>
                                        <div class="col-8"><?= esc($n['age']) ?></div>
                                    </div>

                                    <div class="row py-2 border-bottom">
                                        <div class="col-4 fw-bold text-muted">Sex</div>
                                        <div class="col-8"><?= $n['sex'] === 'M' ? 'Male' : 'Female' ?></div>
                                    </div>

                                    <div class="row py-2 border-bottom">
                                        <div class="col-4 fw-bold text-muted">Address</div>
                                        <div class="col-8">
                                            <?= esc($n['barangay']) ?>, Dapitan City, Zamboanga Del Norte
                                        </div>
                                    </div>

                                    <div class="row py-2 border-bottom">
                                        <div class="col-4 fw-bold text-muted">Unit</div>
                                        <div class="col-8"><?= esc($n['unit']) ?></div>
                                    </div>

                                    <div class="row py-2 border-bottom">
                                        <div class="col-4 fw-bold text-muted">Date Applied</div>
                                        <div class="col-8"><?= esc($n['date_applied'] ?: 'N/A') ?></div>
                                    </div>

                                    <div class="row py-2 border-bottom">
                                        <div class="col-4 fw-bold text-muted">Date Issued</div>
                                        <div class="col-8"><?= esc($n['date_issued'] ?: 'N/A') ?></div>
                                    </div>

                                    <div class="row py-2">
                                        <div class="col-4 fw-bold text-muted">Remarks</div>
                                        <div class="col-8"><?= esc($n['remarks'] ?: 'N/A') ?></div>
                                    </div>
                                </div>

                            </div>



                            <!-- PRINT ID -->

                            <div class="tab-pane fade" id="tabPrint">
                                <h5 class="fw-bold mb-3">Print Senior Citizen ID</h5>

                                <a href="print/<?= $n['id'] ?>" class="btn btn-success">
                                    <i class="fa-regular fa-id-badge"></i> Print ID
                                </a>
                            </div>

                            <!-- ACTIVITY LOGS -->
                            <div class="tab-pane fade" id="tabLogs">
                                <h5 class="fw-bold mb-3">Activity Logs</h5>

                                <p class="text-muted">
                                    No activity logs available.
                                </p>


                            </div>

                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>



</div>


<div class="modal fade" id="updateModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h4 class="modal-title text-white">Update Information</h4>
                <span class="btn btn-close" data-bs-dismiss="modal"></span>
            </div>

            <form action="/osca/manage-record" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= esc($n['id']) ?>">

                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="" class="form-label fw-semibold">Last Name</label>
                            <input type="text" name="lastname" class="form-control" value="<?= esc($n['lastname']) ?>"
                                placeholder="Last Name*" required>
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label fw-semibold">First Name</label>
                            <input type="text" name="firstname" class="form-control" value="<?= esc($n['firstname']) ?>"
                                placeholder="First Name*" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="form-label fw-semibold">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control"
                                value="<?= esc($n['middle_name']) ?>" placeholder="Middle Name">
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label fw-semibold">Name Extension</label>
                            <input type="text" name="suffix" class="form-control" value="<?= esc($n['suffix']) ?>"
                                placeholder="ex. Jr. Sr. III">
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label fw-semibold">Sex</label>
                            <select name="sex" id="" class="form-select" required>
                                <option value="M" <?= $n['sex'] == 'M' ? 'selected' : '' ?>>Male</option>
                                <option value="F" <?= $n['sex'] == 'F' ? 'selected' : '' ?>>Female</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="barangay" class="form-label fw-semibold">Barangay</label>
                            <select name="barangay" id="barangay" class="form-select text-center" required>
                                <option value="">-- Choose Barangay --</option>
                                <?php foreach ($barangay as $b): ?>
                                    <!-- Store barangay unit as a data attribute -->
                                    <option <?= $n['barangay'] == $b['barangay'] ? 'selected' : '' ?>
                                        value="<?= esc($b['barangay']) ?>" data-unit="<?= esc($b['unit']) ?>">
                                        <?= esc($b['barangay']) ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="barangay_unit" class="form-label fw-semibold">Barangay Unit</label>
                            <input type="text" name="unit" id="barangay_unit" class="form-control"
                                value="<?= esc($n['unit']) ?>" placeholder="Auto-filled based on selected barangay"
                                readonly>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function () {
                            // Activate Select2 on the barangay dropdown
                            $('#barangay').select2({
                                placeholder: '-- Choose Barangay --',
                                allowClear: true,
                                width: '100%'
                            });

                            // Auto-fill Barangay Unit when Barangay is selected
                            $('#barangay').on('change', function () {
                                var unit = $(this).find(':selected').data(
                                    'unit'); // get data-unit attribute
                                $('#barangay_unit').val(unit || ''); // set input value
                            });
                        });
                    </script>

                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="form-label fw-semibold">Birthdate</label>
                            <input type="date" name="birthdate" class="form-control" value="<?= esc($n['birthdate']) ?>"
                                required>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label fw-semibold">Age</label>
                            <input type="text" name="" class="form-control" value="<?= esc($n['age']) ?>"
                                placeholder="Auto-calculated by based on birthdate" readonly>
                        </div>
                        <div class="col-4">
                            <label for="" class="form-label fw-semibold">OSCA ID No.</label>
                            <input type="text" name="osca_id" class="form-control" value="<?= esc($n['osca_id']) ?>"
                                placeholder="OSCA ID*" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="" class="form-label fw-semibold">Date Applied</label>
                            <input type="date" name="date_applied" class="form-control"
                                value="<?= esc($n['date_applied']) ?>">
                        </div>
                        <div class="col-6">
                            <label for="" class="form-label fw-semibold">Date Issued</label>
                            <input type="date" name="date_issued" class="form-control"
                                value="<?= esc($n['date_issued']) ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload Photo</label>
                        <input type="file" name="photo" class="form-control" value="<?= esc($n['photo']) ?>" id="photo">
                        <small class="text-muted">Don't upload a new photo if you don't want to change the current
                            one.</small>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label fw-semibold">Remarks</label>
                        <textarea name="remarks" id="" class="form-control"
                            placeholder="Remarks here*"><?= esc($n['remarks']) ?></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Submit</button>
                    <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                </div>
            </form>
        </div>
    </div>
    <?= $this->endSection() ?>