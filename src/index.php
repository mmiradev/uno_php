<?php

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    die();
}else{
    if(!isset($_SESSION['game'])) {
        header('Location: lobby.php');
        die();
    }
}