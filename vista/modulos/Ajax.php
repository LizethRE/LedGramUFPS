<?php

require_once '../../controlador/controlador.php';
require_once '../../modelo/negocio.php';
require_once '../../modelo/DTO/UsuarioDTO.php';
require_once '../../modelo/DAO/UsuarioDAO.php';
require_once '../../modelo/Conexion.php';

class Ajax
{

    public function obtenerControlador()
    {
        $controlador = new Controlador();
        return $controlador;
    }

    public function ingresarGoogle($nombre,$correo,$usuario,$foto){

        $exito = false;
        try{

            $UsuarioDTO = new UsuarioDTO($nombre,$correo,$foto,$usuario,"Añade una descripción");
            $controlador = $this->obtenerControlador();
            $exito = $controlador->ingresarGoogleControlador($UsuarioDTO);
        }catch(Exception $exc){
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));       
        }

        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo loguear el Usuario"));
        }
    }

    public function actualizarUsuario($id,$nombre,$usuario,$descripcion){
        $exito = false;
        try 
        {
            $controlador = $this->obtenerControlador();
            $UsuarioDTO = new UsuarioDTO($nombre, NULL, NULL, $usuario, $descripcion);
            $exito = $controlador->actualizarUsuarioControlador($id,$UsuarioDTO);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }

        if ($exito) 
        {
            session_start();
            $usuario = unserialize($_SESSION['Usuario']);
            $usuario->setNombre($nombre);
            $usuario->setDescripcion($descripcion);
            $_SESSION['Usuario'] = serialize($usuario);
                echo json_encode(array("exito" => true));
        } else {
                echo json_encode(array("exito" => false, "error" => "No se encuentra el Usuario"));
        }
    }

    public function mostrarPublicaciones(){
        try 
        {
            session_start();
            $controlador = $this->obtenerControlador();
            $publicaciones = $controlador->mostrarPublicacionesControlador();
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        echo $publicaciones;
    }

    public function obtenerSeguidos(){
        try 
        {
            session_start();
            $controlador = $this->obtenerControlador();
            $seguidos = $controlador->obtenerSeguidosControlador();
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        echo $seguidos;
    }

    public function obtenerSeguidosAmistad($id){
        try 
        {
            $controlador = $this->obtenerControlador();
            $seguidos = $controlador->obtenerSeguidosAmistadControlador($id);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        echo $seguidos;
    }

    public function obtenerSeguidoresAmistad($id){
        try 
        {
            $controlador = $this->obtenerControlador();
            $seguidos = $controlador->obtenerSeguidoresAmistadControlador($id);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        echo $seguidos;
    }

    public function obtenerSeguidores(){
        try 
        {
            session_start();
            $controlador = $this->obtenerControlador();
            $seguidores = $controlador->obtenerSeguidoresControlador();
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        echo $seguidores;
    }

    public function mostrarPublicacionesAmistad($id){
        try 
        {
            session_start();
            $controlador = $this->obtenerControlador();
            $publicacionesAmistad = $controlador->mostrarPublicacionesAmistadControlador($id);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        echo $publicacionesAmistad;
    }

    public function mostrarPublicacionesInicio(){
        try 
        {
            session_start();
            $controlador = $this->obtenerControlador();
            $publicacionesInicio = $controlador->mostrarPublicacionesInicioControlador();
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        echo $publicacionesInicio;
    }

    public function mostrarSugerencias(){
        try 
        {
            session_start();
            $controlador = $this->obtenerControlador();
            $sugerencias = $controlador->mostrarSugerenciasControlador();
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        echo $sugerencias;
    }

    public function eliminarPublicacion($id){

        $exito = false;
        try{
            $controlador = $this->obtenerControlador();
            $exito = $controlador->eliminarPublicacionControlador($id);
        }catch(Exception $exc){
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));       
        }

        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo eliminar la publicacion"));
        }
    }

    public function seguirUsuario($id,$opcion){

        $exito = false;
        try{
            session_start();
            $controlador = $this->obtenerControlador();
            $exito = $controlador->seguirUsuarioControlador($id,$opcion);
        }catch(Exception $exc){
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));       
        }

        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo seguir al usuario"));
        }
    }

    public function buscarAmistad($palabra,$tipo){
        try{
            $controlador = $this->obtenerControlador();
            $busqueda = $controlador->buscarAmistadControlador($palabra,$tipo);
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        return $busqueda;
    }
    
    public function reacion($idPublicacion,$opcion){
        
        $exito = false;
        try{
            session_start();
            $controlador = $this->obtenerControlador();
            $exito = $controlador->reacionControlador($idPublicacion,$opcion);
        }catch(Exception $exc){
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo reacionar a la foto"));
        }
    }

    public function obtenerReacion(){
        try
        {
            session_start();
            $controlador = $this->obtenerControlador();
            $seguidos = $controlador->obtenerReacionControlador();
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        echo $seguidos;
    }
}

$ajax = new Ajax();

$ingresarGoogle = isset($_POST['nombreGoogle'],$_POST['correoGoogle'],$_POST['usuarioGoogle'],$_POST['fotoGoogle']);
$actualizarUsuario = isset($_POST['actualizarId'],$_POST['actualizarNombres'], $_POST['actualizarUsuario'], $_POST['actualizarDescripcion']);
$mostrarPublicaciones = isset($_GET['mostrarPublicaciones']);
$eliminarPublicacion = isset($_POST['eliminaridpublicacion']);
$buscarAmistad = isset($_GET['buscarAmistad']);
$buscarUsuarios = isset($_POST['idUsuarioBuscar']);
$mostrarPublicacionesAmistad = isset($_POST['idUsuarioMostrarPublicaciones']);
$seguirUsuario = isset($_POST['idUsuarioSeguir'],$_POST['opcionRealizar']);
$obtenerSeguidos = isset($_GET['obtenerSeguidos']);
$obtenerSeguidores = isset($_GET['obtenerSeguidores']);
$obtenerSeguidosAmistad = isset($_POST['idUsuarioMostrarUsuariosSeguidos']);
$obtenerSeguidoresAmistad = isset($_POST['idUsuarioMostrarUsuariosSeguidores']);
$mostrarPublicacionesInicio = isset($_GET['mostrarPublicacionesInicio']);
$mostrarSugerencias = isset($_GET['mostrarSugerencias']);
$reacion = isset($_POST['publicacion'],$_POST['opcionRealizar']);
$obtenerReacion = isset($_GET['obtenerReacion']);

if($ingresarGoogle){
    $ajax->ingresarGoogle($_POST['nombreGoogle'],$_POST['correoGoogle'],$_POST['usuarioGoogle'],$_POST['fotoGoogle']);
}else if($actualizarUsuario){
    $ajax->actualizarUsuario($_POST['actualizarId'],$_POST['actualizarNombres'], $_POST['actualizarUsuario'], $_POST['actualizarDescripcion']);
}else if($mostrarPublicaciones && $_GET['mostrarPublicaciones']){
    $ajax->mostrarPublicaciones();
}else if($eliminarPublicacion){
    $ajax->eliminarPublicacion($_POST['eliminaridpublicacion']);
}else if($buscarAmistad){
    $ajax->buscarAmistad($_GET['buscarAmistad'],"filtro");
}else if($buscarUsuarios){
    $ajax->buscarAmistad($_POST['idUsuarioBuscar'],"todos");
}else if($mostrarPublicacionesAmistad){
    $ajax->mostrarPublicacionesAmistad($_POST['idUsuarioMostrarPublicaciones']);
}else if($seguirUsuario){
    $ajax->seguirUsuario($_POST['idUsuarioSeguir'],$_POST['opcionRealizar']);
}else if($obtenerSeguidos && $_GET['obtenerSeguidos']){
    $ajax->obtenerSeguidos();
}else if($obtenerSeguidores && $_GET['obtenerSeguidores']){
    $ajax->obtenerSeguidores();
}else if($obtenerSeguidosAmistad){
    $ajax->obtenerSeguidosAmistad($_POST['idUsuarioMostrarUsuariosSeguidos']);
}else if($obtenerSeguidoresAmistad){
    $ajax->obtenerSeguidoresAmistad($_POST['idUsuarioMostrarUsuariosSeguidores']);
}else if($mostrarPublicacionesInicio){
    $ajax->mostrarPublicacionesInicio();
}else if($mostrarSugerencias && $_GET['mostrarSugerencias']){
    $ajax->mostrarSugerencias();
}else if($reacion){
    $ajax->reacion($_POST['publicacion'],$_POST['opcionRealizar']);
}else if($obtenerReacion && $_GET['obtenerReacion']){
    $ajax->obtenerReacion();
}
?>