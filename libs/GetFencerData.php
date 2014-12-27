<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "fechten";

$connect = mysql_connect( $db_host, $db_user, $db_pass ) or die( "Der Datenbankserver konnte nicht erreicht werden!" );
if ($connect)
    {
        mysql_select_db( $db_name) or die("Die Datenbank wurde nicht erreicht!");
    }
    //Zeichensatz auf utf8 umstellen
mysql_query("SET NAMES UTF8");

$id = mysqli_escape_string($connect, $_POST['fencerID']);

$fechter = mysqli_query($connect, "SELECT `Vorname`, `Nachname`, `Jahrgang` , `Email` FROM fechter WHERE ID = $id "); 

while($row = $fechter->fetch_assoc()) {
        $vorname = $row["Vorname"];
        $nachname = $row["Nachname"];
        $jahrgang = $row["Jahrgang"];
        $email = $row["Email"];
    }

$data = array();
$data["vorname"] = $vorname;
$data["nachname"] = $nachname;
$data["jahrgang"] = $jahrgang;
$data["email"] = $email;
echo json_encode($data);
?>