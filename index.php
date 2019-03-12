<?php
	$name = htmlentities($_GET['name']);
?>


<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../presentacion/css/estilo.css">

<div class="container" style="margin-top: 10%; text-align: center;">
	<h1>
		<?php echo $name ?>
	</h1>

	<br>

	<label for="boton-archivo">
			<img class="rounded-circle" src="vista/presentacion/images/perfil.jpg" style="width: 20%;">
		</label>

			<input id="boton-archivo" type="file" style="display: none;">
	
</div>