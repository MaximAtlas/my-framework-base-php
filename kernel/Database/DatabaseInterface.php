<?php

namespace App\Kernel\Database;

interface DatabaseInterface
{
    public function insert(string $table, array $data): int|false;

    public function select(string $table, array $conditions = []): ?array;
}
