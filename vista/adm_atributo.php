<?php
session_start();
//si tipo==1, entonces es administrador, si tipo==3 es root, sino se vuelve a login
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3){
    include_once 'layouts/header.php';
    ?>

  <title>Adm | Atributo</title>

<?php include_once 'layouts/nav.php';?>

<!-- modals -->
<div class="modal fade" id="cambiar-logo-lab" tabindex="-1" role="dialog" aria-labelledby="cambio-contrasena" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cambiar-logo-lab">Alterar logotipo do laboratório</h5>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <img id="logoactual" src="../img/avatar2.jpg" alt="imagen-perfil" class="profile-user-image img-fluid img-circle">
        </div>
        <div class="text-center">
            <b id="nombre_logo"></b>
        </div>
        <div class="alert alert-success text-center" id='edit' style='display:none'>
            <span><i class="fas fa-check m-1"></i>Logotipo alterado</span>
        </div>
        <div class="alert alert-danger text-center" id='noedit' style='display:none'>
            <span><i class="fas fa-times m-1"></i>Não foi possível alterar o logotipo, arquivo não suportado</span>
        </div>
        <form id="form-logo-lab" enctype="multipart/form-data">
            <div class="input-group mb-3 ml-3 mt-2">
                <input type="file" name="avatar" class="input-group">
                <input type="hidden" name="funcion" id="funcion">
                <input type="hidden" name="id_logo_lab" id="id_logo_lab">
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

<div class="modal fade" id="crearLaboratorio" tabindex="-1" role="dialog" aria-labelledby="cambio-contrasena" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Criar laboratorio</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="alert alert-success text-center" id='add-laboratorio' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Laboratório adicionado</span>
          </div>
          <div class="alert alert-danger text-center" id='noadd-laboratorio' style='display:none'>
              <span><i class="fas fa-times m-1"></i>O laboratório já existe no sistema</span>
          </div>
          <div class="alert alert-success text-center" id='edit-laboratorio' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Laboratório editado</span>
          </div>
          <form id="form-crear-laboratorio">
            <div class="form-group">
              <label for="nombre-laboratorio">Nome</label>
              <input id="nombre-laboratorio" type="text" class="input form-control" placeholder="Digite o nome do laboratório" required>
              <input type="hidden" id="id_editar_lab">
            </div>
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

<div class="modal fade" id="crearTipo" tabindex="-1" role="dialog" aria-labelledby="cambio-contrasena" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Criar tipo</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
        <div class="alert alert-success text-center" id='add-tipo' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Tipo adicionado</span>
          </div>
          <div class="alert alert-danger text-center" id='noadd-tipo' style='display:none'>
              <span><i class="fas fa-times m-1"></i>O tipo informado já existe no sistema</span>
          </div>
          <div class="alert alert-success text-center" id='edit-tipo' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Tipo editado</span>
          </div>
          <form id="form-crear-tipo">
            <div class="form-group">
              <label for="nombre-tipo">Tipo</label>
              <input id="nombre-tipo" type="text" class="input form-control" placeholder="Digite o nome" required>
              <input type="hidden" id="id_editar_tipo">
            </div>
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

<div class="modal fade" id="crearPresentacion" tabindex="-1" role="dialog" aria-labelledby="cambio-contrasena" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Criar apresentação</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="alert alert-success text-center" id='add-pre' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Apresentação adicionada</span>
          </div>
          <div class="alert alert-danger text-center" id='noadd-pre' style='display:none'>
              <span><i class="fas fa-times m-1"></i>A apresentação já existe no sistema</span>
          </div>
          <div class="alert alert-success text-center" id='edit-pre' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Apresentação editada</span>
          </div>
          <form id="form-crear-presentacion">
            <div class="form-group">
              <label for="nombre-presentacion">Apresentação</label>
              <input id="nombre-presentacion" type="text" class="input form-control" placeholder="Digite o nome" required>
              <input type="hidden" id="id_editar_pre">
            </div>
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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestão de atributos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gestão de atributos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <!-- nav-pills para usar tabs/pestañas-->
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a href="#laboratorio" class="nav-link active" data-toggle="tab">Laboratório</a></li>
                            <li class="nav-item"><a href="#tipo" class="nav-link" data-toggle="tab">Tipo</a></li>
                            <li class="nav-item"><a href="#presentacion" class="nav-link" data-toggle="tab">Apresentação</a></li>
                        </ul>
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-content">
                            <div class="tab-pane active" id='laboratorio'>
                                <div class="card card-success">
                                    <div class="card-header">
                                        <div class="card-title">Busca laboratorio <button type="button" data-toggle="modal" data-target="#crearLaboratorio" class="btn bg-gradient-primary btn-sm m-2">Criar laboratorio</button></div>
                                        <div class="input-group">
                                            <input id="buscar-laboratorio" type="text" class="form-control float-left" placeholder="Digite o nome do laboratório">
                                            <div class="input-group-append">
                                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0 table-responsive">
                                      <table class="table table-hover text-nowrap">
                                        <thread class="table-success">
                                          <tr>
                                            <th>Ação</th>
                                            <th>Logo</th>
                                            <th>Laboratório</th>
                                          </tr>
                                        </thread>
                                        <tbody class="table-active" id="laboratorios">

                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="card-footer">

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane"  id='tipo'>
                                <div class="card card-success">
                                    <div class="card-header">
                                        <div class="card-title">Busca tipo<button type="button" data-toggle="modal" data-target="#crearTipo"class="btn bg-gradient-primary btn-sm m-2">Criar tipo</button></div>
                                        <div class="input-group">
                                            <input id="buscar-tipo" type="text" class="form-control float-left" placeholder="Digite o nome do laboratório">
                                            <div class="input-group-append">
                                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0 table-responsive">
                                      <table class="table table-hover text-nowrap">
                                        <thread class="table-success">
                                          <tr>
                                            <th>Ação</th>
                                            <th>Tipos</th>
                                          </tr>
                                        </thread>
                                        <tbody class="table-active" id="tipos">
                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="card-footer">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane"  id='presentacion'>
                                <div class="card card-success">
                                    <div class="card-header">
                                        <div class="card-title">Busca apresentação<button type="button" data-toggle="modal" data-target="#crearPresentacion"class="btn bg-gradient-primary btn-sm m-2">Criar apresentação</button></div>
                                        <div class="input-group">
                                            <input id="buscar-presentacion" type="text" class="form-control float-left" placeholder="Digite o nome da apresentação">
                                            <div class="input-group-append">
                                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0 table-responsive">
                                      <table class="table table-hover text-nowrap">
                                        <thread class="table-success">
                                          <tr>
                                            <th>Ação</th>
                                            <th>Apresentação</th>
                                          </tr>
                                        </thread>
                                        <tbody class="table-active" id="presentaciones">
                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="card-footer">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
include_once 'layouts/footer.php';
}
else{
    header('Location: ../index.php');
}
?>

<script src="../js/laboratorio.js"></script>
<script src="../js/tipo.js"></script>
<script src="../js/presentacion.js"></script>