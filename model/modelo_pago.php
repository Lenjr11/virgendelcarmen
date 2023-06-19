<?php
    require_once 'modelo_conexion.php';

    class Modelo_Pago extends conexionBD{

        public function listar_select_cod(){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_LISTAR_COD()";
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


        public function Registrar_Pago($code,$monto,$descripcion,$mes,$fecha,$modalidad,$operacion,$registro,$enviar,$boleta){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_REGISTRAR_PAGO(?,?,?,?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1,$code);
            $query->bindParam(2,$monto);
            $query->bindParam(3,$descripcion);
            $query->bindParam(4,$mes);
            $query->bindParam(5,$fecha);
            $query->bindParam(6,$modalidad);
            $query->bindParam(7,$operacion);
            $query->bindParam(8,$registro);
            $query->bindParam(9,$enviar);
            $query->bindParam(10,$boleta);
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

    }

?>