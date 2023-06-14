<?php
require_once "ConexionModel.php";
class CategoriasModel extends ModelPDO{

    public function get($id=''){
        $query = '';
        if($id==''){
            // retornar todos
            $query="SELECT * FROM categoria WHERE estado_categoria='1'";
            return $this->get_query($query);
        }
        else{
            //Retorno por llave primaria
            $query= "SELECT * FROM categoria WHERE id_categoria=:id_categoria AND estado_categoria='1'";
            return $this->get_query($query,[":id_categoria"=>$id]);
        }
       
    }
    public function getDescontinuados($id=''){
        $query = '';     // retornar todos
        if($id==''){
            $query="SELECT * FROM categoria WHERE estado_categoria='0'";
            return $this->get_query($query);
        }
        else{
            $query="SELECT * FROM categoria WHERE id_categoria=:id_categoria AND estado_categoria='0'";
            return $this->get_query($query,[":id_categoria"=>$id]);
        }
       
    }
    public function create($arreglo=array()){
        $query="INSERT INTO categoria(id_categoria, nombre_categoria) VALUES (:id_categoria, :nombre_categoria)";
        return $this->set_query($query,$arreglo);
    }
    public function updateStatus($id=''){
        $query = "UPDATE categoria SET estado_categoria='1' WHERE id_categoria =:id_categoria ";
        return $this->set_query($query,[":id_categoria"=>$id]);
    }
    public function delete($id=''){
        $query = "UPDATE categoria SET estado_categoria='0' WHERE id_categoria =:id_categoria ";
        return $this->set_query($query,[":id_categoria"=>$id]);
    }
    public function  update($libro=array()){
        extract($libro);
        $query = "UPDATE categoria SET nombre_categoria=:nombre_categoria WHERE id_categoria=:id_categoria";
      //  $query="INSERT INTO Editoriales(codigo_editorial, nombre_editorial, contacto, telefono) VALUES ('$codigo_editorial','$nombre_editorial','$contacto','$telefono')";
        return $this->set_query($query,$libro);
    }

}