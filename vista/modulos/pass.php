<?php
if (!isset($_SESSION['Usuario'])) {
    header("location:Inicio");
}

include_once 'modelo/DTO/UsuarioDTO.php';
$user = unserialize($_SESSION["Usuario"]);
?>
<div class="container">
	<div class="row" style="margin-top: -70px;">
		<div class="col-lg-4 card text-center cont">
			<a class="list-group-item cambioPass" href="perfil">Editar perfil</a>
            <a class="list-group-item active" href="">Cambiar contraseña</a>
            <a class="list-group-item cambioPass" href="/LedGram/vista/modulos/politicadatos.html">Privacidad y seguridad</a>
		</div>
		<div class="col-lg-8 card">
			<?php
			echo '<a href="Perfil" class="row m-2">
    		<div class="col-lg-2 p-0"><img width=55 height=55 class="rounded-circle mr-2" src="' . $user->getFoto() . '" /></div>
    		<div class="col-lg-10"><h5 style="margin:0;padding:0;">@' . $user->getUsuario() . '</h5>
    		<h6 style="margin:0;padding:0;">' . $user->getNombre() . '</h6></div>
    		</a>';
			?>
			<div>
				<form method="post" autocomplete="off">
  					<div class="form-group row">
                        <label for="contraActual" class="col-sm-3 col-form-label"><strong>Contraseña actual</strong></label>
                        <div class="col-sm-9">
     						<input type="password" class="form-control" name ="passActual" id="passActual">
    					</div>
  					</div>
  					<div class="form-group row"> 					
                        <label for="contraNueva" class="col-sm-3 col-form-label"><strong>Contraseña nueva</strong></label>
                        <div class="col-sm-9">
     						<input type="password" class="form-control" name ="passNueva" id="passNueva">
    					</div>
  					</div>
  					<div class="form-group row">
                        <label for="contraNNueva" class="col-sm-3 col-form-label"><strong>Confirmar nueva contraseña</strong></label>
                        <div class="col-sm-9">
     						<input type="password" class="form-control" name ="passNNueva" id="passNNueva">
    					</div>
  					</div>
  					<div class="text-center">
  						<button type="button" class="btn btn-primary" style="margin-bottom: 20px;">Cambiar contraseña</button>
  					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div id="modalpublicacionesinicio" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="row">
          <div class="col-lg-8">
               <img id="fotopublicacioninicio" src="" class="card-img-top m-0 p-0 w-100" alt="..." >
          </div>
          <div class="col-lg-4">
            <?php
            echo '
            <section class="row mt-4 mb-4">
            <div class="col-lg-2 p-0"><img width=40 height=40 src="" id="mostrarFotoModalInicio" alt="error al cargar foto" class="rounded-circle mr-2 fotoPerfilUsuario"></div>
            <div class="col-lg-10">
            <div class="row">
               <div class="col-lg-6"> 
            <h6 id="mostrarUsuarioModalInicio"></h6>
            <p class="text-left m-0 p-0" id="fechaamistadinicio"></p>
               </div>
               <div class="col-lg-6">
               <input type="hidden" id="textoamistad" name="textoamistadinicio">
                <button class="btn bg-white ml-4" data-id="" id="megusta"><i class="fas fa-heart"></i></button>
               </div> 
            </div>
            </div>
            </section>
            <p class="text-left" id="descamistadinicio"></p>
            <hr style="margin:0;padding:0;">';
            ?>
          </div>
      </div>
    </div>
  </div>
</div>