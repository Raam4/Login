<?php
class UsuarioRol{
    private $idUsuario;
    private $idRol;
    private $op;

    public function __construct(){
        $this->idUsuario = "";
        $this->idRol = "";
        $this->op = "";
    }

    public function setear($idUsuario, $idRol){
        $this->setIdUsuario($idUsuario);
        $this->setIdRol($idRol);
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }
    public function getIdRol(){
        return $this->idRol;
    }
    public function setIdRol($idRol){
        $this->idRol = $idRol;
    }
    public function getOp(){
        return $this->op;
    }
    public function setOp($op){
        $this->op = $op;
    }

    public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="SELECT * FROM usuariorol WHERE idUsuario = ".$this->getIdUsuario()." and idRol = ".$this->getIdRol();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idUsuario'], $row['idRol']);
                }
            }
        } else {
            $this->setOp("UsuarioRol->listar: ".$base->getError());
        }
        return $resp;
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO usuariorol(idUsuario, idRol) VALUES('".$this->getIdUsuario()."', '".$this->getIdRol()."');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdUsuario($elid);
                $resp = true;
            } else {
                $this->setOp("UsuarioRol->insertar: ".$base->getError());
            }
        } else {
            $this->setOp("UsuarioRol->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE usuariorol SET idRol='".$this->getIdRol()."'  WHERE idUsuario='".$this->getIdUsuario()." and idRol = ".$this->getIdRol()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setOp("UsuarioRol->modificar: ".$base->getError());
            }
        } else {
            $this->setOp("UsuarioRol->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM usuariorol WHERE idUsuario=".$this->getIdUsuario()." and idRol = ".$this->getIdRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setOp("UsuarioRol->eliminar: ".$base->getError());
            }
        } else {
            $this->setOp("UsuarioRol->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuariorol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj= new UsuarioRol();
                    $obj->setear($row['idUsuario'], $row['idRol']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $obj= new Rol();
            $obj->setOp("UsuarioRol->listar: ".$base->getError());
        }
        return $arreglo;
    }
}
?>