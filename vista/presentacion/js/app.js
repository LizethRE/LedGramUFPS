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

  function IngresoGoogle(){
  	if(!firebase.auth().currentUser){
  		var provider = new firebase.auth.GoogleAuthProvider();

  		provider.addScope('https://www.googleapis.com/auth/plus.login');
  		firebase.auth().signInWithPopup(provider).then(function(result){

  			var token = result.credential.accessToken;
  			var user = result.user;
  			var name = result.user.displayName;
  			var correo = result.user.email;
  			var foto = result.user.photoURL;
  			var red = 'Google';
  			location.href = 'index.php?name=' + name;

  	}).catch(function(error){
  		var errorCode = error.code;
  		if(errorCode === 'auth/account-exist-with-diferent-credential'){
  			alert('El usuario ya existe');
  		}
  	});
  }else{
  	firebase.auth().signOut();
  }
}

  document.getElementById('btn-Google').addEventListener('click', IngresoGoogle, false);