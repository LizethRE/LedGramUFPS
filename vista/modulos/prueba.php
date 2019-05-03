<?php
if(!isset($_SESSION['Usuario'])){
	header("location:Inicio");
}
?>

	<div class="container" style="background-color: #fafafa">

		<div class="row">

			<?php
                require_once 'modelo/DTO/UsuarioDTO.php';
				$user = unserialize($_SESSION["Usuario"]);
		        echo '<div class="col-sm-8 mt-4">
				<section>
					<h5>@'.$user->getUsuario().'</h5><a href="Salir" class="btn btn-danger">Cerrar Sesión</a>
					<ul class="lista">
						<li>Publicaciones</li>
						<li>Seguidores</li>
						<li>Seguidos</li>
					</ul>
					<p><b>'.$user->getNombre().'</b></p>
					<p><b>'.$user->getCorreo().'</b></p>
					<br>
					<p>Descripción</p>
				</section>
			</div>
			 
			<div class="col-sm-4 text-center mt-4">
			 	<label for="boton-archivo">
				<img class="rounded-circle" id="imgperfil" src="'.$user->getFoto().'" alt="error">	
				</label>
				<input id="boton-archivo" type="file" style="display: none;">
			</div>';
			?>
			
		</div>
		
	</div>