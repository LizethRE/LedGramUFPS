<?php
 if($_SERVER['REQUEST_METHOD']=='POST'){
     $clave = sha1(rand(0000,9999).rand(00,99));
     $usuario = htmlentities($_POST['idUsuarioPublicacion']);
     $descripcion = htmlentities($_POST['descripcion']);
     $ruta = $_FILES['imagenes']['tmp_name'];
     $imagen = $_FILES['imagenes']['name'];

     if($ruta != ''){
        $ancho = 500;
        $alto = 500;
        $info = pathinfo($imagen);
        $tamanio = getimagesize($ruta);
        $width = $tamanio[0];
        $heigth = $tamanio[1];
          
        if($info['extension'] == 'jpg' || $info['extension'] == 'JPG' || $info['extension'] == 'jpeg' || $info['extension'] == 'JPEG'){
         $imagenSubida = imagecreatefromjpeg($ruta);
         $imagenConvertida = imagecreatetruecolor($ancho,$alto);
         imagecopyresampled($imagenConvertida,$imagenSubida,0,0,0,0,$ancho,$alto,$width,$heigth);
         $copia = 'vista/presentacion/assets/publicaciones/'.$clave.'.jpg';
         imagejpeg($imagenConvertida,$copia);
        }else if($info['extension'] == 'png' || $info['extension'] == 'PNG'){
            $imagenSubida = imagecreatefrompng($ruta);
            $imagenConvertida = imagecreatetruecolor($ancho,$alto);
            imagecopyresampled($imagenConvertida,$imagenSubida,0,0,0,0,$ancho,$alto,$width,$heigth);
            $copia = 'vista/presentacion/assets/publicaciones/'.$clave.'.png';
            imagepng($imagenConvertida,$copia);
        }else{
           header("location:Perfil");
        }
     }else{
         header("location:Perfil");
     }
 }
 require_once $_SERVER["DOCUMENT_ROOT"].'/LedGram/modelo/Conexion.php';
 $conexion = Conexion::crearConexion();
 $consulta = $conexion->prepare('INSERT INTO publicacion (usuario,foto,descripcion,fechacreacion) VALUES (?,?,?,NOW())');
 $consulta->bindParam(1, $usuario, PDO::PARAM_STR);
 $consulta->bindParam(2, $copia, PDO::PARAM_STR);
 $consulta->bindParam(3, $descripcion, PDO::PARAM_STR);
 $consulta->execute();
 header("location:Perfil");
?>

 
 
