<?php
session_start();
//solo se permite a esta seccion al usuario root --> 3, sino se vuelve a login
if($_SESSION['us_tipo']==3){
    include_once 'layouts/header.php';
    ?>

  <title>Adm | Gestão de compras</title>

<?php include_once 'layouts/nav.php';?>

<!-- Modal -->
<div class="modal fade" id="vistaCompra" tabindex="-1" role="dialog" aria-labelledby="vistaCompra" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Detalhe da compra</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="codigo_compra">Código da compra: </label>
            <span id="codigo_compra"></span>
          </div>
          <div class="form-group">
            <label for="fecha_compra">Data da compra: </label>
            <span id="fecha_compra"></span>
          </div>
          <div class="form-group">
            <label for="fecha_entrega">Data da entrega: </label>
            <span id="fecha_entrega"></span>
          </div>
          <div class="form-group">
            <label for="estado_compra_vista">Estado: </label>
            <span id="estado_compra_vista"></span>
          </div>
          <div class="form-group">
            <label for="proveedor">Fornecedor: </label>
            <span id="proveedor"></span>
          </div>
          <table class="table table-hover text-nowrap table-responsive">
            <thead class="table-success">
              <tr>
                <th>0</th>
                <th>Código</th>
                <th>Quantidade</th>
                <th>Vencimento</th>
                <th>Preço</th>
                <th>Produto</th>
                <th>Laboratório</th>
                <th>Apresentação</th>
                <th>Tipo</th>
              </tr>
            </thead>
            <tbody class="table-warning" id="detalles">

            </tbody>
          </table>
            <div class="float-right input-group-append">
              <h3 class="m-3">Total:</h3>
              <h3 class="m-3" id="total"></h3>
            </div>
        </div>
        <div class="card-footer">
          <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-1">Cancelar</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="cambiar-estado" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Alterar status</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="alert alert-danger text-center" id='noedit' style='display:none'>
              <span><i class="fas fa-times m-1"></i>Não foi possível editar</span>
          </div>
          <div class="alert alert-success text-center" id='edit' style='display:none'>
              <span><i class="fas fa-check m-1"></i>Status alterado</span>
          </div>
          <form id="form-editar">
            <div class="form-group">
              <label for="estado_compra">Status</label>
              <select name="estado_compra" id="estado_compra" class="form-control select2" style="width: 100%"></select>
              <input type="hidden" id="id_compra">
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
            <h1>Gestão de compras <a href="adm_nueva_compra.php" class="btn bg-gradient-primary ml-2">Nova compra</a></h1>
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestão de compras</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section>
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Buscar lote</h3>
                    <div class="input-group">
                        <input type="text" id="buscar-lote" placeholder="Nome do produto"class="form-control float-left">
                        <div class="input-group-append">
                            <button class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                  <table id="compras" class="table table-dark table-hover">
                    <thead>
                      <tr>
                        <th>0</th>
                        <th>ID | Código</th>
                        <th>Data da compra</th>
                        <th>Data da entrega</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Fornecedor</th>
                        <th>Opções</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
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
<script src="../js/compras.js"></script>