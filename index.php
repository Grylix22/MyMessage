<?php
    session_start();
    //temporart to not need login every time as start working at project. Before dev delete 2 lines under comment
    $_SESSION['user_id'] = '';
    $_SESSION['accountLoginSession'] = "admin";
    if(isset($_SESSION['accountLoginSession']) and $_SESSION['accountLoginSession'] != '') {
        header("Location: chats.php");
    }

?>

<!DOCTYPE html>

<html lang="PL-pl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="src/icon.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>MyMess</title>


    <script src="scripts.js" defer></script>
</head>


<body style="height:100vh">
    <nav class="navbar">
        <div class="logo">
            <content id="logo-fst">M</content>
            <content id="logo-snd">M</content>
        </div>
        <span class="material-icons menu" alt="menu">menu</span>
        <div class="nav-links">
            <ul>
                <li><a href="index.html">Strona główna</a></li>
                <li><a href="settings.php">Ustawienia</a></li>
                <li><a href="log-in.php">Zaloguj</a></li>
            </ul>
        </div>
    </nav>


    <div class="clearfix"></div>


    <div class="content"> 
            <div class="panel">
                <div style="margin-top: 200px;"></div>
                <a href="register.php" style="text-decoration: none; font-weight: bold;"> Zarejestruj się</a></p>
                <p style="font-size: 50px;">Lub jeżeli posiadasz konto
                <a href="log-in.php" style="text-decoration: none; font-weight: bold;"> Zaloguj się</a>.</p>
                
            </div>
    </div>

</body>
</html>