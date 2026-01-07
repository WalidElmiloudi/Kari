<?php

require_once "../vendor/autoload.php";

use Entities\Rental;

$id = $_POST['rental_id'];
$action = $_GET['action'];

$rental = new Rental('','','','','',0,'',0);

if($action === 'activate') {
    $checked = $rental->activateRental($id) ;
}

if($action === 'deactivate') {
    $checked = $rental->deactivateRental($id) ;
}

if($checked) {
    header("Location: ../views/rentals.php");
    exit;
}
die("mission failed");