<?php

namespace Entities;

require 'vendor/autoload.php' ;

use Entities\Database ;
use PDO;

class Review
{
    private int $rental_id ;
    private int $user_id ;
    private PDO $pdo ;

    public function __construct($rental_id,$user_id)
    {
        $this->rental_id = $rental_id ;
        $this->user_id = $user_id ;
        $this->pdo = Database::getInstance();
    }

    public function addRate($rate,$note): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO reviews (rate,note,rental_id,user_id) VALUES (:rate,:note,:rental_id,:user_id)");
        $stmt->execute([
            ':rate' => $rate,
            ':note' => $note,
            ':rental_id' => $this->rental_id,
            ':user_id' => $this->user_id
        ]);
        return true;
    }

    public function deleteRate($review_id): bool
    {
        $this->pdo->query("DELETE FROM reviews WHERE id = $review_id");
        return true;
    }

    public function getAverageRate(): float
    {
        $stmt = $this->pdo->query("SELECT AVG(rate) as average_rate FROM reviews WHERE rental_id = $this->rental_id");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['average_rate'];
    }

    public function getAllReviews(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM reviews WHERE rental_id = $this->rental_id");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}