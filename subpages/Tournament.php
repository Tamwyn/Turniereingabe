<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "fechten";

if (isset( $_POST['eintragen'] ))
{
    // Maskierende Slashes aus POST entfernen
    //$_POST = get_magic_quotes_gpc() ? array_map( 'stripslashes', $_POST ) : $_POST;
    
    // Inhalte der Felder aus POST holen
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $jahrgang = (int) $_POST['jahrgang'];
    $email = $_POST['email'];
    
    
    // Verbindung oeffnen und Datenbank auswaehlen
    $connect = mysql_connect( $db_host, $db_user, $db_pass ) or die( "Der Datenbankserver konnte nicht erreicht werden!" );
    if ($connect)
    {
        mysql_select_db( $db_name) or die("Die Datenbank wurde nicht erreicht");
    }
    //Zeichensatz auf utf8 umstellen
    mysql_query("SET NAMES UTF8");
    // Anfrage zusammenstellen der an die DB geschickt werden soll
    $addfencer = "INSERT INTO `fechter` (`Nachname` , `Vorname` , `Jahrgang` , `Email`)
                                  VALUES('$nachname', '$vorname', '$jahrgang', '$email')";
    // Schickt die Anfrage an die DB und schreibt die Daten in die Tabelle
    $add = mysql_query( $addfencer );
    // Pruefen ob der neue Datensatz tatsaechlich eingefuegt wurde
    if (mysql_affected_rows() == 1)
    {
        echo "$vorname $nachname wurde erfolgreich hinzugef&uuml;gt!";
    }
    else
    {
        echo "Das Hinzuf&uuml;gen von $vorname $nachname schlug fehl";
    }
}
?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="formular" id="formular" accept-charset="utf-8">
Vorname: <input type="text" name="vorname" id="vorname" /><br /><br />
Nachname: <input type="text" name="nachname" id="nachname" /><br /><br />
Jahrgang: <select name="jahrgang" id="jahrgang"><?php for ($i=1940; $i < date("Y"); $i++) { echo "<option>{$i}</option>"; } ?></select><br /><br />
Email-Adresse: <input type="text" name="email" id="email" /><br /><br />
<input type="submit" name="eintragen" id="eintragen" value="Abschicken" />
