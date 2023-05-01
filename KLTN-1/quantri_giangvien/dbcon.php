<?php
$conn = new mysqli('localhost','admin','123456','db_kltn');
if ($conn->connect_error) {
    die('Error : ('. $conn->connect_errno .') '. $conn->connect_error);
}
?>