<?php
require_once 'app/helpers/SessionHelper.php';
SessionHelper::init(); // Add this line
$cart_count = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sản phẩm</title>
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
    </style>
</head>
<body>
    <?php include 'app/views/shares/header.php'; ?>

    <!-- BANNER -->
    <div class="banner-hero" style="background: url('https://cdnv2.tgdd.vn/mwg-static/tgdd/Banner/23/05/23050828d3211ce7b91e92473a3690b3.jpg') no-repeat center center; background-size: cover; height: 260px; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: bold; color: #fff; text-shadow: 1px 1px 4px #000;">
    </div>

    <!-- MAIN CONTENT -->
    <main class="container pb-5 mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-dark fw-bold">📦 Danh sách sản phẩm</h4>
            <?php if (SessionHelper::isAdmin()): ?>
            <a href="/webbanhang/Product/add" class="btn btn-warning fw-bold">
                <i class="fas fa-plus-circle"></i> Thêm sản phẩm
            </a>
            <?php endif; ?>
        </div>

        <div id="flash-sale-timer" class="text-white fw-bold px-3 py-2 rounded" style="background-color: orange; display: inline-block;">
            <span>Chỉ còn: </span>
            <span id="hour" style="background: white; color: black; padding: 4px 6px; border-radius: 6px;">00</span> :
            <span id="minute" style="background: white; color: black; padding: 4px 6px; border-radius: 6px;">30</span> :
            <span id="second" style="background: white; color: black; padding: 4px 6px; border-radius: 6px;">00</span>
        </div>

        <div class="alert alert-info d-none" id="status-message"></div>
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-5 g-4" id="product-list">
            <!-- Products will be loaded here -->
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="text-center py-4 mt-5">
        <div class="container">
            <p class="mb-1">© <?= date('Y') ?> Thế Giới Di Động. Thiết kế bởi Hữu Nhân hẹ hẹ </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    // Flash sale timer
    let totalSeconds = 30 * 60;
    const hourEl = document.getElementById("hour");
    const minuteEl = document.getElementById("minute");
    const secondEl = document.getElementById("second");

    function updateCountdown() {
        const hours = String(Math.floor(totalSeconds / 3600)).padStart(2, '0');
        const minutes = String(Math.floor((totalSeconds % 3600) / 60)).padStart(2, '0');
        const seconds = String(totalSeconds % 60).padStart(2, '0');

        hourEl.textContent = hours;
        minuteEl.textContent = minutes;
        secondEl.textContent = seconds;

        if (totalSeconds > 0) {
            totalSeconds--;
            setTimeout(updateCountdown, 1000);
        } else {
            hourEl.textContent = "00";
            minuteEl.textContent = "00";
            secondEl.textContent = "00";
        }
    }

    // Product loading and management
    document.addEventListener("DOMContentLoaded", function() {
        updateCountdown();
        loadProducts();
    });

    function loadProducts() {
        const productList = document.getElementById('product-list');
        productList.innerHTML = '<div class="text-center"><div class="spinner-border" role="status"></div></div>';

        fetch('/webbanhang/api/product')
            .then(async response => {
                console.log('Response status:', response.status); // Add status logging
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const text = await response.text();
                console.log('Raw response:', text); // Add response logging
                try {
                    return JSON.parse(text);
                } catch (e) {
                    console.error('Parse error:', e);
                    throw new Error(`Failed to parse JSON response: ${text}`);
                }
            })
            .then(data => {
                console.log('Parsed data:', data); // Add data logging
                if (!Array.isArray(data) || data.length === 0) {
                    productList.innerHTML = '<div class="alert alert-warning text-center">Không có sản phẩm nào.</div>';
                    return;
                }

                displayProducts(data);
            })
            .catch(error => {
                console.error('Fetch error:', error); // Add error logging
                productList.innerHTML = `
                    <div class="alert alert-danger">
                        <p>Lỗi khi tải sản phẩm:</p>
                        <pre class="mt-2 text-danger">${error.message}</pre>
                    </div>`;
            });
    }

    function handleImageError(img) {
        console.error('Image failed to load:', img.src);
        img.src = '/webbanhang/assets/images/no-image.png';
        img.onerror = null; // Prevent infinite loop
    }

    const isAdmin = <?php echo SessionHelper::isAdmin() ? 'true' : 'false'; ?>;
    
    function displayProducts(products) {
        const productList = document.getElementById('product-list');
        let html = '';
        
        products.forEach(product => {
            html += `
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="${product.image_url}" 
                             class="card-img-top" 
                             alt="${product.name}"
                             onerror="handleImageError(this)"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">${product.description}</p>
                            <p class="card-text">
                                <strong>Giá: </strong>${new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(product.price)}
                            </p>
                            <p class="card-text"><small>Danh mục: ${product.category_name}</small></p>
                            ${isAdmin ? `
                                <div class="d-flex justify-content-between mt-3">
                                    <a href="/webbanhang/Product/edit/${product.id}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Sửa
                                    </a>
                                    <button onclick="deleteProduct(${product.id})" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Xóa
                                    </button>
                                </div>
                            ` : ''}
                        </div>
                    </div>
                </div>`;
        });
        
        productList.innerHTML = html;
    }

    function deleteProduct(id) {
        if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
            const statusMessage = document.getElementById('status-message');
            statusMessage.classList.remove('d-none');
            statusMessage.textContent = 'Đang xóa sản phẩm...';

            fetch(`/webbanhang/api/product/${id}`, {
                method: 'DELETE'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.message === 'Product deleted successfully') {
                    statusMessage.className = 'alert alert-success';
                    statusMessage.textContent = 'Sản phẩm đã được xóa thành công';
                    setTimeout(() => {
                        statusMessage.classList.add('d-none');
                        loadProducts();
                    }, 2000);
                } else {
                    throw new Error(data.message || 'Xóa sản phẩm thất bại');
                }
            })
            .catch(error => {
                statusMessage.className = 'alert alert-danger';
                statusMessage.textContent = `Lỗi: ${error.message}`;
            });
        }
    }

    function escapeHtml(unsafe) {
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
    </script>
</body>
</html>
