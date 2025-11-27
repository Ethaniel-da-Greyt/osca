<?= $this->extend('layout/layout') ?>

<?= $this->section('addUsers') ?>active<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="card mt-4 shadow-sm border-0 mb-5">
        <div class="card-header bg-dark text-white fw-bold fs-5">
            <?= esc($n['firstname'] . " " . $n['lastname']) ?>'s Profile
        </div>

        <div class="card-body">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab">Profile</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="activity-tab" data-bs-toggle="tab" data-bs-target="#activity" type="button" role="tab">Activity Logs</button>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content mt-3">
                <!-- Profile Tab -->
                <div class="tab-pane fade show active" id="profile" role="tabpanel">
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

                <!-- Activity Logs Tab -->
                <div class="tab-pane fade" id="activity" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Action</th>
                                    <th>Description</th>
                                    <th>Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($logs)): ?>
                                    <?php foreach ($logs as $key => $log): ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= esc($log['action']) ?></td>
                                            <td><?= esc($log['description']) ?></td>
                                            <td><?= esc(date('F d, Y - h:i A', strtotime($log['created_at']))) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">No activity logs found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div> <!-- tab-content -->

        </div>
    </div>
</div>

<?= $this->endSection() ?>