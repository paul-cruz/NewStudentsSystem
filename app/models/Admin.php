<?php

class Admin
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function index()
    {
        session_start();

        if(!isset($_SESSION['rol'])){
            header('location: /');
        }else{
            if($_SESSION['rol'] != 1){
                header('location: /');
            }
        }

        $admins = array();
        $groups = array();
        $inscritos = array();
        $students = array(); 
        
        $result = $this->db->executeQuery("SELECT * FROM Administrador");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $admins[] = ["Numero de empleado"=>$row['numeroEmpleado'], "Nombre"=>$row["nombre"], "Apellido"=>$row["apPat"], "Puesto"=>$row["puesto"]];
            }
          } else {
            echo "0 results";
        }

        $result = $this->db->executeQuery("SELECT * FROM Grupo");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $groups[] = ["Grupo"=>$row['idGrupo'], "Hora de exámen"=>$row["horaExamen"], "Alumnos inscritos"=>$row["inscritos"]];
            }
          } else {
            echo "0 results";
        }

        $result = $this->db->executeQuery("SELECT * FROM Usuario WHERE rol = '2'");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $inscritos[] = ["Boleta"=>$row['idUsuario']];
            }
          } else {
            echo "0 results";
        }

        $result = $this->db->executeQuery("SELECT * FROM Alumno");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $students[] = ["Boleta"=>$row['boleta'], "Nombre"=>$row["nombre"], "Apellido paterno"=>$row["apPat"], "Apellido materno" => $row["apMat"], "Grupo" => $row["grupo"], "Teléfono" => $row["telefono"], "Correo" => $row["correoE"], "Promedio" => $row["promedio"], "Calle" => $row["calle"], "Número" => $row["numero"], "Colonia" => $row["colonia"], "Código postal" => $row["codigoP"], "Fecha de nacimiento" => $row["fechNac"], "CURP" => $row["curp"]];
            }
          } else {
            echo "0 results";
        }

        return [
            "header" => new Template("views/components/headers/inner_header.html", []),
            "child" => new Template("views/home.html", [
                "cards" => array(
                    new Template("views/components/cards/home_card.html", [
                        "col_size" => "4",
                        "title" => "Administradores",
                        "child" => new Template("views/components/tables/table.html", [
                            "title" => "Admin",
                            "data" => $admins,
                            "insertModal" => new Template("views/components/forms/Admin/insert.html", []),
                            "deleteModal" => new Template("views/components/forms/Admin/delete.html", []),
                            "updateModal" => new Template("views/components/forms/Admin/update.html", []),
                        ])
                    ]),
                    new Template("views/components/cards/home_card.html", [
                        "col_size" => "4",
                        "title" => "Horarios de Examen",
                        "child" => new Template("views/components/tables/table.html", [
                            "title" => "Group",
                            "data" => $groups,
                            "insertModal" => new Template("views/components/forms/Schedule/insert.html", []),
                            "deleteModal" => new Template("views/components/forms/Schedule/delete.html", []),
                            "updateModal" => new Template("views/components/forms/Schedule/update.html", []),
                        ])
                    ]),
                    new Template("views/components/cards/home_card.html", [
                        "col_size" => "4",
                        "title" => "Alumnos inscritos",
                        "child" => new Template("views/components/tables/table.html", [
                            "title" => "Student",
                            "data" => $inscritos,
                            "insertModal" => new Template("views/components/forms/Students/insert.html", []),
                            "deleteModal" => new Template("views/components/forms/Students/delete.html", []),
                            "updateModal" => new Template("views/components/forms/Students/update.html", []),
                        ])
                    ]),
                    new Template("views/components/cards/home_card.html", [
                        "col_size" => "12",
                        "title" => "Usuarios registrados",
                        "child" => new Template("views/components/tables/table.html", [
                            "title" => "User",
                            "data" => $students,
                            "insertModal" => new Template("views/components/forms/Students/insert.html", []),
                            "deleteModal" => new Template("views/components/forms/Students/delete.html", []),
                            "updateModal" => new Template("views/components/forms/Students/update.html", []),
                        ])
                    ])
                )
            ])
        ];
    }

    public function show($arg)
    {
        # code...
    }

    public function read($id)
    {
        # code...
    }

    public function create()
    {
        # code...
    }

    public function update($data)
    {
        $query = "UPDATE Administrador SET nombre = '".$data["nombre"]."', apPat = '".$data["ApPatA"]."', apMat = '".$data["ApMatA"]."', puesto = '".$data["puesto"]."' WHERE numeroEmpleado = '".$data["claveTrabajo"]."'"; 
        $result = $this->db->executeQuery($query);
    }

    public function delete($id)
    {
        $query = "DELETE FROM Administrador WHERE numeroEmpleado = '".$id["claveTrabajo"]."'";
        $this->db->executeQuery($query);
    }
}

if(isset($_REQUEST["delete"])){
    require_once("../controllers/db.class.php");
    $db = new DB();
    $admin = new Admin($db);
    $admin->delete($_REQUEST["delete"]);
}

if(isset($_REQUEST["update"])){
    require_once("../controllers/db.class.php");
    $db = new DB();
    $admin = new Admin($db);
    $admin->update($_REQUEST["update"]);
}