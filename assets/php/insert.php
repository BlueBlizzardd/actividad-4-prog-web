<?php

include_once('connect.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

$insert = $conn->prepare("INSERT INTO measurements (wellName, cityName, date, psi) VALUES (?, ?, ?, ?)");
$well = $_POST['well'];
$state = $_POST['state'];
$date = date("Y-m-d H:i:s", strtotime($_POST['date']));
$psi = $_POST['psi'];

$insert->bind_param("sssi", $well, $state, $date, $psi);

if ($insert->execute() === TRUE) {
    echo "New record created successfully \n";
    echo '<button><a href="../../index.php">Go Back</a></button>';
} else {
    echo "Error: " . $query . "<br>" . $conn->error;
}

$insert->close();
$conn->close();

?>