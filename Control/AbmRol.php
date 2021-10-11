<?php
class AbmRol{

    private function cargarObjeto($param){
        $obj = null;
        if(array_key_exists('idRol',$param) and array_key_exists('rolDescripcion',$param)){
            $obj = new Rol();
            $obj->setear($param['idRol'], $param['rolDescripcion']);
        }
        return $obj;
    }
    
    private function cargarObjetoConClave($param){
        $obj = null;
        if( isset($param['idRol']) ){
            $obj = new Rol();
            $obj->setear($param['idRol'], null);
        }
        return $obj;
    }
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idRol']))
            $resp = true;
        return $resp;
    }

    public function alta($param){
        $resp = false;
        $param['idRol'] = null;
        $elObjtRol = $this->cargarObjeto($param);
        if ($elObjtRol!=null and $elObjtRol->insertar()){
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
                $param['idUsuario'] = $objUserRol[0]->getIdUsuario();
                $abmUsuarioRol->baja($param);
            }
            $elObjtRol = $this->cargarObjetoConClave($param);
            if ($elObjtRol!=null and $elObjtRol->eliminar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    public function modificacion($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $elObjtRol = $this->cargarObjeto($param);
            if($elObjtRol!=null and $elObjtRol->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
    public function buscar($param){
        $where = " true ";
        if ($param<>NULL){
            if  (isset($param['idRol']))
                $where.=" and idRol ='".$param['idRol']."'";
            if  (isset($param['rolDescripcion']))
                 $where.=" and rolDescripcion ='".$param['rolDescripcion']."'";
        }
        $arreglo = Rol::listar($where);
        //$arreglo = $this->objToArr($arreglo);
        return $arreglo;
    }
    
    public function objToArr($arrOfObj){
        $result = array();
        foreach($arrOfObj as $obj){
            $arr = [
                'idRol' => $obj->getIdRol(),
                'rolDescripcion' => $obj->getRolDescripcion()
            ];
            array_push($result, $arr);
        }
        return $result;
    }
}