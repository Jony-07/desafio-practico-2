<?php
require_once "ConexionModel.php";
class EstadosModel extends ModelPDO{

    public function get($id=''){
        $query = '';
        if($id==''){
            // retornar todos
            $query="SELECT * FROM estado";
        }
        else{
            //Retorno por llave primaria
            $query= "SELECT * FROM estado WHERE id_estado=:id_estado";
        }
        return $this->get_query($query,[":id_estado"=>$id]);
    }
    public function getDescontinuados($id=''){
      
    }
    public function create($arreglo=array()){
       
    }
    public function delete($id=''){
      
    }
    public function  update($libro=array()){
     
    }

}