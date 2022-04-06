<?php

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";

$txtIDpro=(isset($_POST['txtIDpro']))?$_POST['txtIDpro']:"";
$txtNombrePro=(isset($_POST['txtNombrePro']))?$_POST['txtNombrePro']:"";
$txtDescripcionPro=(isset($_POST['txtDescripcionPro']))?$_POST['txtDescripcionPro']:"";
$txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
$txtCategoria=(isset($_POST['txtCategoria']))?$_POST['txtCategoria']:"";

$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$accion2=(isset($_POST['accion2']))?$_POST['accion2']:"";

include("conexion.php");

switch($accion){
    case "btnAgregar":
        $sentencia=$pdo->prepare("INSERT INTO categorias(Nombre,Descripcion) VALUES (:Nombre,:Descripcion)");
        
        $sentencia->bindParam(':Nombre',$txtNombre);
        $sentencia->bindParam(':Descripcion',$txtDescripcion);
        $sentencia->execute();
        
        echo $txtNombre;
        echo "Presionaste btnAgregar";
    break;
    case "btnModificar":

        $sentencia=$pdo->prepare("UPDATE categorias SET Nombre=:Nombre,Descripcion=:Descripcion WHERE id=:id");
        
        $sentencia->bindParam(':Nombre',$txtNombre);
        $sentencia->bindParam(':Descripcion',$txtDescripcion);
        $sentencia->bindParam(':id',$txtID);
        $sentencia->execute();

        header('Location: index.php');

        echo $txtNombre;
        echo "Presionaste btnModificar";
    break;
    case "btnEliminar":

        $sentencia=$pdo->prepare("DELETE FROM categorias  WHERE id=:id");
        $sentencia->bindParam(':id',$txtID);
        $sentencia->execute();

        header('Location: categorias.php');

        echo $txtID;
        echo "Presionaste btnEliminar";
    break;
    case "btnCancelar":
        echo $txtID;
        echo "Presionaste btnCancelar";
    break;
}

switch($accion2){
    case "btnAgregar":
        $sentencia=$pdo->prepare("INSERT INTO productos(Nombre,Descripcion,Precio,Categoria) VALUES (:Nombre,:Descripcion,:Precio,:Categoria)");
        
        $sentencia->bindParam(':Nombre',$txtNombrePro);
        $sentencia->bindParam(':Descripcion',$txtDescripcionPro);
        $sentencia->bindParam(':Precio',$txtPrecio);
        $sentencia->bindParam(':Categoria',$txtCategoria);

        $sentencia->execute();
        
        
    break;
    case "btnModificar":

        $sentencia=$pdo->prepare("UPDATE productos SET Nombre=:Nombre,Descripcion=:Descripcion,Precio=:Precio,Categoria=:Categoria WHERE id=:id");
        
        $sentencia->bindParam(':Nombre',$txtNombrePro);
        $sentencia->bindParam(':Descripcion',$txtDescripcionPro);
        $sentencia->bindParam(':Precio',$txtPrecio);
        $sentencia->bindParam(':Categoria',$txtCategoria);
        $sentencia->bindParam(':id',$txtIDpro);
        $sentencia->execute();

        header('Location: index.php');

       
    break;
    case "btnEliminar":

        $sentencia=$pdo->prepare("DELETE FROM productos  WHERE id=:id");
        $sentencia->bindParam(':id',$txtIDpro);
        $sentencia->execute();

        header('Location: categorias.php');

        
    break;
    case "btnCancelar":
        
    break;
}

