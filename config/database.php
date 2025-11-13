<?php
// Database Configuration
class DatabaseConfig {
    const HOST = 'localhost';
    const DB_NAME = 'glr_collabs';
    const USERNAME = 'db85206';  
    const PASSWORD = 'VICTUS2606';      
    const CHARSET = 'utf8mb4';

    public static function getDSN() {
        return "mysql:host=" . self::HOST . ";dbname=" . self::DB_NAME . ";charset=" . self::CHARSET;
    }
}

// PDO Database Connection
class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $this->connection = new PDO(
                DatabaseConfig::getDSN(), 
                DatabaseConfig::USERNAME, 
                DatabaseConfig::PASSWORD, 
                $options
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>