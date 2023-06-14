<?php
    require_once 'modelo_conexion.php';

    class Modelo_Usuario extends conexionBD{

        public function VerificarUsuario($usuario,$pass){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_VERIFICAR_USUARIO(?)";
            $arreglo = array();
            $query = $c->prepare($sql);
            $query->bindParam(1,$usuario);
            $query->execute();
            $resultado = $query->fetchAll();
            foreach($resultado as $resp){
                if(password_verify($pass,$resp['usuari_clave'])){
                $arreglo[] = $resp;
                }
            }

            return $arreglo;
            conexionBD::cerrar_conexion();

        }

        public function listar_usuario(){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_LISTAR_USUARIO()";
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

        public function listar_select_rol(){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_LISTAR_SELECT_ROL()";
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

        public function Registrar_Usuario($nombre,$apellido,$usuario,$email,$contra,$telefono,$fecha,$rol){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_REGISTRAR_USUARIO(?,?,?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1,$nombre);
            $query->bindParam(2,$apellido);
            $query->bindParam(3,$usuario);
            $query->bindParam(4,$email);
            $query->bindParam(5,$contra);
            $query->bindParam(6,$telefono);
            $query->bindParam(7,$fecha);
            $query->bindParam(8,$rol);
            $resultado = $query->execute();
            if($row = $query->fetchColumn()){
                return $row;
            }
            conexionBD::cerrar_conexion();

        }

        public function Modificar_Usuario($id,$nombre,$apellido,$telefono,$email,$rol){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_MODIFICAR_USUARIO(?,?,?,?,?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1,$id);
            $query->bindParam(2,$nombre);
            $query->bindParam(3,$apellido);
            $query->bindParam(4,$telefono);
            $query->bindParam(5,$email);
            $query->bindParam(6,$rol);
            $resultado = $query->execute();
            if($resultado){
                return 1;
            }else{
                return 0;
            }
            conexionBD::cerrar_conexion();

        }

        public function Modificar_Usuario_Estatus($id,$estado){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_MODIFICAR_USUARIO_ESTATUS(?,?)";
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

        public function Modificar_Usuario_Contra($id,$contra){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_MODIFICAR_USUARIO_CONTRA(?,?)";
            $query = $c->prepare($sql);
            $query->bindParam(1,$id);
            $query->bindParam(2,$contra);
            $resultado = $query->execute();
            if($resultado){
                return 1;
            }else{
                return 0;
            }
            conexionBD::cerrar_conexion();

        }


        public function Modificar_Intento_Usuario($user){
            $c = conexionBD::conexionPDO();

            $sql = "CALL SP_INTENTO_USUARIO(?)";
            $query = $c->prepare($sql);
            $query->bindParam(1,$user);
            $resultado = $query->execute();
            if($row = $query->fetchColumn()){
                return $row;
            }
            conexionBD::cerrar_conexion();

        }

       

    }

?>