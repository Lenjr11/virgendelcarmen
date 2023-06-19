<?php
    require_once 'modelo_conexion.php';

    class Modelo_Matricula extends conexionBD{

        public function listar_select_dni(){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_LISTAR_DNI()";
            $arreglo = array();
            $query = $c->prepare($sql);
            $query->execute();
            $resultado = $query->fetchAll();
            foreach($resultado as $resp){
                $arreglo[] = $resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();

        }

        public function listar_select_dni_apoderado(){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_LISTAR_DNI_APODERADO()";
            $arreglo = array();
            $query = $c->prepare($sql);
            $query->execute();
            $resultado = $query->fetchAll();
            foreach($resultado as $resp){
                $arreglo[] = $resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();

        }

        public function listar_select_grado(){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_LISTAR_GRADO()";
            $arreglo = array();
            $query = $c->prepare($sql);
            $query->execute();
            $resultado = $query->fetchAll();
            foreach($resultado as $resp){
                $arreglo[] = $resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();

        }

        public function Registrar_Matricula($dni,$dniapoderado,$matricode,$grado,$situacion,$procedencia,$observacion,$cmatricula,$cmensualidad,$descuento,$fecha,$matrictotal){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_REGISTRAR_MATRICULA(?,?,?,?,?,?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1,$dni);
            $query->bindParam(2,$dniapoderado);
            $query->bindParam(3,$matricode);
            $query->bindParam(4,$grado);
            $query->bindParam(5,$situacion);
            $query->bindParam(6,$procedencia);
            $query->bindParam(7,$observacion);
            $query->bindParam(8,$cmatricula);
            $query->bindParam(9,$cmensualidad);
            $query->bindParam(10,$descuento);
            $query->bindParam(11,$fecha);
            $query->bindParam(12,$matrictotal);
            $resultado = $query->execute();
            if($row = $query->fetchColumn()){
                return $row;
            }
            conexionBD::cerrar_conexion();

        }

        public function Modificar_Matricula_Estatus($id,$estado){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_MODIFICAR_MATRICULA_ESTATUS(?,?)";
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