
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <form action="login.php" method="post">
    <h1>Sistema de Login</h1>
    <p>Admin<input type="text" placeholder="ingrese su usuario" name="usuario"></p>
    <p>Password<input type="password" placeholder="ingrese su password" name="contra"></p>
    <input type="submit" value="Ingresar">

    </form>
</body>
<?php
if($_POST){
    session_start();
    require('conexion.php');
    $u = $_POST['usuario'];
    $p = $_POST['contra'];
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $pdo->prepare("SELECT * FROM admins WHERE usuario= :u AND contra= :p");
    $query->bindParam(":u",$u);
    $query->bindParam(":p",$p);
    $query->execute();
    $usuario=$query->fetch(PDO::FETCH_ASSOC);
    if($usuario){
        $_SESSION['usuario'] =$usuario["admin"];
        header("Location:categorias.php");
    }else{
        echo "Usuario o password son incorrectos";
    }
}
?>
</html>