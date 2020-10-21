<?php
    include("connect.php");
    $sql = "SELECT ID, Familia, Varietat, Planta, Quantitat  FROM Stock";
?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <link href="Imatges/hqdefault.jpg" type="text/css" rel="icon" />
    <link rel="stylesheet" href="css/estilo.css" type="text/css">
    <title>Llavors</title>
    <meta charset="utf-8">


</head>

<body>
    <div class="all">
        <h1>Mr.Seed</h1>
        <nav>
            <ul>
                <li><a href="index.html">Inici</a></li>
                <li><a href="consultallavors.php">Consulta de llavors</a></li>
                <li><a href="gestiollavors.html">Gestió de llavors</a></li>
            </ul>
        </nav>
        <div class="inici">
            <h2>CONSULTA DE LLAVORS</h2>
            <div class="consulta">
                <table class="taulaconsulta" cellspacing="0" cellpadding="0">
                    <tr class="titoltaula">
                        <th>ID</th>
                        <th>Familia</th>
                        <th>Varietat</th>
                        <th>Planta</th>
                        <th>Quantitat</th>
                    </tr>

                    <?php $result = $conn->query($sql); 
                        if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {?>
                    <tr>
                        <th><?php echo $row["ID"];?></th>
                        <th><?php echo $row["Familia"];?></th>
                        <th><?php echo $row["Varietat"];?></th>
                        <th><?php echo $row["Planta"];?></th>
                        <th><?php echo $row["Quantitat"];?></th>
                    </tr>
                    <?php }
                        } else {
                        echo "0 results";
                        }
                        $conn->close();
                        ?>
                </table>

            </div>
        </div>

        <footer>
        <h3>DAM1 (Projecte2)</h3>
        </footer>
    </div>
</body>

</html>
