
<?php

// Incluir archivos externos
require_once './controlador/controlador.php';
require_once './modelo/negocio.php';

// Activar Almacenamiento en el bufer de la pagina
 ob_start();
 $controlador = new controlador();
 $controlador->generarPlantilla();
 
