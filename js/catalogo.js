$(document).ready(function(){
  $('#cat-carrito').show();
  buscar_producto();
  mostrar_lotes_riesgo();
  var datatable

  function buscar_producto(consulta) {
    funcion="buscar";
    $.post('../controlador/productoController.php', {funcion, consulta}, (response)=>{
      //console.log(response);
      const productos=JSON.parse(response);
      let template='';
      productos.forEach(producto => {
        template+=`
        <div prodId="${producto.id}" prodStock="${producto.stock}" prodNombre="${producto.nombre}" prodPrecio="${producto.precio}" prodConcentracion="${producto.concentracion}" prodAdicional="${producto.adicional}" prodLaboratorio="${producto.laboratorio_id}" prodTipo="${producto.tipo_id}" prodPresentacion="${producto.presentacion_id}" prodAvatar="${producto.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
      <div class="card bg-light d-flex flex-fill">
        <div class="card-header text-muted border-bottom-0">
        <i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock}
        </div>
        <div class="card-body pt-0">
          <div class="row">
            <div class="col-7">
            <h2 class="lead"><b>Código: ${producto.id}</b></h2>
              <h2 class="lead"><b>${producto.nombre}</b></h2>
              <h4 class="lead"><b><i class="fas fa-lg fa-brazilian-real-sign mr-1"></i>${producto.precio}</b></h4>
              <ul class="ml-4 mb-0 fa-ul text-muted">
                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span> Concentração: ${producto.concentracion}</li>
                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-prescription-bottle-alt"></i></span> Adicional: ${producto.adicional}</li>
                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-flask"></i></span> Laboratório: ${producto.laboratorio}</li>
                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span> Tipo: ${producto.tipo}</li>
                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-pills"></i></span> Apresentação: ${producto.presentacion}</li>
              </ul>
            </div>
            <div class="col-5 text-center">
              <img src="${producto.avatar}" alt="user-avatar" class="img-circle img-fluid">
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="text-right">
            <button class="agregar-carrito btn btn-sm btn-primary" title="Adicionar ao carrinho">
              <i class="fas fa-plus-square mr-2"></i>Adicionar ao carrinho
            </button>
          </div>
        </div>
      </div>
    </div>
        `;
      });
      $('#productos').html(template);
    });
  }

  $(document).on('keyup','#buscar-producto',function(){
    let valor = $(this).val();
    if(valor!=""){
      buscar_producto(valor);
    }else{
      buscar_producto();
    }
  });

  function mostrar_lotes_riesgo() {
    funcion="buscar_lotes_riesgo";
    $.post('../controlador/loteController.php', {funcion}, (response)=>{
      //console.log(response);
      const lotes=JSON.parse(response);
      datatable = $('#lotes').DataTable({
        data:lotes,
        columns: [
          { data: 'id' },
          { data: 'nome' },
          { data: 'Estoque' },
          { data: 'estado' },
          { data: 'laboratório' },
          { data: 'Apresentação' },
          { data: 'Fornecedor' },
          { data: 'mes' },
          { data: 'dia' }, 
          { data: 'hora' }          
        ],
        //para que en la columna de estado aparezcan los badges de colores
        columnDefs:[{
            "render":function(data,type,row){
              let campo='';
              if(row.estado=='danger'){
                campo=`<h1 class="badge badge-danger">${row.estado}</h1>`;
              }
              if(row.estado=='warning'){
                campo=`<h1 class="badge badge-warning">${row.estado}</h1>`;
              }
              return campo;
            },
            "targets":[3]
          }
        ],
        //destroy necesario para renovar la datatable
        'destroy': true,
        "language": espannol
        });
    })
  }
});

