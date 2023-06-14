<?php
    require_once 'modelo_conexion.php';

    class Modelo_Inscripcion extends conexionBD{

        public function Registrar_inscripcion($dni,$nombres,$apellidos,$correo,$telefono,$grado,$consulta){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_REGISTRAR_INSCRIPCION(?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1,$dni);
            $query->bindParam(2,$nombres);
            $query->bindParam(3,$apellidos);
            $query->bindParam(4,$correo);
            $query->bindParam(5,$telefono);
            $query->bindParam(6,$grado);
            $query->bindParam(7,$consulta);
            $resultado = $query->execute();
            if($row = $query->fetchColumn()){
                return $row;
            }
            conexionBD::cerrar_conexion();
        }

        public function Eliminar_Inscripcion($id){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_ELIMINAR_INSCRIPCION(?)";
            $query = $c->prepare($sql);
            $query->bindParam(1,$id);
            $resultado = $query->execute();
            if($resultado){
                return 1;
            }else{
                return 0;
            }
            conexionBD::cerrar_conexion();

        }

        
        

    }

?>