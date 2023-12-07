<?php
    require_once 'config.php';
    global $db;

    if (isset($_POST['login'])) {
        try {
            $username = $_POST['username'];

            $query = $db->prepare('SELECT * FROM player WHERE username=:user');
            $query->bindValue(':user', $username, PDO::PARAM_STR);
            $query->execute();

            $player = $query->fetch(PDO::FETCH_ASSOC);
            if ($player) {
                if ($player['password'] === $_POST['pass']) {
                    $_SESSION['username'] = $_POST['username'];
                    header('Location: lobby.php');
                    die();
                } else {
                    $error = 'Invalid username/password';
                }
            } else {
                $error = 'Invalid username/password';
            }
        } catch (PDOException $e) {
            $error = 'Database error: ' . $e->getMessage();
        }
    }
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>uNO - Login</title>
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
        echo "<h2>" . $error . "</h2>";
    }
    ?>
    <form method="post">
        <div class="mb-3">
            <label for="floatingInput"><i class='bx bxs-user' ></i> Username:</label>
            <input type="text" class="form-control" name="username" placeholder="Enter your username" />
        </div>
        <div class="mb-3">
            <label for="floatingPassword"><i class='bx bxs-key' ></i> Password:</label>
            <input type="password" class="form-control" name="pass" placeholder="Enter password" />
        </div>

        <button type="submit" name="login" class="btn btn-primary"><i class='bx bx-log-in'></i> Log in</button>
    </form>
</body>
</html>