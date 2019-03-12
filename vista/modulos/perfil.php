
<!DOCTYPE html>
<html>
<head>
	<title>Perfil</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../presentacion/css/estilo.css">
	<link rel="icon" type="image/png" href="../presentacion/images/ledgramicon.png" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>
<body style="background-color: #fafafa">
	<header id="hh">
		<div class="row">
			<div class="izq">
				<img id="imgpd" src="../presentacion/images/ledgram2.png" class="d-inline-block align-top" alt="">
			</div>
			<div class="centro">
				<form class="form-inline">
					<input class="form-control input-sm" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="border-color: red; color:red;"><i class="fas fa-search"></i></button>
				</form>
			</div>
			<div class="der">
				<span style="font-size: 20px; color: gray; margin-right: 15px;">
					<i class="far fa-bell"></i>
				</span>
				<span style="font-size: 20px; color: red; margin-right: 15px;">
					<i class="far fa-heart"></i>
				</span>
				<span style="font-size: 20px; color: gray;">
					<i class="far fa-user"></i>
				</span>
			</div>
		</div>
	</header>

	<div class="container">
			
		<label for="boton-archivo">
			<img class="rounded-circle" id="imgperfil" src="vista/presentacion/images/perfil.jpg">
		</label>

			<input id="boton-archivo" type="file" style="display: none;">

	</div>

</body>
</html>