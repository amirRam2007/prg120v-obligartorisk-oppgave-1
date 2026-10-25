
<?php
/* vis-alle-klasser */
/* Programmet skriver ut alle registrerte klasser */

include("db-tilkobling.php");

$sqlSetning = "SELECT * FROM klasse;";
$sqlResultat = mysqli_query($db, $sqlSetning)
    or die("Ikke mulig å hente data fra databasen");

$antallRader = mysqli_num_rows($sqlResultat);

print("<h3>Registrerte klasser</h3>");
print("<table border=1>");
print("<tr><th>Klassekode</th><th>Klassenavn</th>
       <th>Studiumkode</th></tr>");

for ($r = 1; $r <= $antallRader; $r++)
{
    $rad = mysqli_fetch_array($sqlResultat);

    $klassekode = $rad["klassekode"];
    $klassenavn = $rad["klassenavn"];
    $studiumkode = $rad["studiumkode"];

    print("<tr><td>$klassekode</td>
           <td>$klassenavn</td>
           <td>$studiumkode</td></tr>");
}

print("</table>");
?>

<br>
<a href="index.php">Tilbake til hovedmenyen</a>

