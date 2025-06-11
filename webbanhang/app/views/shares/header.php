<style>
    .navbar-main {
        background-color: #FFD400;
        padding: 10px 0;
    }

    .logo-container {
        width: 180px;
    }

    .logo-container img {
        width: 100%;
        height: auto;
    }

    .search-bar {
        position: relative;
        max-width: 500px;
        width: 100%;
    }

    .search-bar input {
        width: 100%;
        padding: 8px 40px 8px 15px;
        border: none;
        border-radius: 4px;
        outline: none;
    }

    .btn-search {
        position: absolute;
        right: 0;
        top: 0;
        height: 100%;
        background: none;
        border: none;
        padding: 0 15px;
    }

    .header-actions {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .header-action-link {
        color: #000;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .nav-category {
        background-color: #FFD400;
        padding: 8px 0;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    .nav-category .container {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }
</style>

<header>
    <div class="navbar-main">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo-container">
                    <a href="/webbanhang/Product/">
                        <img src="https://cdn.haitrieu.com/wp-content/uploads/2021/11/Logo-The-Gioi-Di-Dong-MWG-B-H.png"
                            alt="Logo">
                    </a>
                </div>

                <div class="search-bar">
                    <input type="text" placeholder="🔍 Bạn tìm gì?">
                    <button class="btn-search"><i class="fa fa-search"></i></button>
                </div>

                <div class="header-actions">    
                    <?php if (SessionHelper::isAdmin()): ?>
                        <a href="/webbanhang/account/list" class="nav-link">
                            <i class="bi bi-people-fill"></i> Quản lý tài khoản
                        </a>
                    <?php endif; ?>
                    <?php if (SessionHelper::isAdmin()): ?>
                        

                        <a class="nav-link" href="/webbanhang/Product/add">Thêm sản phẩm</a>

                    <?php endif; ?>
                    <?php if (!SessionHelper::isLoggedIn()): ?>
                        <a class='nav-link' href='/webbanhang/account/register'>Đăng ký</a>
                    <?php endif; ?>
                    <?php
                    if (SessionHelper::isLoggedIn()) {
                        echo "<a class='nav-link'>" . htmlspecialchars($_SESSION['username']) . "(" . SessionHelper::getRole() . ")</a>";
                    } else {
                        echo "<a class='nav-link' href='/webbanhang/account/login'>Đăng nhập</a>";
                    }
                    ?>


                    <?php
                    if (SessionHelper::isLoggedIn()) {
                        echo "<a class='nav-link' href='/webbanhang/account/logout'>Đăng xuất</a>";
                    }
                    ?>
                    <a href="/WebBanHang/Product/cart" class="header-action-link">

                        <a href="#" class="header-action-link">
                            <i class="fa-solid fa-location-dot"></i> Hồ Chí Minh
                        </a>
                </div>
            </div>
        </div>
    </div>

    <div class="nav-category">
        <div class="container">
            <a href="#" class="nav-item-icon"><i class="fa-solid fa-mobile"></i> Điện thoại</a>
            <a href="#" class="nav-item-icon"><i class="fa-solid fa-laptop"></i> Laptop</a>
            <a href="#" class="nav-item-icon"><i class="fa-solid fa-headphones"></i> Phụ kiện</a>
            <a href="#" class="nav-item-icon"><i class="fa-solid fa-stopwatch"></i> Smartwatch</a>
            <a href="#" class="nav-item-icon"><i class="fa-regular fa-clock"></i> Đồng hồ</a>
            <a href="#" class="nav-item-icon"><i class="""fa-solid fa-tablet-screen-button"></i> Tablet</a>
            <a href="#" class="nav-item-icon"><i class="fa-solid fa-recycle"></i> Máy cũ, Thu cũ</a>
            <a href="#" class="nav-item-icon"><i class="fa-solid fa-display"></i> Màn hình, Máy in</a>
            <a href="#" class="nav-item-icon"><i class="fa-solid fa-sim-card"></i> Sim, Thẻ cào</a>
            <a href="#" class="nav-item-icon"><i class="fa-solid fa-wallet"></i> Dịch vụ tiện ích</a>
        </div>
    </div>
</header>