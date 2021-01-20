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
                            "title" => "Schedule",
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
                            "title" => "Students",
                            "data" => $students,
                            "insertModal" => new Template("views/components/forms/Students/insert.html", []),
                            "deleteModal" => new Template("views/components/forms/Students/delete.html", []),
                            "updateModal" => new Template("views/components/forms/Students/update.html", []),
                        ])
                    ]),
                    new Template("views/components/cards/home_card.html", [
                        "col_size" => "12",
                        "title" => "Alumnos registrados"
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

    public function update($id)
    {
        # code...
    }

    public function delete($id)
    {
        # code...
    }
}
