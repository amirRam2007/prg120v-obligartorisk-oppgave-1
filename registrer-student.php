
<?php
/* registrer-student */
/* Programmet registrerer en student */

include("db-tilkobling.php");
?>

<h3>Registrer student</h3>

<form method="post" action="">
    Brukernavn
    <input type="text" name="brukernavn" maxlength="7" required>
    <br>

    Fornavn
    <input type="text" name="fornavn" maxlength="50" required>
    <br>

    Etternavn
    <input type="text" name="etternavn" maxlength="50" required>
    <br>

    Klassekode
    <select name="klassekode" required>
        <option value="">Velg klasse</option>

        <?php
        $sqlSetning = "SELECT * FROM klasse;";
        $sqlResultat = mysqli_query($db, $sqlSetning)
            or die("Ikke mulig å hente klasser");

        while ($rad = mysqli_fetch_array($sqlResultat))
        {
            $klassekode = $rad["klassekode"];
            $klassenavn = $rad["klassenavn"];

            print("<option value='$klassekode'>"
                  . "$klassekode - $klassenavn</option>");
        }
        ?>
    </select>

    <br>

    <input type="submit" name="registrerStudentKnapp"
           value="Registrer student">
    <input type="reset" value="Nullstill">
</form>

<?php
if (isset($_POST["registrerStudentKnapp"]))
{
    $brukernavn = $_POST["brukernavn"];
    $fornavn = $_POST["fornavn"];
    $etternavn = $_POST["etternavn"];
    $klassekode = $_POST["klassekode"];

    $sqlSetning = "SELECT * FROM student
                   WHERE brukernavn='$brukernavn';";

    $sqlResultat = mysqli_query($db, $sqlSetning)
        or die("Ikke mulig å hente data fra databasen");

    $antallRader = mysqli_num_rows($sqlResultat);

    if ($antallRader != 0)
    {
        print("Studenten er registrert fra før");
    }
    else
    {
        $sqlSetning = "INSERT INTO student
                       VALUES('$brukernavn', '$fornavn',
                              '$etternavn', '$klassekode');";

        mysqli_query($db, $sqlSetning)
            or die("Ikke mulig å registrere studenten");

        print("Følgende student er nå registrert: "
              . "$brukernavn $fornavn $etternavn $klassekode");
    }
}
?>

<br>
<a href="index.php">Tilbake til hovedmenyen</a>
