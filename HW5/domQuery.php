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