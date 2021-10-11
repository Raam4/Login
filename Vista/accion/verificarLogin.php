<?php
include_once "../../configuracion.php";
$data = data_submitted();
$objSession = new Session();
if($objSession->validar($data['username'], md5($data['pass']))){
    if($objSession->habilitado()){
        header("Location:http://".$_SERVER['HTTP_HOST']."/Login/Vista/index/index.php");
    }else{
        header("Location:http://".$_SERVER['HTTP_HOST']."/Login/Vista/sites/login.php?deshab=1");
    }
}else{
    header("Location:http://".$_SERVER['HTTP_HOST']."/Login/Vista/sites/login.php?errorcred=1");
}
?>