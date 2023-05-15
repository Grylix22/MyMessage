<?php

// tu wyświetl input wyszukiwania, znajdź i wyszukaj osoby o podanym nicku.
// wyświetl przycisk dodaj do znajomych, jeżeli istnieje zaproszenie.

     session_start();
     if(isset($_SESSION['accountLoginSession']) and $_SESSION['accountLoginSession'] != '') {
         unset($_SESSION['accountLoginSession']);
         echo $_SESSION['accountLoginSession'];
         header("Location: index.php");
     }
?>