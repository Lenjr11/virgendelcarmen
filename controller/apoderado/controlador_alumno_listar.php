<?php
    require '../../model/modelo_apoderado.php';
    $MU = new Modelo_Apoderado();
    $consulta = $MU->listar_apoderado();
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