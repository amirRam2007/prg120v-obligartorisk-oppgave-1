
<?php
/* vis-alle-studenter */
/* Programmet skriver ut alle registrerte studenter */

include("db-tilkobling.php");

$sqlSetning = "SELECT * FROM student;";
$sqlResultat = mysqli_query($db, $sqlSetning)
    or die("Ikke mulig å hente data fra databasen");

$antallRader = mysqli_num_rows($sqlResultat);

print("<h3>Registrerte studenter</h3>");
print("<table border=1>");
print("<tr><th>Brukernavn</th><th>Fornavn</th>
       <th>Etternavn</th><th>Klassekode</th></tr>");

for ($r = 1; $r <= $antallRader; $r++)
{
    $rad = mysqli_fetch_array($sqlResultat);

    $brukernavn = $rad["brukernavn"];
    $fornavn = $rad["fornavn"];
    $etternavn = $rad["etternavn"];
    $klassekode = $rad["klassekode"];

    print("<tr><td>$brukernavn</td>
           <td>$fornavn</td>
           <td>$etternavn</td>
           <td>$klassekode</td></tr>");
}

print("</table>");
?>

<br>
<a href="index.php">Tilbake til hovedmenyen</a>
