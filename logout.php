<?php
     session_start();
    if(isset($_SESSION['accountLoginSession']) and $_SESSION['accountLoginSession'] != '') {
        unset($_SESSION['accountLoginSession']);
        header("refresh: 2; url = index.php");
    }
?>




<!DOCTYPE html>

<html lang="PL-pl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="register.css">
    <link rel="icon" href="src/icon.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>MyMess</title>


    <script src="scripts.js"></script>
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
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </nav>


    <div class="clearfix"></div>


    <div class="content"> 
                <p class="logoutP">Trwa wylogowywanie...</p>
    </div>

</body>
</html>