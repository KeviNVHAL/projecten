<?php
session_start();
include_once "databaseconectie.php";

global $dbConnectie;
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['submit'])) {
    $query = $dbConnectie->prepare("
        UPDATE profiel
        SET username = :phUsernaMe, password = :phPassword, email = :phEmail
        WHERE username = :phUsername
    ");
    $query->execute([
        "phUsernaMe" => $_POST['username'],
        "phPassword" => $_POST['password'],
        "phEmail" => $_POST['email'],
        "phUsername" => $_SESSION['username']
    ]);

}


$query = $dbConnectie->prepare("
    SELECT * FROM profiel WHERE username = :phUsername
");
$query->execute([
    "phUsername" => $_SESSION['username']
]);
$profiel = $query->fetch(PDO::FETCH_ASSOC);
?>

<head>
    <link rel="stylesheet" href="form.css">
</head>

<h1>Edit profile</h1>
<div class="container">
    <form class="login-form" method="post" action="">
        <label for="voornaam">username:</label>
        <input type="text" name="username" value="<?php echo $profiel['username']; ?>"><br>

        <label for="achternaam">password:</label>
        <input type="text" name="password" value="<?php echo $profiel['password']; ?>"><br>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $profiel['email']; ?>"><br>

        <div class="button-container">
            <input type="submit" name="submit" value="Save changes">
        </div>
        <div class="link-container">
            <a href="home.php">back</a>
        </div>
        <div style="clear: both;"></div>
    </form>
</div>





