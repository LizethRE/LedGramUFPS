<html lang="es">

<head>
    <title>LedGram UFPS</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <link type="text/css" rel="stylesheet" href="vista/presentacion/css/lib/argon.css?v=1.0.1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" />
    <link type="text/css" rel="stylesheet" href="vista/presentacion/css/lib/nucleo.css">
    <!-- Fuente de letra -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="vista/presentacion/css/estilo.css">
    <link rel="stylesheet" type="text/css" href="vista/presentacion/css/estilos.css">
    <link rel="stylesheet" type="text/css" href="vista/presentacion/css/tarjetas.css">

    <link rel="shortcut icon" type="image/jpg" href="vista/presentacion/images/ledgramicon.png">

</head>

<body style="background-color: #F1F1F1">

    <?php
    session_start();
    include_once 'modulos/header.php';
    $controlador = new controlador();
    $controlador->generarVista();
    ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js "></script>
    <script src="//oss.maxcdn.com/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-latest.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" src="vista/presentacion/js/jquery.validate.js"></script>
    <script type="text/javascript" src="vista/presentacion/js/alertas.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.5/firebase.js"></script>
    <script type="text/javascript" src="vista/presentacion/js/app.js"></script>
    <script type="text/javascript" src="vista/presentacion/js/main.js"></script>
    <script type="text/javascript" src="vista/presentacion/js/usuario.js"></script>

</body>

</html> 