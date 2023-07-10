<?php
include_once('assets/php/connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presenta</title>
    <link rel="stylesheet" href="assets/css/estilazo.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous" defer>
        </script>
    <script type="module" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"
        defer></script>
    <script src="assets/js/scripts.js" defer></script>
</head>

<body>
    <!-- Seccion 1: Agregar Mediciones -->
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

    <button type="button" class="chart">Save</button>

    <div class="status"></div>

    <div class="responsiveChart">
        <canvas id="myChart" class="chart"></canvas>
    </div>

</body>