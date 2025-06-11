<?php include 'app/views/shares/header.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
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
    <div class="container mt-4">
        <?php if (!isset($_SESSION['user_id'])): ?>
            <div class="alert alert-warning">
                Vui lòng <a href="/webbanhang/account/login">đăng nhập</a> để xem giỏ hàng của bạn.
            </div>
        <?php else: ?>
            <h1>Giỏ hàng</h1>
            <?php if (empty($cart)): ?>
                <p>Giỏ hàng trống.</p>
            <?php else: ?>
                <?php
                $total_price = 0;
                foreach ($cart as $item) {
                    $total_price += $item['price'] * $item['quantity'];
                }
                ?>
                <?php foreach ($cart as $id => $item): ?>
                    <div style="border: 1px solid #ccc; padding: 10px; margin-bottom: 10px;">
                        <img src="<?php echo htmlspecialchars($item['image'] ?? ''); ?>"
                            alt="<?php echo htmlspecialchars($item['name']); ?>" width="100">
                        <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                        <p>Giá: <?php echo number_format($item['price'], 0, ',', '.') ?> VND</p>
                        <div class="quantity-controls">
                            <button class="btn btn-secondary btn-sm quantity-btn" data-action="decrease" data-id="<?php echo $id; ?>">-</button>
                            <input type="number" class="form-control quantity-input" style="width: 80px; display: inline-block;" 
                                value="<?php echo $item['quantity']; ?>" 
                                min="1" 
                                data-id="<?php echo $id; ?>">
                            <button class="btn btn-secondary btn-sm quantity-btn" data-action="increase" data-id="<?php echo $id; ?>">+</button>
                        </div>
                        <?php if (isset($item['is_promotion']) && $item['is_promotion']): ?>
                            <span style="color: green;">✔ Khuyến mãi online</span>
                        <?php endif; ?>
                        <a href="/webbanhang/Product/deleteFromCart/<?php echo $id; ?>" class="btn btn-danger">Xóa</a>
                    </div>
                <?php endforeach; ?>
                <h3>Tổng tiền: <?php echo number_format($total_price, 0, ',', '.'); ?> VND</h3>
                <a href="/webbanhang/Product/checkout" class="btn btn-primary">Thanh toán</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Add this before the closing </body> tag -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityControls = document.querySelectorAll('.quantity-controls');

        quantityControls.forEach(control => {
            const input = control.querySelector('.quantity-input');
            const buttons = control.querySelectorAll('.quantity-btn');

            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    const action = this.dataset.action;
                    const id = this.dataset.id;
                    const currentValue = parseInt(input.value);

                    if (action === 'increase') {
                        input.value = currentValue + 1;
                    } else if (action === 'decrease' && currentValue > 1) {
                        input.value = currentValue - 1;
                    }

                    updateQuantity(id, input.value);
                });
            });

            input.addEventListener('change', function() {
                const id = this.dataset.id;
                if (this.value < 1) this.value = 1;
                updateQuantity(id, this.value);
            });
        });

        function updateQuantity(productId, quantity) {
            fetch(`/webbanhang/Product/updateCartQuantity/${productId}/${quantity}`, {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload(); // Reload to update total price
                } else {
                    alert('Có lỗi xảy ra khi cập nhật số lượng');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi cập nhật số lượng');
            });
        }
    });
    </script>
</body>
</html>
<?php include 'app/views/shares/footer.php'; ?>