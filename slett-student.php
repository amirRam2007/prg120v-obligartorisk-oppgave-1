
<?php
/* slett-student */
/* Programmet sletter en valgt student */
?>

<script src="funksjoner.js"></script>

<h3>Slett student</h3>

<form method="post" action="" onsubmit="return bekreft()">
    Brukernavn
    <input type="text" name="brukernavn" maxlength="7" required>
    <br>

    <input type="submit" name="slettStudentKnapp"
           value="Slett student">
</form>

<?php
if (isset($_POST["slettStudentKnapp"]))
{
    $brukernavn = $_POST["brukernavn"];

    include("db-tilkobling.php");

    $sqlSetning = "SELECT * FROM student
                   WHERE brukernavn='$brukernavn';";

    $sqlResultat = mysqli_query($db, $sqlSetning)
        or die("Ikke mulig å hente data fra databasen");

    $antallRader = mysqli_num_rows($sqlResultat);

    if ($antallRader == 0)
    {
        print("Studenten finnes ikke");
    }
    else
    {
        $sqlSetning = "DELETE FROM student
                       WHERE brukernavn='$brukernavn';";

        mysqli_query($db, $sqlSetning)
            or die("Ikke mulig å slette studenten");

        print("Studenten $brukernavn er nå slettet");
    }
}
?>

<br>
<a href="index.php">Tilbake til hovedmenyen</a>
