<?php

session_start();
if(!isset($_SESSION['userID']) || $_SESSION['stat'] === 'inactive') {
    header("Location: ../views/index.php");
    exit;
}

require '../vendor/autoload.php';

use Core\Database;
use Core\Mailer;
use Entities\Rental;
use Entities\Booking;
use Entities\Travler;
use Entities\Notification;

$pdo = Database::getInstance();

$user_id = $_SESSION['userID'];
$user_email = $_SESSION['email'];
$rental_id = $_GET['rental_id'];
$host_id = $_GET['host_id'];
$target = $_GET['target'];
$start_date = $_POST['checkin'];
$end_date = $_POST['checkout'];

if($_SESSION['role'] != 'travler') {
    header("Location: ../views/$target.php");
    exit;
}

$rentals_bookings = Rental::getCheckInAndCheckOutDates($pdo,$rental_id);
$travler_bookings = Travler::getCheckInAndCheckOutDates($pdo,$user_id);

$rental_booked_dates = [];
$travler_booked_dates = [];
$dates = [];

foreach($rentals_bookings as $booking) {
    $start = $booking['start_date'];
    $end = $booking['end_date'];
    foreach(Booking::getDatesBetween($start, $end) as $date) {
        $rental_booked_dates[] = $date;
    }
}

foreach($travler_bookings as $booking) {
    $start = $booking['start_date'];
    $end = $booking['end_date'];
    foreach(Booking::getDatesBetween($start, $end) as $date) {
        $travler_booked_dates[] = $date;
    }
}

foreach(Booking::getDatesBetween($start_date, $end_date) as $date) {
        $dates[] = $date;
    }


$count = 1;

foreach ($dates as $date) {
    if (in_array($date, $rental_booked_dates, true)) {
        $count = 0;
        $message = 'the days the user choosed are reserved';
        break;
    }
}

foreach ($dates as $date) {
    if (in_array($date, $travler_booked_dates, true)) {
        $count = 0;
        $message = 'you already booked in another rental in these days';
        break;
    }
}


if($count != 0) {
    $booking = new Booking($rental_id,$start_date,$end_date,$user_id);
    $booking->book();
    $notification = new Notification("{$_SESSION['name']} booked a rental from You",$host_id);
    $notification->notify();
    $message = "<h1>Vous avez reserver un logement de {$start_date} a {$end_date} consultez votre page de reservations pour connaitre plus .</h1>";
    $mailer = new Mailer();
    $mailer->sendEmail('Reservation',$message,$user_email);
    header("Location: ../views/$target.php");
    exit;
} else {
    die($message);
}