$(document).ready(function() {
    //buscar_pre() justo al principio hace que automáticamente se muestren todos los laboratorios al usuario
    buscar_pre();
    var funcion;
    var edit=false;

    $('#form-crear-presentacion').submit(e=>{
        let nombre_presentacion=$('#nombre-presentacion').val();
        let id_editado=$('#id_editar_pre').val();
        //si edit es false, se crea un laboratorio, si es true, se modifica, asi se puede usar el mismo modal para crear y editar laboratorio
        if(edit==false){
            funcion='crear';
        }else{
            funcion='editar';
        }
        $.post('../controlador/presentacionController.php', {nombre_presentacion, id_editado, funcion}, (response)=>{
            console.log(response);
            if(response=='add'){
                $('#add-pre').hide('slow');
                $('#add-pre').show(1000);
                $('#add-pre').hide(3000);
                buscar_pre();
            }
            if(response=='noadd'){
                $('#noadd-pre').hide('slow');
                $('#noadd-pre').show(1000);
                $('#noadd-pre').hide(3000);
            }
            if(response=='edit'){
                $('#edit-pre').hide('slow');
                $('#edit-pre').show(1000);
                $('#edit-pre').hide(3000);
                buscar_pre();
            }
            //resetea los campos de la card
            $('#form-crear-presentacion').trigger('reset');
            edit=false;
        })
        e.preventDefault();
    });

    function buscar_pre(consulta){
        funcion='buscar';
        $.post('../controlador/presentacionController.php', {consulta, funcion}, (response)=>{
            const presentaciones = JSON.parse(response);
            let template='';
            presentaciones.forEach(presentacion => {
                template+=`
                    <tr preId="${presentacion.id}" preNombre="${presentacion.nombre}">
                        <td>
                            <button class="editar-pre btn btn-success" title="Editar Apresentação" type="button" data-toggle="modal" data-target="#crearPresentacion"><i class="fas fa-pencil-alt"></i></button>
                            <button class="borrar-pre btn btn-danger" title="Excluir Apresentação"><i class="fas fa-trash"></i></button>
                        </td>
                        <td>"${presentacion.nombre}"</td>
                    </tr>
                `;
            });
            $('#presentaciones').html(template);
        })
    }
    //con el atributo .on, se ejecuta cada vez que se pulsa una tecla
    $(document).on('keyup', '#buscar-presentacion', function(){
        let valor = $(this).val();
        if(valor!='')
        {
            buscar_pre(valor);
        }else{
            buscar_pre();
        }
    });
    $(document).on('click', '.borrar-pre', (e)=>{
        funcion="borrar";
        //se usan 2 parentElement para llegar al tr desde el button #cambiar-logo-lab en el que se hace click
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('preId');
        const nombre=$(elemento).attr('preNombre');

        //https://sweetalert2.github.io para más informacion
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger mr-1'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: 'É seguro excluir '+nombre+'?',
            text: "A ação não pode ser desfeita",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, eliminar',
            cancelButtonText: 'Nãoo eliminar',
            reverseButtons: true
          }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controlador/presentacionController.php', {id, funcion}, (response)=>{
                    edit=false;
                    if(response=='borrado'){
                        swalWithBootstrapButtons.fire(
                          'Eliminado',
                          'A apresentação '+nombre+' foi eliminado.',
                          'success'
                        )
                        buscar_pre();
                        
                    }else{
                        swalWithBootstrapButtons.fire(
                          'No se pudo borrar',
                          'A apresentação '+nombre+' Não foi excluído porque um produto o está usando',
                          'error'
                        )
                    }
                })
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                'A apresentação '+nombre+' não foi excluído',
                'error'
              )
            }
          })
    });

    $(document).on('click', '.editar-pre', (e)=>{
        //se usan 2 parentElement para llegar al tr desde el button #cambiar-logo-lab en el que se hace click
        const elemento=$(this)[0].activeElement.parentElement.parentElement;
        const id=$(elemento).attr('preId');
        const nombre=$(elemento).attr('preNombre');
        $('#id_editar_pre').val(id);
        $('#nombre-presentacion').val(nombre);
        edit=true;
    });
});