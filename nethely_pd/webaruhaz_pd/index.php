<html lang="hu">
<?php include 'head.php';?>
<body>

<div class="jumbotron text-center" style="margin-bottom:0">
  <h4>MSZC Kandó Kálmán Informatikai Technikum</h4>
  <h2>Projektmunka // Webáruház</h2>
  <h5>Pásztor Dávid - Webáruház</h5>  
</div>

<?php include 'navbar.php';?>
<hr>

<?php include 'slider.php';?>

<div class="container" align="center">
  <hr>
  <br>
  <?php

$servername = "localhost";
$username = "webaruhaz_pd";
$password = "Dave03";
$dbname = "webaruhaz_pd";

// Create connection --------------------------------------------------------------
$kapcsolat = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$kapcsolat) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Create connection ";


$sql = "SELECT * FROM termek"; //puda --> termek
$eredmeny = mysqli_query($kapcsolat, $sql);


// A lekérdezés kiíratása
print("<H2>A Pásztor Dávid webáruház tartalma - minden termék</H2>");

print("<table class=\"table table-condensed table table-striped\">
	<thead>
		<tr>");
// Az eredménytábla mezőneveinek kiíratása
		print("<th style= \"width: 2%\">id</th>");
		print("<th style= \"width: 2%\">kategoria</th>");
		print("<th style= \"width: 2%\">termek_neve</th>");
		print("<th style= \"width: 2%\">ar</th>");
		print("<th style= \"width: 2%\">foto</th>");
		//print("<th style= \"width: 2%\">foto_nk</th>");
		print("<th style= \"width: 2%\">keszlet</th>");	
		print("<th style= \"width: 2%\">vásárlás</th>");			
print("</tr>
	</thead>");
	
// Az eredménytábla tartalmának kiíratása
	
print("<tbody>");
while ($sor = mysqli_fetch_array($eredmeny,MYSQLI_ASSOC))
	{
		print ("<tr>");
		$mezo_szamlalo=0;
		foreach ($sor as $i=>$ertek)
		{
			$mezo_szamlalo++;
			if ($mezo_szamlalo == 1)
				{$termek_id=$ertek; $termek_id_nagykephez=$ertek;}
			if ($mezo_szamlalo < 4) 
				print("<td>$ertek</td>");
			if ($mezo_szamlalo == 4)
				print("<td>$ertek Ft</td>");
			if ($mezo_szamlalo == 5)
				print("<td><a href=\"fotok/$sor[foto_nk]\" target=\"_blank\"><img src=\"fotok/$ertek\" alt=\"\" height=\"200\" widht=\"300\" style=\"max-width=\"300\"\"></a></td>");
			//if ($mezo_szamlalo == 6)
				//print("<td><a href=\"fotok/$ertek\" target=\"_blank\">nagykép</a></td>");
			if ($mezo_szamlalo == 7) 
				print("<td>$ertek db</td>");
						
		}
		print("<td>
						<form name=\"form1\" method=\"post\" action=\"kosar_vasarlas.php\">
						<input name=\"termek_id\" type=\"hidden\" id=\"termek_id\" value=\"$termek_id\">
						Kosárba<br>
						<input type=\"image\" name=\"kosar_kepe\" src=\"kosar.png\" alt=\"\" height=\"50\" widht=\"50\">
						
						</form>
					   </td>");	
		print("</tr>");
	}		
print("</table>\n");

mysqli_close($kapcsolat);

?>
<br>
</div>
<?php include 'footer.php';?>
</body>
</html>