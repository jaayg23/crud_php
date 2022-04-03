<?php

include("conexion.php");

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
    <title>Consultas</title>
</head>
<body>
    <div class="container">
        <div class="row">

            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                    </tr>
                </thead>

                <?php foreach($listaCategorias as $categoria){ ?>

                    <tr>
                        <td><?php echo $categoria['Nombre']; ?></td>
                        <td><?php echo $categoria['Descripcion']; ?></td>
                    </tr>
                <?php } ?>
            </table>

            <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Precio</th>
                <th>Categoria</th>
            </tr>
        </thead>

        <?php foreach($listaPorductos as $producto){ ?>

        <tr>

            <td><?php echo $producto['Nombre']; ?></td>
            <td><?php echo $producto['Descripcion']; ?></td>
            <td><?php echo $producto['Precio']; ?></td>
            <td><?php echo $producto['Categoria']; ?></td>

            </td>
        </tr>

        <?php } ?>    
        </table>
    </div>
</body>
</html>