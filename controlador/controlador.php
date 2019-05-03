<?php

/**
* 
*/
class controlador {
	
	private $negocio;

    // Constructor de la clase
    public function __construct() {
        $this->negocio = new negocio();
    }

    public function generarPlantilla() {
        return negocio::generarPlantilla();
    }

    public function generarVista() {

        $enlace = filter_input(INPUT_GET, "ubicacion");
        if ($enlace) {
            $enlace = $this->negocio->generarEnlace($enlace);
        } else {
            $enlace = $this->negocio->generarEnlace("Inicio");
        }
        include_once $enlace;
    }

    public function ingresarGoogleControlador($UsuarioDTO){
        return $this->negocio->ingresarGoogleNegocio($UsuarioDTO);
    }

    public function actualizarUsuarioControlador($id,$UsuarioDTO){
        return $this->negocio->actualizarUsuarioNegocio($id,$UsuarioDTO);
    }

    public function mostrarPublicacionesControlador(){
        echo $this->negocio->mostrarPublicacionesNegocio();
    }

    public function mostrarPublicacionesAmistadControlador($id){
        echo $this->negocio->mostrarPublicacionesAmistadNegocio($id);
    }

    public function mostrarPublicacionesInicioControlador(){
        echo $this->negocio->mostrarPublicacionesInicioNegocio();
    }

    public function mostrarSugerenciasControlador(){
        echo $this->negocio->mostrarSugerenciasNegocio();
    }

    public function eliminarPublicacionControlador($id){
        return $this->negocio->eliminarPublicacionNegocio($id);
    }

    public function buscarAmistadControlador($palabra,$tipo) {
        echo $this->negocio->buscarAmistadNegocio($palabra,$tipo);
    }
    
    public function seguirUsuarioControlador($id,$opcion){
     return $this->negocio->seguirUsuarioNegocio($id,$opcion);   
    }

    public function obtenerSeguidosControlador(){
        echo $this->negocio->obtenerSeguidosNegocio();
    }

    public function obtenerSeguidosAmistadControlador($id){
        echo $this->negocio->obtenerSeguidosAmistadNegocio($id);
    }

    public function obtenerSeguidoresAmistadControlador($id){
        echo $this->negocio->obtenerSeguidoresAmistadNegocio($id);
    }

    public function obtenerSeguidoresControlador(){
        echo $this->negocio->obtenerSeguidoresNegocio();
    }
    
    public function reacionControlador($idPublicacion,$opcion){
        return $this->negocio->reacionNegocio($idPublicacion,$opcion);
    }
    
    public function obtenerReacionControlador(){
        echo $this->negocio->obtenerReacionNegocio();
    }
}

?>