<?php

namespace Entities;

use Core\Database;

use PDO;

class Rental
{
    private string $title;
    private string $description;
    private string $country;
    private string $city;
    private string $adress;
    private float $price;
    private string $img;
    private string $statut;
    private int $user_id;
    private PDO $pdo;

    public function __construct($title,$description,$country,$city,$adress,$price,$img,$user_id)
    {
        $this->title = $title;
        $this->description = $description;
        $this->country = $country;
        $this->city = $city;
        $this->adress = $adress;
        $this->price = $price;
        $this->img = $img;
        $this->user_id = $user_id;
        $this->pdo = Database::getInstance();
    }

    public function add(): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO rentals (title,description,country,city,adress,price,img,user_id) VALUES (:title,:description,:country,:city,:adress,:price,:img,:user_id)");
        $stmt->execute([
            ':title' => $this->title,
            ':description' => $this->description,
            ':country' => $this->country,
            ':city' => $this->city,
            ':adress' => $this->adress,
            ':price' => $this->price,
            ':img' => $this->img,
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

    public static function dispalyAll($pdo): array
    {
        $stmt = $pdo->query("SELECT * FROM rentals WHERE statut = 'active'");
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $results;
    }

    public function activateRental($rental_id): bool
    {
        $this->pdo->query("UPDATE rentals SET statut = 'active' WHERE id = $rental_id");
        return true;
    }

    public function deactivateRental($rental_id): bool
    {
        $this->pdo->query("UPDATE rentals SET statut = 'inactive' WHERE id = $rental_id");
        return true;
    }

    public static function getCheckInAndCheckOutDates($pdo,$rental_id): array
    {
        $stmt = $pdo->query("SELECT start_date,end_date FROM bookings WHERE rental_id = $rental_id AND statut = 'active'");
        $results = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return $results;
    }

}