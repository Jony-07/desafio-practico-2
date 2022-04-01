<?php
require_once "ConexionModel.php";
class UsuariosModel extends ModelPDO{

    public function get($id=''){
        $query = '';
        if($id==''){
            // retornar todos
            $query="SELECT * FROM usuario U INNER JOIN tipo_usuario T ON U.id_tipo_usuario=T.id_tipo_usuario;";
        }
        else{
            //Retorno por llave primaria
            $query= "SELECT * FROM usuario WHERE codigo_usuario =:codigo_usuario";
        }
        return $this->get_query($query,[":codigo_usuario"=>$id]);
    }
    public function create($arreglo=array()){
        $query="INSERT INTO usuario(codigo_usuario, nickname, clave, hash_active, verificado, estado, id_tipo_usuario, correo, telefono) VALUES (:codigo_usuario, :nickname, :clave, :hash_active, :verificado , :estado , :id_tipo_usuario , :correo, :telefono)";
        return $this->set_query($query,$arreglo);
    }
    public function delete($id=''){
        $query = "DELETE FROM usuario WHERE codigo_usuario =:codigo_usuario ";
        return $this->set_query($query,[":codigo_usuario"=>$id]);
    }
    public function  update($arreglo=array()){
        extract($arreglo);
        $query = "UPDATE usuario SET nickname=:nickname, clave=:clave, hash_active=:hash_active, verificado=:verificado , estado=:estado , id_tipo_usuario=:id_tipo_usuario , correo=:correo, telefono=:telefono WHERE codigo_usuario=:codigo_usuario";
        return $this->set_query($query,$arreglo);
    }

}