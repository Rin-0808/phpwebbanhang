<?php
require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');

class ProductApiController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    // Lấy danh sách sản phẩm
    public function index()
    {
        header('Content-Type: application/json');
        $products = $this->productModel->getProducts();
        echo json_encode($products);
    }

    // Lấy thông tin sản phẩm theo ID
    public function show($id)
    {
        header('Content-Type: application/json');
        $product = $this->productModel->getProductById($id);
        if ($product) {
            echo json_encode($product);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Product not found']);
        }
    }

    // Thêm sản phẩm mới
    public function store()
    {
        header('Content-Type: application/json');
        $data = $_POST;
        $image = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            $fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $fileName = uniqid() . '.' . $fileExtension;
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                $image = $fileName;
            }
        }

        $category_id = $data['category_id'] ?? null;
        $categoryModel = new CategoryModel($this->db);
        $categoryExists = $categoryModel->getCategoryById($category_id);
        if ($category_id !== null && !$categoryExists) {
            http_response_code(400);
            echo json_encode(['errors' => ['category_id' => 'Danh mục không tồn tại!']]);
            return;
        }

        $result = $this->productModel->addProduct(
            $data['name'] ?? '',
            $data['description'] ?? '',
            $data['price'] ?? '',
            $category_id,
            $image
        );

        if (is_array($result)) {
            http_response_code(400);
            echo json_encode(['errors' => $result]);
        } else {
            http_response_code(201);
            echo json_encode(['message' => 'Product created successfully', 'id' => $this->db->lastInsertId()]);
        }
    }

    // Cập nhật sản phẩm theo ID
    public function update($id)
    {
        header('Content-Type: application/json');
        $data = $_POST;
        $image = $_POST['existing_image'] ?? null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $fileName = uniqid() . '.' . $fileExtension;
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                if (!empty($_POST['existing_image']) && file_exists('uploads/' . $_POST['existing_image'])) {
                    unlink('uploads/' . $_POST['existing_image']);
                }
                $image = $fileName;
            }
        }

        $category_id = $data['category_id'] ?? null;
        $categoryModel = new CategoryModel($this->db);
        $categoryExists = $categoryModel->getCategoryById($category_id);
        if ($category_id !== null && !$categoryExists) {
            http_response_code(400);
            echo json_encode(['errors' => ['category_id' => 'Danh mục không tồn tại!']]);
            return;
        }

        $result = $this->productModel->updateProduct(
            $id,
            $data['name'] ?? '',
            $data['description'] ?? '',
            $data['price'] ?? '',
            $category_id,
            $image
        );

        if ($result) {
            echo json_encode(['message' => 'Product updated successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Failed to update product']);
        }
    }

    // Xóa sản phẩm theo ID
    public function destroy($id)
    {
        header('Content-Type: application/json');
        $product = $this->productModel->getProductById($id);
        if ($product && !empty($product->image) && file_exists('uploads/' . $product->image)) {
            unlink('uploads/' . $product->image);
        }
        $result = $this->productModel->deleteProduct($id);
        if ($result) {
            echo json_encode(['message' => 'Product deleted successfully']);
        } else {
            http_response_code(400);
            echo json_encode(['message' => 'Product deletion failed']);
        }
    }
}