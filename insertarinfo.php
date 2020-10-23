<!DOCTYPE html>
<html lang="ca">

<head>
    <link href="Imatges/hqdefault.jpg" type="text/css" rel="icon" />
    <title>Llavors</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/estilo.css" type="text/css">


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
        <div class="inicientrada">
<!--Declarem les variables per a iniciar sessió-->
            <?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "BDStockLlavors";

// Establim la connexió
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
// Comprovem la connexió
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// Agafem la informació
$nomfamilia = mysqli_real_escape_string($conn, $_POST['nomfamilia']);
$nomvarietat = mysqli_real_escape_string($conn, $_POST['nomvarietat']);
$nomplanta = mysqli_real_escape_string($conn, $_POST['nomplanta']);
$numstock = mysqli_real_escape_string($conn, $_POST['numstock']);


// Intentem inserir la informació.
$sql = "INSERT INTO Stock (Familia, Varietat, Planta, Quantitat) VALUES ('$nomfamilia', '$nomvarietat', '$nomplanta','$numstock')";
if(mysqli_query($conn, $sql)){
    echo "<h2>Entrada Efectuada</h2>"."<p>La seva entrada s'ha efectuat, torni a la web, o tanqui aquesta pestanya.";
    
} else{
    echo "<p>ERROR: No s'ha pogut executar $sql. </p>" . mysqli_error($conn);
}
 
// Tanquem la connexió.
mysqli_close($conn);
?>
        </div>
        <footer>
            <h3>DAM1 (Projecte2)</h3>
        </footer>
    </div>
</body>

</html>