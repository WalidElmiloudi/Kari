<?php

require_once '../vendor/autoload.php';

use Entities\Booking;
use Core\Database;

$booking_id = $_GET['booking-id'];
$target = $_GET['target'];
$pdo = Database::getInstance();

$cancel = Booking::cancel($pdo,$booking_id);
if($cancel) {
    header("Location: ../views/$target.php");
    exit;
} else {
    die('mission failed');
}