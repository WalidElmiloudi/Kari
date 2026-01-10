<?php

namespace Entities;

use Core\Database;

use PDO;

class Favorite
{
    private int $rental_id;
    private int $user_id;
    private PDO $pdo;

    public function __construct($rental_id,$user_id)
    {
        $this->rental_id = $rental_id;
        $this->user_id = $user_id;
        $this->pdo = Database::getInstance();
    }

    public function add(): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO favorites (rental_id,user_id) VALUES (:rental_id,:user_id)");
        $stmt->execute([
            ':rental_id' => $this->rental_id,
            ':user_id' => $this->user_id
        ]);
        return true;
    }

    public function delete(): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM favorites  WHERE rental_id = :rental_id AND user_id = :user_id");
        $stmt->execute([
            ':rental_id' => $this->rental_id,
            ':user_id' => $this->user_id
        ]);
        return true;
    }

    public static function getAllFavorites($pdo,$user_id): array
    {
        $stmt = $pdo->query("SELECT f.id as favorite_id,
                                    f.date,
                                    r.id as rental_id,
                                    r.img,
                                    r.title,
                                    r.city,
                                    r.adress,
                                    r.price
                             FROM favorites f 
                             JOIN rentals r ON f.rental_id = r.id 
                             WHERE f.user_id = $user_id");
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function isFavorite(): bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM favorites WHERE rental_id = :rental_id AND user_id = :user_id");
        $stmt->execute([
                                 ':rental_id' => $this->rental_id,
                                 ':user_id' => $this->user_id
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)) {
            return true;
        }
        return false;
    }

    public static function deleteAll($user_id): bool
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("DELETE FROM favorites  WHERE user_id = :user_id");
        $stmt->execute([
            ':user_id' => $user_id
        ]);
        return true;
    }

    public static function getCount($user_id): int
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->prepare("SELECT COUNT(*) as favorite_count FROM favorites  WHERE user_id = :user_id");
        $stmt->execute([
            ':user_id' => $user_id
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['favorite_count'];
    }
}