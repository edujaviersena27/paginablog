<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
   <strong>Copyright &copy; 2014-2019 <a href="#http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../js/demo.js"></script>
<!-- Sweetalert2 -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="../js/Desplegable.js"></script>
</body>
<script>
  let funcion='devolver_avatar';
  $.post('../controlador/UsuarioController.php',{funcion},(response) => {
    const avatar=JSON.parse(response);
    $('#avatar4').attr('src','../img/'+avatar.avatar);
  })

   funcion='tipo_usuario';
  $.post('../controlador/EntradaController.php',{funcion},(response) => {
    console.log(response);
    if(response==1){
      $('#gestion_usuario').hide();
    }
   
  });
</script>

</html>