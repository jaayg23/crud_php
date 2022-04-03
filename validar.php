<?php
$usuario=$_POST['usuario'];
$contra=$_POST['contra'];
session_star();
$_SESSION['contra']=$usuario;

include("conexion.php");

$conexion=mysqli_connect("localhost","root","","prueba php");

$consulta="SELECT * FROM admins WHERE usuario='$usuario' AND contra='$contra'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
    header("location: categorias.php");
}else{
    ?>
    <?php
    include("index.php");
    ?>
    <h1 class="bad">ERROR EN LA AUTENTIFICACION</h1>
    <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);
