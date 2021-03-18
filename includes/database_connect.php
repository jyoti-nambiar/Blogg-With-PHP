<?php
$servername = "localhost:8001";
$username = "root";
$password = "root";
$conn = new PDO("mysql:host=$servername;dbname=bloggdb", $username, $password);
if (!$conn) {
    echo "connection failed";
}
