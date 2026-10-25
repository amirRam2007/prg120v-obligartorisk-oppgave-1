
<?php
/* slett-student */
/*
  Programmet lager et skjema for å velge en student som skal slettes.
  Programmet sletter den valgte studenten.
*/

include("db-tilkobling.php");
?>

<script src="funksjoner.js"></script>

<h3>Slett student</h3>

<form method="post" action="" id="slettStudentSkjema"
      name="slettStudentSkjema" onsubmit="return bekreft()">

  Brukernavn

  <select name="brukernavn" id="brukernavn" required>
    <option value="">Velg student</option>

    <?php
    $sqlSetning = "SELECT * FROM student ORDER BY brukernavn;";
    $sqlResultat = mysqli_query($db, $sqlSetning)
        or die("Ikke mulig å hente studenter fra databasen");

    while ($rad = mysqli_fetch_array($sqlResultat))
    {
        print("<option value='$rad[brukernavn]'>");
        print("$rad[brukernavn] - $rad[fornavn] $rad[etternavn]");
        print("</option>");
    }
    ?>
  </select>

  <br />

  <input type="submit" value="Slett student"
         name="slettStudentKnapp" id="slettStudentKnapp" />

  <input type="reset" value="Nullstill" />
</form>

<?php
if (isset($_POST["slettStudentKnapp"]))
{
    $brukernavn = $_POST["brukernavn"];

    $sqlSetning = "DELETE FROM student
                   WHERE brukernavn='$brukernavn';";

    mysqli_query($db, $sqlSetning)
        or die("Ikke mulig å slette studenten fra databasen");

    print("Studenten $brukernavn er nå slettet.");
}
?>

<br />
<a href="index.php">Tilbake til hovedmenyen</a>
