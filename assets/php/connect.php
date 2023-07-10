<?php

$host = "localhost";
$user = "id20904805_ejuli";
$pass = "Progwebeshorrible1.com";
$db = "id20904805_progweb";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>