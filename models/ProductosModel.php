<?php
require_once "ConexionModel.php";
class ProductosModel extends ModelPDO{

    public function get($id=''){
        $query = '';
        if($id==''){
            // retornar todos
            $query="SELECT * FROM producto P INNER JOIN categoria C ON P.id_categoria=C.id_categoria WHERE estado='1';";
        }
        else{
            //Retorno por llave primaria
            $query= "SELECT * FROM producto P INNER JOIN categoria C ON P.id_categoria=C.id_categoria WHERE codigo_producto =:codigo_producto AND estado='1'";
        }
        return $this->get_query($query,[":codigo_producto"=>$id]);
    }
    public function getDescontinuados($id='')
    {
        $query = '';
        if($id==''){
            // retornar todos
            $query="SELECT * FROM producto P INNER JOIN categoria C ON P.id_categoria=C.id_categoria;";
        }
        else{
            //Retorno por llave primaria
            $query= "SELECT * FROM producto P INNER JOIN categoria C ON P.id_categoria=C.id_categoria WHERE codigo_producto =:codigo_producto AND estado='0'";
        }
        return $this->get_query($query,[":codigo_producto"=>$id]);
    }

    public function updateStatus($id='')
    {
        $query = "UPDATE producto SET estado='1' WHERE codigo_producto =:codigo_producto ";
        return $this->set_query($query,[":codigo_producto"=>$id]);
    }

    public function updateExistencias($existencias='',$id='')
    {
        $query = "UPDATE producto SET existencias=:existencias WHERE codigo_producto =:codigo_producto ";
        return $this->set_query($query,[":existencias"=>$existencias,":codigo_producto"=>$id]);
    }
    
    public function getCategoria($id=''){
        $query = '';

            //Retorno por llave primaria
            $query= "SELECT * FROM producto P INNER JOIN categoria C ON P.id_categoria=C.id_categoria WHERE nombre_categoria =:nombre_categoria  AND estado='1'";
        return $this->get_query($query,[":nombre_categoria"=>$id]);
    }
    public function create($arreglo=array()){
        $query="INSERT INTO producto(codigo_producto, nombre_producto, descripcion, imagen, id_categoria, precio, existencias) VALUES (:codigo_producto, :nombre_producto, :descripcion, :imagen, :id_categoria, :precio, :existencias )";
        return $this->set_query($query,$arreglo);
    }
    public function delete($id=''){
        $query = "UPDATE producto SET estado='0' WHERE codigo_producto =:codigo_producto ";
        return $this->set_query($query,[":codigo_producto"=>$id]);
    }
    public function  update($libro=array()){
        extract($libro);
        $query = "UPDATE producto SET nombre_producto=:nombre_producto, descripcion =:descripcion, imagen=:imagen, id_categoria=:id_categoria, precio=:precio, existencias=:existencias WHERE codigo_producto=:codigo_producto";
        return $this->set_query($query,$libro);
    }

    public function  updateImgNone($libro=array()){
        extract($libro);
        $query = "UPDATE producto SET nombre_producto=:nombre_producto, descripcion =:descripcion, id_categoria=:id_categoria, precio=:precio, existencias=:existencias WHERE codigo_producto=:codigo_producto";
        return $this->set_query($query,$libro);
    }

}