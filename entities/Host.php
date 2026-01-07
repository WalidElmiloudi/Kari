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

    public static function getActiveRentalsCount($pdo,$user_id): array
    {
        $stmt = $pdo->query("SELECT COUNT(*) as active_rentals FROM rentals WHERE user_id = $user_id AND statut = 'active'");
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    public static function getRentalsCount($pdo,$user_id): array
    {
        $stmt = $pdo->query("SELECT COUNT(*) as total_rentals FROM rentals WHERE user_id = $user_id");
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
}
