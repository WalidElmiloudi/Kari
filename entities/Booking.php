<?php

namespace Entities;

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
            ':start_date' => $this->start_date,
            ':end_date' => $this->end_date,
            ':rental_id' => $this->rental_id,
            ':user_id' => $this->user_id
        ]);
        return true;
    }

    public static function cancel($pdo,$booking_id): bool
    {
        $pdo->query("UPDATE bookings SET statut = 'canceled' WHERE id = $booking_id");
        return true;
    }

    public static function confirm($booking_id): bool
    {
        $pdo = Database::getInstance();
        $pdo->query("UPDATE bookings SET statut = 'completed' WHERE id = $booking_id");
        return true;
    }

    public static function getDatesBetween($start, $end): array
    {
    $dates = [];
    $current = new \DateTime($start);
    $endDate = new \DateTime($end);

    while ($current <= $endDate) {
        $dates[] = $current->format('Y-m-d');
        $current->modify('+1 day');
    }

    return $dates;
   }

   public static function getAll(): array
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT * FROM bookings");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}