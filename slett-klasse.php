
<?php
/* slett-klasse */
/*
  Programmet lager et skjema for å velge en klasse som skal slettes.
  Programmet sletter den valgte klassen.
*/

include("db-tilkobling.php");
?>

<script src="funksjoner.js"></script>

<h3>Slett klasse</h3>

<form method="post" action="" id="slettKlasseSkjema"
      name="slettKlasseSkjema" onsubmit="return bekreft()">

  Klassekode

  <select name="klassekode" id="klassekode" required>
    <option value="">Velg klasse</option>

    <?php
    $sqlSetning = "SELECT * FROM klasse ORDER BY klassekode;";
    $sqlResultat = mysqli_query($db, $sqlSetning)
        or die("Ikke mulig å hente klasser fra databasen");

    while ($rad = mysqli_fetch_array($sqlResultat))
    {
        print("<option value='$rad[klassekode]'>");
        print("$rad[klassekode] - $rad[klassenavn]");
        print("</option>");
    }
    ?>
  </select>

  <br />

  <input type="submit" value="Slett klasse"
         name="slettKlasseKnapp" id="slettKlasseKnapp" />

  <input type="reset" value="Nullstill" />
</form>

<?php
if (isset($_POST["slettKlasseKnapp"]))
{
    $klassekode = $_POST["klassekode"];

    $sqlSetning = "SELECT * FROM student
                   WHERE klassekode='$klassekode';";

    $sqlResultat = mysqli_query($db, $sqlSetning)
        or die("Ikke mulig å hente studenter fra databasen");

    $antallStudenter = mysqli_num_rows($sqlResultat);

    if ($antallStudenter != 0)
    {
        print("Klassen kan ikke slettes fordi det finnes studenter i klassen.");
    }
    else
    {
        $sqlSetning = "DELETE FROM klasse
                       WHERE klassekode='$klassekode';";

        mysqli_query($db, $sqlSetning)
            or die("Ikke mulig å slette klassen fra databasen");

        print("Klassen $klassekode er nå slettet.");
    }
}
?>

<br />
<a href="index.php">Tilbake til hovedmenyen</a>
