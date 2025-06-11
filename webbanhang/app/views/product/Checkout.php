<?php
require_once 'app/config/database.php';
require_once 'app/models/AccountModel.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize database connection and AccountModel
$db = (new Database())->getConnection();
$accountModel = new AccountModel($db);

$accountInfo = null;

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $accountInfo = $accountModel->getAccountById($userId); // Fetch user data
}

// Set promotion end time (24 hours from now)
$promotionEnd = time() + (24 * 60 * 60); // 24 hours from now
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <?php include 'app/views/shares/header.php'; ?>
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
    <h1>Thanh toán</h1>
    <form method="POST" action="/webbanhang/Product/processCheckout">
        <div class="form-group">
            <label>Họ tên</label>
            <input type="text" name="fullname"
                value="<?php echo isset($accountInfo->fullname) ? htmlspecialchars($accountInfo->fullname) : ''; ?>"
                class="form-control" required>
        </div>
        <div class="form-group">
            <label>Số điện thoại</label>
            <input type="text" name="phone"
                value="<?php echo isset($_SESSION['checkout_info']['phone']) ? htmlspecialchars($_SESSION['checkout_info']['phone']) : ''; ?>"
                class="form-control" >
        </div>
        <div class="form-group">
            <label>Địa chỉ</label>
            <input type="text" name="address"
                value="<?php echo isset($_SESSION['checkout_info']['address']) ? htmlspecialchars($_SESSION['checkout_info']['address']) : ''; ?>"
                class="form-control" >
        </div>
        <div class="form-group"></div>
            <label>Số lượng</label>
            <input type="number" name="quantity" value="1" class="form-control" required>
            <div id="promotion-countdown" style="color: red; margin-top: 10px;">
                Khuyến mãi kết thúc sau: <span id="countdown"></span>
            </div>
            <script>
                // Countdown timer
                function updateCountdown() {
                    const endTime = <?php echo $promotionEnd; ?>;
                    const now = Math.floor(Date.now() / 1000);
                    const timeLeft = endTime - now;
                    if (timeLeft > 0) {
                        const hours = Math.floor(timeLeft / 3600);
                        const minutes = Math.floor((timeLeft % 3600) / 60);
                        const seconds = timeLeft % 60;
                        document.getElementById('countdown').textContent = `${hours}h ${minutes}m ${seconds}s`;
                    } else {
                        document.getElementById('countdown').textContent = 'Khuyến mãi đã kết thúc';
                    }
                }
                setInterval(updateCountdown, 1000);
                updateCountdown(); // Initial call
            </script>
            <div style="margin-top: 10px;">
                <label>Giảm giá (số tiền)</label>
                <input type="number" name="discount_amount" class="form-control" placeholder="Nhập số tiền giảm giá (VND)"
                    min="0" value="0">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thanh toán</button>
    </form>
    <a href="/webbanhang/Product/cart" class="btn btn-secondary mt-2">Quay lại giỏ hàng</a>
    <?php include 'app/views/shares/footer.php'; ?>
</body>
</html>
