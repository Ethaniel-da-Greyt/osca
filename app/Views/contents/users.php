<?= $this->extend('layout/layout') ?>

<?= $this->section('addUsers') ?>active<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap gap-2">
            <div class="d-flex flex-wrap gap-3">

                <form action="" method="get" class="d-flex flex-column">
                    <input placeholder="Search users" type="text" name="search" class="form-control"
                        value="<?= esc($search ?? '') ?>">
                    <label class="form-text text-muted small">Search users here</label>
                </form>

                <form action="" method="get" class="d-flex flex-column">
                    <select name="role" id="role" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Choose Role --</option>
                        <option value="admin" <?= isset($roleFilter) && $roleFilter == 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="user" <?= isset($roleFilter) && $roleFilter == 'user' ? 'selected' : '' ?>>User</option>
                        <option value="all" <?= isset($roleFilter) && $roleFilter == 'all' ? 'selected' : '' ?>>All</option>
                    </select>
                    <label class="form-text text-muted small">Select role to filter</label>
                </form>

                <form action="" method="get" class="d-flex flex-column">
                    <select name="status" id="status" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Choose Status --</option>
                        <option value="active" <?= isset($statusFilter) && $statusFilter == 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= isset($statusFilter) && $statusFilter == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                    <label class="form-text text-muted small">Filter by status</label>
                </form>
            </div>

            <div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa-solid fa-user-plus"></i> Add User</button>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4 shadow-sm border-0 mb-5">
    <div class="card-header bg-dark text-white fw-bold fs-4">
        Current Users
    </div>
    <div class="card-body p-0">
        <?php if (!empty($users)): ?>
            <div class="table-responsive">
                <div class="list-group list-group-flush">
                    <div class="list-group-item bg-light fw-bold d-flex justify-content-between align-items-center">
                        <div class="col-3">Username</div>
                        <div class="col-3">Name</div>
                        <div class="col-2">Role</div>
                        <div class="col-2 text-center">Status</div>
                        <div class="col-2 text-end">Action</div>
                    </div>

                    <?php foreach ($users as $u): ?>
                        <a href="/osca/manage-user/<?= $u['id'] ?>"
                            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center py-3">
                            <div class="col-3 fw-semibold"><?= esc($u['username']) ?></div>
                            <div class="col-3"><?= esc(($u['firstname'] . " " . $u['lastname']) ?? 'N/A') ?></div>
                            <div class="col-2"><?= esc($u['role'] ?? 'User') ?></div>
                            <div class="col-2 text-center">
                                <?php if ($u['isDelete'] === '1'): ?>
                                    <span class="badge bg-secondary">Inactive</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Active</span>
                                <?php endif; ?>
                            </div>
                            <div class="col-2 text-end">
                                <i class="fa fa-chevron-right text-muted"></i>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <p class="text-muted text-center my-3">No users found.</p>
        <?php endif; ?>
    </div>
</div>

<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Add New User</h5>
                <span class="btn btn-close" data-bs-dismiss="modal"></span>
            </div>

            <form action="users/add-user" method="post">
                <div class="modal-body">
                    <div class="row mb-2">
                        <div class="col-6">
                            <label for="" class=" form-label fw-semibold">First Name</label>
                            <input type="text" name="firstname" id="" class="form-control" placeholder="Enter Firstname">
                        </div>
                        <div class="col-6">
                            <label for="" class=" form-label fw-semibold">Last Name</label>
                            <input type="text" name="lastname" id="" class="form-control" placeholder="Enter Lastname">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-9">
                            <label for="" class="form-label fw-semibold">Username</label>
                            <input type="text" name="username" id="" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="col-3">
                            <label for="" class="form-label fw-semibold">Select Role</label>
                            <select name="role" id="" class="form-select">
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" id="" class="form-control" placeholder="Enter Password">
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label fw-semibold">Confirm Password</label>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary">Add User</button>
                    <span class="btn btn-secondary" data-bs-dismiss="modal">Cancel</span>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .list-group-item-action {
        transition: all 0.15s ease-in-out;
    }

    .list-group-item-action:hover {
        background-color: #f8f9fa;
        transform: translateY(-1px);
    }

    .list-group-item.bg-light {
        border-bottom: 2px solid #dee2e6;
    }
</style>
<?= $this->endSection() ?>