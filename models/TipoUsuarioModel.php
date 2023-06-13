<?php
require_once "ConexionModel.php";
class TipoUsuarioModel extends ModelPDO{

    public function get($id=''){
        $query = '';
        if($id==''){
            // retornar todos
            $query="SELECT * FROM tipo_usuario";
            return $this->get_query($query);
        }
        else{
            //Retorno por llave primaria
            $query= "SELECT * FROM tipo_usuario WHERE id_tipo_usuario=:id_tipo_usuario";
            return $this->get_query($query,[":id_tipo_usuario"=>$id]);
        }
       
    }
    public function create($arreglo=array()){
        $query="INSERT INTO tipo_usuario(id_tipo_usuario, nombre_tipo_usuario) VALUES (:id_tipo_usuario, :nombre_tipo_usuario)";
        return $this->set_query($query,$arreglo);
    }
    public function delete($id=''){
        $query = "DELETE FROM tipo_usuario WHERE id_tipo_usuario =:id_tipo_usuario ";
        return $this->set_query($query,[":id_tipo_usuario"=>$id]);
    }
    public function  update($libro=array()){
        extract($libro);
        $query = "UPDATE tipo_usuario SET nombre_tipo_usuario=:nombre_tipo_usuario WHERE id_tipo_usuario=:id_tipo_usuario";
      //  $query="INSERT INTO Editoriales(codigo_editorial, nombre_editorial, contacto, telefono) VALUES ('$codigo_editorial','$nombre_editorial','$contacto','$telefono')";
        return $this->set_query($query,$libro);
    }

}