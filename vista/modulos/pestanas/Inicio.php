<?php

if(isset($_SESSION['Usuario'])){
	header("location:perfil");
}

?>

<div class="carrusel">
    <div class="cargar">
        
    </div>
    <div class="container" id="inicio">
		<section id="seccionop">
			<div>
				<img src="vista/presentacion/images/ledgram.png" id="iconocabecera">
				<p>Ingresa para ver fotos y vídeos de tus amigos de la UFPS.</p>
				<br>
				<div style="padding-left: 20px;padding-right: 20px;">
					<button style="color: white;" id="btn-Google" class="btn btn-danger btn-md btn-block"><i class="fab fa-google"></i>  Google</button>
				</div>
				<br>
			</div>
		</section>
		<p>Al ingresar, aceptas nuestras Condiciones, la <a href="vista/modulos/politicadatos.html">Política de datos.</a></p>
		<!-- Content here -->
	</div>

	<footer>
		<a href="https://ww2.ufps.edu.co/"><img class="imagen-principal " src=vista/presentacion/images/logoufps.png></a>
		© 2019 LedGram
	</footer>
</div>