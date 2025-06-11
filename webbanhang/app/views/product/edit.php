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
<h1>Sửa sản phẩm</h1>
<form id="edit-product-form" enctype="multipart/form-data">
    <input type="hidden" id="id" name="id">
    <div class="form-group">
        <label for="name">Tên sản phẩm:</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Mô tả:</label>
        <textarea id="description" name="description" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="price">Giá:</label>
        <input type="number" id="price" name="price" class="form-control" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="image">Hình ảnh sản phẩm:</label>
        <input type="file" id="image" name="image" class="form-control" accept="image/*">
        <input type="hidden" name="existing_image" id="existing_image">
        <div id="current-image" class="mt-2"></div>
        <div id="image-preview" class="mt-2"></div>
    </div>
    <div class="form-group">
        <label for="category_id">Danh mục:</label>
        <select id="category_id" name="category_id" class="form-control" required>
            <!-- Các danh mục sẽ được tải từ API và hiển thị tại đây -->
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
</form>
<a href="/webbanhang/Product/list" class="btn btn-secondary mt-2">Quay lại danh sách sản phẩm</a>
<?php include 'app/views/shares/footer.php'; ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const productId = <?= $editId ?>;

        // Image preview functionality
        document.getElementById('image').addEventListener('change', function(event) {
            const preview = document.getElementById('image-preview');
            preview.innerHTML = '';
            const file = event.target.files[0];
            if (file) {
                const img = document.createElement('img');
                img.style.maxWidth = '200px';
                img.style.maxHeight = '200px';
                img.src = URL.createObjectURL(file);
                preview.appendChild(img);
            }
        });

        // Load product data
        fetch(`/webbanhang/api/product/${productId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('id').value = data.id;
                document.getElementById('name').value = data.name;
                document.getElementById('description').value = data.description;
                document.getElementById('price').value = data.price;
                document.getElementById('category_id').value = data.category_id;
                document.getElementById('existing_image').value = data.image;
                
                // Display current image if it exists
                if (data.image_url) {
                    const currentImage = document.getElementById('current-image');
                    const img = document.createElement('img');
                    img.style.maxWidth = '200px';
                    img.style.maxHeight = '200px';
                    img.src = data.image_url;
                    currentImage.innerHTML = '<p>Hình ảnh hiện tại:</p>';
                    currentImage.appendChild(img);
                }
            });

        // Load categories
        fetch('/webbanhang/api/category')
            .then(response => response.json())
            .then(data => {
                const categorySelect = document.getElementById('category_id');
                data.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.name;
                    categorySelect.appendChild(option);
                });
            });

        // Form submission
        document.getElementById('edit-product-form').addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            
            fetch(`/webbanhang/api/product/${formData.get('id')}`, {
                method: 'POST', // Using POST with _method=PUT for file upload
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Product updated successfully') {
                    location.href = '/webbanhang/Product';
                } else {
                    alert('Cập nhật sản phẩm thất bại');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Lỗi: Không thể cập nhật sản phẩm.');
            });
        });
    });
</script>