<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?></title>

    <!-- ✅ Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">

    <!-- ✅ Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('css/all.min.css') ?>">

    <!-- Select2 CSS -->
    <link href="<?= base_url('css/select2.min.css') ?>" rel="stylesheet" />

    <script src="<?= base_url('js/jquery.min.js') ?>"></script>

    <!-- Select2 JS -->
    <script src="<?= base_url('js/select2.full.min.js') ?>"></script>

    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
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

        .sidebar h4 {
            text-align: center;
            margin-bottom: 20px;
            padding: 0 10px;
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

        .logout-section {
            border-top: 1px solid #495057;
            padding-top: 10px;
            margin-bottom: 10px;
        }

        .logout-section a {
            color: #ff6b6b !important;
        }

        .logout-section a:hover {
            background-color: #dc3545 !important;
            color: white !important;
        }
    </style>
</head>

<body>

    <!-- ✅ Sidebar -->
    <div class="sidebar d-flex flex-column justify-content-between">
        <div>
            <div class="text-center mb-3">
                <img src="<?= base_url('logo/osca_logo.png') ?>" alt="OSCA Logo"
                    style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover;">
                <h6 class="mt-2">Office of the Senior Citizens Affairs</h6>
            </div>

            <a href="/" class="<?= $this->renderSection('dashboard') ?>">
                <i class="fa fa-gauge"></i> Dashboard
            </a>
            <a href="/osca/sc-list" class="<?= $this->renderSection('sclist') ?>">
                <i class="fa fa-users"></i> Senior Citizen Lists
            </a>
            <a href="/osca/add-record" class="<?= $this->renderSection('addrecord') ?>">
                <i class="fa-solid fa-plus"></i> Add Records
            </a>
            <a href="/osca/export-record" class="<?= $this->renderSection('print') ?>">
                <i class="fa fa-gear"></i> Export/Print Records
            </a>
        </div>

        <div class="logout-section text-center mt-auto mb-3">
            <a href="/logout" class="text-danger fw-semibold" style="color: #f8d7da !important;">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </div>
    </div>

    <!-- ✅ Content Wrapper -->
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4 p-3 rounded">
            <div class="container-fluid">
                <button class="btn btn-outline-secondary btn-sm d-lg-none" type="button" id="sidebarToggle">
                    <i class="fa fa-bars"></i>
                </button>
                <span class="navbar-brand">OSCA Management System</span>
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

    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        // Optional: mobile sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', () => {
            document.querySelector('.sidebar').classList.toggle('d-none');
        });
    </script>

</body>

</html>