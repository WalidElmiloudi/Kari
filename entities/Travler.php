<?php

namespace Entities;

use Entities\User;
use PDO;

class Travler extends User
{
    public static function getBooking($pdo,$id): array
    {
        $stmt = $pdo->query("SELECT b.id as booking_id,
                                    b.start_date,
                                    b.end_date,
                                    b.statut,
                                    r.id as rental_id,
                                    r.user_id as host_id,
                                    r.img,
                                    r.title,
                                    r.city,
                                    r.adress,
                                    r.price,
                                    u.name
                                    FROM bookings b 
                                    JOIN rentals r ON b.rental_id = r.id 
                                    JOIN users u ON r.user_id = u.id 
                                    WHERE b.user_id = $id
                                    ORDER BY b.statut ");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    public static function getBookingCount($pdo,$id,$statut): int
    {
        $stmt = $pdo->query("SELECT COUNT(*) as booking_count FROM bookings WHERE user_id = $id AND statut = '$statut'");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['booking_count'];
    }

    public static function getCheckInAndCheckOutDates($pdo,$user_id): array
    {
        $stmt = $pdo->query("SELECT start_date,end_date FROM bookings WHERE user_id= $user_id AND statut = 'active'");
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $results;
    }
}
