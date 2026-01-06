<?php

namespace Entities;

require 'vendor/autoload.php';

use Entities\User;
use PDO;

class Admin extends User
{
    public function activateUser($target_id): bool
    {
        $this->pdo->query("UPDATE users SET statut = 'active' WHERE id = $target_id");
        return true;
    }

    public function deactivateUser($target_id): bool
    {
        $this->pdo->query("UPDATE users SET statut = 'blocked' WHERE id = $target_id");
        return true;
    }

    public function activateRental($rental_id): bool
    {
        $this->pdo->query("UPDATE rentals SET statut = 'active' WHERE id = $rental_id");
        return true;
    }

    public function deactivateRental($rental_id): bool
    {
        $this->pdo->query("UPDATE rentals SET statut = 'blocked' WHERE id = $rental_id");
        return true;
    }

    public function cancelBooking($booking_id): bool
    {
        $this->pdo->query("DELETE FROM bookings WHERE id = $booking_id");
        return true;
    }
}
