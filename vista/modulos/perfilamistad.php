<?php
if (!isset($_SESSION['Usuario'])) {
    header("location:Inicio");
}
$id = htmlentities($_GET['id']);
include_once 'modelo/DTO/UsuarioDTO.php';
$user = unserialize($_SESSION["Usuario"]);
if (strcmp($user->getId(), $id) === 0) {
    header("location:Perfil");
} else {
    echo '<input type="hidden" id="idUsuarioMostrar" value="' . $id . '">
    ';
}
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
                                <img src="" id="mostrarFoto" alt="error al cargar foto" class="rounded-circle fotoPerfilUsuario">
                            </div>
                        </div>
                        <div class="col-lg-4 order-lg-3 text-lg-right align-self-lg-center">
                            <button class="btn btn-primary" data-id="seguir" id="btnSeguir">Seguir</button>
                        </div>
                        <div class="col-lg-4 order-lg-1">
                            <div class="card-profile-stats d-flex justify-content-center">
                                <div>
                                    <span class="heading" id="publicacionesAmistad"></span>
                                    <span class="description">Publicaciones</span>
                                </div>
                                <div data-toggle="modal" data-target="#modalSeguidosAmistad" id="btnSeguidoresAmistad" style="cursor: pointer;">
                                    <span class="heading" id="seguidoresAmistad"></span>
                                    <span class="description">Seguidores</span>
                                </div>
                                <div data-toggle="modal" data-target="#modalSeguidosAmistad" id="btnSeguidosAmistad" style="cursor: pointer;">
                                    <span class="heading" id="seguidosAmistad"></span>
                                    <span class="description">Seguidos</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade bd-example-modal-sm" id="modalSeguidosAmistad" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content" id="mostrarSeguidosAmistad">
                                
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-5">
                        <section>
                            <h5 id="mostrarUsuario"></h5>
                            <p><b id="mostrarNombre"></b></p>
                            <p><b id="mostrarCorreo"></b></p>
                            <br>
                            <p id="mostrarDescripcion"></p>
                        </section>
                    </div>

                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="fas fa-images mr-2"></i>Publicaciones</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active row" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                    <div style="text-align: center;">
                                        <div class="container mt-2">
                                            <div class="row" id="cargarPublicacionesAmistad">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div id="modalpublicacionamistad" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="row">
          <div class="col-lg-8">
               <img id="fotopublicacionamistad" src="" class="card-img-top m-0 p-0 w-100" alt="..." >
          </div>
          <div class="col-lg-4">
            <?php
            echo '
            <section class="row mt-4 mb-4">
            <div class="col-lg-2 p-0"><img width=40 height=40 src="" id="mostrarFotoModal" alt="error al cargar foto" class="rounded-circle mr-2 fotoPerfilUsuario"></div>
            <div class="col-lg-10">
            <div class="row">
               <div class="col-lg-6"> 
            <h6 id="mostrarUsuarioModal"></h6>
            <p class="text-left m-0 p-0" id="fechaamistad"></p>
               </div>
               <div class="col-lg-6">
               <input type="hidden" id="textoamistad" name="textoamistad">
                <button class="btn bg-white ml-4" data-id="" id="megusta"><i class="fas fa-heart"></i></button>
               </div> 
            </div>
            </div>
            </section>
            <p class="text-left" id="descamistad"></p>
            <hr style="margin:0;padding:0;">';
            ?>
          </div>
      </div>
    </div>
  </div>
</div>
        
    </section>
</main>