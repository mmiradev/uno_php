<?php
require_once 'config.php';
global $db;

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    die();
}

if(!isset($_SESSION['game'])) {
    $_SESSION['game'] = new Game();
    $game = $_SESSION['game'];
}

//Process form
if (isset($_POST['newGam'])) {
    $querue = $db->prepare('insert into game values (1, 0, );');
}

?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>UNO - Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        form{
            width: 70%;
            margin: 5em auto;
        }

        .navbar{
            width: 100%;
            margin: 0 auto;
        }

        h6{
            color: white;
        }

        a{
            margin: 1em auto;
        }
    </style>
</head>
<body>
<div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <h6 class="display-6">UNO - Lobby</h6>
</div>
<form method="post">
    <button type="submit" name="newGame" class="btn btn-primary">Create new game</button>
    <button type="submit" name="enterGame" class="btn btn-primary">Enter game</button>
</form>
</body>
</html>