<?php

require_once '../vendor/autoload.php' ;

use Entities\User;

if(isset($_GET['target'])) {
    $target = $_GET['target'];
} else {
    $target = 'index';
}


User::logout();

header("Location: ../views/$target.php");
exit;