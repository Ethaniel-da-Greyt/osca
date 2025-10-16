<?= $this->extend('layout/layout') ?>

<?= $this->section('print') ?>active<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="card border-0 shadow-sm p-4">
        <div class="text-center text-primary mb-4">
            <h3 class="fw-bold">Select Format</h3>
            <p class="text-muted mb-0">Choose an option below to export or print your records</p>
        </div>

        <div class="container">
            <div class="row g-3 justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <a href="/osca/export-record/all" class="btn btn-success w-100 py-4 shadow-sm fw-semibold">
                        <i class="fas fa-file-excel me-2"></i> Export All in Excel
                    </a>
                </div>
                <div class="col-md-6 col-lg-5">
                    <a href="/osca/export-record/pdf/all" class="btn btn-primary w-100 py-4 shadow-sm fw-semibold">
                        <i class="fas fa-file-pdf me-2"></i> Export All in PDF
                    </a>
                </div>

                <div class="col-md-6 col-lg-5">
                    <button class="btn btn-success w-100 py-4 shadow-sm fw-semibold text-white" data-bs-target="#barangay" data-bs-toggle="modal">
                        <i class="fas fa-check-square me-2"></i> Export by Barangay in Excel
                    </button>
                </div>
                <div class="col-md-6 col-lg-5">
                    <button class="btn btn-primary w-100 py-4 shadow-sm fw-semibold" data-bs-target="#pdf_barangay" data-bs-toggle="modal">
                        <i class="fas fa-file-export me-2"></i> Export by Barangay in PDF
                    </button>
                </div>

                <div class="col-md-6 col-lg-5">
                    <button class="btn btn-success w-100 py-4 shadow-sm fw-semibold text-white" data-bs-target="#unit" data-bs-toggle="modal">
                        <i class="fas fa-print me-2"></i> Export by Unit in Excel
                    </button>
                </div>
                <div class="col-md-6 col-lg-5">
                    <button data-bs-toggle="modal" data-bs-target="#pdf_unit" class="btn btn-primary w-100 py-4 shadow-sm fw-semibold">
                        <i class="fas fa-download me-2"></i> Export by Unit in PDF
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="barangay">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h6 class="modal-title text-white">Select Barangay to Export</h6>
                    <span class="btn btn-close" data-bs-dismiss="modal"></span>
                </div>
                <form action="/osca/export-record/barangay" method="post">
                    <div class="modal-body">
                        <select name="barangay" id="" class="form-select">
                            <option class="text-center">-- Choose Barangay --</option>
                            <?php foreach ($barangay as $b) : ?>
                                <option value="<?= esc($b['barangay']) ?>"><?= esc($b['barangay']) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success">Export</button>
                        <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="unit">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h6 class="modal-title text-white">Select Barangay to Export</h6>
                    <span class="btn btn-close" data-bs-dismiss="modal"></span>
                </div>
                <form action="/osca/export-record/unit" method="post">
                    <div class="modal-body">
                        <select name="unit" id="" class="form-select">
                            <option class="text-center">-- Choose Barangay Unit --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success">Export</button>
                        <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- PDF PRINT/DOWNLOAD BY UNIT -->
    <div class="modal fade" id="pdf_unit">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title text-white">Select Barangay to Export</h6>
                    <span class="btn btn-close" data-bs-dismiss="modal"></span>
                </div>
                <form action="/osca/export-record/pdf/unit" method="post">
                    <div class="modal-body">
                        <select name="unit" id="" class="form-select">
                            <option class="text-center">-- Choose Barangay Unit --</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Export PDF</button>
                        <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- PDF PRINT/DOWNLOAD BY BARANGAY -->
    <div class="modal fade" id="pdf_barangay">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title text-white">Select Barangay to Export</h6>
                    <span class="btn btn-close" data-bs-dismiss="modal"></span>
                </div>
                <form action="/osca/export-record/pdf/barangay" method="post">
                    <div class="modal-body">
                        <select name="barangay" id="" class="form-select">
                            <option class="text-center">-- Choose Barangay --</option>
                            <?php foreach ($barangay as $b) : ?>
                                <option value="<?= esc($b['barangay']) ?>"><?= esc($b['barangay']) ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary">Export PDF</button>
                        <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>