<?php

declare(strict_types=1);

namespace App\Core\Repository;

use PDO;
use App\Core\Database\Database;

abstract class BaseRepository
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::connection();
    }
}
