<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "turniermanagment";

if (isset( $_POST['add'] ))
{
    // Verbindung oeffnen und Datenbank auswaehlen
    $connect = mysqli_connect( $db_host, $db_user, $db_pass ) or die( "Der Datenbankserver konnte nicht erreicht werden!" );
    if ($connect)
    {
        mysqli_select_db( $connect , $db_name) or die("Die Datenbank wurde nicht erreicht");
    }
    //Zeichensatz auf utf8 umstellen
    mysqli_query($connect,"SET NAMES UTF8");

        // Inhalte der Felder aus POST holen
    $iddump = mysqli_fetch_assoc(mysqli_query($connect, "SELECT MAX(`ID`)+1 AS `newid` FROM `turnier`"));
    $id = $iddump["newid"];
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $ausschreibung = mysqli_real_escape_string($connect, $_POST['link']);
    $datum = mysqli_real_escape_string($connect, $_POST['datepicker']);
    if (isset($_POST['pflichtturnier']))
    {
        $pflicht = (int) '1';
    }
    else
    {
        $pflicht = (int) '0';
    }

    // Anfrage zusammenstellen die an die DB geschickt werden soll
    $addtournament = "INSERT INTO `turnier` (`ID` , `Name` , `Ausschreibung` , `Pflichtturnier` , `Datum`)
                    VALUES('$id' , '$name', '$ausschreibung', '$pflicht', '$datum')";
    // Schickt die Anfrage an die DB und schreibt die Daten in die Tabelle
    $add = mysqli_query($connect, $addtournament );
    // Pruefen ob der neue Datensatz tatsaechlich eingefuegt wurde
    if (mysqli_affected_rows($connect) == 1)
    {
        echo "$name wurde erfolgreich hinzugef&uuml;gt!";
    }
    else
    {
        echo "Das Hinzuf&uuml;gen von $name schlug fehl". mysqli_error($connect);
    }
 
 //Erkenne Altersklassen
$AKobjects = array ("nothing" , "schueler", "bjg" , "ajg" , "jun" , "aktive" , "senioren"  ); //Um mit den IDs der Datenbank synchron zu bleiben "nothing"
$Waobjects = array ("saebel", "florett");
for ($i = 1; $i <= 6; $i++) {
    if (isset($_POST["$AKobjects[$i]"]))
    {
        $ak = "INSERT INTO `altersklassen` (`TurnierID` , `JahrgID`) VALUES ('$id' , '$i') ";
        $add = mysqli_query($connect, $ak);
    }
}

//Schreibe Waffen 
    for ( $i=0; $i <= 1; $i++){
        if (isset($_POST["$Waobjects[$i]"]))
        {
            $waffe = "INSERT INTO `waffetur` (`TurnierID` , `WaffeID`) VALUES ('$id' , '$i') ";
            $add = mysqli_query($connect, $waffe);
        }
    }
}


?>


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="formular" id="formular" accept-charset="utf-8">
<fieldset>
    <p><b><label style="display:block;">Name des Turniers:</label></b> <input style="display:block;" type="text" name="name" id="name" /></p>
    <p><b><label style="display:block;">Link zur Ausschreibung:</label></b> <input style="display:block;" type="text" name="link" id="link" /></p>
    <p><b><label style="display:block;">Datum:</label></b> <input style="display:block;" type="text" id="datepicker" name="datepicker"></p>
    <p><b><label style="display:block;">Altersklasse(n):</label></b>
       <fieldset>
        <div style="float: left;">
        <label style="display:block;">Schüler: </label><input style="display:block;" type="checkbox" name="schueler" value="0"><br>
        <label style="display:block;">B-Jugend: </label><input style="display:block;" type="checkbox" name="bjg" value="0"><br>
        <label style="display:block;">A-Jugend: </label><input style="display:block;" type="checkbox" name="ajg" value="0">
        </div>
        
        <div style="float: center; margin-left: 150px;" >
        <label style="display:block;">Junioren: </label><input style="display:block;" type="checkbox" name="jun" value="0"><br>
        <label style="display:block;">Aktive: </label><input style="display:block;" type="checkbox" name="aktive" value="0"> <br>
        <label style="display:block;">Senioren: </label><input style="display:block;" type="checkbox" name="senioren" value="0"> </p>
        </div>
       </fieldset>
    <p><b><label style="display:block;">Waffe(n):</label></b>
        <fieldset>
         <div style="float: left;"><label style="display:block;">S&auml;bel: </label> <input style="display:block;" type="checkbox" name="saebel" value="0"><br></div>
         <div style="float: center; margin-left: 150px;" ><label style="display:block;">Florett: </label> <input style="display:block;" type="checkbox" name="florett" value="0"></div>
        </fieldset></p>
    <p><b><label style="display:block;">Pflichtturnier:</label></b><fieldset> <label style="display:block;">Anklicken für "Ja"</label> <input style="display:block;" type="checkbox" name="pflichtturnier" value="0"></p></fieldset>
    <input type="submit" name="add" id="add" value="Abschicken" />
</fieldset>