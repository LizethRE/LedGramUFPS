$(document).ready(function () {

    $("#opcionesActualizarFoto").hide();
    $("#cargarBusqueda").hide();
    $(mostrarPublicaciones());
    $(buscarUsuarioAmistad());
    $(mostrarPublicacionesAmistad());
    $(obtenerSeguidos());
    $(usuariosSeguidos());
    $(usuariosSeguidores());
    $(usuariosSeguidosAmistad());
    $(usuariosSeguidoresAmistad());
    $(mostrarPublicacionesInicio());
    $(mostrarSugerencias());
    $("#cargarReacion").hide();
    $(cargarNotificaciones());

    $("#formActualizar").validate({

        rules:
        {
            actualizarNombres: { required: true },
            actualizarUsuario: { required: true },
            actualizarDescripcion: { required: true }
        },
        messages:
        {
            actualizarNombres: { required: '<p style="color:red;">✘</p>' },
            actualizarUsuario: { required: '<p style="color:red;">✘</p>' },
            actualizarDescripcion: { required: '<p style="color:red;">✘</p>' }
        },

        submitHandler: function () {

            var datos = {
                actualizarId: $("#actualizarId").val(),
                actualizarNombres: $("#actualizarNombres").val(),
                actualizarUsuario: $("#actualizarUsuario").val(),
                actualizarDescripcion: $("#actualizarDescripcion").val()
            }

            $.ajax({
                url: 'vista/modulos/Ajax.php',
                method: 'post',
                data: datos,
                dataType: "json",

                beforeSend: function () {
                    respuestaInfoEspera("Espera un momento por favor.");
                },

                success: function (respuesta) {
                    if (respuesta["exito"]) {
                        ingresoExitoso("Exito!", "Se actualizarón sus datos");
                    } else if (!respuesta["exito"]) {
                        respuestaError("Error!", "Ocurrio un Error");
                    }
                }
            });

        }

    });

    $("#fotoUsuario").click(function () {
        $("#opcionesActualizarFoto").show();
    });

    function mostrarPublicaciones() {
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarPublicaciones=true',
            method: 'get',
            dataType: "json",

            success: function (respuesta) {
            	var cantidad = respuesta.length;
                var html = '';
                var html2 = '';
                if(cantidad<1){
                    html2 += html2.concat('<div class="alert alert-primary alert-dismissible fade show" role="alert">',
                    		'<span class="alert-inner--icon"><i class="fas fa-info-circle"></i></span>',
                    		'<span class="alert-inner--text"><strong>Información!</strong> Ahora puedes empezar a publicar tus fotos para que tus amigos puedan verlas</span>',
                    		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">',
                    		'<span aria-hidden="true">&times;</span>',
                    		'</button>',
                    		'</div>');
                    $("#alert").html(html2);
                }else{
                	document.getElementById("publicacion").innerHTML = respuesta.length;
                	for (var i = 0; i < respuesta.length; i++) {
                        html += '<div class="col-lg-3" id="dana"  data-publicacion="' + respuesta[i].id + '" data-fecha="' + respuesta[i].fecha + '" data-descripcion="' + respuesta[i].descripcion + '" data-id="' + respuesta[i].foto + '" data-toggle="modal" data-target="#modalpublicacion">\n\
                                    <img class="mt-2" src="'+ respuesta[i].foto + '" width="200" height="200">\n\
                                    </div>';
                    }
                }
                $("#cargarPublicaciones").html(html);
            }
        });
    }

    $(document).on("click", "#dana", function () {
        var foto = $(this).data("id");
        var des = $(this).data("descripcion");
        var fecha = $(this).data("fecha");
        var publicacion = $(this).data("publicacion");
        document.getElementById("fecha").innerHTML = fecha;
        document.getElementById("desc").innerHTML = des;
        $("#fotopublicacion").attr("src", foto);
        $("#texto").val(publicacion);
        $(contReaciones());
    });

    $("#btnEliminarPublicacion").click(function () {
        swal({
            title: "Estas Seguro?",
            text: "si eliminas la foto ya no podras recuperarla",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    var eliminar = $("#texto").val();

                    var datos = {
                        eliminaridpublicacion: eliminar
                    }

                    $.ajax({
                        url: 'vista/modulos/Ajax.php',
                        method: 'post',
                        data: datos,
                        dataType: "json",

                        success: function (respuesta) {
                            mostrarPublicaciones();
                            $("#modalpublicacion").modal("hide");
                        }
                    });
                }
            });

    });

    function cargarBusqueda(busqueda) {
        $.ajax({
            url: 'vista/modulos/Ajax.php?buscarAmistad=' + busqueda,
            dataType: 'json',
            success: function (respuesta) {
                var html = "";
                var cantidad = respuesta.length;
                if (cantidad < 1) {
                    html = "<p>No se encontrarón usuarios</p>";
                } else {
                    for (var i = 0; i < respuesta.length; i++) {
                        html += '<a href="Usuario=' + respuesta[i].id + '" class="row">\n\
                        <div class="col-lg-2"><img width=45 height=45 class="rounded-circle ml-4" src="'+ respuesta[i].foto + '" /></div>\n\
                        <div class="col-lg-10">\n\
                            <h6 class="text-left m-0 p-0"><b>'+ respuesta[i].usuario + '<b></h6>\n\
                            <h6 class="text-left m-0 p-0">'+ respuesta[i].nombre + '</h6>\n\
                        </div>\n\
                    </a>';
                    }
                }
                $("#cargarBusqueda").html(html);
            }
        });
    }

    function buscarUsuarioAmistad() {
        var datos = {
            idUsuarioBuscar: $("#idUsuarioMostrar").val()
        }

        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",

            success: function (respuesta) {
                document.getElementById("mostrarNombre").innerHTML = respuesta[0].nombre;
                document.getElementById("mostrarUsuario").innerHTML = "@" + respuesta[0].usuario;
                document.getElementById("mostrarUsuarioModal").innerHTML = "@" + respuesta[0].usuario;
                document.getElementById("mostrarCorreo").innerHTML = respuesta[0].correo;
                document.getElementById("mostrarDescripcion").innerHTML = respuesta[0].descripcion;
                $("#mostrarFoto").attr("src", respuesta[0].foto);
                $("#mostrarFotoModal").attr("src", respuesta[0].foto);
            }
        });
    }

    $(document).on('keyup', "#busqueda", function () {
        var busqueda = $(this).val();
        if (busqueda != "") {
            cargarBusqueda(busqueda);
            $("#cargarBusqueda").show();
        } else {
            $("#cargarBusqueda").hide();
        }
    });

    function mostrarPublicacionesAmistad() {
        var datos = {
            idUsuarioMostrarPublicaciones: $("#idUsuarioMostrar").val()
        }
        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",

            success: function (respuesta) {
                var html = '';
                document.getElementById("publicacionesAmistad").innerHTML = respuesta.length;
                for (var i = 0; i < respuesta.length; i++) {
                    html += '<div class="col-lg-3" id="pamistad"  data-publicacion="' + respuesta[i].id + '" data-fecha="' + respuesta[i].fecha + '" data-descripcion="' + respuesta[i].descripcion + '" data-id="' + respuesta[i].foto + '" data-toggle="modal" data-target="#modalpublicacionamistad">\n\
                                <img class="mt-2" src="'+ respuesta[i].foto + '" width="200" height="200">\n\
                                </div>';
                }
                $("#cargarPublicacionesAmistad").html(html);
            }
        });
    }

    //muestra la foto en modal del perfil usuario amistad
    $(document).on("click", "#pamistad", function () {
        var fotoa = $(this).data("id");
        var desa = $(this).data("descripcion");
        var fechaa = $(this).data("fecha");
        var publicaciona = $(this).data("publicacion");
        document.getElementById("fechaamistad").innerHTML = fechaa;
        document.getElementById("descamistad").innerHTML = desa;
        $("#fotopublicacionamistad").attr("src", fotoa);
        $("#textoamistad").val(publicaciona);
        $(obtenerReacion2());
    });

    $("#btnSeguir").click(function () {
        var idUsuario = $("#idUsuarioMostrar").val();
        var opcion = $(this).data("id");
        var datos = {};
        if (opcion === "seguir") {
            datos = {
                idUsuarioSeguir: idUsuario,
                opcionRealizar: "seguir"
            }
        } else if (opcion === "noseguir") {
            datos = {
                idUsuarioSeguir: idUsuario,
                opcionRealizar: "noseguir"
            }
        }

        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",

            success: function (respuesta) {
                if (respuesta["exito"]) {
                    ingresoExitoso("Exito!", "Proceso realizado Correctamente");
                } else if (!respuesta["exito"]) {
                    respuestaError("Error!", "Ocurrio un Error");
                }
            }
        });
    });

    function obtenerSeguidos() {
        var idUsuario = $("#idUsuarioMostrar").val();
        $.ajax({
            url: 'vista/modulos/Ajax.php?obtenerSeguidos=true',
            dataType: 'json',
            success: function (respuesta) {
                for (var i = 0; i < respuesta.length; i++) {
                    if (respuesta[i].idSeguido == idUsuario) {
                        $("#btnSeguir").attr("data-id", "noseguir");
                        document.getElementById("btnSeguir").innerHTML = "No Seguir";
                        break;
                    } else {
                        $("#btnSeguir").attr("data-id", "seguir");
                        document.getElementById("btnSeguir").innerHTML = "Seguir";
                    };
                }
            }
        });
    }

    function usuariosSeguidos() {
        $.ajax({
            url: 'vista/modulos/Ajax.php?obtenerSeguidos=true',
            dataType: 'json',
            success: function (respuesta) {
                var cantidad = respuesta.length;
                document.getElementById("seguidos").innerHTML = cantidad;
            }
        });
    }

    function usuariosSeguidosAmistad() {
        var datos = {
            idUsuarioMostrarUsuariosSeguidos: $("#idUsuarioMostrar").val()
        }
        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",
            success: function (respuesta) {
                var cantidad = respuesta.length;
                document.getElementById("seguidosAmistad").innerHTML = cantidad;
            }
        });
    }

    function usuariosSeguidoresAmistad() {
        var datos = {
            idUsuarioMostrarUsuariosSeguidores: $("#idUsuarioMostrar").val()
        }
        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",
            success: function (respuesta) {
                var cantidad = respuesta.length;
                document.getElementById("seguidoresAmistad").innerHTML = cantidad;
            }
        });
    }

    function usuariosSeguidores() {
        $.ajax({
            url: 'vista/modulos/Ajax.php?obtenerSeguidores=true',
            dataType: 'json',
            success: function (respuesta) {
                var cantidad = respuesta.length;
                document.getElementById("seguidores").innerHTML = cantidad;
            }
        });
    }

    $("#btnMegustaAmistad").click(function () {
    	var idPublicacion = document.getElementById("fotopublicacionamistad").getAttribute('src');
        var opcion = $(this).data("id");
        var datos = {};
        if (opcion === "megusta") {
            datos = {
                publicacion: idPublicacion,
                opcionRealizar: "megusta"
            }
        }else if (opcion === "nomegusta") {
            datos = {
            	publicacion: idPublicacion,
                opcionRealizar: "nomegusta"
            }
        }

        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",
            success: function (respuesta) {
                if (respuesta["exito"]) {
                    ingresoExitoso("Exito!", "Proceso realizado Correctamente");
                } else if (!respuesta["exito"]) {
                    respuestaError("Error!", "Ocurrio un Error");
                }
            }
        });
    });

    function obtenerReacion2() {
    	var idPublicacion = document.getElementById("fotopublicacionamistad").getAttribute('src');
        $.ajax({
            url: 'vista/modulos/Ajax.php?obtenerReacion=true',
            dataType: 'json',
            success: function (respuesta) {
                for (var i = 0; i < respuesta.length; i++) {
                	var elem = document.getElementById("icoMegusta");
                    if (respuesta[i].foto == idPublicacion) {
                        $("#btnMegustaAmistad").attr("data-id", "nomegusta");
                        elem.classList.remove("far");
                        elem.classList.remove("fa-heart");
                        elem.classList.add("fas");
                        elem.classList.add("fa-heart");
                        elem.style.color = '#5e72e4';

                        break;
                    } else {
                        $("#btnMegustaAmistad").attr("data-id", "megusta");
                        elem.classList.remove("fas");
                        elem.classList.remove("fa-heart");
                        elem.classList.add("far");
                        elem.classList.add("fa-heart");
                        elem.style.color = null;
                    };
                }
            }
        });
    }

    $("#btnSeguidosAmistad").click(function () {
        var datos = {
            idUsuarioMostrarUsuariosSeguidos: $("#idUsuarioMostrar").val()
        }
        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",
            success: function (respuesta) {
                var cantidad = respuesta.length;
                var html = "";
                if (cantidad < 1) {
                    html = "<p>No ha seguido a ningún usuario.</p>";
                } else {
                    for (var i = 0; i < cantidad; i++) {
                        html += '<a href="Usuario=' + respuesta[i].idSeguido + '" class="row m-2">\n\
                    <div class="col-lg-2 p-0"><img width=55 height=55 class="rounded-circle mr-2" src="'+ respuesta[i].foto + '" /></div>\n\
                    <div class="col-lg-10"><h5 style="margin:0;padding:0;">@'+ respuesta[i].usuario + '</h5>\n\
                    <h6 style="margin:0;padding:0;">'+ respuesta[i].nombre + '</h6></div>\n\
                    </a>';
                    }
                }
                $("#mostrarSeguidosAmistad").html(html);
            }
        });
    });

    $("#btnSeguidoresAmistad").click(function () {
        var datos = {
            idUsuarioMostrarUsuariosSeguidores: $("#idUsuarioMostrar").val()
        }
        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",
            success: function (respuesta) {
                var cantidad = respuesta.length;
                var html = "";
                if (cantidad < 1) {
                    html = "<p>No tiene Seguidores.</p>";
                } else {
                    for (var i = 0; i < cantidad; i++) {
                        html += '<a href="Usuario=' + respuesta[i].idSeguidor + '" class="row m-2">\n\
                    <div class="col-lg-2 p-0"><img width=55 height=55 class="rounded-circle mr-2" src="'+ respuesta[i].foto + '" /></div>\n\
                    <div class="col-lg-10"><h5 style="margin:0;padding:0;">@'+ respuesta[i].usuario + '</h5>\n\
                    <h6 style="margin:0;padding:0;">'+ respuesta[i].nombre + '</h6></div>\n\
                    </a>';
                    }
                }
                $("#mostrarSeguidosAmistad").html(html);
            }
        });
    });

    $("#btnSeguidos").click(function () {
        $.ajax({
            url: 'vista/modulos/Ajax.php?obtenerSeguidos=true',
            dataType: 'json',
            success: function (respuesta) {
                var cantidad = respuesta.length;
                var html = "";
                if (cantidad < 1) {
                    html = "<p>No has seguido a ningún usuario.</p>";
                } else {
                    for (var i = 0; i < cantidad; i++) {
                        html += '<a href="Usuario=' + respuesta[i].idSeguido + '" class="row m-2">\n\
                    <div class="col-lg-2 p-0"><img width=55 height=55 class="rounded-circle mr-2" src="'+ respuesta[i].foto + '" /></div>\n\
                    <div class="col-lg-10"><h5 style="margin:0;padding:0;">@'+ respuesta[i].usuario + '</h5>\n\
                    <h6 style="margin:0;padding:0;">'+ respuesta[i].nombre + '</h6></div>\n\
                    </a>';
                    }
                }
                $("#mostrarSeguidos").html(html);
            }
        });
    });

    $("#btnSeguidores").click(function () {
        $.ajax({
            url: 'vista/modulos/Ajax.php?obtenerSeguidores=true',
            dataType: 'json',
            success: function (respuesta) {
                var cantidad = respuesta.length;
                var html = "";
                if (cantidad < 1) {
                    html = "<p>No tiene Seguidores.</p>";
                } else {
                    for (var i = 0; i < cantidad; i++) {
                        html += '<a href="Usuario=' + respuesta[i].idSeguidor + '" class="row m-2">\n\
                    <div class="col-lg-2 p-0"><img width=55 height=55 class="rounded-circle mr-2" src="'+ respuesta[i].foto + '" /></div>\n\
                    <div class="col-lg-10"><h5 style="margin:0;padding:0;">@'+ respuesta[i].usuario + '</h5>\n\
                    <h6 style="margin:0;padding:0;">'+ respuesta[i].nombre + '</h6></div>\n\
                    </a>';
                    }
                }
                $("#mostrarSeguidos").html(html);
            }
        });
    });

    function mostrarPublicacionesInicio(){
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarPublicacionesInicio=true',
            dataType: 'json',
            success: function (respuesta) {
                var cantidad = respuesta.length;
                var html = "";
                if(cantidad<1){
                    html += html.concat('<br>',
                    		'<div class="alert alert-primary alert-dismissible fade show" role="alert">',
                    		'<span class="alert-inner--icon"><i class="fas fa-info-circle"></i></span>',
                    		'<span class="alert-inner--text"><strong>Información! </strong>Tus amigos no ha realizado publicaciones recientemente o no sigues</span>',
                    		'<span class="alert-inner--text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a nadie.</span>',
                    		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">',
                    		'<button type="button" class="close" data-dismiss="alert" aria-label="Close">',
                    		'<span aria-hidden="true">×</span>',
                    		'</button>',
                    		'</div>');
                }else{
                    for(var i=0;i<cantidad;i++){
                        html += '<div id="iniciom"  data-nombreu="' + respuesta[i].usuario + '" data-usuario="' + respuesta[i].fotousuario + '" data-publicacion="' + respuesta[i].usuario + '" data-fecha="' + respuesta[i].fechacreacion + '" data-descripcion="' + respuesta[i].descripcion + '" data-id="' + respuesta[i].fotoPublicacion + '" data-toggle="modal" data-target="#modalpublicacionesinicio">\n\
                        <a href="Usuario='+respuesta[i].idusuario+'" class="row m-2">\n\
                        <div class="col-lg-2 p-0"><img style="display:block; margin:auto;" class="rounded-circle mt-2" src="'+respuesta[i].fotousuario+ '"width="45" height="45""></div>\n\
                        <div class="col-lg-10"><h5 style="margin:0;padding:0;"><b>@'+ respuesta[i].usuario + '<b></h5>\n\
                        <h6 style="margin:0;padding:0;">'+ respuesta[i].nombre + '</h6></div></a>\n\
                        <br>\n\
                        <img style="display: block; margin: auto;" class="mt-2" src="'+respuesta[i].fotoPublicacion+'" alt="Error al cargar" width="500" height="500">\n\
                        <h6 style="margin:0;padding:0; text-align:center;">'+ respuesta[i].fechacreacion + '</h6>\n\
                        </div>\n\
                        <br><br>\n\
                        ';
                    }
                }
                $("#cargarPublicacionesInicio").html(html);
            }
        });
    }

    //muestra la foto en modal de las publicaciones de inicio
    $(document).on("click", "#iniciom", function () {
        var fotoi = $(this).data("id");
        var desi = $(this).data("descripcion");
        var fechai = $(this).data("fecha");
        var fotou = $(this).data("usuario");
        var nombreu = $(this).data("nombreu");
        var publicacioni = $(this).data("publicacion");
        document.getElementById("mostrarUsuarioModalInicio").innerHTML = nombreu;
        document.getElementById("fechaamistadinicio").innerHTML = fechai;
        document.getElementById("descamistadinicio").innerHTML = desi;
        $("#mostrarFotoModalInicio").attr("src", fotou);
        $("#fotopublicacioninicio").attr("src", fotoi);
        $("#textoamistadinicio").val(publicacioni);
        $(obtenerReacion());
    });

    function mostrarSugerencias(){
        $.ajax({
            url: 'vista/modulos/Ajax.php?mostrarSugerencias=true',
            dataType: 'json',
            success: function (respuesta) {
                var cantidad = respuesta.length;
                var html = "";
                if(cantidad<1){
                    html = "No hay sugerencias";
                }else{
                    for(var i=0;i<cantidad;i++){
                        html += '<a href="Usuario='+respuesta[i].id+'" class="row m-2">\n\
                        <div class="col-lg-2 p-0"><img width=55 height=55 class="rounded-circle mr-2" src="'+respuesta[i].foto+'" /></div>\n\
                        <div class="col-lg-10">\n\
                            <h5 style="margin:0;padding:0;">@'+respuesta[i].usuario+'</h5>\n\
                            <h6 style="margin:0;padding:0;">'+respuesta[i].nombre+'</h6>\n\
                        </div>\n\
                    </a>';
                    }
                }
                $("#mostrarSugerencias").html(html);
            }
        });
    }

    $("#btnMegustaInicio").click(function () {
    	var idPublicacion = document.getElementById("fotopublicacioninicio").getAttribute('src');
        var opcion = $(this).data("id");
        var datos = {};

        if (opcion === "megusta") {
            datos = {
                publicacion: idPublicacion,
                opcionRealizar: "megusta"
            }
        }else if (opcion === "nomegusta") {
            datos = {
            	publicacion: idPublicacion,
                opcionRealizar: "nomegusta"
            }
        }

        $.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",
            success: function (respuesta) {
                if (respuesta["exito"]) {
                    ingresoExitoso("Exito!", "Proceso realizado Correctamente");
                } else if (!respuesta["exito"]) {
                    respuestaError("Error!", "Ocurrio un Error");
                }
            }
        });
    });

    function obtenerReacion() {
    	var idPublicacion = document.getElementById("fotopublicacioninicio").getAttribute('src');
        $.ajax({
            url: 'vista/modulos/Ajax.php?obtenerReacion=true',
            dataType: 'json',
            success: function (respuesta) {
                for (var i = 0; i < respuesta.length; i++) {
                	var elem = document.getElementById("icoMegusta");
                    if (respuesta[i].foto == idPublicacion) {
                        $("#btnMegustaInicio").attr("data-id", "nomegusta");
                        elem.classList.remove("far");
                        elem.classList.remove("fa-heart");
                        elem.classList.add("fas");
                        elem.classList.add("fa-heart");
                        elem.style.color = '#5e72e4';

                        break;
                    } else {
                        $("#btnMegustaInicio").attr("data-id", "megusta");
                        elem.classList.remove("fas");
                        elem.classList.remove("fa-heart");
                        elem.classList.add("far");
                        elem.classList.add("fa-heart");
                        elem.style.color = null;
                    };
                }
            }
        });
    }

    function cargarReacion() {
        $.ajax({
            url: 'vista/modulos/Ajax.php?buscarReacion=true',
            dataType: 'json',
            success: function (respuesta) {
            },
            error: function (jqXHR, estado, error) {
                console.log(estado);
                console.log(error);
                console.log(jqXHR);
            }
        });
    }

    $("#btnReacion").click(function () {
    	cargarReacion(busqueda);
    	$("#cargarReacion").show();
    });

    function guardarActual(dato){
            localStorage.setItem('cantidadActual',dato);
    }

    $("#btnMostrarNotificaciones").click(function(){
        $(cargarNotificaciones());
    });

    function cargarNotificaciones(){
        $.ajax({
            url: 'vista/modulos/Ajax.php?cargarNotificaciones=true',
            dataType: 'json',
            success: function (respuesta) {
                var cantidad = respuesta.length;
                var actual = localStorage.getItem('cantidadActual');
                if(actual!=cantidad || actual === null){
                    guardarActual(cantidad);
                    $("#cantidadNotificaciones").show();
                }else{
                    $("#cantidadNotificaciones").hide();
                }
                var html = "";
                document.getElementById('cantidadNotificaciones').innerHTML = cantidad;
                if(cantidad<1){
                    var nulo = null;
                    guardarActual(nulo);
                    $("#cantidadNotificaciones").hide();
                    html = 'Sin Notificaciones';
                }else{
                    for(var i=0;i<cantidad;i++){
                        html += '<p>\n\
                    <a href="Usuario='+respuesta[i].idUsuario+'">\n\
                    <img src="'+respuesta[i].fotoUsuario+'" alt="Error" width="30" height="30" class="rounded-circle mr-2"> <strong>'+respuesta[i].nombre+'</strong>\n\
                    </a>\n\
                    le ha gustado su publicación \n\
                    <img src="'+respuesta[i].fotoPublicacion+'" alt="Error" width="50" height="50" class="rounded-circle mr-2 imagen-gustada"> \n\
                    </p>\n\
                    <hr class="m-0 p-0">';
                    }
                }
                $("#cargarNotificaciones").html(html);
            }
        });
    }

	function contReaciones() {
		var idPublicacion = document.getElementById("fotopublicacion").getAttribute('src');
		var datos = {
				contReaciones: idPublicacion
	    }
		$.ajax({
            url: 'vista/modulos/Ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",
            success: function (respuesta) {
                var cantidad = respuesta.length;
                document.getElementById("iconoLikes").innerHTML = cantidad;
            }
        });
	}	
});