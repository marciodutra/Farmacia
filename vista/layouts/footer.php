<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://meuportifolioangular.netlify.app/">Márcio Dutra</a>.</strong> All rights reserved.
  </footer>

  <!-- /.control-sidebar -->
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
<!-- swertalert2 -->
<script src="../js/sweetalert2.js"></script>
<!-- select2 -->
<script src="../js/select2.js"></script>
<!-- datatables -->
<script src="../js/datatables.js"></script>
</body>
<script>
  let funcion='mostrar_avatar';
  $.post('../controlador/usuarioController.php', {funcion}, (response)=>{
    const avatar=JSON.parse(response);
    $('#avatar-nav').attr('src','../img/'+avatar.avatar);
  });

  funcion='tipo_usuario';
  $.post('../controlador/usuarioController.php', {funcion}, (response)=>{
    if(response==1){//administrador
      $('#gestion_lote').hide();
    }
    if(response==2){//tecnico
      $('#gestion_lote').hide();
      $('#gestion_usuario').hide();
      $('#gestion_producto').hide();
      $('#gestion_atributo').hide();
      $('#gestion_proveedor').hide();
    }
  });
</script>
</html>