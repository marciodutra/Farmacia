<?php
session_start();
//si tipo==1, entonces es administrador, si es 3 es root, sino se vuelve a login
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3){
    include_once 'layouts/header.php';
    ?>

  <title>Adm | Fornecedor</title>

<?php include_once 'layouts/nav.php';?>

<!-- Modal -->
<div class="modal fade" id="crear-proveedor" tabindex="-1" role="dialog" aria-labelledby="cambio-contrasena" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Criar fornecedor</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="alert alert-success text-center" id='add-prov' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Fornecedor adicionado</span>
          </div>
          <div class="alert alert-danger text-center" id='noadd-prov' style='display:none'>
              <span><i class="fas fa-times m-1"></i>O fornecedor já existe no sistema</span>
          </div>
          <div class="alert alert-success text-center" id='edit-prov' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Fornecedor editado</span>
          </div>
          <form id="form-crear-proveedor">
            <div class="form-group">
              <label for="nombre">Nome</label>
              <input id="nombre" type="text" class="input form-control" placeholder="Digite o nome" required>
            </div>
            <div class="form-group">
              <label for="telefono">Telefone</label>
              <input id="telefono" type="number" class="input form-control" placeholder="Digite o telefone" required>
            </div>
            <div class="form-group">
              <label for="correo">Email</label>
              <input id="correo" type="email" class="input form-control" placeholder="Digite o email">
            </div>
            <div class="form-group">
              <label for="direccion">Endereço</label>
              <input id="direccion" type="text" class="input form-control" placeholder="Digite o endereço" required>
            </div>
            <input type="hidden" id="id_edit_prov">
        </div>
        <div class="card-footer">
          <button type="submit" class="btn bg-gradient-primary float-right m-1">Salvar</button>
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cancelar</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="cambiar-logo-prov" tabindex="-1" role="dialog" aria-labelledby="cambio-contrasena" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cambiar-logo-lab">Alterar logotipo do fornecedor</h5>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <img id="logo-actual" src="../img/avatar2.jpg" alt="imagen-perfil" class="profile-user-image img-fluid img-circle">
        </div>
        <div class="text-center">
            <b id="nombre-logo"></b>
        </div>
        <div class="alert alert-success text-center" id='edit' style='display:none'>
            <span><i class="fas fa-check m-1"></i>Logotipo alterado</span>
        </div>
        <div class="alert alert-danger text-center" id='noedit' style='display:none'>
            <span><i class="fas fa-times m-1"></i>Não foi possível alterar o logotipo, arquivo não suportado</span>
        </div>
        <form id="form-logo-prov" enctype="multipart/form-data">
            <div class="input-group mb-3 ml-3 mt-2">
                <input type="file" name="avatar" class="input-group">
                <input type="hidden" name="funcion" id="funcion">
                <input type="hidden" name="id_logo_prov" id="id_logo_prov">
                <input type="hidden" name="avatar" id="avatar">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn bg-gradient-primary">Salvar</button>
        </form>
      </div>
    </div>
  </div>
</div>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestão de fornecedor <button type="button" data-toggle="modal" data-target="#crear-proveedor" class="btn bg-gradient-primary ml-2">Criar fornecedor</button></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestão de fornecedor</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section>
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Buscar fornecedor</h3>
                    <div class="input-group">
                        <input type="text" id="buscar-proveedor" placeholder="Nome do fornecedor" class="form-control float-left">
                        <div class="input-group-append">
                            <button class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div id="proveedores" class="row d-flex align-items-stretch">

                    </div>
                  </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

<?php
include_once 'layouts/footer.php';
}
else{
    header('Location: ../index.php');
}
?>
<script src="../js/proveedor.js"></script>