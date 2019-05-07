<?php
if (!isset($_SESSION['Usuario'])) {
    header("location:Inicio");
}

include_once 'modelo/DTO/UsuarioDTO.php';
$user = unserialize($_SESSION["Usuario"]);
?>

<main class="profile-page">
    <section class="section-profile-cover section-shaped my-0" style="background-color: #F1F1F1">
    </section>
    <section class="section">
        <div class="container">
            <div class="card card-profile shadow" style="margin-top: -560px;">
                <div class="px-4">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">

                                <form action="cargarFotoPerfilUsuario" method="POST" autocomplete="off" enctype="multipart/form-data">
                                    <?php
                                    echo '<input type="hidden" value="' . $user->getId() . '" name="idUsuario" id="idUsuario" />
                                	<input type="hidden" value="' . $user->getFoto() . '" name="fotoActualUsuario" id="fotoActualUsuario" />
                                	<label id="fotoUsuario" for="imagen" data-toggle="tooltip" title="Cambiar Foto">
                                	<img src="' . $user->getFoto() . '" class="rounded-circle fotoPerfilUsuario">
                                	</label>';
                                    ?>
                                    <input id="imagen" name="imagen" type="file" required />
                                    <div id="opcionesActualizarFoto">
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                        <button type="submit" id="btnActualizarFotoUsuario" class="btn btn-success ml-4"><i class="fas fa-check"></i></button>
                                        <a href="Perfil" id="btnCancelarActualizarFotoUsuario" class="btn btn-danger ml-4"><i class="fas fa-times-circle"></i></a>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                            <div class="dropdown">
                                <a href="#" class="btn btn-default dropdown-toggle " data-toggle="dropdown" id="navbarDropdownMenuLink2"><i class="fas fa-cog mr-2"></i></a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                    <li>
                                        <a class="dropdown-item" href="pass">
                                            Cambiar Contraseña
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="Salir">
                                            Cerrar Sesión
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 order-lg-1">
                            <div class="card-profile-stats d-flex justify-content-center">
                                <div>
                                    <span class="heading" id="publicacion">0</span>
                                    <span class="description">Publicaciones</span>
                                </div>
                                <div data-toggle="modal" data-target="#modalSeguidos" id="btnSeguidores" style="cursor: pointer;">
                                    <span class="heading" id="seguidores">0</span>
                                    <span class="ription">Seguidores</span>
                                </div>
                                <div data-toggle="modal" data-target="#modalSeguidos" id="btnSeguidos" style="cursor: pointer;">
                                    <span class="heading" id="seguidos">0</span>
                                    <span class="ription">Seguidos</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade bd-example-modal-sm" id="modalSeguidos" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content" id="mostrarSeguidos">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-5">
                        <?php
                        echo '
   <section>
   <h5>@<b>' . $user->getUsuario() . '<b></h5>
   <p>' . $user->getNombre() . '</p>
   <p>' . $user->getCorreo() . '</p>
   <br>
   <p>' . $user->getDescripcion() . '</p>
   </section>';
                        ?>
                    </div>

                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fas fa-images mr-2"></i>Mis Publicaciones</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="fas fa-tags mr-2"></i>Etiquetas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fas fa-edit mr-2"></i>Actualizar Datos</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active row" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                    <div id="alert"></div>
                                    <div style="text-align: center;">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable" data-toggle="tooltip" title="Cambiar Foto"> Añadir Publicación <i class="fas fa-plus"></i>
                                        </button>

                                        <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <form class="modal-content" action="cargarFotoPublicacionUsuario" method="POST" autocomplete="off" enctype="multipart/form-data">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalScrollableTitle">Publicar Foto</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php
                                                        echo '<input type="hidden" value="' . $user->getId() . '" name="idUsuarioPublicacion" id="idUsuarioPublicacion" required/>'
                                                        ?>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-camera"></i></span>
                                                            </div>
                                                            <input class="form-control" id="imagenes" name="imagenes" type="file" required />
                                                        </div>
                                                        <div class="input-group mt-2">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-edit"></i></span>
                                                            </div>
                                                            <textarea class="form-control" id="descripcion" name="descripcion" aria-label="With textarea"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="container mt-2">
                                        <div class="row" id="cargarPublicaciones">
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <span class="alert-inner--icon"><i class="fas fa-info-circle"></i></span>
                                        <span class="alert-inner--text"><strong>Información!</strong> Aquí van las etiquetas.</span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <span class="alert-inner--icon"><i class="fas fa-info-circle"></i></span>
                                        <span class="alert-inner--text"><strong>Información!</strong> Cambie los datos que desea actualizar, los cambios se reflejan al instante.</span>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="col-lg-8 mx-auto">
                                        <form role="form" method="POST" id="formActualizar">
                                            <div class="form-group mb-3">
                                                <?php
                                                require_once 'modelo/DTO/UsuarioDTO.php';
                                                $user = unserialize($_SESSION["Usuario"]);
                                                echo '<input type="hidden" name="actualizarId" id="actualizarId" value="' . $user->getId() . '" required>';
                                                ?>
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                                                    </div>
                                                    <?php
                                                    echo '<input class="form-control" name="actualizarNombres" id="actualizarNombres" placeholder="Nombre" type="text" value="' . $user->getNombre() . '"  required>';
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="input-group input-group-alternative d-none">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                                                </div>
                                                <?php
                                                echo '<input class="form-control" name="actualizarUsuario" id="actualizarUsuario" placeholder="Usuario" value="' . $user->getUsuario() . '" type="hidden" required>';
                                                ?>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-align-justify"></i></span>
                                                    </div>
                                                    <?php
                                                    echo '<input class="form-control" name="actualizarDescripcion" id="actualizarDescripcion" placeholder="Descripcion" value="' . $user->getDescripcion() . '" type="text" required>';
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary my-4"><i class="fas fa-sync-alt mr-2"></i> Actualizar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="modalpublicacion" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-lg-8">
                            <img id="fotopublicacion" src="" class="card-img-top m-0 p-0 w-100" alt="...">
                        </div>
                        <div class="col-lg-4">
                            <?php
                            echo '<section class="row mt-4 mb-4">
            <div class="col-lg-2 p-0"><img width=40 height=40 class="rounded-circle mr-2" src="' . $user->getFoto() . '" /></div>
            <div class="col-lg-10">
            <div class="row">
               <div class="col-lg-6">
            <h6 style="margin:0;padding:0;">@' . $user->getUsuario() . '</h6>
            <p class="text-left m-0 p-0" id="fecha"></p>
               </div>
               <div class="col-lg-6">
               <input type="hidden" id="texto" name="texto">
                <button class="btn bg-white ml-4" data-id="" id="btnEliminarPublicacion"><i class="fas fa-trash-alt"></i></button>
               </div>
            </div>
            </div>
            </section>
            <p class="text-left" id="desc"></p>
            <hr style="margin:0;padding:0;">
            <div class="row divIconos mt-2 ml-2">
                <div>
                  <span class="numLikes" id="iconoLikes">0</span>
                  <span class="likes"><i class="fas fa-heart" style="color: #5e72e4; font-size: 20px; margin-right: 10px;"></i></span>
              </div>
                <div>
                  <span class="numLikes" id="iconoComment">0</span>
                  <span class="likes"><i class="far fa-comment" style="font-size: 20px;"></i></span>
              </div>
            </div>
            ';
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
