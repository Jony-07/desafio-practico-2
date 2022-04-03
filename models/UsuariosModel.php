<?php
require_once "ConexionModel.php";
class UsuariosModel extends ModelPDO{
    public function ValidateUser($correo,$clave)
    {
        $query = "SELECT nombre,id_tipo_usuario,correo FROM usuario WHERE correo=:correo AND clave=SHA2(:clave,256);";
        return $this->get_query($query,[":correo"=>$correo,":clave"=>$clave]);
    }

    public function ValidateU($correo,$clave)
    {
        $query = "SELECT nombre,id_tipo_usuario,correo FROM usuario WHERE correo=:correo AND hash_active=:hash_active;";
        return $this->get_query($query,[":correo"=>$correo,":hash_active"=>$clave]);
    }

    public function ValidateAccess($correo,$clave)
    {
        $query = "SELECT codigo_usuario,nombre,id_tipo_usuario,correo FROM usuario WHERE correo=:correo AND clave=SHA2(:clave,256)
        AND verificado='1' AND id_estado='1';";
        return $this->get_query($query,[":correo"=>$correo,":clave"=>$clave]);
    }

    

    public function DataActive($correo)
    {
        $query = "SELECT nombre,hash_active,id_tipo_usuario,correo FROM usuario WHERE correo=:correo";
        return $this->get_query($query,[":correo"=>$correo]);
    }
    public function Validate($correo)
    {
        $query = "SELECT nombre,hash_active,id_tipo_usuario,correo FROM usuario WHERE correo=:correo
        AND verificado='0';";
        return $this->get_query($query,[":correo"=>$correo]);
    }

    public function ValidateVerificate($correo)
    {
        $query = "SELECT nombre,hash_active,id_tipo_usuario,correo FROM usuario WHERE correo=:correo
        AND verificado='1';";
        return $this->get_query($query,[":correo"=>$correo]);
    }

    public function get($id=''){
        $query = '';
        if($id==''){
            // retornar todos
            $query="SELECT * FROM usuario U INNER JOIN tipo_usuario T ON U.id_tipo_usuario=T.id_tipo_usuario;";
        }
        else{
            //Retorno por llave primaria
            $query= "SELECT * FROM usuario U INNER JOIN tipo_usuario T ON U.id_tipo_usuario=T.id_tipo_usuario 
             INNER JOIN estado E ON U.id_estado=E.id_estado WHERE codigo_usuario =:codigo_usuario";
        }
        return $this->get_query($query,[":codigo_usuario"=>$id]);
    }
    public function getStatus($id=''){
        $query = '';
        if($id==''){
            // retornar todos
            $query="SELECT * FROM usuario U INNER JOIN estado E ON U.id_estado=E.id_estado 
            INNER JOIN tipo_usuario T ON U.id_tipo_usuario=T.id_tipo_usuario;";
        }
        else{
            //Retorno por llave primaria
            $query= "SELECT * FROM usuario U INNER JOIN estado E ON U.id_estado=E.id_estado 
            INNER JOIN tipo_usuario T ON U.id_tipo_usuario=T.id_tipo_usuario WHERE nombre_estado=:nombre_estado";
        }
        return $this->get_query($query,[":nombre_estado"=>$id]);
    }
    public function create($arreglo=array()){
        $query="INSERT INTO usuario(codigo_usuario, nombre, clave, hash_active, id_tipo_usuario, correo, telefono) VALUES (:codigo_usuario, :nombre, :clave, :hash_active, :id_tipo_usuario , :correo, :telefono)";
        return $this->set_query($query,$arreglo);
    }
    public function delete($id=''){
        $query = "DELETE FROM usuario WHERE codigo_usuario =:codigo_usuario ";
        return $this->set_query($query,[":codigo_usuario"=>$id]);
    }
    public function  update($arreglo=array()){
        extract($arreglo);
        $query = "UPDATE usuario SET nombre=:nombre, clave=:clave, correo=:correo, telefono=:telefono WHERE codigo_usuario=:codigo_usuario";
        return $this->set_query($query,$arreglo);
    }

    public function  updateST($arreglo=array()){
        extract($arreglo);
        $query = "UPDATE usuario SET id_estado=:id_estado, id_tipo_usuario=:id_tipo_usuario WHERE codigo_usuario=:codigo_usuario";
        return $this->set_query($query,$arreglo);
    }

    public function  updateNonPass($arreglo=array()){
        extract($arreglo);
        $query = "UPDATE usuario SET nombre=:nombre, correo=:correo, telefono=:telefono WHERE codigo_usuario=:codigo_usuario";
        return $this->set_query($query,$arreglo);
    }

    public function  UpdateActivacion($correo,$clave){
        extract($arreglo);
        $query = "UPDATE usuario SET verificado='1' WHERE correo=:correo AND hash_active=:hash_active";
        return $this->set_query($query,[":correo"=>$correo,":hash_active"=>$clave]);
    }

}