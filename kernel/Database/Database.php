<?php

namespace App\Kernel\Database;

use App\Kernel\Config\ConfigInterface;

class Database implements DatabaseInterface
{
    private \PDO $pdo;

    public function __construct(
        private ConfigInterface $config,
    ) {
        $this->connect();
    }

    public function insert(string $table, array $data): int|false
    {
        $fields = array_keys($data);

        $columns = implode(', ', $fields);
        $binds = implode(', ', array_map(fn ($field) => ":$field", $fields));

        //INSERT INTO tableName (name, field2) VALUES (:name, :field2)
        $sql = "INSERT INTO $table ($columns) VALUES ($binds)";
        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (\PDOException $exception) {
            return false;
        }

        return (int) $this->pdo->lastInsertId();

    }

    public function select(string $table, array $conditions = []): ?array
    {
        $where = '';

        if (count($conditions) > 0) {
            $where = 'WHERE '.implode(' AND ', array_map(fn ($field) => "$field = :$field", array_keys($conditions)));
        }

        $sql = "SELECT * FROM $table $where LIMIT 1";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($conditions);

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    private function connect(): void
    {
        $driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        $port = $this->config->get('database.port');
        $database = $this->config->get('database.database');
        $username = $this->config->get('database.username');
        $password = $this->config->get('database.password');
        $charset = $this->config->get('database.charset');

        try {
            $this->pdo = new \PDO("$driver:host=$host;port=$port;dbname=$database;charset=$charset", $username, $password);
        } catch (\PDOException $exception) {
            exit("Database connection failed: {$exception->getMessage()}");

        }
    }
}
