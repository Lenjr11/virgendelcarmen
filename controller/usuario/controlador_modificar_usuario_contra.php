<?php
    require '../../model/modelo_usuario.php';
    $ruta ="";
    $MU = new Modelo_Usuario();
    $id = htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');
    $contra = password_hash($_POST['contranueva'],PASSWORD_DEFAULT,['cost'=>12]);
    $consulta = $MU->Modificar_Usuario_Contra($id,$contra);
    echo $consulta;

?>