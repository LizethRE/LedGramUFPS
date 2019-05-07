<?php

class negocio {

public function generarPlantilla() {
    // Incluir Archivo a la ruta
    include 'vista/plantilla.php';
}

 // Metodo para obtener la pestaña seleccionada en el menú
    private function validarPestañaBarraDeNavegacion($pestaña) {

        $exito = false;
        $pestañas = array("Inicio","Salir");
        if(in_array($pestaña, $pestañas)){
            $exito=true;
        }
        return $exito;

    }

    // Metodo para obtener la pestaña a redirigir
    private function validarPestañaRedireccion($pestaña) {

        $exito=false;
        $pestañas = array("perfil","error","FuncionesAdmin","cargarFotoPerfilUsuario","cargarFotoPublicacionUsuario", "inicio","perfilamistad","pass");
        if(in_array($pestaña, $pestañas)){
            $exito=true;
        }
        return $exito;

    }

    public function generarEnlace($enlace) {

        if($this->validarPestañaBarraDeNavegacion($enlace)){
            return "vista/modulos/pestanas/" .$enlace. ".php";
        }else if($this->validarPestañaRedireccion($enlace)){
            return "vista/modulos/" .$enlace. ".php";
        }else{
            return "vista/modulos/pestanas/Inicio.php";
        }
    }

    public function ingresarGoogleNegocio($UsuarioDTO){
        return UsuarioDAO::ingresarGoogle($UsuarioDTO);
    }

    public function actualizarUsuarioNegocio($id,$UsuarioDTO){
        return UsuarioDAO::actualizarUsuario($id,$UsuarioDTO);
    }

    public function mostrarPublicacionesNegocio(){
        include_once 'DTO/UsuarioDTO.php';
        $usuario = unserialize($_SESSION['Usuario']);
        echo UsuarioDAO::mostrarPublicaciones($usuario->getId());
    }

    public function mostrarPublicacionesAmistadNegocio($id){
        echo UsuarioDAO::mostrarPublicaciones($id);
    }

    public function mostrarPublicacionesInicioNegocio(){
        include_once 'DTO/UsuarioDTO.php';
        $usuario = unserialize($_SESSION['Usuario']);
        echo UsuarioDAO::mostrarPublicacionesInicio($usuario->getId());
    }

    public function mostrarSugerenciasNegocio(){
        include_once 'DTO/UsuarioDTO.php';
        $usuario = unserialize($_SESSION['Usuario']);
        echo UsuarioDAO::mostrarSugerencias($usuario->getId());
    }

    public function eliminarPublicacionNegocio($id){
        return UsuarioDAO::eliminarPublicacion($id);
    }

    public function buscarAmistadNegocio($palabra,$tipo) {
        echo UsuarioDAO::buscarAmistad($palabra,$tipo);
    }

    public function seguirUsuarioNegocio($id,$opcion){
        include_once 'DTO/UsuarioDTO.php';
        $usuario = unserialize($_SESSION['Usuario']);
        if(strcmp($opcion,"seguir")===0){
            return UsuarioDAO::seguirUsuario($id,$usuario->getId());
        }else{
            return UsuarioDAO::noSeguirUsuario($id,$usuario->getId());
        }
    }

    public function obtenerSeguidosNegocio(){
        include_once 'DTO/UsuarioDTO.php';
        $usuario = unserialize($_SESSION['Usuario']);
        echo UsuarioDAO::obtenerSeguidos($usuario->getId());
    }

    public function obtenerSeguidosAmistadNegocio($id){
        echo UsuarioDAO::obtenerSeguidos($id);
    }

    public function obtenerSeguidoresAmistadNegocio($id){
        echo UsuarioDAO::obtenerSeguidores($id);
    }

    public function obtenerSeguidoresNegocio(){
        include_once 'DTO/UsuarioDTO.php';
        $usuario = unserialize($_SESSION['Usuario']);
        echo UsuarioDAO::obtenerSeguidores($usuario->getId());
    }

    public function reacionNegocio($idPublicacion,$opcion){
        include_once 'DTO/UsuarioDTO.php';
        $usuario = unserialize($_SESSION['Usuario']);
        if(strcmp($opcion,"megusta")===0){
            return UsuarioDAO::reacion($usuario->getId(),$idPublicacion);
        }else{
            return UsuarioDAO::noReacion($usuario->getId(),$idPublicacion);
        }
    }

    public function obtenerReacionNegocio(){
        include_once 'DTO/UsuarioDTO.php';
        $usuario = unserialize($_SESSION['Usuario']);
        echo UsuarioDAO::obtenerReacion($usuario->getId());
    }

    public function cargarNotificacionesNegocio(){
        include_once 'DTO/UsuarioDTO.php';
        $usuario = unserialize($_SESSION['Usuario']);
        echo UsuarioDAO::cargarNotificaciones($usuario->getId());
    }

    public function buscarReacionNegocio() {
        include_once 'DTO/UsuarioDTO.php';
        $usuario = unserialize($_SESSION['Usuario']);
        echo UsuarioDAO::buscarReacion($usuario->getId());
    }

    public function contReacionesNegocio($idPublicacion){
        echo UsuarioDAO::contReaciones($idPublicacion);
    }
}
