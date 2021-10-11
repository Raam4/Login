<?php
include_once "../../configuracion.php";
$session = new Session();
if(!$session->activa()){
    header("Location:http://".$_SERVER['HTTP_HOST']."/Login/Vista/sites/login.php");
}
include_once "../estructura/header.php";
$Titulo = "Index";
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-7">
            <div class="card border rounded shadow fw-bold p-4">
                <h3 class="text mb-4">Trabajo Práctico 4 - PWD</h3>
                <h5>Integrantes:</h5>
                <p class="lead">
                - Ramiro Cardozo  FAI-1729  <br>
                - Landaeta Lucia  FAI-1981 </p> 
            </div>
        </div>
    </div>
</div>
<?php include_once "../estructura/footer.php"; ?>