<?php

require_once 'config.php';
require_once 'Card.php';
global $db;

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    die();
}

if (!isset($_SESSION['game'])) {
    $_SESSION['game'] = [];
}else{
    $game = $_SESSION['game'];
}

header("refresh:5");
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>UNO - Waiting</title>
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
    <h6 class="display-6">UNO - Login</h6>
</div>
<?php
if (!empty($error)) {
    echo '<h2 class="alert alert-warning d-flex align-items-center" role="alert">' . $error . "</h2>";
}
?>
<form method="post">



</form>
</body>
</html>
