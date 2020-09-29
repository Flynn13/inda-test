<?php

namespace App\Repositories;

use Core\Database;

abstract class Repository {

    /**
     * @var \PDO
     */
    protected $db;

    public function __construct() {
        $this->db = (new Database())->db;
    }

    public function __destruct() {
        $this->db = null;
    }
}