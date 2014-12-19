<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "turniermanagment";

if (isset( $_POST['add'] ))
{
    // Verbindung oeffnen und Datenbank auswaehlen
    $connect = mysql_connect( $db_host, $db_user, $db_pass ) or die( "Der Datenbankserver konnte nicht erreicht werden!" );
    if ($connect)
    {
        mysql_select_db( $db_name) or die("Die Datenbank wurde nicht erreicht");
    }
    //Zeichensatz auf utf8 umstellen
    mysql_query("SET NAMES UTF8");

        // Inhalte der Felder aus POST holen
    $iddump = mysql_fetch_assoc(mysql_query("SELECT MAX(`ID`)+1 AS `newid` FROM `turnier`"));
    $id = $iddump["newid"];
    $name = $_POST['name'];
    $ausschreibung = $_POST['link'];
    $datum = $_POST['datepicker'];
    if (isset($_POST['pflichtturnier']))
    {
        $pflicht = (int) '1';
    }
    else
    {
        $pflicht = (int) '0';
    }
    echo "Die nächste ID lautet: $id <br>";
    // Anfrage zusammenstellen der an die DB geschickt werden soll
    $addtournament = "INSERT INTO `turnier` (`ID` , `Name` , `Ausschreibung` , `Pflichtturnier` , `Datum`)
                    VALUES('$id' , '$name', '$ausschreibung', '$pflicht', '$datum')";
    // Schickt die Anfrage an die DB und schreibt die Daten in die Tabelle
    $add = mysql_query( $addtournament );
    // Pruefen ob der neue Datensatz tatsaechlich eingefuegt wurde
    if (mysql_affected_rows() == 1)
    {
        echo "$name wurde erfolgreich hinzugef&uuml;gt!";
    }
    else
    {
        echo "Das Hinzuf&uuml;gen von $name schlug fehl". mysql_error($connect);
    }
//Schreibe Altersklassen    
    if (isset($_POST['schueler']))
    {
        $akschueler = "INSERT INTO `altersklassen` (`TurnierID` , `JahrgID`) VALUES ('$id' , '1') ";
        $add = mysql_query($akschueler);
    }

    if (isset($_POST['bjg']))
    {
        $akbjg = "INSERT INTO `altersklassen` (`TurnierID` , `JahrgID`) VALUES ('$id' , '2') ";
        $add = mysql_query($akbjg);
    }

    if (isset($_POST['ajg']))
    {
        $akajg = "INSERT INTO `altersklassen` (`TurnierID` , `JahrgID`) VALUES ('$id' , '3') ";
        $add = mysql_query($akajg);
    }

    if (isset($_POST['jun']))
    {
        $akjun = "INSERT INTO `altersklassen` (`TurnierID` , `JahrgID`) VALUES ('$id' , '4') ";
        $add = mysql_query($akjun);
    }

    if (isset($_POST['aktive']))
    {
        $akaktive = "INSERT INTO `altersklassen` (`TurnierID` , `JahrgID`) VALUES ('$id' , '5') ";
        $add = mysql_query($akaktive);
    }

    if (isset($_POST['senioren']))
    {
        $aksenioren = "INSERT INTO `altersklassen` (`TurnierID` , `JahrgID`) VALUES ('$id' , '6') ";
        $add = mysql_query($aksenioren);
    }

 //Schreibe Waffen 
    if (isset($_POST['saebel']))
    {
        $waffesa = "INSERT INTO `waffetur` (`TurnierID` , `WaffeID`) VALUES ('$id' , '1') ";
        $add = mysql_query($waffesa);
    }
    
    if (isset($_POST['saebel']))
    {
        $waffefl = "INSERT INTO `waffetur` (`TurnierID` , `WaffeID`) VALUES ('$id' , '2') ";
        $add = mysql_query($waffefl);
    }
}


?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="formular" id="formular" accept-charset="utf-8">
<p>Name des Turniers <input type="text" name="name" id="name" /><br /><br /></p>
<p>Link zur Ausschreibung: <input type="text" name="link" id="link" /><br /><br /></p>
<p>Datum: <input type="text" id="datepicker" name="datepicker"></p>
<p>Altersklasse(n): 
Schüler:<input type="checkbox" name="schueler" value="0"> 
B-Jugend:<input type="checkbox" name="bjg" value="0"> 
A-Jugend<input type="checkbox" name="ajg" value="0"> 
Junioren:<input type="checkbox" name="jun" value="0"> 
Aktive:<input type="checkbox" name="aktive" value="0"> 
Senioren:<input type="checkbox" name="senioren" value="0"> </p>
<p>Waffe(n):
S&auml;bel: <input type="checkbox" name="saebel" value="0">
Florett: <input type="checkbox" name="florett" value="0">
</p>
<p>Pflichtturnier: <input type="checkbox" name="pflichtturnier" value="0"></p>
<input type="submit" name="add" id="add" value="Abschicken" />
