<?= $this->extend('layout/layout') ?>

<?= $this->section('select-batch') ?>active<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Select Batch to Print</h4>
                </div>

                <div class="card-body">

                    <?php if (empty($batches)) : ?>
                        <div class="alert alert-warning">
                            No batch folders found.
                        </div>
                    <?php else : ?>

                        <form action="<?= base_url('osca/print-batch') ?>" method="get">
                            <select name="batch" class="form-select" required>
                                <option value="">-- Select Batch --</option>

                                <?php foreach ($batches as $batch): ?>
                                    <option value="<?= esc($batch) ?>"><?= strtoupper($batch) ?></option>
                                <?php endforeach; ?>
                            </select>

                            <button class="btn btn-primary w-100 mt-3">Print</button>
                        </form>

                    <?php endif; ?>

                </div>

            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>