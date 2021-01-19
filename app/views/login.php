<?php
require_once('controllers/db.class.php');

session_start();

if (isset($_SESSION['rol'])) {
    switch ($_SESSION['rol']) {
        case 1:
            header('location: /Admin');
            break;

        case 2:
            header('location: /User');
            break;

        default:
    }
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new DB();
    $row = (array) $db->queryOne("SELECT * FROM Usuario WHERE idUsuario = '" . $username . "' AND clave = '" . $password . "';");
    if ($row == true) {
        $rol = $row["rol"];
        $_SESSION['rol'] = $rol;

        switch ($_SESSION['rol']) {
            case 1:
                header('location: /Admin');
                break;

            case 2:
                header('location: /User');
                break;

            default:
        }
    } else {
        echo '<script language="javascript"> alert("Nombre de usuario o contraseña incorrecto") </script>';
    }
}

?>
<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center vh-100">
        <div class="col-lg-2 col-md-2"></div>
        <div class="col-lg-8 col-md-8">
            <div class="card text-center border my-5">
                <div class="card-header p-3">
                    <span> <img src="views/images/logoESCOM.svg" alt="Logo" class="w-40"> </span><br />
                    <h2 class="logo_title mt-1"> Sistema de nuevo ingreso </h2>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center text-center">
                        <form action="" method="POST" class="w-75 login-form">
                            <input type="text" name="username" class="form-control" placeholder="Boleta">
                            <input type="password" name="password" class="form-control" placeholder="Contraseña">
                            <input type="submit" name="btn" value="Iniciar Sesión" class="btn btn-outline-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-2"></div>
    </div>
</div>