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
         <div class="inici">
             <?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "BDStockLlavors";

// Establir la conexio
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");
// Comprovar la conexio
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// Agafar la informació
$nomfamilia = mysqli_real_escape_string($conn, $_POST['nomfamilia']);
$nomvarietat = mysqli_real_escape_string($conn, $_POST['nomvarietat']);
$nomplanta = mysqli_real_escape_string($conn, $_POST['nomplanta']);
$numstock = mysqli_real_escape_string($conn, $_POST['numstock']);


// Intent d'inserció de informació
$sql = "INSERT INTO Stock (Familia, Varietat, Planta, Quantitat) VALUES ('$nomfamilia', '$nomvarietat', '$nomplanta',"$numstock")";
if(mysqli_query($conn, $sql)){
    echo "<h2>Entrada Efectuada</h2>";
    
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
 
// Close connection
mysqli_close($conn);
?>
         </div>
     </div>
 </body>

 </html>
