<?php

require_once '../vendor/autoload.php';

use Entities\Admin;
use Entities\Notification;
use Entities\Rental;
use Core\Database;

$id = $_GET['id'];
$action = $_GET['action'];
$target = $_GET['target'];

$pdo = Database::getInstance();

switch($target) {
    case 'users' : switch($action) {
                       case 'activate' : $is_done = Admin::activateUser($pdo,$id);
                                         $notification = new Notification('Votre Compte a ete activée',$id);
                                         break;
                       case 'deactivate' : $is_done = Admin::deactivateUser($pdo,$id);
                                         $notification = new Notification('Votre Compte a ete suspendée',$id);
                                         break;
                    }
                    break;
    case 'rentals' : $host = Rental::getRentalOwner($id);
                     switch($action) {
                       case 'activate' : $is_done = Admin::activateRental($pdo,$id);
                                        $notification = new Notification('Votre logement a ete avtivée',$host['id']);
                                         break;
                       case 'deactivate' : $is_done = Admin::deactivateRental($pdo,$id);
                                        $notification = new Notification('Votre logement a ete suspendée',$host['id']);
                                         break;
                     }
                     break;
}

if($is_done) {
    $notification->notify();
    header("Location: ../views/admin-dashboard.php");
    exit;
}

die("mission failed");