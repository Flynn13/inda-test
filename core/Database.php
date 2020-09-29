<?php

namespace Core;

use PDO;
use PDOException;

class Database {

    /**
     * @var PDO
     */
    public $db;

    public function __construct() {

        $connection = getenv('DB_CONNECTION');
        $host = getenv('DB_HOST');
        $database = getenv('DB_DATABASE');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');

        try {
            $this->db = new PDO("$connection:host=$host;dbname=$database", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}