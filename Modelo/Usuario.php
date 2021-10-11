<?php
class Usuario{
    private $idUsuario;
    private $usNombre;
    private $usPass;
    private $usMail;
    private $usDeshabilitado;
    private $op;

    public function __construct(){
        $this->idUsuario = "";
        $this->usNombre = "";
        $this->usPass = "";
        $this->usMail = "";
        $this->usDeshabilitado = "";
        $this->op = "";
    }

    public function setear($idUsuario, $usNombre, $usPass, $usMail, $usDeshabilitado){
        $this->setIdUsuario($idUsuario);
        $this->setUsNombre($usNombre);
        $this->setUsPass($usPass);
        $this->setUsMail($usMail);
        $this->setusDeshabilitado($usDeshabilitado);
    }

    public function getIdUsuario(){
        return $this->idUsuario;
    }
    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }
    public function getUsNombre(){
        return $this->usNombre;
    }
    public function setUsNombre($usNombre){
        $this->usNombre = $usNombre;
    }
    public function getUsPass(){
        return $this->usPass;
    }
    public function setUsPass($usPass){
        $this->usPass = $usPass;
    }
    public function getUsMail(){
        return $this->usMail;
    }
    public function setUsMail($usMail){
        $this->usMail = $usMail;
    }
    public function getUsDeshabilitado(){
        return $this->usDeshabilitado;
    }
    public function setUsDeshabilitado($usDeshabilitado){
        $this->usDeshabilitado = $usDeshabilitado;
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
        $sql="SELECT * FROM usuario WHERE idUsuario = ".$this->getIdUsuario();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idUsuario'], $row['usNombre'], $row['usPass'], $row['usMail'], $row['usDeshabilitado']);
                }
            }
        } else {
            $this->setOp("Usuario->listar: ".$base->getError());
        }
        return $resp;
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO usuario(idUsuario, usNombre, usPass, usMail, usDeshabilitado) VALUES('".$this->getIdUsuario()."', '".$this->getUsNombre()."', '".$this->getUsPass()."', '".$this->getUsMail()."', '".$this->getUsDeshabilitado()."');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdUsuario($elid);
                $resp = true;
            } else {
                $this->setOp("Usuario->insertar: ".$base->getError());
            }
        } else {
            $this->setOp("Usuario->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar($bool){
        $resp = false;
        $base=new BaseDatos();
        if($bool){
            $sql="UPDATE usuario SET usNombre='".$this->getUsNombre()."', usPass='".$this->getUsPass()."', usMail='".$this->getUsMail()."', usDeshabilitado='".$this->getUsDeshabilitado()."'  WHERE idUsuario='".$this->getIdUsuario()."'";
        }else{
            $sql="UPDATE usuario SET usNombre='".$this->getUsNombre()."', usPass='".$this->getUsPass()."', usMail='".$this->getUsMail()."'  WHERE idUsuario='".$this->getIdUsuario()."'";
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setOp("Usuario->modificar: ".$base->getError());
            }
        } else {
            $this->setOp("Usuario->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM usuario WHERE idUsuario=".$this->getIdUsuario();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setOp("Usuario->eliminar: ".$base->getError());
            }
        } else {
            $this->setOp("Usuario->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM usuario ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj= new Usuario();
                    $obj->setear($row['idUsuario'], $row['usNombre'], $row['usPass'], $row['usMail'], $row['usDeshabilitado']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $obj= new Usuario();
            $obj->setOp("Usuario->listar: ".$base->getError());
        }
        return $arreglo;
    }
}
?>