<html><body>
<?php
    $myFile = fopen("oscars.txt", "r");
    for ($i=1; $i < 4; $i++){
        echo "<h1>". fgets($myFile) . "</h1>";
        echo "<ul>";

        while (True){
            $line = fgets($myFile);

            if ($line == "\n") break;
            echo "<li>" . $line . "</li>";
            if (feof($myFile)) break;
        }
        echo "</ul>";
    }
?>
</body>
</html>
