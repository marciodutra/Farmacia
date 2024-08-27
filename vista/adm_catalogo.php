<?php
session_start();
//si tipo==1, entonces es administrador, si tipo==3 es root, sino se vuelve a login
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3||$_SESSION['us_tipo']==2){
    include_once 'layouts/header.php';
    ?>

  <title>Adm | Catálogo</title>

<?php include_once 'layouts/nav.php';?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Catálogo</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Catálogo</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section>
      <div class="container-fluid">
        <div class="card card-danger">
          <div class="card-header">
              <h3 class="card-title">Lotes em risco</h3>
          </div>
          <div class="card-body p-0 table-responsive">
            <table id="lotes" class="animate__animated animate__fadeIn table table-hover text-nowrap">
              <thead class="table-danger">
                <tr>
                  <th>Código</th>
                  <th>Produto</th>
                  <th>Estoque</th>
                  <th>Estado</th>
                  <th>Laboratório</th>
                  <th>Apresentação</th>
                  <th>Fornecedor</th>
                  <th>Mês</th>
                  <th>Dias</th>
                  <th>Hora</th>
                </tr>
              </thead>
              <tbody class="table-active">

              </tbody>
            </table>
          </div>
          <div class="card-footer">

          </div>
        </div>
      </div>
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

<script src="../js/catalogo.js"></script>
<script src="../js/carrito.js"></script>