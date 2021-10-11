<?php
include_once "../../configuracion.php";
include_once "../estructura/header.php";
$Titulo = "Actualiza Usuario";
$data = data_submitted();
$ok = false;
$bool = false;
$objAbmUsuario = new AbmUsuario();
$objAbmUsuarioRol = new AbmUsuarioRol();
$rolesDelUser = $objAbmUsuarioRol->buscar(['idUsuario' => $data['idUsuario']]);
$idRolesActuales = array();

foreach($rolesDelUser as $roluser){
    array_push($idRolesActuales, $roluser->getIdRol());
}

if(strlen($data['usPass'])<32){
    $data['usPass'] = md5($data['usPass']);
}

if(isset($data['usDeshabilitado'])){
    $data['usDeshabilitado'] = date("Y-m-d H:i:s");
    $bool = true;
}

if($objAbmUsuario->modificacion($data, $bool)){
    foreach($idRolesActuales as $idRolActual){ //debe tener al menos un rol (validacion)
        $param = ['idUsuario' => $data['idUsuario'], 'idRol' => $idRolActual];
        if(!in_array($idRolActual, $data['roles'])){
            $objAbmUsuarioRol->baja($param);
        }
        echo "ok";
    }
    foreach($data['roles'] as $idRol){ //debe tener al menos un rol (validacion)
        $param = ['idUsuario' => $data['idUsuario'], 'idRol' => $idRol];
        if(!in_array($idRol, $idRolesActuales)){
            $objAbmUsuarioRol->alta($param);
        }
        echo "ok";
    }
    $ok = true;
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <div class="card border rounded shadow fw-bold p-4">
                <?php
                if($ok){
                    echo "<h3>Los datos fueron modificados exitosamente.</h3>";
                }else{
                    echo "<h3>Los datos no pudieron ser modificados.</h3>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include_once "../estructura/footer.php"; ?>