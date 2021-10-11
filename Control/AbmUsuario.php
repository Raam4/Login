<?php
class AbmUsuario{

    private function cargarObjeto($param){
        $obj = null;
        if(array_key_exists('idUsuario',$param) and array_key_exists('usNombre',$param) and array_key_exists('usPass',$param) and array_key_exists('usMail',$param) and array_key_exists('usDeshabilitado',$param)){
            $obj = new Usuario();
            $obj->setear($param['idUsuario'], $param['usNombre'], $param['usPass'], $param['usMail'], $param['usDeshabilitado']);
        }
        if(array_key_exists('idUsuario',$param) and array_key_exists('usNombre',$param) and array_key_exists('usPass',$param) and array_key_exists('usMail',$param)){
            $obj = new Usuario();
            $obj->setear($param['idUsuario'], $param['usNombre'], $param['usPass'], $param['usMail'], null);
        }
        return $obj;
    }
    
    private function cargarObjetoConClave($param){
        $obj = null;
        if( isset($param['idUsuario']) ){
            $obj = new Usuario();
            $obj->setear($param['idUsuario'], null, null, null, null);
        }
        return $obj;
    }
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idUsuario']))
            $resp = true;
        return $resp;
    }

    public function alta($param){
        $resp = false;
        $param['idUsuario'] = null;
        $elObjtUsuario = $this->cargarObjeto($param);
        if ($elObjtUsuario!=null and $elObjtUsuario->insertar()){
            $resp = true;
        }
        return $resp;
    }
    
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $abmUsuarioRol = new AbmUsuarioRol();
            $objUserRol = $abmUsuarioRol->buscar($param);
            if($objUserRol){
                $param['idRol'] = $objUserRol[0]->getIdRol();
                $abmUsuarioRol->baja($param);
            }
            $elObjtUsuario = $this->cargarObjetoConClave($param);
            if ($elObjtUsuario!=null and $elObjtUsuario->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    public function modificacion($param, $bool){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtUsuario = $this->cargarObjeto($param);
            if($elObjtUsuario!=null and $elObjtUsuario->modificar($bool)){
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
            if  (isset($param['usNombre']))
                 $where.=" and usNombre ='".$param['usNombre']."'";
            if  (isset($param['usPass']))
                $where.=" and usPass ='".$param['usPass']."'";
            if  (isset($param['usMail']))
                $where.=" and usMail ='".$param['usMail']."'";
            if  (isset($param['usDeshabilitado']))
                $where.=" and usDeshabilitado ='".$param['usDeshabilitado']."'";
        }
        $arreglo = Usuario::listar($where);
        //$arreglo = $this->objToArr($arreglo);
        return $arreglo;
    }
    
    public function objToArr($arrOfObj){
        $result = array();
        foreach($arrOfObj as $obj){
            $arr = [
                'idUsuario' => $obj->getIdUsuario(),
                'usNombre' => $obj->getUsNombre(),
                'usPass' => $obj->getUsPass(),
                'usMail' => $obj->getUsMail(),
                'usDeshabilitado' => $obj->getUsDeshabilitado()
            ];
            array_push($result, $arr);
        }
        return $result;
    }
}