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
        $_SESSION['idUsuario'] = $username;

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
                        <form id="loginForm" action="" method="POST" class="w-75 login-form">
                            <input type="text" name="username" class="form-control" placeholder="Boleta">
                            <input type="password" name="password" class="form-control" placeholder="Contraseña">
                            <div>
                                <input type="submit" name="btn" value="Iniciar Sesión" class="btn btn-outline-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-2"></div>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        $("#loginForm").validate({
            rules: {
                username: {
                    required: true,
                    pattern: /((P)+([P,E])+([0-9]{8}))|(ADMIN+([0-9]{5}))/,
                    minlength: 10,
                    maxlength: 10
                },
                password: {
                    required: true,
                    minlength: 10,
                    maxlength: 10
                }
            },
            messages: {
                username: {
                    required: "Ingresa un usuario por favor",
                    pattern: "Usuario inválido",
                    maxlength: "El usuario debe ser de 10 caracteres",
                    minlength: "El usuario debe ser de 10 caracteres",
                },
                password: {
                    required: "Ingresa tu contraseña por favor",
                    maxlength: "La contraseña debe ser de 10 caracteres",
                    minlength: "La contraseña debe ser de 10 caracteres",
                }
            },
            highlight: function(e) {
                $(e).addClass("is-invalid");
                $(e).removeClass("is-valid");
            },
            unhighlight: function(e) {
                $(e).addClass("is-valid");
                $(e).removeClass("is-invalid");
            },
        });

    });
</script>