<!DOCTYPE html>
<html>
    <body>
        <?php
            $servername ="cis.gvsu.edu";
            $username = "wrighjax";
            $password = "wrighjax1720";
            $dbname = "wrighjax";
            
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            
            if (!$conn) {
                die("Connection failed: ".mysqli_connect_error());
            }
            
            $sql = "CREATE TABLE: Guests (
                id INT(6) PRIMARY KEY,
                firstName VARCHAR(30) NOT NULL,
                lastName VARCHAR(30) NOT NULL,
                address VARCHAR(50) NOT NULL,
                city VARCHAR(50) NOT NULL,
                state VARCHAR(2) NOT NULL,
                zipCode INT(5) NOT NULL,
                creditCard VARCHAR(20) NOT NULL,
                balance double NOT NULL
                )";
                
            if(mysqli_query($conn, $sql)) {
                echo "Table created";
            } else {
                echo "error creating table: ".mysqli_error($conn);
            }
        ?> 
    </body>
</html>