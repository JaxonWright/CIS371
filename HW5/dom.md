## domQuery.php

```php
<?php
header('Content-Type: text/xml');
$doc = new DOMDocument('1.0', 'utf-8');
$dom->formatOutput = true;
$root = $doc->createElement('Guests');
$doc->appendChild($root);
$state = $_GET['state'];

$serverName = "cis.gvsu.edu";
$username = "wrighjax";
$password = "wrighjax1720";
$dbName = "wrighjax";

// Create connection
$conn = mysqli_connect($serverName, $username, $password, $dbName);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM Guests WHERE state = '$state'";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_assoc($result)) {
	     $guest = $doc->createElement('guest');
	     $id = $guest->setAttribute('id', $row["id"]);
	     $root->appendChild($guest);


	      $name = $doc->createElement('name');
	      $nameTxt = $doc->createTextNode($row["firstName"]." ".$row["lastName"]);
	      $name->appendChild($nameTxt);
	      $guest->appendChild($name);


	      $addr = $doc->createElement('address');

	      $street = $doc->createElement('street');
	      $streetTxt = $doc->createTextNode($row["address"]);
	      $street->appendChild($streetTxt);
	      $addr->appendChild($street);

	      $city = $doc->createElement('city');
	      $cityTxt = $doc->createTextNode($row["city"]);
	      $city->appendChild($cityTxt);
	      $addr->appendChild($city);

	      $state = $doc->createElement('state');
	      $stateTxt = $doc->createTextNode($row["state"]);
	      $state->appendChild($stateTxt);
	      $addr->appendChild($state);

	      $zip = $doc->createElement('zip');
	      $zipTxt = $doc->createTextNode($row["zipCode"]);
	      $zip->appendChild($zipTxt);
	      $addr->appendChild($zip);

	      $guest->appendChild($addr);


	      $cc = $doc->createElement('creditcard');
	      $ccTxt = $doc->createTextNode($row["creditCard"]);
	      $cc->appendChild($ccTxt);
	      $guest->appendChild($cc);


	      $bal = $doc->createElement('balance');
	      $balTxt = $doc->createTextNode($row["balance"]);
	      $bal->appendChild($balTxt);
	      $guest->appendChild($bal);
	}
} else {
	echo "0 results";
}
mysqli_close($conn);


echo $doc->saveHTML();
?>
```

## buildTable.php

```php
<!DOCTYPE html>
<html>
    <body>
	<?php
	    $servername ="cis.gvsu.edu";
	    $username = "wrighjax";
	    $password = "wrighjax1720";
	    $dbname = "wrighjax";
	    $txtfile = "customers.txt";
	    $fieldseperator = ",";
	    $lineseperator = "\n";

	    $conn = mysqli_connect($servername, $username, $password, $dbname);

	    if (!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	    }

	    $sql = "CREATE TABLE Guests (
		id int,
		firstName VARCHAR(30),
		lastName VARCHAR(30),
		address VARCHAR(50),
		city VARCHAR(50),
		state VARCHAR(2),
		zipCode INT(5),
		creditCard VARCHAR(20),
		balance double
		)";

	    if(mysqli_query($conn, $sql)) {
		echo "Table created";

		if (!file_exists($txtfile)) echo "ERROR: File not found";

		  $file = fopen($txtfile,"r");
		  $vals = "VALUES ";
		  if (!$file) echo "ERROR: Cannot open file";

		  $first = True;
		  $currLine = fgets($file); //skip top of file
		  while (!feof($file)) {
		      if($first) {
			$first = False;
		      } else {
			$vals .= ",";
		      }
		      $currLine = fgets($file);
		      $v = explode($fieldseperator, $currLine);
		      $vals .= "($v[0],'$v[1]','$v[2]','$v[3]','$v[4]','$v[5]',$v[6],'$v[7]',$v[8])";
		      //echo "<br>";
		      //echo $vals;

		  }

		  $insert = "INSERT INTO Guests ".$vals;

		  if (mysqli_query($conn, $insert)) {
		    echo "insert successful";
		  } else {
		    echo "ERROR: Cannot insert data...".mysqli_error($conn);
		  }
	    } else {
		echo "error creating table: ".mysqli_error($conn);
	    }	    
	?>
    </body>
</html>

```
