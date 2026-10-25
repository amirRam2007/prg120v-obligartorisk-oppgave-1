
<<<<<<< HEAD
<?php
/* slett-klasse */
=======
<?php  /* slett-klasse */
>>>>>>> 638fdc247aca7798c5a85ff02b94e425c78eb183
/*
  Programmet lager et skjema for å velge en klasse som skal slettes.
  Programmet sletter den valgte klassen.
*/
?>

<h3>Slett klasse</h3>

<<<<<<< HEAD
<form method="post" action="" id="slettKlasseSkjema"
      name="slettKlasseSkjema" onsubmit="return bekreft()">

  Klassekode
  <input type="text" id="klassekode" name="klassekode" required />
  <br />

  <input type="submit" value="Slett klasse"
         name="slettKlasseKnapp" id="slettKlasseKnapp" />

=======
<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema">
  Klassekode
  <input type="text" id="klassekode" name="klassekode" required />
  <br />

  <input type="submit" value="Slett klasse"
         name="slettKlasseKnapp" id="slettKlasseKnapp" />
>>>>>>> 638fdc247aca7798c5a85ff02b94e425c78eb183
  <input type="reset" value="Nullstill" />
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

            print("Følgende klasse er nå slettet: $klassekode");
        }
    }
}
?>

<br />
<a href="index.php">Tilbake til hovedmenyen</a>
