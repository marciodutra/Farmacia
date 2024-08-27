<?php
session_start();
//solo se permite a esta seccion al usuario root --> 3, y al daministrador -->1 sino se vuelve a login
if($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==2||$_SESSION['us_tipo']==3){
    include_once 'layouts/header.php';
    ?>

  <title>Adm | Gestão de vendas</title>

<?php include_once 'layouts/nav.php';?>

<!-- Modal -->
<div class="modal fade" id="vista-venta" tabindex="-1" role="dialog" aria-labelledby="vista-venta" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Registros de venda</h3>
          <button data-dismiss="modal" aria-label="close" class="close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="codigo_venta">Código venda: </label>
            <span id="codigo_venta"></span>
          </div>
          <div class="form-group">
            <label for="fecha_venta">Data: </label>
            <span id="fecha_venta"></span>
          </div>
          <div class="form-group">
            <label for="cliente_venta">Cliente: </label>
            <span id="cliente_venta"></span>
          </div>
          <div class="form-group">
            <label for="dni_cliente_venta">Dni: </label>
            <span id="dni_cliente_venta"></span>
          </div>
          <div class="form-group">
            <label for="vendedor_venta">Vendedor: </label>
            <span id="vendedor_venta"></span>
          </div>
          <table class="table table-hover text-nowrap">
            <thead class="table-success">
              <tr>
                <th>Quantidade</th>
                <th>Preço</th>
                <th>Produto</th>
                <th>concentração</th>
                <th>Adicional</th>
                <th>Laboratório</th>
                <th>Apresentação</th>
                <th>Tipo</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody class="table-warning" id="registros">

            </tbody>
          </table>
            <div class="float-right input-group-append">
              <h3 class="m-3">Total:</h3>
              <h3 class="m-3" id="total_venta"></h3>
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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Gestão de vendas
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="adm_catalogo.php">Home</a></li>
              <li class="breadcrumb-item active">Gestão de vendas</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section>
      <div class="container-fluid">
        <div class="card card-success">
          <div class="card-header">
              <h3 class="card-title">Consultas</h3>
              
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3 id="venta_dia_vendedor">0</h3>

                    <p>Promoção do Dia do Vendedor</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user"></i>
                  </div>
                  <a href="#" class="small-box-footer">Mais info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3 id="venta_diaria">0</h3>

                    <p>Venda diária</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-shopping-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">Mais info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3 id="venta_mensual">0</h3>

                    <p>Venda mensal</p>
                  </div>
                  <div class="icon">
                    <i class="far fa-calendar-alt"></i>
                  </div>
                  <a href="#" class="small-box-footer">Mais info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3 id="venta_anual">0</h3>

                    <p>Venda anual</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-signal"></i>
                  </div>
                  <a href="#" class="small-box-footer">Mais info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h3 id="ganancia_mensual">0</h3>

                    <p>Lucro mensal</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                  </div>
                  <a href="#" class="small-box-footer">Mais info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
            </div>
        
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
              <h3 class="card-title">Buscar vendas</h3>
              
          </div>
          <div class="card-body">
            <table id="tabla-venta" class="display table table-hover text-nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>Código</th>
                  <th>Data</th>
                  <th>Cliente</th>
                  <th>Dni</th>
                  <th>Total</th>
                  <th>Vendedor</th>
                  <th>Ações</th>
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
<script src="../js/venta.js"></script>