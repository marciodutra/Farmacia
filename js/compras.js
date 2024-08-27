$(document).ready(function() {
  $('.select2').select2();
  rellenar_estado_pago();
  mostrar_compras();
  var datatable;

  function rellenar_estado_pago(){
    funcion='rellenar_estado';
    $.post('../controlador/estadoController.php', {funcion}, (response)=>{
      let estados=JSON.parse(response);
      let template='';
      estados.forEach(estado=>{
        template+=`
        <option value="${estado.id}">${estado.nombre}</option>
        `;
      });
      $('#estado_compra').html(template);
    });
  }

  function mostrar_compras(){
    funcion='mostrar_compras';
    $.post('../controlador/comprasController.php', {funcion}, (response)=>{
      console.log(response);
      let datos=JSON.parse(response);
      //con datatables, el numero de columnas debe coincidir con el numero de columnas de la tabla, sino da error
      datatable = $('#compras').DataTable({
        data:datos,
        columns: [
          { data: 'numero' },
          { data: 'codigo' },
          { data: 'fecha_compra' },
          { data: 'fecha_entrega' },
          { data: 'total' },
          { data: 'estado' },
          { data: 'proveedor' },
          { "defaultContent": `<button class="btn btn-secondary" title="Imprimir"><i class="fas fa-print"></i></button>
          <button class="ver btn btn-info" title="Mostrar" type="button" data-toggle="modal" data-target="#vistaCompra"><i class="fas fa-search"></i></button>
          <button class="editar btn btn-success" title="Editar" type="button" data-toggle="modal" data-target="#cambiarEstado"><i class="fas fa-pencil-alt"></i></button>` }
        ],
        //destroy necesario para renovar la datatable
        'destroy': true,
        "language": espannol
        });
    });
  }

  $('#compras tbody').on('click', '.editar', function(){
    let datos = datatable.row($(this).parents()).data();
    let codigo = datos.codigo;
    codigo=codigo.split(' | ');
    let id=codigo[0];
    let estado=datos.estado;
    $('#id_compra').val(id);
    funcion='cambiar_estado';
    $.post('../controlador/estadoController.php', {funcion, estado}, (response)=>{
      let id_estado=JSON.parse(response);
      $('#estado_compra').val(id_estado[0]['id']).trigger('change');
    });
  })

  $('#form-editar').submit(e=>{
    let id_compra=$('#id_compra').val();
    let id_estado=$('#estado_compra').val();
    funcion='cambiar_estado';
    $.post('../controlador/comprasController.php', {funcion, id_compra, id_estado}, (response)=>{
      if(response=='edit'){
        $('#edit').hide('slow');
        $('#edit').show(1000);
        $('#edit').hide(3000);
        $('#form-editar').trigger('reset');
        $('#estado_compra').val('').trigger('change');
        mostrar_compras();
      }else{
        $('#noedit').hide('slow');
        $('#noedit').show(1000);
        $('#noedit').hide(3000);
      }
    });
    e.preventDefault();
  });

  $('#compras tbody').on('click', '.ver', function(){
    let datos = datatable.row($(this).parents()).data();
    let codigo = datos.codigo;
    codigo=codigo.split(' | ');
    let id=codigo[0];
    funcion='ver_compra';
    $('#codigo_compra').html(datos.codigo);
    $('#fecha_compra').html(datos.fecha_compra);
    $('#fecha_entrega').html(datos.fecha_entrega);
    $('#estado_compra_vista').html(datos.estado);
    $('#proveedor').html(datos.proveedor);
    $('#total').html(datos.total);
    $.post('../controlador/loteController.php', {id, funcion}, (response)=>{
      console.log(response);
      let registros = JSON.parse(response);
      let template="";
      //para asegurar que #detalles esté vacío
      $('#detalles').html(template);
      registros.forEach(registro => {
        template+=`
        <tr>
          <td>${registro.numero}</td>
          <td>${registro.codigo}</td>
          <td>${registro.cantidad}</td>
          <td>${registro.vencimiento}</td>
          <td>${registro.precio_compra}</td>
          <td>${registro.producto}</td>
          <td>${registro.laboratorio}</td>
          <td>${registro.presentacion}</td>
          <td>${registro.tipo}</td>
        </tr>
        `;
        $('#detalles').html(template);
      });
    })
  });
});

let espannol={
      "processing": "Procesando...",
      "lengthMenu": "Mostrar _MENU_ registros",
      "zeroRecords": "Nenhum resultado encontrado",
      "emptyTable": "Nenhum dado disponível nesta tabelaNenhum dado disponível nesta tabela",
      "infoEmpty": "Mostrando registros de 0 a 0 de un total de 0 registros",
      "infoFiltered": "(filtrado de un total de _MAX_ registros)",
      "search": "Buscar:",
      "infoThousands": ",",
      "loadingRecords": "Cargando...",
      "paginate": {
          "first": "Primero",
          "last": "Último",
          "next": "Siguinte",
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
          "condition": "Condicão",
          "conditions": {
              "date": {
                  "after": "Depois",
                  "before": "Antes",
                  "between": "Entre",
                  "empty": "Vazio",
                  "equals": "Igual a",
                  "notBetween": "Nãoo entre",
                  "notEmpty": "Não Vazio",
                  "not": "Diferente de"
              },
              "number": {
                  "between": "Entre",
                  "empty": "Vazio",
                  "equals": "Igual a",
                  "gt": "Maior a",
                  "gte": "Maior o igual a",
                  "lt": "Menor que",
                  "lte": "Menor o igual que",
                  "notBetween": "Não entre",
                  "notEmpty": "Não vazio",
                  "not": "Diferente de"
              },
              "string": {
                  "contains": "Contém",
                  "empty": "Vacío",
                  "endsWith": "Termina com",
                  "equals": "Igual a",
                  "notEmpty": "Não Vazio",
                  "startsWith": "Começa com",
                  "not": "Diferente de",
                  "notContains": "Não Contém",
                  "notStartsWith": "Não começa com",
                  "notEndsWith": "Não termina com"
              },
              "array": {
                  "not": "Diferente de",
                  "equals": "Igual",
                  "empty": "Vazio",
                  "contains": "Contém",
                  "notEmpty": "Não Vazio",
                  "without": "Sim"
              }
          },
          "data": "Data",
          "deleteTitle": "Excluir regra de filtro",
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
              "0": "Construtor de pesquisa",
              "_": "Construtor de pesquisa (%d)"
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
              "1": "1 célula selecionada",
              "_": "%d células selecionadas"
          },
          "columns": {
              "1": "1 coluna selecionada",
              "_": "%d colunas selecionadas"
          },
          "rows": {
              "1": "1 fila selecionada",
              "_": "%d filas selecionadas"
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
          "close": "Fechar",
          "create": {
              "button": "Novo",
              "title": "Criar Novo Registro",
              "submit": "Criar"
          },
          "edit": {
              "button": "Editar",
              "title": "Editar Registro",
              "submit": "Atualizar"
          },
          "remove": {
              "button": "Eliminar",
              "title": "Eliminar Registro",
              "submit": "Eliminar",
              "confirm": {
                  "_": "Tem certeza de que deseja excluir %d linhas?",
                  "1": "Tem certeza de que deseja excluir 1 linha?"
              }
          },
          "error": {
              "system": "Ocorreu um erro de sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Mais informações&lt;\\\/a&gt;).<\/ a> "
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
              "search": "Pesquisa",
              "select": "Selecionar",
              "columns": {
                  "search": "Pesquisa de coluna",
                  "visible": "Visibilidade da Coluna"
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