<?php

namespace Entities;

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

    public static function getUsersCount($pdo): int
    {
        $stmt = $pdo->query("SELECT COUNT(*) as total_users FROM users");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_users'];
    }

    public static function getActiveRentalsCount($pdo): int
    {
        $stmt = $pdo->query("SELECT COUNT(*) as total_rentals FROM rentals WHERE statut = 'active'");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_rentals'];
    }

    public static function getBookingsCount($pdo): int
    {
        $stmt = $pdo->query("SELECT COUNT(*) as total_bookings FROM bookings WHERE statut != 'canceled'");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_bookings'];
    }

    public static function getAllUsers($pdo): array
    {
        $stmt = $pdo->query("SELECT u.*,r.role as role_name FROM users u JOIN roles r ON u.role_id = r.id");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results; 
    }

    public static function getAllRentals($pdo): array
    {
        $stmt = $pdo->query("SELECT r.*,u.name as host,COUNT(b.id) as total_bookings 
                             FROM rentals r
                             JOIN users u ON r.user_id = u.id
                             JOIN bookings b ON b.rental_id = r.id
                             GROUP BY r.id");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results; 
    }

    public static function getAllBookings($pdo): array
    {
        $stmt = $pdo->query("SELECT b.*,u.name as travler,u.email,r.img,r.title
                             FROM bookings b
                             JOIN users u ON b.user_id = u.id
                             JOIN rentals r ON b.rental_id = r.id;");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results; 
    }
}
