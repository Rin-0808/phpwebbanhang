<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            color: #000;
        }

        .navbar-main {
            background-color: #FFD400;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        </a>.navbar-brand img {
            height: 42px;
        }

        .search-bar {
            border-radius: 30px;
            overflow: hidden;
        }

        .search-bar input {
            border: none;
            padding: 10px 20px;
            outline: none;
            width: 100%;
        }

        .btn-search {
            background: #fff;
            border: none;
            border-left: 1px solid #ccc;
            padding: 0 16px;
        }

        .nav-item-icon {
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
            color: #000;
            font-weight: 500;
        }

        .nav-item-icon:hover {
            text-decoration: underline;
            color: #c70000;
        }

        .nav-category {
            background-color: #FFD400;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            padding: 8px 0;
        }

        .card-title {
            font-size: 1rem;
            min-height: 48px;
        }

        .card-img-top {
            height: 180px;
            object-fit: contain;
            background: #fff;
        }

        .card-footer {
            background-color: transparent;
            border-top: none;
        }

        footer {
            background-color: #212529;
            color: #ccc;
            padding: 40px 0;
            text-align: center;
            margin-top: 60px;
        }

        .alert {
            margin: 15px 0;
            padding: 15px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
        }

        .alert-warning {
            background-color: rgba(255, 193, 7, 0.9);
            color: #000;
            border: none;
        }

        .alert-info {
            background-color: rgba(13, 202, 240, 0.9);
            color: white;
            border: none;
        }
    </style> <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            color: #000;
        }

        .navbar-main {
            background-color: #FFD400;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        </a>.navbar-brand img {
            height: 42px;
        }

        .search-bar {
            border-radius: 30px;
            overflow: hidden;
        }

        .search-bar input {
            border: none;
            padding: 10px 20px;
            outline: none;
            width: 100%;
        }

        .btn-search {
            background: #fff;
            border: none;
            border-left: 1px solid #ccc;
            padding: 0 16px;
        }

        .nav-item-icon {
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
            color: #000;
            font-weight: 500;
        }

        .nav-item-icon:hover {
            text-decoration: underline;
            color: #c70000;
        }

        .nav-category {
            background-color: #FFD400;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            padding: 8px 0;
        }

        .card-title {
            font-size: 1rem;
            min-height: 48px;
        }

        .card-img-top {
            height: 180px;
            object-fit: contain;
            background: #fff;
        }

        .card-footer {
            background-color: transparent;
            border-top: none;
        }

        footer {
            background-color: #212529;
            color: #ccc;
            padding: 40px 0;
            text-align: center;
            margin-top: 60px;
        }

        .alert {
            margin: 15px 0;
            padding: 15px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
        }

        .alert-warning {
            background-color: rgba(255, 193, 7, 0.9);
            color: #000;
            border: none;
        }

        .alert-info {
            background-color: rgba(13, 202, 240, 0.9);
            color: white;
            border: none;
        }
    </style> <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            color: #000;
        }

        .navbar-main {
            background-color: #FFD400;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        </a>.navbar-brand img {
            height: 42px;
        }

        .search-bar {
            border-radius: 30px;
            overflow: hidden;
        }

        .search-bar input {
            border: none;
            padding: 10px 20px;
            outline: none;
            width: 100%;
        }

        .btn-search {
            background: #fff;
            border: none;
            border-left: 1px solid #ccc;
            padding: 0 16px;
        }

        .nav-item-icon {
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 6px;
            color: #000;
            font-weight: 500;
        }

        .nav-item-icon:hover {
            text-decoration: underline;
            color: #c70000;
        }

        .nav-category {
            background-color: #FFD400;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            padding: 8px 0;
        }

        .card-title {
            font-size: 1rem;
            min-height: 48px;
        }

        .card-img-top {
            height: 180px;
            object-fit: contain;
            background: #fff;
        }

        .card-footer {
            background-color: transparent;
            border-top: none;
        }

        footer {
            background-color: #212529;
            color: #ccc;
            padding: 40px 0;
            text-align: center;
            margin-top: 60px;
        }

        .alert {
            margin: 15px 0;
            padding: 15px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
        }

        .alert-warning {
            background-color: rgba(255, 193, 7, 0.9);
            color: #000;
            border: none;
        }

        .alert-info {
            background-color: rgba(13, 202, 240, 0.9);
            color: white;
            border: none;
        }
    </style>
</head>

<body>
    <?php include 'app/views/shares/header.php'; ?>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">
                            <form action="/webbanhang/account/checklogin" method="post">
                            <div class="mb-md-5 mt-md-4 pb-5">
                                    <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                    <p class="text-white-50 mb-5">Please enter your login and password!</p>
                                    <div class="form-outline form-white mb-4">
                                        <input type="text" name="username" class="form-control form-controllg" />
                                        <label class="form-label" for="typeEmailX">UserName</label>
                            </div>
                                <div class="form-outline form-white mb-4">
                                        <input type="password" name="password" class="form-control formcontrol-lg" />
                                        <label class="form-label" for="typePasswordX">Password</label>
                                </div>

                                    <!-- Display login attempt messages -->
                                    <?php if (isset($error)): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $error; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                    if (isset($_POST['username']) && isset($_SESSION['login_attempts'][$_POST['username']])) {
                                        $attempts = $_SESSION['login_attempts'][$_POST['username']];
                                        if ($attempts['locked_until'] > time()) {
                                            $remainingTime = ceil(($attempts['locked_until'] - time()) / 60);
                                            echo '<div class="alert alert-warning">';
                                            echo "Tài khoản đã bị khóa. Vui lòng thử lại sau {$remainingTime} phút.";
                                            echo '</div>';
                                        } else {
                                            $remainingAttempts = 5 - $attempts['count'];
                                            if ($remainingAttempts > 0) {
                                                echo '<div class="alert alert-info">';
                                                echo "Còn {$remainingAttempts} lần thử đăng nhập.";
                                                echo '</div>';
                                            }
                                        }
                                    }
                                    ?>

                                    <!-- Add this debug section temporarily to check the attempts count -->
                                    <?php if (isset($_POST['username']) && isset($_SESSION['login_attempts'][$_POST['username']])): ?>
                                        <div class="alert alert-secondary" style="font-size: 12px;">
                                            Debug: Số lần thử: <?php echo $_SESSION['login_attempts'][$_POST['username']]['count']; ?>
                                        </div>
                                    <?php endif; ?>

                                    <p class="small mb-5 pb-lg-2">
                                        <a class="text-white-50" href="#!">Forgot password?</a>
                                    </p>

                                    <?php
                                    echo '<button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>';
                                    ?>

                                </div>
                                <div>
                                    <p class="mb-0">Don't have an account? <a href="/webbanhang/account/register "
                                            class="text-white-50 fw-bold">Sign Up</a>
                                </p>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'app/views/shares/footer.php'; ?>
</body>