<?php
    require_once 'modelo_conexion.php';

    class Modelo_Apoderado extends conexionBD{

        public function listar_apoderado(){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_LISTAR_APODERADO()";
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

        public function Registrar_Apoderado($dnimadre,$nacionalidadmadre,$nombremadre,$generomadre,$parentescomadre,$nacimientomadre,$ciudadmadre,$direccionmadre,$correomadre,$telefonomadre,
        $dnipadre,$nacionalidadpadre,$nombrepadre,$generopadre,$parentescopadre,$nacimientopadre,$ciudadpadre,$direccionpadre,$correopadre,$telefonopadre,
        $dniapoderado,$nacionalidadapoderado,$nombreapoderado,$generoapoderado,$parentescoapoderado,$nacimientoapoderado,$ciudadapoderado,$direccionapoderado,$correoapoderado,$telefonoapoderado){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_REGISTRAR_APODERADO(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1,$dnimadre);
            $query->bindParam(2,$nacionalidadmadre);
            $query->bindParam(3,$nombremadre);
            $query->bindParam(4,$generomadre);
            $query->bindParam(5,$parentescomadre);
            $query->bindParam(6,$nacimientomadre);
            $query->bindParam(7,$ciudadmadre);
            $query->bindParam(8,$direccionmadre);
            $query->bindParam(9,$correomadre);
            $query->bindParam(10,$telefonomadre);
            $query->bindParam(11,$dnipadre);
            $query->bindParam(12,$nacionalidadpadre);
            $query->bindParam(13,$nombrepadre);
            $query->bindParam(14,$generopadre);
            $query->bindParam(15,$parentescopadre);
            $query->bindParam(16,$nacimientopadre);
            $query->bindParam(17,$ciudadpadre);
            $query->bindParam(18,$direccionpadre);
            $query->bindParam(19,$correopadre);
            $query->bindParam(20,$telefonopadre);
            $query->bindParam(21,$dniapoderado);
            $query->bindParam(22,$nacionalidadapoderado);
            $query->bindParam(23,$nombreapoderado);
            $query->bindParam(24,$generoapoderado);
            $query->bindParam(25,$parentescoapoderado);
            $query->bindParam(26,$nacimientoapoderado);
            $query->bindParam(27,$ciudadapoderado);
            $query->bindParam(28,$direccionapoderado);
            $query->bindParam(29,$correoapoderado);
            $query->bindParam(30,$telefonoapoderado);
            $resultado = $query->execute();
            if($row = $query->fetchColumn()){
                return $row;
            }
            conexionBD::cerrar_conexion();

        }

        public function Modificar_Apoderado($idmadre,$nombremadre,$nacimientomadre,$ciudadmadre,$direccionmadre,$correomadre,$telefonomadre,$idpadre,$nombrepadre,$nacimientopadre,$ciudadpadre,$direccionpadre,$correopadre,$telefonopadre,$idapoderado,$dniapoderado,$nombreapoderado,$parentescoapoderado,$nacimientoapoderado,$ciudadapoderado,$direccionapoderado,$correoapoderado,$telefonoapoderado){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_MODIFICAR_APODERADO(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1,$idmadre);
            $query->bindParam(2,$nombremadre);
            $query->bindParam(3,$nacimientomadre);
            $query->bindParam(4,$ciudadmadre);
            $query->bindParam(5,$direccionmadre);
            $query->bindParam(6,$correomadre);
            $query->bindParam(7,$telefonomadre);
            $query->bindParam(8,$idpadre);
            $query->bindParam(9,$nombrepadre);
            $query->bindParam(10,$nacimientopadre);
            $query->bindParam(11,$ciudadpadre);
            $query->bindParam(12,$direccionpadre);
            $query->bindParam(13,$correopadre);
            $query->bindParam(14,$telefonopadre);
            $query->bindParam(15,$idapoderado);
            $query->bindParam(16,$dniapoderado);
            $query->bindParam(17,$nombreapoderado);
            $query->bindParam(18,$parentescoapoderado);
            $query->bindParam(19,$nacimientoapoderado);
            $query->bindParam(20,$ciudadapoderado);
            $query->bindParam(21,$direccionapoderado);
            $query->bindParam(22,$correoapoderado);
            $query->bindParam(23,$telefonoapoderado);
            $resultado = $query->execute();
            if($resultado){
                return 1;
            }else{
                return 0;
            }
            conexionBD::cerrar_conexion();

        }

        public function Modificar_Apoderado_Estatus($id,$estado){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_MODIFICAR_APODERADO_ESTATUS(?,?)";
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