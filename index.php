<?php
require_once "./autoload.php";
$lighting = new Lighting()

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Pabellon</title>
</head>

<body>
    <div class="center">
        <h1>BIG STADIUM - LIGHTING CONTROL PANEL</h1>
        <h2><?= $lighting->drawMonitor() ?></h2>
        <form action="" method="post">
           <!--<select name="filter">
           <= $lighting->drawZonesOptions() ?>      añadir ?entre < y =     -->
            </select>
            <input type="submit" value="Filter by zone">
        </form>
        <?= $lighting->drawLampsList() ?>
    </div>
</body>

</html>