<?php
session_start();
//si tipo==1, entonces es administrador, si es 3 es root, sino se vuelve a login
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3){
    include_once 'layouts/header.php';
    ?>

  <title>Adm | Gestão de cliente</title>

<?php include_once 'layouts/nav.php';?>

<!-- Modal -->
<div class="modal fade" id="crear-cliente" tabindex="-1" role="dialog" aria-labelledby="cambio-contrasena" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Novo cliente</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="alert alert-success text-center" id='add-prov' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Cliente adicionado</span>
          </div>
          <div class="alert alert-danger text-center" id='noadd-prov' style='display:none'>
              <span><i class="fas fa-times m-1"></i>O cliente já existe no sistema</span>
          </div>
          <form id="form-crear-cliente">
            <div class="form-group">
              <label for="nombre">Nome</label>
              <input id="nombre" type="text" class="input form-control" placeholder="Digite o nome" required>
            </div>
            <div class="form-group">
              <label for="apellidos">Sobrenome</label>
              <input id="apellidos" type="text" class="input form-control" placeholder="Digite o sobrenome" required>
            </div>
            <div class="form-group">
              <label for="dni">DNI</label>
              <input id="dni" type="number" class="input form-control" placeholder="Digite o dni">
            </div>
            <div class="form-group">
              <label for="edad">Data de nascimento</label>
              <input id="edad" type="date" class="input form-control" placeholder="Digite a data de nascimento" required>
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
              <label for="sexo">Sexo</label>
              <input id="sexo" type="text" class="input form-control" placeholder="Digite o sexo" required>
            </div>
            <div class="form-group">
              <label for="adicional">Adicional</label>
              <input id="adicional" type="text" class="input form-control" placeholder="Dados adicionais">
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

<div class="modal fade" id="editar-cliente" tabindex="-1" role="dialog" aria-labelledby="cambio-contrasena" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Editar cliente</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="alert alert-success text-center" id='edit' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Cliente editado corretamente</span>
          </div>
          <div class="alert alert-danger text-center" id='noedit' style='display:none'>
              <span><i class="fas fa-times m-1"></i>O cliente não pôde ser editado</span>
          </div>
          <form id="form-editar-cliente">
            <div class="form-group">
              <label for="telefono_edit">Telefone</label>
              <input id="telefono_edit" type="number" class="input form-control" placeholder="Digite o telefone" required>
            </div>
            <div class="form-group">
              <label for="correo_edit">Email</label>
              <input id="correo_edit" type="email" class="input form-control" placeholder="Digite o email">
            </div>
            <div class="form-group">
              <label for="adicional_edit">Adicional</label>
              <input id="adicional_edit" type="text" class="input form-control" placeholder="Dados adicionais">
            </div>
            <input type="hidden" id="id_edit_cliente">
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
            <h1>Gestão de cliente <button type="button" data-toggle="modal" data-target="#crear-cliente" class="btn bg-gradient-primary ml-2">Novo cliente</button></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestão de cliente</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section>
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Buscar cliente</h3>
                    <div class="input-group">
                        <input type="text" id="buscar-cliente" placeholder="Nome do cliente" class="form-control float-left">
                        <div class="input-group-append">
                            <button class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div id="clientes" class="row d-flex align-items-stretch">

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
<script src="../js/cliente.js"></script>