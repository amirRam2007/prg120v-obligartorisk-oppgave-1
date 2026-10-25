
<?php
/* registrer-klasse */
/* Programmet registrerer en klasse */

include("db-tilkobling.php");
?>

<h3>Registrer klasse</h3>

<form method="post" action="">
    Klassekode
    <input type="text" name="klassekode" maxlength="5" required>
    <br>

    Klassenavn
    <input type="text" name="klassenavn" maxlength="50" required>
    <br>

    Studiumkode
    <input type="text" name="studiumkode" maxlength="50" required>
    <br>

    <input type="submit" name="registrerKlasseKnapp"
           value="Registrer klasse">
    <input type="reset" value="Nullstill">
</form>

<?php
if (isset($_POST["registrerKlasseKnapp"]))
{
    $klassekode = $_POST["klassekode"];
    $klassenavn = $_POST["klassenavn"];
    $studiumkode = $_POST["studiumkode"];

    $sqlSetning = "SELECT * FROM klasse
                   WHERE klassekode='$klassekode';";

    $sqlResultat = mysqli_query($db, $sqlSetning)
        or die("Ikke mulig å hente data fra databasen");

    $antallRader = mysqli_num_rows($sqlResultat);

    if ($antallRader != 0)
    {
        print("Klassen er registrert fra før");
    }
    else
    {
        $sqlSetning = "INSERT INTO klasse
                       VALUES('$klassekode', '$klassenavn',
                              '$studiumkode');";

        mysqli_query($db, $sqlSetning)
            or die("Ikke mulig å registrere klassen");

        print("Følgende klasse er nå registrert: "
              . "$klassekode $klassenavn $studiumkode");
    }
}
?>

<br>
<a href="index.php">Tilbake til hovedmenyen</a>

