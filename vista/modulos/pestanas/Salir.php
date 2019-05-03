<script>
 firebase.auth().signOut();
</script>
<?php
if(isset($_SESSION["Usuario"])){
    session_destroy();
    header("location:Inicio");
}
?>

