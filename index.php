<?php
include_once('assets/php/connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Televisa</title>
    <link rel="stylesheet" href="assets/css/estilazo.css">
</head>

<body>
    <!-- Seccion 1: Agregar Mediciones -->
    <form action="assets/php/insert.php" method="post" class="form">
        <label for="well">Name of the Well:</label>
        <input type="text" id="well" name="well">

        <label for="state">State:</label>
        <select name="state" id="state">
            <?php
            $result = mysqli_query($conn, "SHOW COLUMNS FROM measurements LIKE 'cityName'") or die(mysqli_error($conn));
            if ($result) {
                $option_array = explode("','", preg_replace("/(enum)\('(.+?)'\)/", "\\2", $result->fetch_column(1)));
                foreach ($option_array as $option) {
                    echo '<option value="' . $option . '">' . $option . '</option>';
                }
            }
            ?>
        </select>

        <label for="date">Measurement date:</label>
        <input type="datetime-local" id="date" name="date">

        <label for="psi">Total PSI:</label>
        <input type="number" id="psi" name="psi">

        <button type="submit" class="save">Save</button>
    </form>

    <!-- Seccion 2: Visualizar Mediciones -->
    <?php
    $query = "SELECT id, wellName, cityName, date, psi FROM measurements";
    $rs = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $count = mysqli_num_rows($rs);

    if ($count > 0) {
        ?>
        <table class="measurements">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Well</th>
                    <th>City</th>
                    <th>Date Measured</th>
                    <th>PSI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($rs)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['wellName'] . "</td>";
                    echo "<td>" . $row['cityName'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['psi'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Seccion 3: Visualizar Graficas -->

        <button type="button"><a href="charts.php">Make a Chart</a></button>

        <?php
    }

    $conn->close();

    ?>
</body>

</html>