$sentencia=$pdo->prepare("SELECT * FROM `categorias` WHERE 1");
$sentencia->execute();
$listaCategorias=$sentencia->fetchAll(PDO::FETCH_ASSOC);
$sentenciaPro=$pdo->prepare("SELECT * FROM `productos` WHERE 1");
$sentenciaPro->execute();
$listaPorductos=$sentenciaPro->fetchAll(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD php prueba</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="" method="post">
        <label for="">ID:</label>
        <input type="number" name="txtID" value="<?php echo $txtID?>" placeholder="" id="txtID" requiere="">
        <br>

        <label for="">Nombre:</label>
        <input type="text" name="txtNombre" value="<?php echo $txtNombre?>" placeholder="" id="txtNombre" requiere="">
        <br>

        <label for="">Descripcion:</label>
        <input type="text" name="txtDescripcion" value="<?php echo $txtDescripcion?>" placeholder="" id="txtDescripcion" requiere="">
        <br>

        <button value="btnAgregar" type="submit" name="accion">Agregar</button>
        <button value="btnModificar" type="submit" name="accion">Modificar</button>
        <button value="btnEliminar" type="submit" name="accion">Eliminar</button>
        <button value="btnCancelar" type="submit" name="accion">Cancelar</button>
        </form>

    <div class="row">

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Acciones</th>
                </tr>
            </thead>

        <?php foreach($listaCategorias as $categoria){ ?>

            <tr>
                <td><?php echo $categoria['ID']; ?></td>
                <td><?php echo $categoria['Nombre']; ?></td>
                <td><?php echo $categoria['Descripcion']; ?></td>
                <td>

                <form action="" method="post">
                <input type="hidden" name="txtID" value="<?php echo $categoria['ID']; ?>">
                <input type="hidden" name="txtNombre" value="<?php echo $categoria['Nombre']; ?>">
                <input type="hidden" name="txtDescripcion" value="<?php echo $categoria['Descripcion']; ?>">

                <input type="submit" value="Seleccionar" name="accion">
                <button value="btnEliminar" type="submit" name="accion">Eliminar</button>
                </form>
                    
                
            
            </td>
            </tr>

        <?php } ?>    
        </table>


    </div>
        <form action="" method="post">
        <label for="">ID:</label>
        <input type="number" name="txtIDpro" value="<?php echo $txtIDpro?>" placeholder="" id="txtIDpro" requiere="">
        <br>

        <label for="">Nombre:</label>
        <input type="text" name="txtNombrePro" value="<?php echo $txtNombrePro?>" placeholder="" id="txtNombrePro" requiere="">
        <br>

        <label for="">Descripcion:</label>
        <input type="text" name="txtDescripcionPro" value="<?php echo $txtDescripcionPro?>" placeholder="" id="txtDescripcionPro" requiere="">
        <br>

        <label for="">Precio:</label>
        <input type="number" name="txtPrecio" value="<?php echo $txtPrecio?>" placeholder="" id="txtPrecio" requiere="">
        <br>

        <label for="">Categoria:</label>
        <input type="text" name="txtCategoria" value="<?php echo $txtCategoria?>" placeholder="" id="txtCategoria" requiere="">
        <br>

        <button value="btnAgregar" type="submit" name="accion2">Agregar</button>
        <button value="btnModificar" type="submit" name="accion2">Modificar</button>
        <button value="btnEliminar" type="submit" name="accion2">Eliminar</button>
        <button value="btnCancelar" type="submit" name="accion2">Cancelar</button>
        </form>
        <div class="row">

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Categoria</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <?php foreach($listaPorductos as $producto){ ?>

        <tr>
            <td><?php echo $producto['ID']; ?></td>
            <td><?php echo $producto['Nombre']; ?></td>
            <td><?php echo $producto['Descripcion']; ?></td>
            <td><?php echo $producto['Precio']; ?></td>
            <td><?php echo $producto['Categoria']; ?></td>

            <td>

            <form action="" method="post">
            <input type="hidden" name="txtIDpro" value="<?php echo $producto['ID']; ?>">
            <input type="hidden" name="txtNombrePro" value="<?php echo $producto['Nombre']; ?>">
            <input type="hidden" name="txtDescripcionPro" value="<?php echo $producto['Descripcion']; ?>">
            <input type="hidden" name="txtPrecio" value="<?php echo $producto['Precio']; ?>">
            <input type="hidden" name="txtCategoria" value="<?php echo $producto['Categoria']; ?>">

            <input type="submit" value="Seleccionar" name="accion2">
            <button value="btnEliminar" type="submit" name="accion2">Eliminar</button>
            </form>
                
            
        
        </td>
        </tr>

        <?php } ?>    
        </table>


    </div>
    </div>
</body>
</html>