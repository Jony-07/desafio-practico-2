<?php
require_once "ConexionModel.php";
class CarritosModel extends ModelPDO{

    public function get($id=''){
        $query = '';
        if($id==''){
            // retornar todos
            $query="SELECT * FROM carrito C INNER JOIN producto P ON C.codigo_producto=P.codigo_producto";
            return $this->get_query($query);
        }
        else{
            //Retorno por llave primaria
            $query= "SELECT * FROM carrito C INNER JOIN producto P ON C.codigo_producto=P.codigo_producto 
            INNER JOIN estado_pago E ON C.id_estado_pago=E.id_estado_pago WHERE id_session=:id_session
            ;";
              return $this->get_query($query,[":id_session"=>$id]);
        }
       
    }

    public function CountQuantity($id=''){
            $query="SELECT * FROM carrito C INNER JOIN producto P ON C.codigo_producto=P.codigo_producto
            WHERE id_estado_pago='0'";
    
        return $this->get_query($query,[":id_session"=>$id]);
    }

    public function getEle($id=''){
        $query = '';
        if($id==''){
            // retornar todos
            $query="SELECT * FROM carrito C INNER JOIN producto P ON C.codigo_producto=P.codigo_producto";
        }
        else{
            //Retorno por llave primaria
            $query= "SELECT * FROM carrito C INNER JOIN producto P ON C.codigo_producto=P.codigo_producto 
            INNER JOIN estado_pago E ON C.id_estado_pago=E.id_estado_pago WHERE id_carrito=:id_carrito;
            ;";
        }
        return $this->get_query($query,[":id_carrito"=>$id]);
    }

    public function Comprobate($arreglo=array())
    {
        extract($arreglo);
        $query= "SELECT * FROM carrito WHERE id_session=:id_session AND  codigo_producto=:codigo_producto
        AND id_carrito=:id_carrito;";
                return $this->get_query($query,$arreglo);
    }

    public function GetArray($nombre,$id)
    {
        $query= "SELECT * FROM carrito C INNER JOIN producto P ON C.codigo_producto=P.codigo_producto 
        INNER JOIN estado_pago E ON C.id_estado_pago=E.id_estado_pago WHERE nombre_producto=:nombre_producto AND id_carrito=:id_carrito;";
                return $this->get_query($query,[":nombre_producto"=>$nombre,":id_carrito"=>$id]);
    }
    public function create($arreglo=array()){
        $query="INSERT INTO carrito(id_carrito, id_session, codigo_producto, cantidad) VALUES (:id_carrito, :id_session, :codigo_producto, :cantidad)";
        return $this->set_query($query,$arreglo);
    }
    public function delete($arreglo=array()){
        extract($arreglo);
        $query = "DELETE FROM carrito WHERE id_session=:id_session AND codigo_producto=:codigo_producto
        AND id_carrito=:id_carrito  AND id_carrito=:id_carrito;";
        return $this->set_query($query,$arreglo);
    }
    public function  update($array=array()){
        extract($array);
        $query = "UPDATE carrito SET cantidad=:cantidad WHERE 
        codigo_producto=:codigo_producto AND id_carrito=:id_carrito; ";
        return $this->set_query($query,$array);
    }

    public function  cancelado($array=array()){
        extract($array);
        $query = "UPDATE carrito SET id_estado_pago='1' WHERE codigo_producto=:codigo_producto AND id_carrito=:id_carrito;";
        return $this->set_query($query,$array);
    }

}