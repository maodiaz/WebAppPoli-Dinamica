<?php include("../template/cabecera.php");?>

<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtEco=(isset($_POST['txtEco']))?$_POST['txtEco']:"";
$txtRay=(isset($_POST['txtRay']))?$_POST['txtRay']:"";
$txtRes=(isset($_POST['txtRes']))?$_POST['txtRes']:"";
$txtTac=(isset($_POST['txtTac']))?$_POST['txtTac']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
    
    /*echo $txtEco."<br/>";
    echo $txtRay."<br/>";
    echo $txtRes."<br/>";
    echo $txtTac."<br/>";
    echo $accion."<br/>";*/

    //A partir de este punto se conecta a la base de datos
    $host = "localhost";
    $dbname = "lecturas";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Imprimir un aviso si la conexión es efectiva
        /*echo "<h6>Conectado a BD: $dbname</h6>";*/
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

    switch($accion){

        case "Agregar":

            /*consulta SQL para insertar datos en una tabla llamada "lecturas".
            La consulta utiliza 4 marcadores de posición :eco, :res, :ray y :tac
            para los valores que se van a insertar.*/
            $sentenciaSQL = $conn->prepare("INSERT INTO `lecturas` (`id`, `eco`, `ray`, `res`, `tac`) VALUES (NULL,:eco,:ray, :res, :tac);");
            
            /*se enlazan los valores que se deben insertar a los marcadores de posición utilizando
            el método bindParam. $txtEco se enlaza al marcador :eco */
            $sentenciaSQL->bindParam(':eco',$txtEco);
            $sentenciaSQL->bindParam(':ray',$txtRay);
            $sentenciaSQL->bindParam(':res',$txtRes);
            $sentenciaSQL->bindParam(':tac',$txtTac);

            /* la consulta SQL se ejecuta utilizando el método execute().
            Esto ejecuta la consulta y asigna los paràmetros a la base de datos.*/
            $sentenciaSQL->execute();

            break;
        
        case "Modificar":
            /*actualiza el registro en la tabla "lecturas" donde el ID coincide con el valor de :id.
            Se utiliza bindParam para enlazar el valor de  $txtID al marcador :id y
            $txtEco al marcador :eco y los demàs valores de registros*/
            $sentenciaSQL = $conn->prepare("UPDATE lecturas SET eco=:eco,
                                                                ray=:ray,
                                                                res=:res,
                                                                tac=:tac        
                                                                        WHERE id=:id");
            $sentenciaSQL->bindParam(':eco',$txtEco);
            $sentenciaSQL->bindParam(':ray',$txtRay);
            $sentenciaSQL->bindParam(':res',$txtRes);
            $sentenciaSQL->bindParam(':tac',$txtTac);
            $sentenciaSQL->bindParam(':id',$txtID);
            
            $sentenciaSQL->execute();

            break;

        case "Cancelar":
            echo"Presionado boton Cancelar";

        break;

        case "Seleccionar":
        /* cuando $accion es igual a "Seleccionar", se ejecuta este bloque de código*/
            
            /*consulta SQL utilizando prepare() para seleccionar todos los datos de la tabla "lecturas"
            donde el ID coincida con el valor de :id, que se enlaza al valor de $txtID mediante
            bindParam(':id', $txtID) */
         $sentenciaSQL = $conn->prepare("SELECT * FROM lecturas WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();
            /*Después de ejecutar la consulta, los resultados se almacenan en la variable $lectura.
            $listaLibros contendrá los datos del libro seleccionado. */
            $lectura=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            /*Asigna a las variables los valores recuperados de la consulta */
            $txtEco=$lectura['eco'];
            $txtRay=$lectura['ray'];
            $txtRes=$lectura['res'];
            $txtTac=$lectura['tac'];

        break;

        case "Borrar":
            /* consulta SQL utilizando prepare() para eliminar un registro de la tabla "lecturas" donde el ID
            coincide con el valor de :id. Luego, se utiliza bindParam(':id', $txtID) para enlazar el valor de $txtID
            al marcador :id en la consulta preparada. La consulta se ejecuta utilizando execute() */
            $sentenciaSQL = $conn->prepare("DELETE FROM lecturas WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->execute();

        break;


    }

    /* prepara una consulta SQL utilizando la función prepare() de PDO.
    La consulta selecciona todos los registros de la tabla "libros". */
    $sentenciaSQL = $conn->prepare("SELECT * FROM lecturas");
    /* la consulta se ejecuta utilizando el método execute().
    Esto ejecuta la consulta y recupera los resultados de la base de datos.*/
    $sentenciaSQL->execute();
    /*Los resultados de la consulta se almacenan en la variable $listaLecturas
    utilizando el método fetchAll() con PDO::FETCH_ASSOC.Esto significa que los
    resultados se almacenarán en forma de un array asociativo donde las claves
    serán los nombres de las columnas de la tabla y los valores serán los datos de cada fila.*/
    $listaLecturas=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC)

?>

<div class="col-md-5">
        
    <div class="card">
        <div class="card-header">
        Formulario de registro de lecturas
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">

            <div class = "form-group">
                <label for="txtID">ID</label>
                <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
            </div>


            <div class = "form-group">
                <label for="txtEco">Ecografia</label>
                <input type="text" required class="form-control" value="<?php echo $txtEco; ?>" name="txtEco" id="txtEco" placeholder="Ecografía">
            </div>
            <div class = "form-group">
                <label for="txtRay">Rayos X</label>
                <input type="text" required class="form-control" value="<?php echo $txtRay; ?>" name="txtRay" id="txtRay" placeholder="Rayos X">
            </div>
            <div class = "form-group">
                <label for="txtRes">Resonancia</label>
                <input type="text" required class="form-control" value="<?php echo $txtRes; ?>" name="txtRes" id="txtRes" placeholder="Resonancia Magnética">
            </div>
            <div class = "form-group">
                <label for="txtTac">Tomografia</label>
                <input type="text" required class="form-control" value="<?php echo $txtTac; ?>" name="txtTac" id="txtTac" placeholder="Tomografía TAC">
            </div>
            


            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" <?php echo ($accion!=="Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="accion" <?php echo ($accion!=="Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info">Cancelar</button>
            </div>

            </form>
        </div>
    </div>
</div>

<div class="col-md-7">
    Tabla de registros (datos)
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Ecografia</th>
                    <th>Rayos X</th>
                    <th>Resonancia</th>
                    <th>Tomografia</th>
                </tr>
            </thead>
            <tbody>
            <!--Se utiliza un bucle foreach para recorrer cada elemento del array $listaLecturas
            Cada elemento representará un dato en sus respectivas columnas de datos.-->
            <?php foreach($listaLecturas as $lectura) { ?>
                <tr> <!--Se crea una fila (<tr>) en la tabla HTML para cada registro en $listaLecturas -->
                    <td><?php echo $lectura['id']; ?></td> <!--se crea celda (<td>) para mostrar el dato id -->
                    <td><?php echo $lectura['eco']; ?></td> <!--se crea celda (<td>) para mostrar el dato eco -->
                    <td><?php echo $lectura['ray']; ?></td> <!--se crea celda (<td>) para mostrar el dato ray -->
                    <td><?php echo $lectura['res']; ?></td> <!--se crea celda (<td>) para mostrar el dato res -->
                    <td><?php echo $lectura['tac']; ?></td> <!--se crea celda (<td>) para mostrar el dato tac -->
                    <td>
                        <form method="post">
                        <input type="hidden" name="txtID" id="txtID" value="<?php echo $lectura['id']; ?>"/>
                        <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                        <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>
                        </form>
                    </td>
            <?php } ?>

            </tbody>
        </table>
</div>

<?php include("../template/pie.php");?>