<?php
session_start();
?>
<head>
    <title>home</title>
    <link rel="stylesheet" href="home.css">
</head>

<img src="../afbeeldingen/twotter.png" alt="Logo" style="position: absolute; top: 20px; left: 20px; width: 200px; height: 200px;">
<form method="POST" class="tweetten">
    <input type="text" name="tweetInput">
    <br><br>
    <input type="submit" name="submit">
</form>
<div class="sidebar">
    <a href="home.php"><span class="oval">home</span></a><br>
    <?php
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo '<a href="logout.php"><span class="oval">logout</span></a><br>';
        echo '<a href="editprofile.php"><span class="oval">' . $username . '</span></a><br>';

    } else {
        echo '<a href="login.php"><span class="oval">login</span></a><br>';
        echo '<a href="register.php"><span class="oval">register</span></a><br>';
    }
    ?>
</div>

<?php
include_once "databaseconectie.php";

global $dbConnectie;

if(isset($_SESSION['username'])){
    $voorbereideQuery = $dbConnectie->prepare("
        SELECT *, (SELECT username FROM profiel WHERE id = tweets.user_id) AS username 
        FROM tweets;
    ");
    $voorbereideQuery->execute([]);
    $data = $voorbereideQuery->fetchAll(PDO::FETCH_ASSOC);

    foreach ($data as $item){
        ?>
        <div class="tweet-container">
            <div class="DeTweet">
                <?php echo $item["username"]?><br>
                <?php echo $item["inhoud"]?><br>
                <br>
            </div>
            <div>
            <?php
            if ($_SESSION['username'] == $item["username"]) {
                echo '<form method="POST"><button type="submit" name="delete" value="' . $item["id"] . '" class="delete-btn">delete</button></form>';
            }
            ?>
        </div>
        </div>
        <?php
    }
}

if(isset($_POST["submit"])){
    $query = $dbConnectie->prepare("
        INSERT INTO tweets ( inhoud, user_id)
        SELECT  :phInhoud, id
        FROM profiel
        WHERE username = :phUsername
    ");
    $query->execute([
        "phInhoud" => $_POST["tweetInput"],
        "phUsername" => $_SESSION['username']
    ]);

    header("Refresh:0");
}

if(isset($_POST["delete"])){
    $query = $dbConnectie->prepare("
        DELETE FROM tweets 
        WHERE id = :phId
    ");
    $query->execute([
        "phId" => $_POST["delete"]
    ]);

    header("Refresh:0");
}
?>