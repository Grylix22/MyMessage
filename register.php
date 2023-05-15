<?php
    session_start();
    if(isset($_SESSION['accountLoginSession'])) {
        header("Location: chats.php");
    }
    
    require_once "DBconnect.php";

    //dodaj zapytanie o płeć
    if(isset($_POST['submit'])) {
        $login = $_POST['login'];
        $email = $_POST['email'];
        $emailValidate = $email;
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $data_error = false;
        unset($_POST['submit']);
        // unset($_POST['login']);
        // unset($_POST['email']);
        // unset($_POST['password1']);
        // unset($_POST['password2']);
    
        if((ctype_alnum($login) != true) or strlen($login) < 4) {
            $data_error = true;
            $_SESSION['error'] = "Login może się składać tylko z liter i cyfr";

        } else if(!filter_var($emailValidate, FILTER_VALIDATE_EMAIL) or ($email != $emailValidate)) {
            $data_error = true;
            $_SESSION['error'] = "Błędny email";

        } else if(strlen($password1) < 8 or (strlen($password1) > 16)) {
            $data_error = true;
            $_SESSION['error'] = "Hasło musi zawierać pomiędzy 8 a 16 znaków";

        } else if($password1 != $password2) {
            $data_error = true;
            $_SESSION['error'] = "Podane hasła są różne";

        } else if($data_error == false) {


            try {
                $DBconnect = new mysqli($host, $db_user, $db_password, $db_name);
                $q = "SELECT login, email FROM accounts";
                $highestID  = "SELECT id, MAX(id) FROM accounts";
                $result     = $DBconnect-> query($q);
                $result2    = $DBconnect-> query($highestID);
                $userRow    = $result-> num_rows;
                $maxID      = $result2-> fetch_row();
                $NextID     = $maxID[1] + 1;

                while($obj = $result->fetch_object()) {
                    if($obj-> login == $login) {
                        $data_error = true;
                        $_SESSION['error'] = "Podany nick jest zajęty";

                    } else if($obj-> email == $email) {
                        $data_error = true;
                        $_SESSION['error'] = "Podany e-mail jest zajęty";
                    }
                }
                // add user to database
                if($data_error == false) {
                    $qa = "INSERT INTO `accounts`(`id`, `login`, `email`, `password`) VALUES ('$NextID', '$login', '$email', '$password1')";
                    $result = $DBconnect-> query($qa);
                    $_SESSION['error'] = "pomyślna rejestracja";
                    $_SESSION['accountLoginSession'] = $login;
                    echo $DBconnect->error;
                    $DBconnect->close();
                } else {
                    echo $data_error;
                }
            } catch(Exception $error_connection) {
                $_SESSION['error'] = "Błąd serwera: " . $error_connection;
            }
        }
        if($data_error == false) {$error = "rejestracja";}
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
    <link href="https://fonts.googleapis.com/css2?family=Signika+Negative:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>MyMess</title>


    <!-- <script src="scripts.js"></script> -->
    <script src="account.js"></script>
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
                <li><a href="index.html">Strona główna</a></li>
                <li><a href="settings.php">Ustawienia</a></li>
                <li><a href="log-in.php">Zaloguj</a></li>
                <li><a href="log-out">Wyloguj</a></li>
            </ul>
        </div>
    </nav>
    <div class="wrapping">
            <form class="registerInputs" method="post" action="">
            <div class="registerPanel"> 
            <div class="registerBox">
                <span>Zarejestruj się</span>
                <label>
                    <p>Login: </p>
                    <input name="login" type="text" minlength="4" maxlength="12">
                </label>
                <label>
                    <p>E-mail: </p>
                    <input name="email" type="email">
                </label>
                <label>
                    <p>Hasło: </p>
                    <input name="password1" type="password" minlength="8" maxlength="16">
                </label>
                <label>
                    <p>Powtórz hasło: </p>
                    <input name="password2" type="password" minlength="8" maxlength="16">
                </label>


                <div id="error">
                <?php
                if(isset($_SESSION['error'])) {
                    echo "\n" . $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>  
                </div>
                <button class="regBtn" type="submit" name="submit">Zarejestruj</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</body>
</html>