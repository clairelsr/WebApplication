<?php

/* Ce code php utilse la conversion en string XML pour extraire des données de la BDD, les convertir en 
 * string, pour enfin pouvoir les utiliser sur notre carte. Ce code a été copieusement inspiré d'un site sur 
 * internet. Nous nous sommes contentés de l'adapter à nos données.
 */
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

// Opens a connection to a MySQL server
$connection=mysql_connect("Localhost", "root", "");
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db("Donnees_Utilisateurs", $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table
$query = "SELECT * FROM Offres WHERE Etat = True";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml; charset=iso-8859-1\n");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  // Add to XML document node
  echo '<marker ';
  echo 'titre="' . parseToXML($row['Titre']) . '" ';
  echo 'quantite="' . parseToXML($row['Quantite']) . '" ';
  echo 'address="' . parseToXML($row['AdresseDeLaRencontre']) . '" ';
  echo 'id="' . parseToXML($row['id']) . '" ';
  echo 'lat="' . $row['Latitude'] . '" ';
  echo 'lng="' . $row['Longitude'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>