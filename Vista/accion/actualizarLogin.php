<?php 
$Titulo = "Ejercicio 6";
include_once("../../vista/estructura/header.php");
include_once("../../configuracion.php");
$objAbmUsuario = new AbmUsuario();
$objAbmUsuarioRol = new AbmUsuarioRol();
$objAbmRol = new AbmRol();
$data = data_submitted();
$objUsuario = $objAbmUsuario->buscar($data);
$desh = false;
$arrayRoles = array();
if(!is_null($objUsuario[0]->getUsDeshabilitado())){
    $desh = true;
}
$userRol = $objAbmUsuarioRol->buscar($data);
if(count($userRol) != 0){
    foreach($userRol as $obj){
        array_push($arrayRoles, $obj->getIdRol());
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="card border rounded shadow fw-bold pt-1">
                <form class="ms-2 mb-3" id="datauser" name="datauser" method="POST" action="actualizaUser.php" data-toggle="validator" novalidate>
                    <p>Edite los datos del usuario:</p>
                    <div class="row pe-2 mt-3">
                        <div class="col-md-2">
                            <div class="form-group">
                                <input class="form-control" type="text" id="idUsuario" name="idUsuario" placeholder="ID" value="<?=$objUsuario[0]->getIdUsuario()?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row pe-2 mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" type="text" id="usNombre" name="usNombre" placeholder="Nombre de Usuario" value="<?=$objUsuario[0]->getUsNombre()?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" type="password" id="usPass" name="usPass" placeholder="Contraseña" value="<?=$objUsuario[0]->getUsPass()?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="row pe-2 mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" type="text" id="usMail" name="usMail" placeholder="Correo Electrónico" value="<?=$objUsuario[0]->getUsMail()?>" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="deshabilitado" name="usDeshabilitado" value="" <?php if($desh) echo 'checked'?>>Deshabilitado
                            </div>
                        </div>
                    </div>
                    <div class="row pe-2 mt-3">
                            <?php
                                $rolesDisponibles = $objAbmRol->buscar(null);
                                if(count($rolesDisponibles) != 0){
                                    echo '<div class="col-md-6">
                                            <p>Roles del Usuario:</p>
                                            <div class="form-group">';
                                    foreach($rolesDisponibles as $objRol){
                                        $checked = "";
                                        if(in_array($objRol->getIdRol(), $arrayRoles)){
                                            $checked = "checked";
                                        }
                                        echo '<div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="roles" name="roles[]" value="'.$objRol->getIdRol().'" '.$checked.'> '.$objRol->getRolDescripcion().'
                                            </div>';
                                    }
                                    echo '</div>
                                        </div>';
                                }
                            ?>
                    </div>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit">Enviar</button>
                    </div>
                </form>
                <br />
                <a href='../sites/listarUsuario.php'><button class="btn btn-outline-secondary btn-sm m-2">Volver</button></a>
            </div>
        </div>
    </div>
</div>
<?php include_once("../../vista/estructura/footer.php"); ?>