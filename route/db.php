<?php
$conn = new mysqli("localhost", "", "", "");
if ($conn->connect_error) {
    print_r("warning: " . $conn->connect_error);
} 
?>
