<?php

require_once '../vendor/autoload.php';

use Entities\User;

session_start();

$email = $_POST['email'];
$password = $_POST['password'];

$user = new User($email,$password);

$isValide = $user->login();

if($isValide) {
    $_SESSION['userID'] = $user->getId();
    $_SESSION['role'] = $user->getRole();
    $_SESSION['name'] = $user->getName();
    $_SESSION['email'] = $user->getEmail();
    header("Location: ../views/index.php");
    exit;
}
header("Location: ../views/index.php");
exit;