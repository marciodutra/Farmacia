<?php
session_start();
//si tipo==1, entonces es administrador, sino se vuelve a login
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==2||$_SESSION['us_tipo']==3){
    include_once 'layouts/header.php';
    ?>

  <title>Adm | Editar dados</title>

<?php include_once 'layouts/nav.php';?>

<!-- Modal -->
<div class="animate__animated animate__fadeIn modal fade" id="cambio-contrasena" tabindex="-1" role="dialog" aria-labelledby="cambio-contrasena" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cambio-contrasena">Alterar a senha</h5>
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
        <div class="alert alert-success text-center" id='update' style='display:none'>
            <span><i class="fas fa-check m-1"></i>Senha alterada</span>
        </div>
        <div class="alert alert-danger text-center" id='noupdate' style='display:none'>
            <span><i class="fas fa-times m-1"></i>A senha não está correta</span>
        </div>
        <form id="form-pass">
            <div class="input-group mb-3">
                <div class="input-grup-prepend">
                    <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                </div>
                <input type="password" name="" id="oldpass" class="form-control" placeholder="Digite a senha antiga">
            </div>
            <div class="input-group mb-3">
                <div class="input-grup-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                </div>
                <input type="text" name="" id="newpass" class="form-control" placeholder="Digite a nova senha">
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

<div class="modal fade" id="cambio-avatar" tabindex="-1" role="dialog" aria-labelledby="cambio-contrasena" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cambio-avatar">Alterar avatar</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
            <img id="avatar-modal-avatar" src="../img/avatar2.jpg" alt="imagen-perfil" class="profile-user-image img-fluid img-circle">
        </div>
        <div class="text-center">
            <b><?php echo $_SESSION['nombre_us']; ?></b>
        </div>
        <div class="alert alert-success text-center" id='edit' style='display:none'>
            <span><i class="fas fa-check m-1"></i>Avatar alterado</span>
        </div>
        <div class="alert alert-danger text-center" id='noedit' style='display:none'>
            <span><i class="fas fa-times m-1"></i>Não foi possível alterar o avatar, arquivo não suportado</span>
        </div>
        <form id="form-avatar" enctype="multipart/form-data">
            <div class="input-group mb-3 ml-3 mt-2">
                <input type="file" name="avatar" class="input-group">
                <input type="hidden" name="funcion" value="cambiar_avatar">
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
            <h1>Dados pessoais</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../vista/adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Dados pessoais</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-success card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img id="avatar-content" src="../img/avatar1.jpg" class="profile-user-img img-fluid img-circle" alt="">
                                </div>
                                <div class="text-center mt-1">
                                    <button type="button" data-toggle="modal" data-target="#cambio-avatar" class="btn btn-primary btn-sm">Alterar avatar</button>
                                </div>
                                <input id="id_usuario" type="hidden" value="<?php echo $_SESSION['usuario']?>">
                                <h3 id="nombre_us" class="profile-username text-center text-success">Nome</h3>
                                    <p id="apellidos_us" class="text-muted text-center">Sobrenome</p>
                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item"><b style="color:#0B7300">Idade</b><a id="edad" class="float-right">25</a>
                                        </li>
                                        <li class="list-group-item"><b style="color:#0B7300">DNI</b><a id="dni_us" class="float-right">25</a>
                                        </li>
                                        <li class="list-group-item"><b style="color:#0B7300">Tipo usuário</b>
                                            <span id="us_tipo" class="float-right">Administrador</span>    
                                        </li>
                                        <button data-toggle="modal" data-target="#cambio-contrasena" type="button" class="btn btn-block btn-outline-warning btn-sm">Alterar a senha</button>
                                    </ul>
                            </div>
                        </div>
                        <div class="card card-success">
                            <div class="card-header">
                                <div class="card-title">Dados pessoais</div>
                            </div>
                            <div class="card-body">
                                <strong>
                                    <i class="fas fa-phone mr-1"></i>Telefone
                                </strong>
                                <p id="telefono_us" class="text-muted">51994690210</p>
                                <strong>
                                    <i class="fas fa-map-marker-alt mr-1"></i>Residência
                                </strong>
                                <p id="residencia_us" class="text-muted">123456789</p>
                                <strong>
                                    <i class="fas fa-at mr-1"></i>Email
                                </strong>
                                <p id="correo_us" class="text-muted">i12sarof@gmail.com</p>
                                <strong>
                                    <i class="fas fa-smile-wink mr-1"></i>Sexo
                                </strong>
                                <p id="sexo_us" class="text-muted">123456789</p>
                                <strong>
                                    <i class="fas fa-pencil-alt mr-1"></i>Informação adicional
                                </strong>
                                <p id="adicional_us" class="text-muted">123456789</p>
                                <button class="edit btn btn-block bg-gradient-danger">Editar</button>
                            </div>
                            <div class="card-footer">
                                <p class="text-muted">Click para editar</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card card-success">
                        <div class="card-header">
                                <div class="card-title">Editar dados pessoais</div>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-success text-center" id='editado' style='display:none'>
                                    <span><i class="fas fa-check m-1"></i>Editado</span>
                                </div>
                                <div class="alert alert-danger text-center" id='no-editado' style='display:none'>
                                    <span><i class="fas fa-times m-1"></i>Edição desabilitada</span>
                                </div>
                                <form id="form-usuario" class="form-horizontal " action="">
                                    <div class="form-group row">
                                        <label for="telefono" class="col-sm-2 col-form-label">Telefone</label>
                                        <div class="col-sm-10">
                                        <input type="number" id="telefono" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="residencia" class="col-sm-2 col-form-label">Residência</label>
                                        <div class="col-sm-10">
                                        <input type="text" id="residencia" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="correo" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                        <input type="text" id="correo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="sexo" class="col-sm-2 col-form-label">Sexo</label>
                                        <div class="col-sm-10">
                                        <input type="text" id="sexo" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="adicional" class="col-sm-2 col-form-label">Informações adicionais</label>
                                        <div class="col-sm-10">
                                        <textarea class="form-control" id="adicional" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10 float-right">
                                            <button class="btn btn-block btn-outline-success">Salvar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <p class="text-muted">Tenha cuidado ao inserir dados errados</p>
                            </div>
                        </div>
                    </div>
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
<script src="../js/usuario.js"></script>