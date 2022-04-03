<?php
    function estaVacio($var)
    {
        //trim si est{a vacío-}
        return empty(trim($var));
    }
    function esTexto($var){
        return preg_match('/^[a-zA-ZóáéíúñÁÉÍÓÚÑ ]+$/',$var);
    }
    function esDescripcion($var){
        return preg_match('/^([a-zA-Z0-9óáúéíñÁÉÓÍÚÑ\.\, \;\:\%\/]+)$/',$var);
    }
    function esVar($var){
        return preg_match('/^[a-zA-Z0-9óáéúíñÁÉÓÍÚÑ ]+$/',$var);
    }
    function esCategoria($var)
    {
        return preg_match('/^[0-9]{1,2}$/',$var);
    }
    function esMail($var)
    {
        return filter_var($var,FILTER_VALIDATE_EMAIL);
    }
    
    function esProducto($var)
    {
        return preg_match('/^PROD[0-9]{5}$/',$var);
    }
    function esNickname($var)
    {
        return preg_match('/^[a-zA-Z0-9óáéúíñÁÉÓÍÚÑ\-\_]+$/',$var);
    }
    function esUsuario($var)
    {
        return preg_match('/^U[0-9]{3}$/',$var);
    }
    function esClave($var)
    {
        return preg_match('/^[a-zA-Z0-9\&\%\$\#\+\*\(\)]{8,40}$/',$var);
    }
    function esDUI($var)
    {
        return preg_match('/^0[0-9]{7}-[0-9]{1}$/',$var);
    }
    function esTelefono($var)
    {
        return preg_match('/^[267][0-9]{3}-[0-9]{4}$/',$var);
    }
    function esCodigoEditorial($var)
    {
        return preg_match('/^EDI[0-9]{3}$/',$var);
    }

    function esCodigoAutor($var)
    {
        return preg_match('/^AUT[0-9]{3}$/',$var);
    }

    function esCodigoLibro($var)
    {
        return preg_match('/^LIB[0-9]{6}$/',$var);
    }
    function esEntero($var)
    {
        return preg_match('/^[0-9]+$/',$var);
    }

    function esFloat($var)
    {
        return preg_match('/^[0-9]+([.]?[0-9]+)?$/',$var);
    }
?>