<?php
require_once __DIR__ . '/../config/database.php';

abstract class BaseModel
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    abstract public function find(int $id): ?array;
    abstract public function delete(int $id): bool;
}
