<?php
session_start();
//si tipo==1, entonces es administrador, si es 3 es root, sino se vuelve a login
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3){
    include_once 'layouts/header.php';
    ?>

  <title>Adm | Editar dados</title>

<?php include_once 'layouts/nav.php';?>

<div class="modal fade" id="confirmar" tabindex="-1" role="dialog" aria-labelledby="cambio-contrasena" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cambio-contrasena">Confirmar ação</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <img id="avatar-modal-pass" src="../img/avatar2.jpg" alt="imagen-perfil" class="profile-user-image img-fluid img-circle">
        </div>
        <div class="text-center">
            <b><?php echo $_SESSION['nombre_us']; ?></b>
        </div>
        <span>Digite a senha para continuar</span>
        <div class="alert alert-success text-center" id='confirmado' style='display:none'>
            <span><i class="fas fa-check m-1"></i>Usuário modificado</span>
        </div>
        <div class="alert alert-danger text-center" id='rechazado' style='display:none'>
            <span><i class="fas fa-times m-1"></i>Senha incorreta</span>
        </div>
        <form id="form-confirmar">
            <div class="input-group mb-3">
                <div class="input-grup-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input type="password" id="pass" class="form-control" placeholder="Digite a nova senha">
                <input type="hidden" id="id_user">
                <input type="hidden" id="funcion">
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

<!-- Modal -->
<div class="modal fade" id="crear-usuario" tabindex="-1" role="dialog" aria-labelledby="cambio-contrasena" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Criar usuário</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="alert alert-success text-center" id='add' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Usuário adicionado</span>
          </div>
          <div class="alert alert-danger text-center" id='noadd' style='display:none'>
              <span><i class="fas fa-times m-1"></i>O DNI já existe no sistema</span>
          </div>
          <form id="form-crear-usuario">
            <div class="form-group">
              <label for="nombre">Nome</label>
              <input id="nombre" type="text" class="input form-control" placeholder="Digite o nome" required>
            </div>
            <div class="form-group">
              <label for="apellidos">Sobrenome</label>
              <input id="apellidos" type="text" class="input form-control" placeholder="Digite o sobrenome" required>
            </div>
            <div class="form-group">
              <label for="edad">Nascimento</label>
              <input id="edad" type="date" class="input form-control" placeholder="Digite a data de nascimento" required>
            </div>
            <div class="form-group">
              <label for="dni">DNI</label>
              <input id="dni" type="text" class="input form-control" placeholder="Digite o dni" required>
            </div>
            <div class="form-group">
              <label for="pass">Senha</label>
              <input id="pass" type="password" class="input form-control" placeholder="Digite a senha" required>
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
            <h1>Gestão de usuários <button id="button-crear-usuario" type="button" data-toggle="modal" data-target="#crear-usuario" class="btn bg-gradient-primary ml-2">Criar usuário</button></h1>
            <input type="hidden" id="tipo_usuario" value="<?php echo $_SESSION['us_tipo'];?>">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestão de usuário</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section>
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Buscar usuário</h3>
                    <div class="input-group">
                        <input type="text" id="buscar" placeholder="Nombre de usuario"class="form-control float-left">
                        <div class="input-group-append">
                            <button class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div id="usuarios" class="row d-flex align-items-stretch">

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
<script src="../js/gestion_usuario.js"></script>