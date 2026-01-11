<?php

session_start();
if(!isset($_SESSION['userID']) || $_SESSION['stat'] === 'inactive') {
    header("Location: ../views/index.php");
    exit;
}

require_once '../vendor/autoload.php';

use Entities\Favorite;

$rental_id = $_GET['rental_id'];
$action = $_GET['action'];
$target = $_GET['target'];
$user_id = $_SESSION['userID'];

$favorite = new Favorite($rental_id,$user_id);

switch($action) {
    case 'add'        : $is_done = $favorite->add();
                        break;
    case 'delete'     : $is_done = $favorite->delete();
                        break;
    case 'delete-all' : $is_done = Favorite::deleteAll($user_id);
                        break;
}

if($is_done) {
    header("Location: ../views/$target.php");
    exit;
} else {
    die("mission failed");
}