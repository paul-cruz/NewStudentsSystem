<?php
require("PHPMailer/src/PHPMailer.php");
require("PHPMailer/src/SMTP.php");
require("PHPMailer/src/Exception.php");

class Emailsender
{

    public function __construct($db)
    {
        session_start();

        if (!$_SESSION['idUsuario']) {
            header('location: /');
        }

        $db = new DB();
        $user = (array) $db->queryOne("SELECT boleta, Alumno.nombre, apPat, apMat, telefono, correoE, genero, curp, Grupo.idGrupo AS 'grupo', Grupo.horaExamen AS 'horario', CatalogoDeEscuelas.nombre AS 'Escuela', promedio, opcionESCOM, calle, colonia, numero, codigoP AS 'CP', EntidadFederativa.nombre AS 'state', fechNac, nombreEscuela AS 'Nombre Escuela' FROM Alumno INNER JOIN EntidadFederativa ON Alumno.idEntFed = EntidadFederativa.idEntFed LEFT JOIN CatalogoDeEscuelas ON Alumno.idEscuela = CatalogoDeEscuelas.idEscuela INNER JOIN Grupo ON Alumno.grupo = Grupo.idGrupo WHERE boleta = '" . $_SESSION['idUsuario'] . "'");

        $user["genero"] = $user["genero"] == "M" ? "Masculino" : "Femenino";
        if (!$user["Escuela"]) {
            $user["Escuela"] = $user["Nombre Escuela"];
        }

        $template = "<!doctype html>" .
            "<html lang='es'>" .
            "    <head>" .
            "        <meta charset='utf-8'>" .
            "        <meta name='viewport' content='width=device-width, initial-scale=1'>" .
            "        <style>" .
            "            * {" .
            "                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen," .
            "                    Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;" .
            "            }" .
            "            body {" .
            "                margin: 10px;" .
            "                text-align: center;" .
            "            }" .
            "            h1,img {" .
            "                color: #136aa4;" .
            "                margin: 0px 5px 0px 5px;" .
            "                height: 100px;" .
            "                display: inline-block;" .
            "            }" .
            "            .field{" .
            "                margin: 0 5px 10px 25px;" .
            "            }" .
            "            .value{" .
            "                margin: 0 25px 10px 0px;" .
            "            }" .
            "            h2{" .
            "                color: #3d001d;" .
            "            }" .
            "            p{" .
            "                font-size: x-large;" .
            "            }" .
            "        </style>" .
            "    </head>" .
            "    <body>" .
            "        <div>" .
            "            <div>" .
            "                <img src='https://www.escom.ipn.mx/images/conocenos/escudoESCOM.png' style='width: 100px;'>" .
            "                <h1>Escuela Superior de Cómputo</h1>" .
            "                <img src='https://www.est.ipn.mx/assets/files/est/uploads/ipn.png' style='width: 100px;'>" .
            "            </div>" .
            "            <div>" .
            "                <div>" .
            "                    <p>A continuación se presenta los datos que ingresaste en el sistema de alumnos de nuevo" .
            "                        ingreso de ESCOM, recuerda que presentarás un exámen de saberes generales, encontraras el" .
            "                        grupo y hora que te fue asignado, no faltes. ¡Bienvenido!</p>" .
            "                </div>" .
            "                <h2>Identidad</h2>" .
            "                <div>" .
            "                    <label class='field'><strong>No.Boleta:</strong></label>" .
            "                    <label class='value'>" . $user["boleta"] . "</label>" .
            "                    <label class='field'><strong>Nombre(s):</strong></label>" .
            "                    <label class='value'>" . $user["nombre"] . "</label>" .
            "                </div>" .
            "                <div>" .
            "                    <label class='field'><strong>Apellido Paterno:</strong></label>" .
            "                    <label class='value'>" . $user["apPat"] . "</label>" .
            "                    <label class='field'><strong>Apellido Materno:</strong></label>" .
            "                    <label class='value'>" . $user["apMat"] . "</label>" .
            "                </div>" .
            "                <div>" .
            "                    <label class='field'><strong>Fecha de Nacimiento:</strong></label>" .
            "                    <label class='value'>" . $user["fechNac"] . "</label>" .
            "                    <label class='field'><strong>Sexo:</strong></label>" .
            "                    <label class='value'>" . $user["genero"] . "</label>" .
            "                </div>" .
            "                <div>" .
            "                    <label class='field'><strong>CURP:</strong></label>" .
            "                    <label class='value'>" . $user["curp"] . "</label>" .
            "                </div>" .
            "                <h2>Contacto</h2>" .
            "                <hr />" .
            "                <div>" .
            "                    <label class='field'><strong>Calle:</strong></label>" .
            "                    <label class='value'>" . $user["calle"] . "</label>" .
            "                    <label class='field'><strong>Número:</strong></label>" .
            "                    <label class='value'>" . $user["numero"] . "</label>" .
            "                </div>" .
            "                <div>" .
            "                    <label class='field'><strong>Colonia:</strong></label>" .
            "                    <label class='value'>" . $user["colonia"] . "</label>" .
            "                    <label class='field'><strong>CP:</strong></label>" .
            "                    <label class='value'>" . $user["CP"] . "</label>" .
            "                </div>" .
            "                <div>" .
            "                    <label class='field'><strong>Teléfono:</strong></label>" .
            "                    <label class='value'>" . $user["telefono"] . "</label>" .
            "                    <label class='field'><strong>Correo:</strong></label>" .
            "                    <label class='value'>" . $user["correoE"] . "</label>" .
            "                </div>" .
            "                <h2>Procedencia</h2>" .
            "                <hr />" .
            "                <div>" .
            "                    <label class='field'><strong>Entidad Federativa:</strong></label>" .
            "                    <label class='value'>" . $user["state"] . "</label>" .
            "                    <label class='field'><strong>Escuela de procedencia:</strong></label>" .
            "                    <label class='value'>" . $user["Escuela"] . "</label>" .
            "                </div>" .
            "                <div>" .
            "                    <label class='field'><strong>Promedio:</strong></label>" .
            "                    <label class='value'>" . $user["promedio"] . "</label>" .
            "                    <label class='field'><strong>Número de opción:</strong></label>" .
            "                    <label class='value'>" . $user["opcionESCOM"] . "</label>" .
            "                </div>" .
            "                <h2>Datos de exámen</h2>" .
            "                <hr />" .
            "                <div>" .
            "                    <label class='field'><strong>Grupo:</strong></label>" .
            "                    <label class='value'>" . $user["grupo"] . "</label>" .
            "                    <label class='field'><strong>Hora:</strong></label>" .
            "                    <label class='value'>" . $user["horario"] . "</label>" .
            "                </div>" .
            "            </div>" .
            "        </div>" .
            "    </body>" .
            "</html>";

        // Send message using PHP Mailer
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP(); // enable SMTP
        $mail->CharSet="UTF-8";
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
        $mail->Username = "nuevo.usuario.smpt@gmail.com";
        $mail->Password = "Contrasena1";
        $mail->SetFrom("sni.escom.ipn@gmail.com");
        $mail->Subject = "Formulario de registro sistema nuevo ingreso";
        $mail->Body = $template;
        $mail->AddAddress($user["correoE"]);

        if (!$mail->Send()) {
            echo '<script language="javascript"> alert("No se pudo enviar el correo electronico\n Mailer Error: '.$mail->ErrorInfo.') </script>';
        }
        header('location: /User');
    }
}
