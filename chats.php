<?php

    session_start();
    if(!isset($_SESSION['accountLoginSession']) and $_SESSION['accountLoginSession'] != '') {
        echo $_SESSION['accountLoginSession'];
        header("Location: index.php");
    }

    // check users added to friends and include to json, then select by js and add to array
    // check last message for every user in friendlist
    // when new friend is adding create new table on DB




?>



<!DOCTYPE html>

<html lang="PL-pl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="chat.css">
    <link rel="icon" href="src/icon.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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
                    <input id="submit" type="button" name="submitButton" value=" >" autocomplete="off" onclick="sendMessage()">
                </form>
                <!-- delete before 1.0 -->
                <label  text="">dostawaj wiadomości
                    <input type="checkbox" name="autoReceive" id="autoReceiveMessage" checked>
                </label>
            </div>
    </div>

</body>
</html>