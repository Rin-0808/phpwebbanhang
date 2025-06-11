<?php
class AccountModel
{
    private $conn;
    private $table_name = "account";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAccountByUsername($username)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getAllAccounts() 
    {
        $query = "SELECT id, username, fullname, role FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAccountById($id)
    {
        $query = "SELECT id, username, fullname, role FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function save($username, $fullName, $password, $phone, $email, $role = 'user')
    {
        // Kiểm tra xem username đã tồn tại chưa
        if ($this->getAccountByUsername($username)) { // Đảm bảo gọi đúng phương thức
            return false;
        }

        // Chuẩn bị câu lệnh INSERT, bao gồm phone và email
        $query = "INSERT INTO " . $this->table_name . " SET username=:username, fullname=:fullname, password=:password, phone=:phone, email=:email, role=:role";
        $stmt = $this->conn->prepare($query);

        // Vệ sinh đầu vào
        $username = htmlspecialchars(strip_tags($username));
        $fullName = htmlspecialchars(strip_tags($fullName));
        $password = password_hash($password, PASSWORD_BCRYPT);
        $phone = htmlspecialchars(strip_tags($phone));
        $email = htmlspecialchars(strip_tags($email));
        $role = htmlspecialchars(strip_tags($role));

        // Gắn tham số
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":fullname", $fullName);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":phone", $phone);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":role", $role);

        // Thực thi câu lệnh
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Lỗi khi lưu tài khoản: " . $e->getMessage());
            return false;
        }
    }

    public function updateAccount($id, $username, $fullname, $password = null, $role = 'user')
    {
        if ($password) {
            $query = "UPDATE " . $this->table_name . " 
                     SET username = :username, fullname = :fullname, 
                         password = :password, role = :role 
                     WHERE id = :id";
        } else {
            $query = "UPDATE " . $this->table_name . " 
                     SET username = :username, fullname = :fullname, role = :role 
                     WHERE id = :id";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":fullname", $fullname);
        $stmt->bindParam(":role", $role);
        $stmt->bindParam(":id", $id);

        if ($password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(":password", $hashed_password);
        }

        return $stmt->execute();
    }

    public function deleteAccount($id) 
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}