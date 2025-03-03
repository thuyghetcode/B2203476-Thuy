<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlbanhang";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "select id, fullname, email from customers where email = '" . $_POST["email"] . "' and
password = '" . md5($_POST["pass"]) . "'";

echo $sql;
$conn->close();
