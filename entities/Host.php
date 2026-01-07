<?php

namespace Entities;

use Entities\User;
use Core\Database;
use PDO;

class Host extends User
{
    public static function getAllRentals($user_id): array
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT * FROM rentals WHERE user_id = $user_id");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
