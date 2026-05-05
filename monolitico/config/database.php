<?php
class Database
{
    private const HOST = '127.0.0.1';
    private const DB_NAME = 'gestor_historias_db';
    private const USER = 'root';
    private const PASS = '';

    public static function connect(): PDO
    {
        try {
            $dsn = 'mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME . ';charset=utf8mb4';
            return new PDO($dsn, self::USER, self::PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
    }
}
