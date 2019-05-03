<?php

class Conexion{
    
    public function crearConexion() {
        
        try{
            $conexion = new PDO("mysql:host=localhost;dbname=ledgram","root","lizeth.20",array(PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));;
            return $conexion;
        } catch (Exception $ex) {
            throw new Exception("Se presento un error al conectar con la base de datos");
        }
        
    }
    
} 