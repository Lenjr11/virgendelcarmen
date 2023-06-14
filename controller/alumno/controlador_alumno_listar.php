<?php
    require '../../model/modelo_alumno.php';
    $MU = new Modelo_Alumno();
    $consulta = $MU->listar_alumno();
    if($consulta){
        echo json_encode($consulta);
    }else{
        echo '{
            "sEcho": 1,
            "iTotalRecords": "0",
            "iTotalDisplayRecords": "0",
            "aaData": []
        }';
    }


?>