<?php include 'app/views/shares/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tài khoản</title>
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
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary mb-0">
                <i class="bi bi-people-fill me-2"></i>Quản lý tài khoản
            </h2>
            <a href="/webbanhang/account/register" class="btn btn-success">
                <i class="bi bi-person-plus-fill me-1"></i>Thêm tài khoản
            </a>
        </div>

        <div class="card shadow">
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Tên đăng nhập</th>
                            <th>Họ tên</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Vai trò</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($accounts as $account): ?>
                            <tr>
                                <td><?= htmlspecialchars($account->id) ?></td>
                                <td><?= htmlspecialchars($account->username) ?></td>
                                <td><?= htmlspecialchars($account->fullname) ?></td>
                                <td><?= htmlspecialchars($account->phone ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($account->email ?? 'N/A') ?></td>
                                <td>
                                    <span class="badge <?= $account->role === 'admin' ? 'bg-danger' : 'bg-success' ?>">
                                        <?= htmlspecialchars($account->role) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="/webbanhang/account/edit/<?= $account->id ?>" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Sửa
                                    </a>
                                    <a href="/webbanhang/account/delete/<?= $account->id ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa tài khoản này?');">
                                        <i class="bi bi-trash"></i> Xóa
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
<?php include 'app/views/shares/footer.php'; ?>