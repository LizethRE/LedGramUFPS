<header id="header">
	<div class="row">
		<a href="inicio" class="col">
			<img src="vista/presentacion/images/ledgram2.png" id="logop">
		</a>
		<div class="col">
			<div class="input-group input-group-sm mb-3">
				<input type="text" class="form-control dropdown-toggle" id="busqueda" name="busqueda" placeholder="Buscar" autocapitalize="none" style="text-align: center; position: relative;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<div class="dropdown-menu text-center" style="width: 100%;" id="cargarBusqueda">

				</div>
			</div>
		</div>
		<div class="col">
			<div style="display: block;float: right;margin-right: 40%;">
				<span style="font-size: 30px; color: gray; margin-right: 15px; align-content: center;">
					<i class="far fa-bell"></i>
				</span>
				<span id="btnMostrarNotificaciones" style="font-size: 30px; color: gray; margin-right: 15px; align-content: center;cursor: pointer;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="far fa-heart"></i><span class="badge badge-danger" id="cantidadNotificaciones"></span>
				</span>
				<div class="dropdown-menu text-center" style="width: 90%;">
				<div style="height: 208px;overflow: scroll;overflow-x: hidden;" id="cargarNotificaciones">
				
				</div>
				</div>
				<span>
					<a href="perfil" style="font-size: 30px; color: gray; align-content: center;"><i class="far fa-user"></i></a>
				</span>
			</div>
		</div>
	</div>
</header>