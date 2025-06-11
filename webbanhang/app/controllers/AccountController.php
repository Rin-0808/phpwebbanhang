<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');

class AccountController
{
    private $accountModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
    }

    public function register()
    {
        include_once 'app/views/account/register.php';
    }

    public function login()
    {
        include_once 'app/views/account/login.php';
    }

    public function save()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'] ?? '';
        $fullName = $_POST['fullname'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirmpassword'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $email = $_POST['email'] ?? '';
        $role = $_POST['role'] ?? 'user';
        $errors = [];

        if (empty($username))
            $errors['username'] = "Vui lòng nhập username!";
        if (empty($fullName))
            $errors['fullname'] = "Vui lòng nhập fullname!";
        if (empty($password))
            $errors['password'] = "Vui lòng nhập password!";
        if ($password != $confirmPassword)
            $errors['confirmPass'] = "Mật khẩu và xác nhận chưa khớp!";
        if (!in_array($role, ['admin', 'user']))
            $role = 'user';
        if ($this->accountModel->getAccountByUsername($username)) {
            $errors['account'] = "Tài khoản này đã được đăng ký!";
        }
        if (empty($phone))
            $errors['phone'] = "Vui lòng nhập số điện thoại!";
        if (empty($email))
            $errors['email'] = "Vui lòng nhập email!";
        if (count($errors) > 0) {
            include_once 'app/views/account/register.php';
        } else {
            $result = $this->accountModel->save($username, $fullName, $password, $phone, $email, $role);
            if ($result) {
                header('Location: /webbanhang/account/login');
                exit;
            }
        }
    }
}

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        unset($_SESSION['checkout_info']);
        header('Location: /webbanhang/product');
        exit;
    }

    public function checkLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $account = $this->accountModel->getAccountByUsername($username);
            if ($account && password_verify($password, $account->password)) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user_id'] = $account->id;
                $_SESSION['username'] = $account->username;
                $_SESSION['role'] = $account->role;
                
                // Check if there's a redirect URL stored in session
                if (isset($_SESSION['redirect_after_login'])) {
                    $redirect = $_SESSION['redirect_after_login']; 
                    unset($_SESSION['redirect_after_login']); // Clear the stored URL
                    header('Location: ' . $redirect);
                    exit;
                }
                
                header('Location: /webbanhang/product');
                exit;
            } else {
                $error = $account ? "Mật khẩu không đúng!" : "Không tìm thấy tài khoản!";
        include_once 'app/views/account/login.php';
            exit;
        }
        }
    }

    public function list() 
    {
        if (!SessionHelper::isAdmin()) {
            header('Location: /webbanhang/product');
            exit;
        }
        $accounts = $this->accountModel->getAllAccounts();
        include_once 'app/views/account/list.php';
    }

    public function edit($id) 
    {
        if (!SessionHelper::isAdmin()) {
            header('Location: /webbanhang/product');
            exit;
        }
        $account = $this->accountModel->getAccountById($id);
        if ($account) {
            include_once 'app/views/account/edit.php';
        } else {
            echo "Account not found";
        }
    }

    public function update()
    {
        if (!SessionHelper::isAdmin() || $_SERVER['REQUEST_METHOD'] != 'POST') {
            header('Location: /webbanhang/product');
            exit;
        }

        $id = $_POST['id'] ?? '';
        $username = $_POST['username'] ?? '';
        $fullName = $_POST['fullname'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'user';

        if ($this->accountModel->updateAccount($id, $username, $fullName, $password, $role)) {
            header('Location: /webbanhang/account/list');
        } else {
            echo "Error updating account";
        }
    }

    public function delete($id)
    {
        if (!SessionHelper::isAdmin()) {
            header('Location: /webbanhang/product');
            exit;
        }
        
        if ($this->accountModel->deleteAccount($id)) {
            header('Location: /webbanhang/account/list');
        } else {
            echo "Error deleting account";
        }
    }
}
?>