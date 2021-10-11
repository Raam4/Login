<?php
class AbmUsuarioRol{

    private function cargarObjeto($param){
        $obj = null;
        if(array_key_exists('idUsuario',$param) and array_key_exists('idRol',$param)){
            $obj = new UsuarioRol();
            $obj->setear($param['idUsuario'], $param['idRol']);
        }
        return $obj;
    }
    
    private function cargarObjetoConClave($param){
        $obj = null;
        if(isset($param['idUsuario']) && isset($param['idRol'])){
            $obj = new UsuarioRol();
            $obj->setear($param['idUsuario'], $param['idRol']);
        }
        return $obj;
    }
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idUsuario']) && isset($param['idRol']))
            $resp = true;
        return $resp;
    }

    public function alta($param){
        $resp = false;
        $elObjtUsuarioRol = $this->cargarObjeto($param);
        if ($elObjtUsuarioRol!=null and $elObjtUsuarioRol->insertar()){
            $resp = true;
        }
        return $resp;
    }
    
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtUsuarioRol = $this->cargarObjetoConClave($param);
            if ($elObjtUsuarioRol!=null and $elObjtUsuarioRol->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtUsuarioRol = $this->cargarObjeto($param);
            if($elObjtUsuarioRol!=null and $elObjtUsuarioRol->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idUsuario']))
                $where.=" and idUsuario ='".$param['idUsuario']."'";
            if  (isset($param['idRol']))
                 $where.=" and idRol ='".$param['idRol']."'";
        }
        $arreglo = UsuarioRol::listar($where);
        //$arreglo = $this->objToArr($arreglo);
        return $arreglo;
    }

    public function objToArr($arrOfObj){
        $result = array();
        foreach($arrOfObj as $obj){
            $arr = [
                'idUsuario' => $obj->getIdUsuario(),
                'idRol' => $obj->getIdRol()
            ];
            array_push($result, $arr);
        }
        return $result;
    }
}