<?php

include_once('connect.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: application/json');

if (isset($_POST['state']) && !empty($_POST['state'])) {
    $state = $_POST['state'];

    $select = $conn->prepare("SELECT * FROM measurements WHERE cityName = '$state' ORDER BY date");
    $select->execute();
    $rs = $select->get_result();
    $response = array();

    while ($row = mysqli_fetch_array($rs)) {
        array_push(
            $response,
            array(
                "id" => $row['id'],
                "well" => $row['wellName'],
                "state" => $row['cityName'],
                "date" => $row['date'],
                "psi" => $row['psi']
            )
        );
    }

    $select->close();
    $conn->close();
    echo json_encode($response);

} else {
    echo "No state selected. Try again.", "<br>";
    echo '<a href="javascript:history.back()">Try again</a>';
}
?>