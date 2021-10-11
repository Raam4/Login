<?php
include_once "../../configuracion.php";
include_once "../estructura/header.php";
$Titulo = "Eliminar Login";
$data = data_submitted();
$ok = false;
$objAbmUsuario = new AbmUsuario();
$user = $objAbmUsuario->buscar($data);
$arrObjUsuario = $objAbmUsuario->objToArr($user);
$arrObjUsuario[0]['usDeshabilitado'] = date();
if($objAbmUsuario->modificacion($arrObjUsuario[0], true)){
    $ok = true;
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-7">
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