<?php

session_start();
if(!isset($_SESSION['userID']) || $_SESSION['stat'] === 'inactive') {
    header("Location: ../views/index.php");
    exit;
}

require_once '../vendor/autoload.php';

use Entities\Notification;
use Entities\Booking;
use Core\Database;

$booking_id = $_GET['booking-id'];
$target = $_GET['target'];
$host_id = $_GET['host_id'];
$pdo = Database::getInstance();

$cancel = Booking::cancel($pdo,$booking_id);
if($cancel) {
    $notification = new Notification("{$_SESSION['name']} canceled a booking of a rental from You",$host_id);
    $notification->notify();
    header("Location: ../views/$target.php");
    exit;
} else {
    die('mission failed');
}