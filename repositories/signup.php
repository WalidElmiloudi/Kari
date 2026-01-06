<?php

require_once  '../vendor/autoload.php';

use Entities\User;

$email = $_POST['email'];
$name = $_POST['name'];
$role = $_POST['roles'];
$password = $_POST['password'];

$user = new User($email,$password);

$isRegistered = $user->register($name,$role);

if($isRegistered){
  header("Location: ../views/index.php");
  exit;
}