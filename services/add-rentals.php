<?php
session_start();
if(!isset($_SESSION['userID']) || $_SESSION['stat'] === 'inactive') {
    header("Location: ../views/index.php");
    exit;
}

require_once '../vendor/autoload.php';

use Entities\Rental;

$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$country = $_POST['country'];
$city = $_POST['city'];
$adress = $_POST['adress'];
$user_id = $_SESSION['userID'];
if(isset($_FILES['img']) && $_FILES['img']['error'] == 0){
            $imageName = $_FILES['img']['name'];
            $imageTemp = $_FILES['img']['tmp_name'];


            $newFileName = 'listing'.time().$imageName;

            $uploadDestination = '../uploads/listings/'.$newFileName;

            if(move_uploaded_file($imageTemp , $uploadDestination)){

                $img = '../uploads/listings/'.$newFileName;
            }else{
                exit;
            }
        }
$rental = new Rental($title,$description,$country,$city,$adress,$price,$img,$user_id);

$is_added = $rental->add();

if($is_added) {
  header("Location: ../views/rentals.php");
  exit;
} else {
  die("mission failed");
}