<?php

declare(strict_types=1);

namespace HighBornHoney\BlogEngine\Models;

use HighBornHoney\BlogEngine\Core\Database;
use PDO;

class BaseModel
{
    protected static function db(): PDO
    {
        return Database::connect();
    }
}
