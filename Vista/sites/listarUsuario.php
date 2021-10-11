<?php 
include_once "../../configuracion.php";
$session = new Session();
if(!$session->activa()){
    header("Location:http://".$_SERVER['HTTP_HOST']."/Login/Vista/sites/login.php");
}
include_once "../estructura/header.php";
$Titulo = "Listar Usuario";
$objAbmUsuario = new AbmUsuario();
$users = $objAbmUsuario->buscar(null);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10">
            <div class="card border rounded shadow fw-bold p-4">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre de usuario</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Deshabilitado</th>
                            <th scope="col">Roles</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(count($users)!=0){
                                foreach($users as $obj){
                                    $dis = is_null($obj->getUsDeshabilitado()) ? "No" : "Sí";
                                    $abmUsuarioRol = new AbmUsuarioRol();
                                    $idUsuario = $obj->getIdUsuario();
                                    $arrObjUsuarioRol = $abmUsuarioRol->buscar(['idUsuario' => $idUsuario]);
                                    $roles = "";
                                    if(count($arrObjUsuarioRol) != 0){
                                        foreach($arrObjUsuarioRol as $objUserRol){
                                            $abmRol = new AbmRol();
                                            $arrObjRol = $abmRol->buscar(['idRol' => $objUserRol->getIdRol()]);
                                            $roles .= $arrObjRol[0]->getRolDescripcion()."\n";
                                        }
                                    }
                                    echo '<tr>
                                            <th scope="row">'.$obj->getIdUsuario().'</th>
                                            <td>'.$obj->getUsNombre().'</td>
                                            <td>'.$obj->getUsMail().'</td>
                                            <td>'.$dis.'</td>
                                            <td>'.$roles.'</td>
                                            <td>
                                                <a href="../accion/actualizarLogin.php?idUsuario='.$idUsuario.'"><button class="btn btn-sm btn-primary">Editar</button></a>
                                                <a href="../accion/eliminarLogin.php?idUsuario='.$idUsuario.'"><button class="btn btn-sm btn-danger">Borrar</button></a>
                                            </td>
                                        </tr>';
                                }
                            }else{
                                echo '<tr>
                                        <th colspan="6">No se ha encontrado ningun usuario cargado.</th>
                                    </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include_once "../estructura/footer.php"; ?>