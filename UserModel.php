<?php
class UserModel {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "db_login");
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function checkLogin($username, $password) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM users WHERE username = ? AND password = ?"
        );
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>