$(document).ready(function() {
  $('#aviso-exito').hide();
  $('#aviso-error').hide();

  $('#form-recuperar').submit(e=>{
    $('#aviso-exito').hide();
    $('#aviso-error').hide();
    mostrar_loader('recuperar_password');
    let email=$('#email-recuperar').val();
    let dni=$('#dni-recuperar').val();
    if(email==''||dni==''){
      $('#aviso-error').show();
      $('#aviso-error').text("Preencha todos os campos.");
      cerrar_loader('');
    }else{
      $('#aviso-error').hide();
      let funcion='verificar';
      $.post('../controlador/recuperarController.php',{funcion, email, dni}, (response)=>{
        $('#aviso-exito').hide();
        $('#aviso-error').hide();
        if(response=='encontrado'){
          let funcion='recuperar';
          $.post('../controlador/recuperarController.php',{funcion, email, dni}, (response2)=>{
            console.log(response2);
            if(response2=='enviado'){
              cerrar_loader('exito_envio');
              $('#aviso-exito').show();
              $('#aviso-exito').text("Redefinição de senha.");
            }else{
              cerrar_loader('error_envio');
              $('#aviso-error').show();
              $('#aviso-error').text("Não foi possível redefinir a senha.");
            }
            $('#form-recuperar').trigger('reset');
          });
        }else{
          cerrar_loader('error_usuario');
          $('#aviso-error').show();
          $('#aviso-error').text("O e-mail e ID não estão cadastrados ou estão incorretos");
        }
      })
    }
    e.preventDefault();
  })

  function mostrar_loader(mensaje){
    var texto=null;
    var mostrar=false;
    switch (mensaje) {
      case 'recuperar_password':
        texto='Enviando e-mail, aguarde...';
        mostrar=true;
        break;

    }
    if(mostrar==true){
      Swal.fire({
        title: 'Enviando email',
        text: texto,
        showConfirmButton: false
      });
    }
  }

  function cerrar_loader(mensaje){
    var tipo=null;
    var texto=null;
    var mostrar=false;
    switch (mensaje) {
      case 'exito_envio':
        tipo='success';
        texto='Correio enviado com sucesso.';
        mostrar=true;
        break;

      case 'error_envio':
        tipo='error';
        texto='Não foi possível enviar o e-mail, tente novamente.';
        mostrar=true;
        break;

      case 'error_usuario':
        tipo='error';
        texto='O usuário não foi encontrado.';
        mostrar=true;
        break;

      default:
        Swal.close();
        break;
    }
    if(mostrar==true){
      Swal.fire({
        position: 'center',
        icon: tipo,
        text: texto,
        showConfirmButton: false
      });
    }
  }
})