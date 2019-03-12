<!DOCTYPE html>
<html>
<head>
	<title>LedGram</title>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="vista/presentacion/css/style.css">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body>
	<br>
	<div class="container">
		<section id="seccionop">
			<div>
				<img src="vista/presentacion/images/ledgram.png" id="iconocabecera">
				<p>Ingresa para ver fotos y vídeos de tus amigos de la UFPS.</p>
				<br>
				<div>
					<button style="color: white; width: 80%;" id="btn-Google" class="btn btn-danger btn-md "><i class="fab fa-google" style="margin-right: 5%;"></i>Google</button>
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
</body>

<script type="text/javascript">
	var index = 0;

	var listaimg = ["vista/presentacion/images/apps_co.jpg", "vista/presentacion/images/apps.jpg", "vista/presentacion/images/fondoescritorio.jpg", "vista/presentacion/images/fondopantalla.png"];

	$(function() {

		setInterval(changeImage, 2000);

	});

	function changeImage() {


		$('body').css("background-image", 'url(' + listaimg[index] + ')');

		index++;

		if(index == 4)
			index = 0;


	}
</script>

<script src="https://www.gstatic.com/firebasejs/5.8.6/firebase.js"></script>
<script type="text/javascript" src="vista/presentacion/js/app.js"></script>
</html>