<?php
 if($_SERVER['REQUEST_METHOD']=='POST'){
     $clave = sha1(rand(0000,9999).rand(00,99));
     $usuario = htmlentities($_POST['idUsuario']);
     $actual = htmlentities($_POST['fotoActualUsuario']);
     $ruta = $_FILES['imagen']['tmp_name'];
     $imagen = $_FILES['imagen']['name'];

     if($ruta != ''){
        $ancho = 800;
        $alto = 800;
        $info = pathinfo($imagen);
        $tamanio = getimagesize($ruta);
        $width = $tamanio[0];
        $heigth = $tamanio[1];
          
        if($info['extension'] == 'jpg' || $info['extension'] == 'JPG' || $info['extension'] == 'jpeg' || $info['extension'] == 'JPEG'){
         $imagenSubida = imagecreatefromjpeg($ruta);
         $imagenConvertida = imagecreatetruecolor($ancho,$alto);
         imagecopyresampled($imagenConvertida,$imagenSubida,0,0,0,0,$ancho,$alto,$width,$heigth);
         if(strpos($actual, 'https') === false){
             unlink($actual);
         }
         $copia = 'vista/presentacion/assets/fotos_usuarios/'.$clave.'.jpg';
         imagejpeg($imagenConvertida,$copia);
        }else if($info['extension'] == 'png' || $info['extension'] == 'PNG'){
            $imagenSubida = imagecreatefrompng($ruta);
            $imagenConvertida = imagecreatetruecolor($ancho,$alto);
            imagecopyresampled($imagenConvertida,$imagenSubida,0,0,0,0,$ancho,$alto,$width,$heigth);
            if(strpos($actual, 'https') === false){
             unlink($actual);
         }
            $copia = 'vista/presentacion/assets/fotos_usuarios/'.$clave.'.png';
            imagepng($imagenConvertida,$copia);
        }else{
            $copia = $actual;
        }
     }else{
         $copia = $actual;
     }
 }
 require_once $_SERVER["DOCUMENT_ROOT"].'/LedGram/modelo/Conexion.php';
 include_once 'modelo/DTO/UsuarioDTO.php';
 $UsuarioActualizado = unserialize($_SESSION["Usuario"]);
 $UsuarioActualizado->setFoto($copia);
 $conexion = Conexion::crearConexion();
 $consulta = $conexion->prepare('UPDATE usuario SET foto=? WHERE id=?;');
 $consulta->bindParam(1, $copia, PDO::PARAM_STR);
 $consulta->bindParam(2, $usuario, PDO::PARAM_INT);
 $_SESSION["Usuario"] = serialize($UsuarioActualizado);
 $consulta->execute();
 header("location:Perfil");
?>

 
 
