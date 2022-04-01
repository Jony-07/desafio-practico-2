<?php
require_once "ConexionModel.php";
class ClientesModel extends ModelPDO{

    public function get($id=''){
        $query = '';
        if($id==''){
            // retornar todos
            $query="SELECT * FROM cliente;";
        }
        else{
            //Retorno por llave primaria
            $query= "SELECT * FROM cliente WHERE codigo_cliente =:codigo_cliente";
        }
        return $this->get_query($query,[":codigo_cliente"=>$id]);
    }
    public function create($arreglo=array()){
        $query="INSERT INTO cliente(codigo_cliente, nombre, apellido, telefono, correo, clave, direccion, verificado, estado, hash_active) VALUES (:codigo_cliente, :nombre, :apellido, :telefono, :correo, :clave, :direccion, :verificado , :estado , :hash_active)";
        return $this->set_query($query,$arreglo);
    }
    public function delete($id=''){
        $query = "DELETE FROM cliente WHERE codigo_cliente =:codigo_cliente ";
        return $this->set_query($query,[":codigo_cliente"=>$id]);
    }
    public function  update($arreglo=array()){
        extract($arreglo);
        $query = "UPDATE cliente SET nombre=:nombre, apellido =:apellido, telefono=:telefono, correo=:correo, clave=:clave, direccion=:direccion, verificado=:verificado , estado=:estado , hash_active=:hash_active WHERE codigo_cliente=:codigo_cliente";
        return $this->set_query($query,$arreglo);
    }

}