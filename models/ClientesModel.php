<?php
require_once "ConexionModel.php";
class ClientesModel extends ModelPDO{

    public function ValidateCliente($correo,$clave)
    {
        $query = "SELECT nombre, apellido,correo FROM cliente WHERE correo=:correo AND clave=SHA2(:clave,256);";
        return $this->get_query($query,[":correo"=>$correo,":clave"=>$clave]);
    }

    public function ValidateC($correo,$clave)
    {
        $query = "SELECT nombre, apellido,correo FROM cliente WHERE correo=:correo AND hash_active=:hash_active;";
        return $this->get_query($query,[":correo"=>$correo,":hash_active"=>$clave]);
    }
    public function ValidateAccessCliente($correo,$clave)
    {
        $query = "SELECT codigo_cliente,nombre, apellido,correo,id_tipo_usuario FROM cliente WHERE correo=:correo AND clave=SHA2(:clave,256)
        AND verificado='1' AND id_estado='1';";
        return $this->get_query($query,[":correo"=>$correo,":clave"=>$clave]);
    }
    public function DataActive($correo)
    {
        $query = "SELECT nombre,apellido,correo,hash_active FROM usuario WHERE correo=:correo";
        return $this->get_query($query,[":correo"=>$correo]);
    }
    public function ValidateVerificate($correo)
    {
        $query = "SELECT nombre,apellido,correo,hash_active FROM usuario WHERE correo=:correo
        AND verificado='1';";
        return $this->get_query($query,[":correo"=>$correo]);
    }
    public function Validate($correo)
    {
        $query = "SELECT nombre,apellido,correo,hash_active FROM usuario WHERE correo=:correo
        AND verificado='0';";
        return $this->get_query($query,[":correo"=>$correo]);
    }
    public function get($id=''){
        $query = '';
        if($id==''){
            // retornar todos
            $query="SELECT * FROM cliente C INNER JOIN estado E ON C.id_estado=E.id_estado;";
        }
        else{
            //Retorno por llave primaria
            $query= "SELECT * FROM cliente C INNER JOIN estado E ON C.id_estado=E.id_estado WHERE codigo_cliente =:codigo_cliente";
        }
        return $this->get_query($query,[":codigo_cliente"=>$id]);
    }

    public function getStatus($id=''){
        $query = '';
        if($id==''){
            // retornar todos
            $query="SELECT * FROM cliente C INNER JOIN estado E ON C.id_estado=E.id_estado;";
        }
        else{
            //Retorno por llave primaria
            $query= "SELECT * FROM cliente C INNER JOIN estado E ON C.id_estado=E.id_estado WHERE nombre_estado=:nombre_estado";
        }
        return $this->get_query($query,[":nombre_estado"=>$id]);
    }
    public function create($arreglo=array()){
        $query="INSERT INTO cliente(codigo_cliente, nombre, apellido, telefono, correo, clave, direccion, hash_active) VALUES (:codigo_cliente, :nombre, :apellido, :telefono, :correo, :clave, :direccion, :hash_active)";
        return $this->set_query($query,$arreglo);
    }

    public function updateStatus($id=''){
        $query = "UPDATE cliente SET id_estado='1' WHERE codigo_cliente =:codigo_cliente ";
        return $this->set_query($query,[":codigo_cliente"=>$id]);
    }

    public function delete($id=''){
        $query = "UPDATE cliente SET id_estado='2' WHERE codigo_cliente =:codigo_cliente ";
        return $this->set_query($query,[":codigo_cliente"=>$id]);
    }

    public function updateST($arreglo=array()){
        $query = "UPDATE cliente SET id_estado=:id_estado WHERE codigo_cliente =:codigo_cliente ";
        return $this->set_query($query,$arreglo);
    }

    public function  updateNonPass($arreglo=array()){
        extract($arreglo);
        $query = "UPDATE cliente SET nombre=:nombre, apellido =:apellido, telefono=:telefono, correo=:correo, direccion=:direccion WHERE codigo_cliente=:codigo_cliente";
        return $this->set_query($query,$arreglo);
    }
    public function  update($arreglo=array()){
        extract($arreglo);
        $query = "UPDATE cliente SET nombre=:nombre, apellido =:apellido, telefono=:telefono, correo=:correo, clave=:clave, direccion=:direccion WHERE codigo_cliente=:codigo_cliente";
        return $this->set_query($query,$arreglo);
    }

    public function  UpdateActivacion($correo,$clave){
        $query = "UPDATE cliente SET verificado='1' WHERE correo=:correo AND hash_active=:hash_active";
        return $this->set_query($query,[":correo"=>$correo,":hash_active"=>$clave]);
    }

}