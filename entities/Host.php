<?php

namespace Entities;

require 'vendor/autoload.php';

use Entities\User;
use PDO;

class Host extends User
{
    public function getAllRentals(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM rentals WHERE user_id = $this->id");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
