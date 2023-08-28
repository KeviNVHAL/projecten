<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
<div class="container">
    <form class="login-form" method="post" action="login.php">
        <?php
        include_once "databaseconectie.php";

        global $dbConnectie;

        if (isset($_POST['inloggen'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = $dbConnectie->prepare("SELECT * FROM profiel WHERE username = :user AND password = :pass");
            $query->bindParam(":user", $username);
            $query->bindParam(":pass", $password);
            $query->execute();

            if ($query->rowCount() > 0) {
                $_SESSION['username'] = $username;
                header("Location: home.php");
                exit;
            } else {
                echo '<p class="error-message">Inloggegevens zijn onjuist!</p>';
            }
        }
        ?>
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <input type="submit" name="inloggen" value="Inloggen">
    </form>
</div>
</body>
</html>
