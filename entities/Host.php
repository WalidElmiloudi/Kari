<?php

namespace Entities;

class Host
{
    public static function getAllRentals($pdo,$user_id): array
    {
        $stmt = $pdo->query("SELECT * FROM rentals WHERE user_id = $user_id");
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public static function getActiveRentalsCount($pdo,$user_id): int
    {
        $stmt = $pdo->query("SELECT COUNT(*) as active_rentals FROM rentals WHERE user_id = $user_id AND statut = 'active'");
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['active_rentals'];
    }

    public static function getRentalsCount($pdo,$user_id): int
    {
        $stmt = $pdo->query("SELECT COUNT(*) as total_rentals FROM rentals WHERE user_id = $user_id");
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['total_rentals'];
    }

    public static function getActiveBookingCount($pdo,$user_id): int
    {
        $stmt = $pdo->query("SELECT COUNT(b.id) as active_bookings FROM bookings b JOIN rentals r ON b.rental_id = r.id WHERE r.user_id = $user_id AND b.statut = 'active'");
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['active_bookings'];
    }

    public static function getBookingCountById($pdo,$rental_id): int
    {
        $stmt = $pdo->query("SELECT COUNT(b.id) as active_bookings FROM bookings b JOIN rentals r ON b.rental_id = r.id WHERE b.rental_id = $rental_id AND b.statut != 'canceled'");
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result['active_bookings'];
    }
}
