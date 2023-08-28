<!DOCTYPE html>
<html>
<head>
    <title>register</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
<div class="container">
    <form class="login-form" method="post" action="">
        <?php

        include_once "databaseconectie.php";
        global $dbConnectie;

        if (isset($_POST['inloggen'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $query = $dbConnectie->prepare(
                "SELECT * FROM profiel WHERE username = :user"
            );
            $query->bindParam(":user", $username);
            $query->execute();

            if ($query->rowCount() > 0) {
                echo '<p class="error-message">Gebruikersnaam bestaat al!</p>';
            } else {
                $insertQuery = $dbConnectie->prepare(
                    "INSERT INTO profiel (username, password) VALUES (:user, :pass)"
                );
                $insertQuery->bindParam(":user", $username);
                $insertQuery->bindParam(":pass", $password);
                $insertQuery->execute();

                echo '<p class="success-message">Gebruiker toegevoegd!</p>';
            }
        }
        ?>
        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <input type="submit" name="inloggen" value="register"><br>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>

    </form>
</div>

</body>
</html>