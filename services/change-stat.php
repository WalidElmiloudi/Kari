<?php

require_once '../vendor/autoload.php';

use Entities\Admin;
use Core\Database;

$id = $_GET['id'];
$action = $_GET['action'];
$target = $_GET['target'];

$pdo = Database::getInstance();

switch($target) {
    case 'users' : switch($action) {
                       case 'activate' : $is_done = Admin::activateUser($pdo,$id);
                                         break;
                       case 'deactivate' : $is_done = Admin::deactivateUser($pdo,$id);
                                         break;
                    }
                    break;
    case 'rentals' : switch($action) {
                       case 'activate' : $is_done = Admin::activateRental($pdo,$id);
                                         break;
                       case 'deactivate' : $is_done = Admin::deactivateRental($pdo,$id);
                                         break;
                    }
                    break;
}

if($is_done) {
    header("Location: ../views/admin-dashboard.php");
    exit;
}

die("mission failed");