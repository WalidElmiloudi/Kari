<?php

namespace Entities;

use Core\Database;

use PDO;

class Notification
{
    private string $body;
    private int $reciever_id;
    private PDO $pdo;

    public function __construct($body,$reciever_id)
    {
        $this->body = $body;
        $this->reciever_id = $reciever_id;
        $this->pdo = Database::getInstance();
    }

    public function notify(): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO  notifications (body,reciever_id) VALUES (:body,:reciever_id)");
        $stmt->execute([
          ':body' => $this->body,
          ':reciever_id' => $this->reciever_id
        ]);
        return true;
    }

    public static function getUserNotifications($user_id): array
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT * FROM notifications WHERE reciever_id = $user_id");
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function getUnseenNotificationsCount($user_id): int
    {
        $pdo = Database::getInstance();
        $stmt = $pdo->query("SELECT COUNT(*) as unseen_count FROM notifications WHERE reciever_id = $user_id AND stat = 'unseen' ");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['unseen_count'];
    }
}