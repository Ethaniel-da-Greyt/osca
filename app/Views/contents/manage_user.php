<?= $this->extend('layout/layout') ?>

<?= $this->section('addUsers') ?>active<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="card mt-4 shadow-sm border-0 mb-5">
        <div class="card-header bg-dark text-white fw-bold fs-5">
            <?= esc($n['firstname'] . " " . $n['lastname']) ?>'s Profile
        </div>

        <div class="card-body">
            <form action="/osca/users/update-user/<?= esc($n['id']) ?>" method="POST">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Last Name</label>
                        <input type="text" name="lastname" value="<?= esc($n['lastname']) ?>" class="form-control" placeholder="Last Name*" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">First Name</label>
                        <input type="text" name="firstname" value="<?= esc($n['firstname']) ?>" class="form-control" placeholder="First Name*" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Username</label>
                        <input type="text" name="username" class="form-control" value="<?= esc($n['username']) ?>" placeholder="Username*" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter new password or leave blank">
                        <small class="text-muted">Leave empty if you don’t want to change the password</small>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Role</label>
                        <select name="role" class="form-select" required>
                            <option value="user" <?= $n['role'] == 'user' ? 'selected' : '' ?>>User</option>
                            <option value="admin" <?= $n['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="isDelete" class="form-select">
                            <option value="0" <?= $n['isDelete'] == 0 ? 'selected' : '' ?>>Active</option>
                            <option value="1" <?= $n['isDelete'] == 1 ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button class="btn btn-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i> Update User</button>
                    <a href="<?= base_url('osca/users') ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>