   <?php
// Establim la conexió amb la web. Ens assegurem de que la nostra web funcioni amb caracters UTF 8
$mysqli = mysqli_connect('localhost', 'root', 'root', 'BDStockLlavors');
mysqli_set_charset($mysqli, "utf8");
// Per a evitar possibles errors declarem exactament les columnes que es puguin ordenar en la nostra base de dades.
$columns = array('ID','Familia','Varietat','Planta','Quantitat');


// Ens assegurem que la columna existeixi en l'array que hem declarat adalt. En cas de no existir utilitzarem el primer item de les columnes, en aquest cas s'ordenará per ID.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

//Obtenim l'ordre predeterminat per a les columnes que es ascendent, tant com l'ordre que podem tenir: Descendent o ascendent.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Realitzem la consulta predeterminada. 
if ($result = $mysqli->query('SELECT * FROM Stock ORDER BY ' .  $column . ' ' . $sort_order)) {
	// Declarem unes variables adicionals, per a garantitzar el correcte funcionament de la nostra funció d'ordenació
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order);
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
    	// La variable responsable de aplicar l'estil a la fletxa.
	$add_class = ' class="highlight"';
//    Verifiquem si l'usuari ha buscat algo. Si es aixi, canviem la consulta, utilitzant la que definim abaix.
if($_POST['hacercat']==1) {
    // Agafem l'informació del camp buscar.
                    $cerca = mysqli_real_escape_string($mysqli, $_POST['cerca']);
    //Agreguem " a la cerca, per a que la consulta funcioni en el MYSQL.
                    $com = '"'.$cerca.'"';
    //Realitzem la consulta
                    $result = $mysqli->query("SELECT * FROM Stock WHERE (ID = " . $com .") OR (Familia = ".$com.") OR (Varietat =" .$com.") OR (Planta =".$com.") OR (Quantitat = ".$com.") ORDER BY "  .  $column . " " . $sort_order);
                    }
	?>
   <!--Document HTML-->
   <!DOCTYPE html>
   <!--Idioma catalá-->
   <html lang="ca">
   <!--Declarem tots els estils que utilitzem, a més del favicon, del titol, i del charset utf, que permet entendre accents.-->

   <head>
       <link href="Imatges/hqdefault.jpg" type="text/css" rel="icon" />
       <link rel="stylesheet" href="css/estilo.css" type="text/css">
       <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
       <title>Llavors</title>
       <meta charset="utf-8">


   </head>

   <body>
       <!--Declarem el div que contindrá tota la web-->
       <div class="all">
           <h1>Mr.Seed</h1>
           <!--Declarem el menú-->
           <nav>
               <ul>
                   <li><a href="index.html">Inici</a></li>
                   <li><a href="consultallavors.php">Consulta de llavors</a></li>
                   <li><a href="gestiollavors.html">Gestió de llavors</a></li>
               </ul>
           </nav>
           <!--Declarem el div que contindrá les consultes-->
           <div class="inici">
               <h2>CONSULTA DE LLAVORS</h2>
               <div class="consulta">
                   <div class="formcerca">
                       <!--Declarem un formulari per a la cerca de informació. Ens assegurem de que no pugui estar vuit.-->
                       <form class="cerca" name="name" action="consultallavors.php" method="post">
                           <input type="text" name="cerca" required="required">
                           <input id="Buscar" type="submit" value="Buscar">
                           <!--Creem una variable invisible, per a que puguem canviar la nostra consulta amb els valors de la cerca.-->
                           <input type="hidden" name="hacercat" value="1">
                       </form>
                   </div>
                   <!--Declarem la taula. Utilitzem part de php per a poder canviar l'ordre de la taula.-->
                   <table class="taulaconsulta" cellspacing="0" cellpadding="0">
                       <tr class="titoltaula">
                           <th><a href="consultallavors.php?column=ID&order=<?php echo $asc_or_desc; ?>">ID<i class="fas fa-sort<?php echo $column == 'ID' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                           <th><a href="consultallavors.php?column=Familia&order=<?php echo $asc_or_desc; ?>">Familia<i class="fas fa-sort<?php echo $column == 'Familia' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                           <th><a href="consultallavors.php?column=Varietat&order=<?php echo $asc_or_desc; ?>">Varietat<i class="fas fa-sort<?php echo $column == 'Varietat' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                           <th><a href="consultallavors.php?column=Planta&order=<?php echo $asc_or_desc; ?>">Planta<i class="fas fa-sort<?php echo $column == 'Planta' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                           <th><a href="consultallavors.php?column=Quantitat&order=<?php echo $asc_or_desc; ?>">Quantitat<i class="fas fa-sort<?php echo $column == 'Quantitat' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                       </tr>
                       <!--Declarem un loop, per a que puguem mostrar tots els valors-->
                       <?php while ($row = $result->fetch_assoc()): ?>
                       <tr>
                           <td<?php echo $column == 'ID' ? $add_class : ''; ?>><?php echo $row['ID']; ?></td>
                               <td<?php echo $column == 'Familia' ? $add_class : ''; ?>><?php echo $row['Familia']; ?></td>
                                   <td<?php echo $column == 'Varietat' ? $add_class : ''; ?>><?php echo $row['Varietat']; ?></td>
                                       <td<?php echo $column == 'Planta' ? $add_class : ''; ?>><?php echo $row['Planta']; ?></td>
                                           <td<?php echo $column == 'Quantitat' ? $add_class : ''; ?>><?php echo $row['Quantitat']; ?></td>
                       </tr>
                       <!--Tanquem el loop, i la connexió.-->
                       <?php endwhile; ?>
                       <?php
	$result->free();
    $mysqli->close();
}
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
