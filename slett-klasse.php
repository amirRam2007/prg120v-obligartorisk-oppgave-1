
<?php
/* slett-klasse */
/* Programmet sletter en valgt klasse */
?>

<script src="funksjoner.js"></script>

<h3>Slett klasse</h3>

<form method="post" action="" onsubmit="return bekreft()">
    Klassekode
    <input type="text" name="klassekode" maxlength="5" required>
    <br>

    <input type="submit" name="slettKlasseKnapp"
           value="Slett klasse">
</form>

<?php
if (isset($_POST["slettKlasseKnapp"]))
{
    $klassekode = $_POST["klassekode"];

    include("db-tilkobling.php");

    $sqlSetning = "SELECT * FROM klasse
                   WHERE klassekode='$klassekode';";

    $sqlResultat = mysqli_query($db, $sqlSetning)
        or die("Ikke mulig å hente data fra databasen");

    $antallRader = mysqli_num_rows($sqlResultat);

    if ($antallRader == 0)
    {
        print("Klassen finnes ikke");
    }
    else
    {
        $sqlSetning = "DELETE FROM klasse
                       WHERE klassekode='$klassekode';";

        mysqli_query($db, $sqlSetning)
            or die("Ikke mulig å slette klassen. "
                   . "Kontroller om klassen har studenter.");

        print("Klassen $klassekode er nå slettet");
    }
}
?>

<br>
<a href="index.php">Tilbake til hovedmenyen</a>
