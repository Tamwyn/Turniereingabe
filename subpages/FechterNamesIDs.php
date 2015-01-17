<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "password";
$db_name = "fechten";

$connect = mysqli_connect( $db_host, $db_user, $db_pass ) or die( "Der Datenbankserver konnte nicht erreicht werden!" );
    if ($connect)
    {
        mysqli_select_db($connect, $db_name) or die("Die Datenbank wurde nicht erreicht");
    }
    //Zeichensatz auf utf8 umstellen
mysqli_query($connect,"SET NAMES UTF8");

$data = mysqli_query($connect, "SELECT `ID` , CONCAT(`Vorname` , ' ' , `Nachname`) AS Name FROM `fechter`");

while ($row = mysqli_fetch_array($data, MYSQL_NUM)) {
    printf("<option id='idOption' name='%s' style='display:block;'>%s</option>", $row[0], $row[1]);
}
?>