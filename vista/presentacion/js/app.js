
// Initialize Firebase
var config = {
  apiKey: "AIzaSyAYTTgyJVBiKuac3o3bB90PL5ujFrCmZVA",
  authDomain: "ledgram-386da.firebaseapp.com",
  databaseURL: "https://ledgram-386da.firebaseio.com",
  projectId: "ledgram-386da",
  storageBucket: "ledgram-386da.appspot.com",
  messagingSenderId: "350942783534"
};
firebase.initializeApp(config);

function IngresoGoogle() {
  if (!firebase.auth().currentUser) {
    var provider = new firebase.auth.GoogleAuthProvider();

    provider.addScope('https://www.googleapis.com/auth/plus.login');
    firebase.auth().signInWithPopup(provider).then(function (result) {

      var user = result.user;
      var name = result.user.displayName;
      var correo = result.user.email;
      var foto = result.user.photoURL;


      if (correo.indexOf('@ufps.edu.co') > -1) {
        user = correo.split('@')[0];
        var datos = {
          nombreGoogle: name,
          correoGoogle: correo,
          fotoGoogle: foto,
          usuarioGoogle: user
        };

        $.ajax({
          url: 'vista/modulos/Ajax.php',
          method: 'POST',
          data: datos,
          dataType: 'JSON',

          success: function (respuesta) {
            if (respuesta["exito"]) {
              ingresoExitoso("Bienvenido", " Ha Iniciado Sesión con Google");
            } else if (!respuesta["exito"]) {
              respuestaError("Error", "No se pudo Iniciar la Sesión");
            }
          },
          error: function (jqXHR, estado, error) {
            console.log(estado);
            console.log(error);
            console.log(jqXHR);
          }
        });


      } else {
        location.href = 'error';
        return;
      }

    }).catch(function (error) {
      var errorCode = error.code;
      if (errorCode === 'auth/account-exist-with-diferent-credential') {
        alert('El usuario ya existe');
      }
    });
  } else {
    firebase.auth().signOut();
  }
}

document.getElementById('btn-Google').addEventListener('click', IngresoGoogle, false);