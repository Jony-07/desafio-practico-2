<?php
require_once "ConexionModel.php";
class ProductosModel extends ModelPDO{

    public function get($id=''){
        $query = '';
        if($id==''){
            // retornar todos
            $query="SELECT * FROM producto P INNER JOIN categoria C ON P.id_categoria=C.id_categoria;";
        }
        else{
            //Retorno por llave primaria
            $query= "SELECT * FROM producto P INNER JOIN categoria C ON P.id_categoria=C.id_categoria WHERE codigo_producto =:codigo_producto";
        }
        return $this->get_query($query,[":codigo_producto"=>$id]);
    }
    public function create($arreglo=array()){
        $query="INSERT INTO producto(codigo_producto, nombre_producto, descripcion, imagen, id_categoria, precio, existencias) VALUES (:codigo_producto, :nombre_producto, :descripcion, :imagen, :id_categoria, :precio, :existencias )";
        return $this->set_query($query,$arreglo);
    }
    public function delete($id=''){
        $query = "DELETE FROM producto WHERE codigo_producto =:codigo_producto ";
        return $this->set_query($query,[":codigo_producto"=>$id]);
    }
    public function  update($libro=array()){
        extract($libro);
        $query = "UPDATE producto SET nombre_producto=:nombre_producto, descripcion =:descripcion, imagen=:imagen, id_categoria=:id_categoria, precio=:precio, existencias=:existencias WHERE codigo_producto=:codigo_producto";
        return $this->set_query($query,$libro);
    }

}