<?php
require_once "ConexionModel.php";
class CarritosModel extends ModelPDO{

    public function get($id=''){
        $query = '';
        if($id==''){
            // retornar todos
            $query="SELECT * FROM carrito C INNER JOIN producto P ON C.codigo_producto=P.codigo_producto";
        }
        else{
            //Retorno por llave primaria
            $query= "SELECT * FROM carrito C INNER JOIN producto P ON C.codigo_producto=P.codigo_producto 
            INNER JOIN estado_pago E ON C.id_estado_pago=E.id_estado_pago WHERE id_session=:id_session;";
        }
        return $this->get_query($query,[":id_session"=>$id]);
    }

    public function GetArray($arreglo=array())
    {
        extract($arreglo);
        $query= "SELECT * FROM carrito C INNER JOIN producto P ON C.codigo_producto=P.codigo_producto 
        INNER JOIN estado_pago E ON C.id_estado_pago=E.id_estado_pago WHERE id_session=:id_session
        AND  nombre_producto=:nombre_producto;";
                return $this->get_query($query,$arreglo);
    }
    public function create($arreglo=array()){
        $query="INSERT INTO carrito(id_session, codigo_producto, cantidad) VALUES (:id_session, :codigo_producto, :cantidad)";
        return $this->set_query($query,$arreglo);
    }
    public function delete($arreglo=array()){
        extract($arreglo);
        $query = "DELETE FROM carrito WHERE id_session=:id_session AND codigo_producto=:codigo_producto;";
        return $this->set_query($query,$arreglo);
    }
    public function  update($array=array()){
        extract($array);
        $query = "UPDATE carrito SET cantidad=:cantidad WHERE id_session=:id_session AND
        codigo_producto=:codigo_producto; ";
        return $this->set_query($query,$array);
    }

}