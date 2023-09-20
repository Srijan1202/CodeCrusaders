<?php
$mysqli = new mysqli("localhost", "root", "thegreat1", "dealharbor");

if ($mysqli->ping()) {
    echo "Our connection is ok!\n";
} else {
    echo "Error: " . $mysqli->error . "\n";
}
?>
