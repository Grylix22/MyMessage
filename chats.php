<?php

session_start();
if (!isset($_SESSION['accountLoginSession']) and $_SESSION['accountLoginSession'] != '') {
    header("Location: index.php");
}


$userID = $_SESSION['accountLoginSession'];
echo $_SESSION['user_id'];
require_once "DBconnect.php";
try {
    ini_set('display_errors', 'Off');
    $DBconnect = new mysqli($host, $db_user, $db_password, $db_name);
    $q = "SELECT friend_id FROM friends_list WHERE user_id = '$userID'";
    $result = $DBconnect->real_escape_string($q);
    $result = $DBconnect->query($q);
    $friendList = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $friendList[] = $row['friend_id'];
        }
    }
    $friendListJSON = json_encode($friendList);
    $file = fopen('data/friendlist.json', 'w');
    fwrite($file, $friendListJSON);
    fclose($file);


    // here code packing friends logins to data/friendlogins.json
    $connection = mysqli_connect($host, $db_user, $db_password, $db_name);
    if (!$connection) {
        die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
    }

    $friendlistIds = '';
    $leng = count($friendList);
    for ($i = 0; $i < $leng; $i++) {
        if ($i < $leng - 1) {
            $friendlistIds .= '"' . $friendList[$i] . '", ';
        } else {
            $friendlistIds .= '"' . $friendList[$i] . '"';
        }
    }
    $friendlistIds = rtrim($friendlistIds, ', ');

    $query = "SELECT login FROM accounts WHERE id IN ($friendlistIds)";
    $result = $connection->query($query);
    $friendLogins = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $friendLogins[] = $row['login'];
        }
    }

    $data = json_encode($friendLogins);
    $file = fopen('data/friendLogins.json', 'w');
    fwrite($file, $data);
    fclose($file);

} catch (Exception $error_connection) {
    $_SESSION['error'] = "Błąd serwera: " . $error_connection;
}
?>

<!DOCTYPE html>

<html lang="PL-pl" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="chat.css">
    <link rel="icon" href="src/icon.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Chaty - MyMess</title>


    <script src="scripts.js" defer></script>
    <script src="messanges-control.js" defer></script>
</head>



<body>
    <nav class="navbar">
        <div class="logo">
            <content id="logo-fst">M</content>
            <content id="logo-snd">M</content>
        </div>
        <span class="material-icons menu" alt="menu">menu</span>
        <div class="nav-links">
            <ul>
                <li><a href="index.php">Strona główna</a></li>
                <li><a href="settings.php">Ustawienia</a></li>
                <li><a href="logout.php">Wyloguj</a></li>
            </ul>
        </div>
    </nav>


    <div class="clearfix"></div>
    <!-- TODO:
            add list accounts who sended friend request
            load every friends and his messages database-->

    <div class="content">
        <div class="chatsContainer">
            <div id="chatList">
            </div>
        </div>

        <div id="chatStory">
            <!-- chat container -->
        </div>
        <div id="submitMessagePanel">
            <form type="input">
                <input id="textInput" type="text" phaceholder="Aa">
                <input id="submit" type="button" name="submitButton" value=" >" autocomplete="off"
                    onclick="sendMessage()">
            </form>
            <!-- delete before 1.0 -->
            <label text="">dostawaj wiadomości
                <input type="checkbox" name="autoReceive" id="autoReceiveMessage" checked>
            </label>
        </div>
    </div>
</body>

</html>