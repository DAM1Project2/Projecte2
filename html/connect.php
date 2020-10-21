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
?>