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

if (!isset($game['id'])) {
    $game['id'] = 0;
}

$color = [Card::BLUE, Card::RED, Card::GREEN, Card::YELLOW];
shuffle($color);
$color_selected = $color[0];

// Procesar formulario
if (isset($_POST['newGame'])) {
    $query = $db->prepare('INSERT INTO game (active, finished, direction, pending_color_selection, active_color, round_number) VALUES (1, 0, "clockwise", 0, :color, 1)');
    $query->bindValue(':color', $color_selected, PDO::PARAM_STR);
    $query->execute();
}

if (isset($_POST['enterGame'])) {
    $active = 1;
    $query = $db->prepare('SELECT id FROM game WHERE active = :active LIMIT 1');
    $query->bindValue(':active', $active, PDO::PARAM_INT);
    $query->execute();
    $game['id'] = $query->fetch(PDO::FETCH_ASSOC);

    $_SESSION['game_id'] = $game['id'];
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
        form {
            width: 70%;
            margin: 5em auto;
        }

        .navbar {
            width: 100%;
            margin: 0 auto;
        }

        h6{
            color: white;
        }

        a {
            text-decoration: none;
            color: white;
            margin: 1em auto;
        }

        a:hover {
            text-decoration: none;
            color: white;
        }

    </style>
</head>
<body>
<div class="navbar navbar-expand-lg navbar-dark bg-dark">
    <h6 class="display-6">UNO - Lobby</h6>
</div>
<div class="container">
    <h3 class="row">Let's play!</h3>
    <h5 class="row">Do you want to join a game or do you prefere to create a new one?</h5>
    <form method="post" class="row">
        <button type="submit" class="btn btn-primary" name="newGame"><a href="waiting.php?id=<?php $game['id']; ?>" ><i class='bx bx-plus'></i> Create new game</a></button>
        <button type="submit" name="enterGame" class="btn btn-info"><a href="waiting.php?id=<?php $game['id']; ?>"><i class='bx bx-user-plus' ></i> Enter game</a></button>
    </form>
</div>
</body>
</html>
