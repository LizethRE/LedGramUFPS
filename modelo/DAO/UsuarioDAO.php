<?php

class UsuarioDAO{

    function ingresarGoogle($UsuarioDTO){
        $exito = false;
        try{
            $nombre = $UsuarioDTO->getNombre();
            $correo = $UsuarioDTO->getCorreo();
            $foto = $UsuarioDTO->getFoto();
            $usuario = $UsuarioDTO->getUsuario();
            $descripcion = $UsuarioDTO->getDescripcion();

            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT id,nombre,correo,usuario,foto,descripcion FROM usuario WHERE correo = ?");
            $consulta->bindParam(1,$correo,PDO::PARAM_STR);
            $consulta->execute();
            $existe = $consulta->rowCount();
            $respuesta = $consulta->fetch();
            if($existe>0){
                $UsuarioDTO->setId($respuesta['id']);
                $UsuarioDTO->setNombre($respuesta['nombre']);
                $UsuarioDTO->setCorreo($respuesta['correo']);
                $UsuarioDTO->setUsuario($respuesta['usuario']);
                $UsuarioDTO->setFoto($respuesta['foto']);
                $UsuarioDTO->setDescripcion($respuesta['descripcion']);
                session_start();
                $_SESSION['Usuario'] = serialize($UsuarioDTO);
                $exito=true;
            }else{
                $consulta2 = $conexion->prepare("INSERT INTO usuario (nombre,correo,usuario,foto,descripcion) VALUES (?,?,?,?,?)");
                $consulta2->bindParam(1,$nombre,PDO::PARAM_STR);
                $consulta2->bindParam(2,$correo,PDO::PARAM_STR);
                $consulta2->bindParam(3,$usuario,PDO::PARAM_STR);
                $consulta2->bindParam(4,$foto,PDO::PARAM_STR);
                $consulta2->bindParam(5,$descripcion,PDO::PARAM_STR);
                $consulta2->execute();

                $consulta3 = $conexion->prepare("SELECT id AS id FROM usuario WHERE correo = ?");
                $consulta3->bindParam(1,$correo,PDO::PARAM_STR);
                $consulta3->execute();
                $respuesta2 = $consulta3->fetch();
                $UsuarioDTO->setId($respuesta2['id']);
                session_start();
                $_SESSION['Usuario'] = serialize($UsuarioDTO);
                $exito=true;
            }
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
        return $exito;
    }

    function actualizarUsuario($id,$UsuarioDTO){
        $exito = false;
        try
        {
            $nombre = $UsuarioDTO->getNombre();
            $usuario = $UsuarioDTO->getUsuario();
            $descripcion = $UsuarioDTO->getDescripcion();
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("UPDATE usuario SET nombre=? , usuario=?, descripcion=? WHERE id = ?;");
            $consulta->bindParam(1,$nombre,PDO::PARAM_STR);
            $consulta->bindParam(2,$usuario,PDO::PARAM_STR);
            $consulta->bindParam(3,$descripcion,PDO::PARAM_STR);
            $consulta->bindParam(4,$id,PDO::PARAM_INT);
            $exito = $consulta->execute();
        }catch(Exception $exc)
        {
            throw new Exception("Ocurrio un error".$exc->getTraceAsString());
        }
        return $exito;
    }

    function mostrarPublicaciones($id){
           try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT publicacion.foto AS foto, publicacion.descripcion AS descripcion, publicacion.fechacreacion AS fecha, publicacion.id AS id FROM publicacion WHERE publicacion.usuario = ?;");
            $consulta->bindParam(1,$id,PDO::PARAM_INT);
            $consulta->execute();
            $publicaciones = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($publicaciones);
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function eliminarPublicacion($id){
        $exito = false;
        try
        {
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("DELETE FROM publicacion WHERE id = ?;");
            $consulta->bindParam(1,$id,PDO::PARAM_INT);
            $exito = $consulta->execute();
        }catch(Exception $exc)
        {
            throw new Exception("Ocurrio un error".$exc->getTraceAsString());
        }
        return $exito;
    }

    function buscarAmistad($palabra,$tipo){
        try{
            $conexion = Conexion::crearConexion();
            if(strcmp($tipo,"todos")===0){
            $consulta = $conexion->prepare('SELECT * FROM usuario WHERE id = ?');
            $consulta->bindParam(1,$palabra,PDO::PARAM_INT);
            }else{
            $consulta = $conexion->prepare('SELECT * FROM usuario WHERE nombre LIKE "%' .$palabra. '%" OR usuario LIKE "%' .$palabra. '%";');
            }
            $consulta->execute();
            $busqueda = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($busqueda);
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error".$exc->getTraceAsString());
        }
    }

    function seguirUsuario($seguido,$seguidor){
        $exito = false;
        try
        {
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("INSERT INTO amistad (idSeguido,idSeguidor) VALUES (?,?)");
            $consulta->bindParam(1,$seguido,PDO::PARAM_INT);
            $consulta->bindParam(2,$seguidor,PDO::PARAM_INT);
            $exito = $consulta->execute();
        }catch(Exception $exc)
        {
            throw new Exception("Ya sigues este usuario".$exc->getTraceAsString());
        }
        return $exito;
    }

    function noSeguirUsuario($seguido,$seguidor){
        $exito = false;
        try
        {
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("DELETE FROM amistad WHERE idSeguido = ? AND idSeguidor = ?;");
            $consulta->bindParam(1,$seguido,PDO::PARAM_INT);
            $consulta->bindParam(2,$seguidor,PDO::PARAM_INT);
            $exito = $consulta->execute();
        }catch(Exception $exc)
        {
            throw new Exception("Ocurrio un error".$exc->getTraceAsString());
        }
        return $exito;
    }

    function obtenerSeguidos($id){
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT * FROM usuario INNER JOIN amistad ON amistad.idSeguido = usuario.id WHERE amistad.idSeguidor = ?;");
            $consulta->bindParam(1,$id,PDO::PARAM_INT);
            $consulta->execute();
            $seguidos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($seguidos);
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function obtenerSeguidores($id){
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT * FROM usuario INNER JOIN amistad ON amistad.idSeguidor = usuario.id WHERE amistad.idSeguido = ?;");
            $consulta->bindParam(1,$id,PDO::PARAM_INT);
            $consulta->execute();
            $seguidores = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($seguidores);
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function mostrarPublicacionesInicio($id){
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT publicacion.id AS idpublicacion,publicacion.foto AS fotoPublicacion,publicacion.descripcion,publicacion.fechacreacion,usuario.foto AS fotousuario,usuario.nombre AS nombre, usuario.usuario, usuario.id as idusuario FROM publicacion INNER JOIN usuario ON publicacion.usuario = usuario.id WHERE publicacion.usuario IN (SELECT usuario.id FROM usuario INNER JOIN amistad ON amistad.idSeguido = usuario.id WHERE amistad.idSeguidor = ?) AND publicacion.fechacreacion >= (SELECT date_sub(CURDATE(), INTERVAL 1 DAY));
            ");
            $consulta->bindParam(1,$id,PDO::PARAM_INT);
            $consulta->execute();
            $seguidores = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($seguidores);
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }

    function mostrarSugerencias($id){
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT usuario.nombre,usuario.foto,usuario.usuario,usuario.id FROM usuario WHERE usuario.id NOT IN (SELECT usuario.id FROM usuario INNER JOIN amistad ON usuario.id = amistad.idSeguido WHERE amistad.idSeguidor = ?) AND usuario.id <> ?;");
            $consulta->bindParam(1,$id,PDO::PARAM_INT);
            $consulta->bindParam(2,$id,PDO::PARAM_INT);
            $consulta->execute();
            $seguidores = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($seguidores);
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }
   
    function reacion($idUsuario,$idPublicacion){
        $exito = false;
        try
        {
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("INSERT INTO reacion (idUsuario,idPublicacion) SELECT usuario.id, publicacion.id FROM usuario, publicacion WHERE usuario.id = ? AND publicacion.foto = ?;");
            $consulta->bindParam(1,$idUsuario,PDO::PARAM_INT);
            $consulta->bindParam(2,$idPublicacion,PDO::PARAM_STR);
            $exito = $consulta->execute();
        }catch(Exception $exc)
        {
            throw new Exception("Ya reacionaste a la publicacion".$exc->getTraceAsString());
        }
        return $exito;
    }
    
    function noReacion($idUsuario,$idPublicacion){
        $exito = false;
        try
        {
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("DELETE FROM reacion WHERE reacion.idUsuario = ? AND reacion.idPublicacion = (SELECT publicacion.id FROM publicacion WHERE publicacion.foto = ?;");
            $consulta->bindParam(1,$idUsuario,PDO::PARAM_INT);
            $consulta->bindParam(2,$idPublicacion,PDO::PARAM_STR);
            $exito = $consulta->execute();
        }catch(Exception $exc)
        {
            throw new Exception("Ocurrio un error".$exc->getTraceAsString());
        }
        return $exito;
    }
    
    function obtenerReacion($id){
        try{
            $conexion = Conexion::crearConexion();
            $consulta = $conexion->prepare("SELECT publicacion.foto FROM publicacion INNER JOIN reacion ON reacion.idPublicacion = publicacion.id WHERE reacion.idUsuario = ?;");
            $consulta->bindParam(1,$id,PDO::PARAM_INT);
            $consulta->execute();
            $reaciones = $consulta->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($reaciones);
        }catch(Exception $exc){
            throw new Exception("Ocurrio un error" . $exc->getTraceAsString());
        }
    }
}
?>