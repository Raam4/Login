<?php
class Session{
    
    public function __construct(){
        session_start();
    }

    public function validar($nombreUsuario, $psw){
        $ret = false;
        $objUsuario = Usuario::listar("usNombre = '".$nombreUsuario."'");
        if(count($objUsuario) != 0){
            if($psw == $objUsuario[0]->getUsPass()){
                $idUsuario = $objUsuario[0]->getIdUsuario();
                $_SESSION['idUsuario'] = $idUsuario;
                $objUsuarioRol = UsuarioRol::listar("idUsuario = ".$idUsuario);
                if(count($objUsuarioRol) != 0){
                    $_SESSION['arrayRol'] = array();
                    foreach($objUsuarioRol as $obj){
                        $idRol = $obj->getIdRol();
                        array_push($_SESSION['arrayRol'], $idRol);
                    }
                }
                $ret = true;
            }
        }
        return $ret;
    }
    
    public function activa(){
        $ret = false;
        if(isset($_SESSION['idUsuario'])){
            $ret = true;
        }
        return $ret;
    }

    public function getUsuario(){
        $objUsuario = null;
        if($this->activa()){
            $objUsuario = Usuario::listar("idUsuario = '".$_SESSION['idUsuario']."'");
        }
        return $objUsuario[0];
    }

    public function getRol(){
        $arrayObjRol = array();
        if($this->activa() && isset($_SESSION['arrayRol'])){
            foreach($_SESSION['arrayRol'] as $idRol){
                $objRol = Rol::listar("idRol = '".$idRol."'");
                array_push($arrayObjRol, $objRol[0]);
            }
        }
        return $arrayObjRol;
    }

    public function habilitado(){
        $ret = true;
        if(!is_null($this->getUsuario()->getUsDeshabilitado())){
            $ret = false;
        }
        return $ret;
    }

    public function cerrar(){
        session_destroy();
    }
}
?>