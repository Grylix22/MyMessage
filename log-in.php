<?php
    session_start();
    if(isset($_SESSION['accountLoginSession']) and $_SESSION['accountLoginSession'] != '') {
        unset($_SESSION['accountLoginSession']);
        echo $_SESSION['accountLoginSession'];
        header("Location: index.php");
    }

    if(isset($_POST['submit']) and isset($_POST['login']) and isset($_POST['password'])) {
        if(ctype_alnum($_POST['login']) != true or (!isset($_POST['password']))) {
            $_SESSION['error'] = "Błędny login lub hasło";
        } else {


            // database
            $login = $_POST['login'];
            $password = $_POST['password'];
            require_once "DBconnect.php";
            try {
                $DBconnect = new mysqli($host, $db_user, $db_password, $db_name);
                $q = "SELECT id, login, password FROM accounts";

                $result = $DBconnect-> query($q);
                $userRow = $result-> num_rows;
                while($obj = $result->fetch_object()) {
                    
                    if($obj-> login == $_POST['login']) {
                        $_SESSION['error'] = "Błędny login lub hasło";
                    } else if($obj-> password == $_POST['password']) {
                        $_SESSION['error'] = "Błędny login lub hasło";
                    } else {
                        unset($_SESSION['error']);
                        $_SESSION['user_id'] = $_POST['id'];
                        $_SESSION['accountLoginSession'] = $_POST['login'];
                        header("Location: chats.php");
                    }
                }
                // website with information about succesful logging in, then set location
                // to chats.php / chats.html

            } catch(Exception $error_connection) {
                $_SESSION['error'] = "Błąd serwera" . $error_connection;
            }
        }
    }
    if(isset($_SESSION['error'])) {
        $_SESSION['error'] = '';
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
                <li><a href="log-in.php">Zaloguj</a></li>
            </ul>
        </div>
    </nav>

    <div class="wrapping">
            <form class="registerInputs" method="post" action="">
            <div class="registerPanel"> 
            <div class="registerBox">
                <span>Zaloguj się</span>
                <label>
                    <p>Login: </p>
                    <input name="login" type="text" maxlength="12">
                </label>
                <label>
                    <p>Hasło: </p>
                    <input name="password" type="password" maxlength="16">
                </label>


                <div id="error">
                <?php
                    if(isset($_SESSION['error'])) {
                        $_SESSION['error'];
                    }
                ?>  
                </div>
                <button class="regBtn" type="submit" name="submit">Zaloguj</button>
                <button class="regBtn" id="register">Zarejestruj</button>
                </div>
            </div>
            </form>
        </div>
    </div>

</body>

<!-- całe działanie sql
            try {
                $DBconnect = new mysqli($host, $db_user, $db_password, $db_name);
                //$sqlLogin = $DBconnect-> prepare("SELECT * FROM accounts WHERE login = ?");
                $q = "SELECT id, login FROM accounts";
                $result = $DBconnect-> query($q);
                $userRow = $result-> num_rows;
                while($obj = $result->fetch_object())
                {
                    echo $obj-> id . "\t";
                    echo $obj-> login . "\t";
                }

                } catch(Exception $error_connection) {
                $error = "Błąd serwera " . $error_connection;
            }
 -->