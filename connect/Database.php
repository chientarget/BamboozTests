<?php
class Database {

    static function Connect() {
        ini_set("display_errors", 1);
        $host = "localhost";
        $port = 6060;
        $username = "root";
        $password = "";
        $dbname = "bambooz_db";
        // Khởi tạo kết nối
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname";
        $pdo = new PDO($dsn, $username, $password);
        return $pdo;
    }

    static function testConnection() {
        try {
            $pdo = self::Connect();
            echo "Kết nối thành công đến cơ sở dữ liệu";
            return $pdo != null;
        } catch (Exception $e) {
            echo "Lỗi kết nối đến cơ sở dữ liệu: " . $e->getMessage();
            return false;
        }
    }
}
?>
