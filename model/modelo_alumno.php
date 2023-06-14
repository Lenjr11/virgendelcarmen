<?php
    require_once 'modelo_conexion.php';

    class Modelo_Alumno extends conexionBD{

        public function listar_alumno(){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_LISTAR_ALUMNO()";
            $arreglo = array();
            $query = $c->prepare($sql);
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($resultado as $resp){
                $arreglo["data"][] = $resp;
            }

            return $arreglo;
            conexionBD::cerrar_conexion();

        }

        public function Registrar_Alumno($dni,$nacionalidad,$nombre,$genero,$nacimiento,$celular,$ciudad,$direccion){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_REGISTRAR_ALUMNO(?,?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1,$dni);
            $query->bindParam(2,$nacionalidad);
            $query->bindParam(3,$nombre);
            $query->bindParam(4,$genero);
            $query->bindParam(5,$nacimiento);
            $query->bindParam(6,$celular);
            $query->bindParam(7,$ciudad);
            $query->bindParam(8,$direccion);
            $resultado = $query->execute();
            if($row = $query->fetchColumn()){
                return $row;
            }
            conexionBD::cerrar_conexion();

        }

        public function Modificar_Alumno($id,$nombre,$ciudad,$direccion){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_MODIFICAR_ALUMNO(?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1,$id);
            $query->bindParam(2,$nombre);
            $query->bindParam(3,$ciudad);
            $query->bindParam(4,$direccion);
            $resultado = $query->execute();
            if($resultado){
                return 1;
            }else{
                return 0;
            }
            conexionBD::cerrar_conexion();

        }
        public function Modificar_Alumno_Estatus($id,$estado){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_MODIFICAR_ALUMNO_ESTATUS(?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1,$id);
            $query->bindParam(2,$estado);
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