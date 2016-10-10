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