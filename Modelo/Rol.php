<?php
class Rol{
    private $idRol;
    private $rolDescripcion;
    private $op;

    public function __construct(){
        $this->idRol = "";
        $this->rolDescripcion = "";
        $this->op = "";
    }

    public function setear($idRol, $rolDescripcion){
        $this->setIdRol($idRol);
        $this->setRolDescripcion($rolDescripcion);
    }

    public function getIdRol(){
        return $this->idRol;
    }
    public function setIdRol($idRol){
        $this->idRol = $idRol;
    }
    public function getRolDescripcion(){
        return $this->rolDescripcion;
    }
    public function setRolDescripcion($rolDescripcion){
        $this->rolDescripcion = $rolDescripcion;
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
        $sql="SELECT * FROM rol WHERE idRol = ".$this->getIdRol();
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idRol'], $row['rolDescripcion']);
                }
            }
        } else {
            $this->setOp("rol->listar: ".$base->getError());
        }
        return $resp;
    }
    
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO rol(idRol, rolDescripcion) VALUES('".$this->getIdRol()."', '".$this->getRolDescripcion()."');";
        if ($base->Iniciar()) {
            if ($elid = $base->Ejecutar($sql)) {
                $this->setIdRol($elid);
                $resp = true;
            } else {
                $this->setOp("Rol->insertar: ".$base->getError());
            }
        } else {
            $this->setOp("Rol->insertar: ".$base->getError());
        }
        return $resp;
    }
    
    public function modificar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="UPDATE rol SET rolDescripcion='".$this->getRolDescripcion()."'  WHERE idRol='".$this->getIdRol()."'";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setOp("Rol->modificar: ".$base->getError());
            }
        } else {
            $this->setOp("Rol->modificar: ".$base->getError());
        }
        return $resp;
    }
    
    public function eliminar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="DELETE FROM rol WHERE idRol=".$this->getIdRol();
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                return true;
            } else {
                $this->setOp("Rol->eliminar: ".$base->getError());
            }
        } else {
            $this->setOp("Rol->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    public static function listar($parametro=""){
        $arreglo = array();
        $base=new BaseDatos();
        $sql="SELECT * FROM rol ";
        if ($parametro!="") {
            $sql.='WHERE '.$parametro;
        }
        $res = $base->Ejecutar($sql);
        if($res>-1){
            if($res>0){
                while ($row = $base->Registro()){
                    $obj= new Rol();
                    $obj->setear($row['idRol'], $row['rolDescripcion']);
                    array_push($arreglo, $obj);
                }
            }
        } else {
            $obj= new Rol();
            $obj->setOp("Rol->listar: ".$base->getError());
        }
        return $arreglo;
    }
}
?>