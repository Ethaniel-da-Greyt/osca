<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSCA System | Register</title>
    <link rel="shortcut icon" href="<?= base_url('logo/osca_logo.png') ?>" type="image/x-icon">

    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/all.min.css') ?>">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-header h3 {
            color: #007bff;
            font-weight: 700;
        }

        .form-control {
            border-radius: 8px;
        }

        .btn-success {
            width: 100%;
            border-radius: 8px;
        }

        .footer-text {
            text-align: center;
            margin-top: 15px;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .logo {
            width: 90px;
            height: 70px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="login-header">
            <img src="<?= base_url('logo/osca_logo.png') ?>" alt="OSCA Logo" class="logo">
            <h3>OSCA Management System</h3>
            <p class="text-muted mb-0">Office of the Senior Citizens Affairs</p>
        </div>

        <form action="<?= base_url('osca-register') ?>" method="post">
            <div class="mb-3">
                <label for="username" class="form-label fw-semibold">First Name</label>
                <input type="text" id="username" name="firstname" class="form-control" placeholder="Enter your First Name" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label fw-semibold">Last Name</label>
                <input type="text" id="username" name="lastname" class="form-control" placeholder="Enter your Last Name" required>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label fw-semibold">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Confirm Password</label>
                <input type="password" id="password" name="confirm_pass" class="form-control" placeholder="Confirm password" required>
            </div>

            <button type="submit" class="btn btn-primary fw-semibold form-control">Register</button>
        </form>

        <div class="footer-text">
            <small>© <?= date('Y') ?> Office of the Senior Citizens Affairs</small>
        </div>
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

</body>

</html>