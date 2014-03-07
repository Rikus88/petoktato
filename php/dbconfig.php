<?php
    $kapcs = mysql_connect("oziris2.nyme.hu","iliasr", "jelszó");
    if (!$kapcs) {
        die('Hiba a csatlakozáskor: ' . mysql_error()); 
    }
    mysql_select_db("adatbázisnév", $kapcs);
?>
