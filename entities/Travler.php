<?php

namespace Entities;

require 'vendor/autoload.php';

use Entities\User;
use PDO;

class Travler extends User
{
    public function getBooking(): ?array
    {
        $stmt = $this->pdo->query("SELECT * FROM bookings WHERE user_id = $this->id");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }
}
