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
use Core\Mailer;

$booking_id = $_GET['booking-id'];
$target = $_GET['target'];
$host_id = $_GET['host_id'];
$user_email = $_GET['user_email'];
$pdo = Database::getInstance();

$cancel = Booking::cancel($pdo,$booking_id);
if($cancel) {
    $notification = new Notification("{$_SESSION['name']} canceled a booking of a rental from You",$host_id);
    $notification->notify();
    $message = "<h1>Une reservation a ete annuler,consultez votre page de reservations pour connaitre plus ou contacter nous si il y'a un probleme .</h1>";
    $mailer = new Mailer();
    $mailer->sendEmail('Reservation',$message,$user_email);
    header("Location: ../views/$target.php");
    exit;
} else {
    die('mission failed');
}