let espannol={
      "processing": "Procesando...",
      "lengthMenu": "Mostrar _MENU_ registros",
      "zeroRecords": "Nenhum resultado encontrado",
      "emptyTable": "Não há dados disponíveis nesta tabela",
      "infoEmpty": "Mostrando registros de 0 a 0 de um total de 0 registros",
      "infoFiltered": "(filtrado de un total de _MAX_ registros)",
      "search": "Buscar:",
      "infoThousands": ",",
      "loadingRecords": "Cargando...",
      "paginate": {
          "first": "Primero",
          "last": "Último",
          "next": "Seguinte",
          "previous": "Anterior"
      },
      "aria": {
          "sortAscending": ": Ative para classificar a coluna em ordem crescente",
          "sortDescending": ": Ative para classificar a coluna em ordem decrescente"
      },
      "buttons": {
          "copy": "Copiar",
          "colvis": "Visibilidade",
          "collection": "Coleção",
          "colvisRestore": "Restaurar visibilidade",
          "copyKeys": "Pressione ctrl ou u2318 + C para copiar os dados da tabela para a área de transferência do sistema. <br \/> <br \/> Para cancelar, clique nesta mensagem ou pressione Escape.",
          "copySuccess": {
              "1": "Copiou 1 linha para a área de transferência",
              "_": "%ds linha copiada para a área de transferência"
          },
          "copyTitle": "Copiar para a área de transferência",
          "csv": "CSV",
          "excel": "Excel",
          "pageLength": {
              "-1": "Mostrar todas as filas",
              "_": "Mostrar %d filas"
          },
          "pdf": "PDF",
          "print": "Imprimir",
          "renameState": "Alterar nome",
          "updateState": "Atualizar",
          "createState": "Criar Estado",
          "removeAllStates": "Remover Estados",
          "removeState": "Remover",
          "savedStates": "Estados Guardados",
          "stateRestore": "Estado %d"
      },
      "autoFill": {
          "cancel": "Cancelar",
          "fill": "Preencha todas as células com <i>%d<\/i>",
          "fillHorizontal": "Preencha as células horizontalmente",
          "fillVertical": "Preencha as células verticalmente"
      },
      "decimal": ",",
      "searchBuilder": {
          "add": "Adicionar condição",
          "button": {
              "0": "Construtor de pesquisa",
              "_": "Construtor de pesquisa (%d)"
          },
          "clearAll": "Excluir tudo",
          "condition": "Condição",
          "conditions": {
              "date": {
                  "after": "Depois",
                  "before": "Antes",
                  "between": "Entre",
                  "empty": "Vazio",
                  "equals": "Igual a",
                  "notBetween": "Não entre",
                  "notEmpty": "Não vazio",
                  "not": "Diferente de"
              },
              "number": {
                  "between": "Entre",
                  "empty": "Vazio",
                  "equals": "Igual a",
                  "gt": "Maior a",
                  "gte": "Maior ou igual a",
                  "lt": "Menor que",
                  "lte": "Menor o igual que",
                  "notBetween": "Não entre",
                  "notEmpty": "Não está vazio",
                  "not": "Diferente de"
              },
              "string": {
                  "contains": "Contém",
                  "empty": "Vazio",
                  "endsWith": "Termina em",
                  "equals": "Igual a",
                  "notEmpty": "Não vazio",
                  "startsWith": "Comece com",
                  "not": "Diferente de",
                  "notContains": "Não contém",
                  "notStartsWith": "Não começa com",
                  "notEndsWith": "Não termina com"
              },
              "array": {
                  "not": "Diferente de",
                  "equals": "Igual",
                  "empty": "Vazio",
                  "contains": "Contém",
                  "notEmpty": "Não vazio",
                  "without": "Sim"
              }
          },
          "data": "Data",
          "deleteTitle": "Eliminar regra de filtrado",
          "leftTitle": "Critérios anulados",
          "logicAnd": "Y",
          "logicOr": "O",
          "rightTitle": "Critérios de recuo",
          "title": {
              "0": "Construtor de pesquisa",
              "_": "Construtor de pesquisa (%d)"
          },
          "value": "Valor"
      },
      "searchPanes": {
          "clearMessage": "Excluir tudo",
          "collapse": {
              "0": "Painéis de pesquisa",
              "_": "Painéis de pesquisa (%d)"
          },
          "count": "{total}",
          "countFiltered": "{shown} ({total})",
          "emptyPanes": "Sem painéis de pesquisa",
          "loadMessage": "Carregando painéis de pesquisa",
          "title": "Filtros Ativos - %d",
          "showMessage": "Mostrar Tudo",
          "collapseMessage": "Recolher tudo"
      },
      "select": {
          "cells": {
              "1": "1 células selecionada",
              "_": "%d células selecionadas"
          },
          "columns": {
              "1": "1 coluna selecionada",
              "_": "%d colunas selecionadas"
          },
          "rows": {
              "1": "1 fila seleccionada",
              "_": "%d filas seleccionadas"
          }
      },
      "thousands": ".",
      "datetime": {
          "previous": "Anterior",
          "next": "Proximo",
          "hours": "Horas",
          "minutes": "Minutos",
          "seconds": "Segundos",
          "unknown": "-",
          "amPm": [
              "AM",
              "PM"
          ],
          "months": {
              "0": "Janeiro",
              "1": "Fevereiro",
              "10": "Novembro",
              "11": "Dezembro",
              "2": "Março",
              "3": "Abril",
              "4": "Maio",
              "5": "Junho",
              "6": "Julho",
              "7": "Agosto",
              "8": "Setembro",
              "9": "Outubro"
          },
          "weekdays": [
              "Dom",
              "Seg",
              "Ter",
              "Quar",
              "Quin",
              "Sex",
              "Sab"
          ]
      },
      "editor": {
          "close": "Cancelar",
          "create": {
              "button": "Novo",
              "title": "Criar novo registro",
              "submit": "Criar"
          },
          "edit": {
              "button": "Editar",
              "title": "Editar Registro",
              "submit": "Actualizar"
          },
          "remove": {
              "button": "Eliminar",
              "title": "Eliminar Registro",
              "submit": "Eliminar",
              "confirm": {
                  "_": "¿Está seguro que desea eliminar %d filas?",
                  "1": "¿Está seguro que desea eliminar 1 fila?"
              }
          },
          "error": {
              "system": "Ocorreu um erro no sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
          },
          "multi": {
              "title": "Múltiplos Valores",
              "info": "Os itens selecionados contêm valores diferentes para este registro. Para editar e definir todos os elementos deste registro com o mesmo valor, clique ou toque aqui, caso contrário eles manterão seus valores individuais.",
              "restore": "Desfazer alterações",
              "noMulti": "Este registro pode ser editado individualmente, mas não como parte de um grupo."
          }
      },
      "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
      "stateRestore": {
          "creationModal": {
              "button": "Criar",
              "name": "Nome:",
              "order": "Clasificação",
              "paging": "Paginação",
              "search": "Procurar",
              "select": "Selecionar",
              "columns": {
                  "search": "Pesquisa de coluna",
                  "visible": "Visibilidade de Coluna"
              },
              "title": "Criar novo estado",
              "toggleLabel": "Incluir:"
          },
          "emptyError": "O nome não pode ficar vazio",
          "removeConfirm": "Tem certeza de que deseja excluir este %s?",
          "removeError": "Erro ao excluir registro",
          "removeJoiner": "y",
          "removeSubmit": "Eliminar",
          "renameButton": "Alterar nome",
          "renameLabel": "Novo nome para %s",
          "duplicateError": "Já existe um Estado com este nome.",
          "emptyStates": "Não há estados salvos",
          "removeTitle": "Remover Estado",
          "renameTitle": "Alterar estado do nome"
      }
  }