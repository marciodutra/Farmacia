<?php
session_start();
//si tipo==1, entonces es administrador, si es 3 es root, sino se vuelve a login
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3){
    include_once 'layouts/header.php';
    ?>

  <title>Adm | Gestão do produto</title>

<?php include_once 'layouts/nav.php';?>

<!-- Modal -->
<div class="modal fade" id="crear-producto" tabindex="-1" role="dialog" aria-labelledby="cambio-contrasena" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Criar produto</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="alert alert-success text-center" id='add' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Produto adicionado</span>
          </div>
          <div class="alert alert-danger text-center" id='noadd' style='display:none'>
              <span><i class="fas fa-times m-1"></i>O produto já existe no sistema</span>
          </div>
          <div class="alert alert-success text-center" id='edit' style='display:none'>
              <span><i class="fas fa-check m-1"></i>O produto foi editado</span>
          </div>
          <form id="form-crear-producto">
            <div class="form-group">
              <label for="nombre-producto">Nome</label>
              <input id="nombre-producto" type="text" class="input form-control" placeholder="Digite o nome" required>
            </div>
            <div class="form-group">
              <label for="concentracion">Concentração</label>
              <input id="concentracion" type="text" class="input form-control" placeholder="Digite a concentração">
            </div>
            <div class="form-group">
              <label for="adicional">Adicional</label>
              <input id="adicional" type="text" class="input form-control" placeholder="Digite a informação adicional">
            </div>
            <div class="form-group">
              <label for="precio">Preço</label>
              <input id="precio" type="number" step="any" class="input form-control" value='1' placeholder="Digite o preço" required>
            </div>
            <div class="form-group">
              <label for="laboratorio">Laboratório</label>
              <select name="laboratorio" id="laboratorio" class="form-control select2" style="width: 100%"></select>
            </div>
            <div class="form-group">
              <label for="tipo">Tipo</label>
              <select name="tipo" id="tipo" class="form-control select2" style="width: 100%"></select>
            </div>
            <div class="form-group">
              <label for="presentacion">Apresentação</label>
              <select name="presentacion" id="presentacion" class="form-control select2" style="width: 100%"></select>
            </div>
            <input type="hidden" id="id_edit_prod">
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

<div class="modal fade" id="cambiar-logo-prod" tabindex="-1" role="dialog" aria-labelledby="alterar a senha" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cambiar-logo-lab">Alterar logotipo do produto</h5>
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
        <form id="form-logo-prod" enctype="multipart/form-data">
            <div class="input-group mb-3 ml-3 mt-2">
                <input type="file" name="avatar" class="input-group">
                <input type="hidden" name="funcion" id="funcion">
                <input type="hidden" name="id_logo_prod" id="id_logo_prod">
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

<div class="modal fade" id="crear-reporte-pdf" tabindex="-1" role="dialog" aria-labelledby="cambio-contrasena" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Escolha o formato do relatório</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="form-group text-center">
            <button id="button-reporte-productos" class="btn btn-outline-danger">Formato PDF <i class="far fa-file-pdf ml-2"></i></button>
            <button class="btn btn-outline-success">Formato EXCEL <i class="far fa-file-excel ml-2"></i></button>
          </div>
        </div>
        <div class="card-footer">
          
        </div>
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
          <div class="col-sm-8">
            <h1>Gestão do produto <button id="button-crear-producto" type="button" data-toggle="modal" data-target="#crear-producto" class="btn bg-gradient-primary ml-2">Criar produto</button> <button type="button" data-toggle="modal" data-target="#crear-reporte-pdf" class="btn bg-gradient-success ml-2">Relatório de produtos</button></h1>
            
          </div>
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestão de produto</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section>
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Buscar produto</h3>
                    <div class="input-group">
                        <input type="text" id="buscar-producto" placeholder="Nome do produto"class="form-control float-left">
                        <div class="input-group-append">
                            <button class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div id="productos" class="row d-flex align-items-stretch">

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
<script src="../js/producto.js"></script>