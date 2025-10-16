<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?></title>

    <!-- ✅ Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">

    <!-- ✅ Font Awesome Icons -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="<?= base_url('css/all.min.css') ?>">

    <!-- Select2 CSS -->
    <link href="<?= base_url('css/select2.min.css') ?>" rel="stylesheet" />

    <script src="<?= base_url('js/jquery.min.js') ?>"></script>

    <!-- Select2 JS -->
    <script src="<?= base_url('js/select2.full.min.js') ?>"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: #fff;
            padding-top: 1rem;
        }

        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 4px 8px;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .navbar {
            position: sticky;
            top: 0;
            z-index: 1020;
        }
    </style>
</head>

<body>

    <!-- ✅ Sidebar -->
    <div class="sidebar">
        <h4 class="text-center mb-4">Office of the Senior Citizen Affairs</h4>
        <div class="">
            <a href="/" class="<?= $this->renderSection('dashboard') ?>"><i class="fa fa-gauge"></i> Dashboard</a>
            <a href="/osca/sc-list" class="<?= $this->renderSection('sclist') ?>"><i class="fa fa-users"></i> Senior Citizen Lists</a>
            <a href="/osca/add-record" class="<?= $this->renderSection('addrecord') ?>"><i class="fa-solid fa-plus"></i> Add Records</a>
            <a href="/osca/export-record" class="<?= $this->renderSection('print') ?>"><i class="fa fa-gear"></i> Export/Print Records</a>
        </div>

        <div class="">

        </div>
    </div>

    <!-- ✅ Content Wrapper -->
    <div class="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4 p-3 rounded">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary btn-sm d-lg-none" type="button" id="sidebarToggle">
                    <i class="fa fa-bars"></i>
                </button>
                <span class="navbar-brand">OSCA Management System</span>

                <!-- <div class="ms-auto">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown">
                            <i class="fa fa-user-circle fa-lg me-2"></i> Admin
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </nav>


        <!-- Main Content -->
        <?= $this->renderSection('content') ?>
    </div>

    <script src="<?= base_url('js/sweetalert2.all.min.js') ?>"></script>

    <?php if (session()->getFlashdata('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: '<?= session()->getFlashdata('success') ?>',
                showConfirmButton: false,
                timer: 2000,
            });
        </script>
    <?php elseif (session()->getFlashdata('error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: '<?= session()->getFlashdata('error') ?>',
                showConfirmButton: false,
                timer: 2000,
            });
        </script>
    <?php endif ?>
    <!-- ✅ Bootstrap JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        // Optional: mobile sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', () => {
            document.querySelector('.sidebar').classList.toggle('d-none');
        });
    </script>

</body>

</html>