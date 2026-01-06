<?php

namespace Entities;

require 'vendor/autoload.php';

use Core\Database;

use PDO;

class Booking
{
    private int $rental_id;
    private string $start_date;
    private string $end_date;
    private int $user_id;
    private PDO $pdo;

    public function __construct($rental_id,$start_date,$end_date,$user_id)
    {
        $this->rental_id = $rental_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->user_id = $user_id;
        $this->pdo = Database::getInstance();
    }

    public function book(): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO bookings (start_date,end_date,rental_id,user_id) VALUES (:start_date,:end_date,:rental_id,:user_id)");
        $stmt->execute([
            ':start_id' => $this->start_id,
            ':end_id' => $this->end_id,
            ':rental_id' => $this->rental_id,
            ':user_id' => $this->user_id
        ]);
        return true;
    }

    public function cancel($booking_id): bool
    {
        $this->pdo->query("DELETE FROM bookings WHERE id = $booking_id");
        return true;
    }
}