<?php

namespace Entities;

require 'vendor/autoload.php';

use Core\Database;

use PDO;

class Rental
{
    private string $country;
    private string $city;
    private float $price;
    private string $img;
    private string $statut;
    private int $user_id;
    private PDO $pdo;

    public function __construct($country,$city,$price,$img,$statut,$user_id)
    {
        $this->country = $country;
        $this->city = $city;
        $this->price = $price;
        $this->img = $img;
        $this->statut = $statut;
        $this->user_id = $user_id;
        $this->pdo = Database::getInstance();
    }

    public function add(): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO rentals (country,city,price,img,statut,user_id) VALUES (:country,:city,:price,:img,:statut,:user_id)");
        $stmt->execute([
            ':country' => $this->country,
            ':city' => $this->city,
            ':price' => $this->price,
            ':img' => $this->img,
            ':statut' => $this->statut,
            ':user_id' => $this->user_id
        ]);
        return true;
    }

     public function update($rental_id): bool
    {
        $stmt = $this->pdo->prepare("UPDATE rentals SET country = :country , city = :city , price = :price , img = :img , statut = :statut , user_id = :user_id WHERE id = $rental_id");
        $stmt->execute([
            ':country' => $this->country,
            ':city' => $this->city,
            ':price' => $this->price,
            ':img' => $this->img,
            ':statut' => $this->statut,
            ':user_id' => $this->user_id
        ]);
        return true;
    }

    public function delete($rental_id): bool
    {
        $this->pdo->query("DELETE FROM rentals WHERE id = $rental_id");
        return true;
    }

    public function dispalyAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM rentals");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }
}