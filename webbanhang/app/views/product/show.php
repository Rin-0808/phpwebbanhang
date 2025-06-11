<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
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
    <?php include 'app/views/shares/header.php'; ?>
    <div class="container mt-4">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center"></div>
                <h2 class="mb-0">Chi tiết sản phẩm</h2>
            </div>
            <div class="card-body">
                <?php if ($product): ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?php if ($product->image): ?>
                                <img src="/webbanhang/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid rounded" alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>">
                            <?php else: ?>
                                <img src="/webbanhang/images/no-image.png" class="img-fluid rounded" alt="Không có ảnh">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6">
                            <h3 class="card-title text-dark font-weight-bold">
                                <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                            </h3>
                            <p class="card-text"></p>
                                <?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?>
                            </p>
                            <p class="text-danger font-weight-bold h4">
                                💰 <?php echo number_format($product->price, 0, ',', '.'); ?> VND
                            </p>
                            <p><strong>Danh mục:</strong>
                                <span class="badge bg-info text-white"></span>
                                    <?php echo !empty($product->category_name) ? htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8') : 'Chưa có danh mục'; ?>
                                </span>
                            </p>
                            <div class="mt-4"></div>
                                <a href="/webbanhang/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-success px-4">➕ Thêm vào giỏ hàng</a>
                                <a href="/webbanhang/Product/list" class="btn btnsecondary px-4 ml-2">Quay lại danh sách</a>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-danger text-center"></div>
                        <h4>Không tìm thấy sản phẩm!</h4>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php include 'app/views/shares/footer.php'; ?>
</body>
</html>
