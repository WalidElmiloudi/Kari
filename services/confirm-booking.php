<?php

require_once 'C:xampp/htdocs/Kari/vendor/autoload.php';

use Entities\Booking;

$bookings = Booking::getAll();

$booking_id = [];

$date = new DateTime();

$current_date =  $date->format('Y-m-d') ;

foreach($bookings as $booking) {
    if($booking['end_date'] === $current_date) {
      $is_confirmed = Booking::confirm($booking['id']);
    }
}