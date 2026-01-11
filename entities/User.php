<?php

namespace Entities;

use Core\Database;

use PDO;

class User 
{
    protected int $id;
    protected string $name;
    protected string $email;
    private string $password;
    private string $role;
    protected PDO $pdo;

    public function __construct($email,$password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->pdo = Database::getInstance();
    }

    public function register($name,$role_id): bool
    {
        $this->name = $name;
        $hashed_password = password_hash($this->password,PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute([':email' => $this->email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if(empty($user)){
            $stmt = $this->pdo->prepare("INSERT INTO users (name,email,password,role_id) VALUES (:name,:email,:password,:role_id)");
            $stmt->execute([
                           ':name'=>$this->name,
                           ':email' => $this->email,
                           ':password' =>$hashed_password,
                           ':role_id' =>$role_id
            ]);
            return true;
        } else{
            return false;
        }
    }

    public function login(): bool
    {
      $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
      $stmt->execute([':email' => $this->email]);
      $user = $stmt->fetch(PDO::FETCH_ASSOC);
      if(!empty($user)){
          if(password_verify($this->password,$user['password'])){
              $this->name = $user['name'];
              $this->id = $user['id'];
              $stmt = $this->pdo->query("SELECT r.role FROM roles r JOIN users u ON u.role_id = r.id WHERE u.id = $this->id");
              $role = $stmt->fetch(PDO::FETCH_ASSOC);
              $this->role = $role['role'];
              return true;
          } else{
              return false;
          }
      } else{
          return false;
      }
    }
    public static function logout(): void
    {
        session_start();
        session_destroy();
        session_unset();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}

// $user = new User('admin@gmail.com','test1234');

// $user->register('Admin Tester',3);