<?php
include_once "../../configuracion.php";
$session = new Session();
if($session->activa()){
    header("Location:http://".$_SERVER['HTTP_HOST']."/Login/Vista/index/index.php");
}
$data = data_submitted();
?>
<!DOCTYPE html>
  <html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="../css/bootstrap/bootstrapValidator.min.css">
        <link rel="stylesheet" href="../css/fontawesome/all.min.css">
        <script src="../js/jquery/jquery-3.5.1.slim.min.js"></script>
        <script src="../js/popper/popper.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/bootstrap/bootstrapValidator.min.js"></script>
        <title>Login</title>
    </head>
    <body class="text-center">
        <main>
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-md-4 align-self-center mt-5">
                        <div class="card border rounded shadow fw-bold p-4">
                            <form id="login" name="login" method="POST" action="../accion/verificarLogin.php" novalidate>
                                <h1 class="h3 mb-3 fw-normal">Login</h1>
                                <div class="form-floating m-3">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="">
                                    <label for="floatingInput">Nombre de usuario</label>
                                </div>
                                <div class="form-floating m-3">
                                    <input type="password" class="form-control" id="pass" name="pass" placeholder="">
                                    <label for="floatingPassword">Contraseña</label>
                                </div>
                                <?php
                                    if(isset($data['noval'])){
                                        echo "<div>
                                                <label>Usuario y/o contraseña inválidos.</label>
                                            </div>";
                                    }
                                    if(isset($data['deshab'])){
                                        echo "<div>
                                                <label>Usuario deshabilitado.</label>
                                            </div>";
                                    }
                                ?>
                                <button class="w-100 btn btn-lg btn-success mt-3" type="submit">Ingresar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <script type="text/javascript" src="../js/bootstrap/validator.js"></script>
    </body>
</html>