$( document ).ready( function ()
{
  var tipo_usuario = $( '#tipo_usuario' ).val();
  console.log( tipo_usuario );
  if ( tipo_usuario == 2 )
  {
    $( '#button-crear' ).hide();
  }
  buscar_datos();
  var funcion;
  var edit=false;
  function buscar_datos ( consulta )
  {
    funcion = 'buscar_usuarios_adm';
    $.post( '../controlador/UsuarioController.php', { consulta, funcion }, ( response ) =>
    {
      console.log( response );
      const usuario = JSON.parse( response );
      let template = '';

      usuario.forEach( usuario =>
      {
        template += `
                <div usuarioId="${ usuario.email }" usuarioNombre="${ usuario.nombre }" usuarioActivar="${ usuario.activar }" usuarioRol="${ usuario.rol }" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                <div class="card bg-light">
                  <div class="card-header text-muted border-bottom-0">`;
        if ( usuario.rol == 2 )
        {
          template += `<h1 class="badge badge-danger">Administrador</h1>`;
        }
        if ( usuario.rol == 1 )
        {
          template += `<h1 class="badge badge-warning">Técnico</h1>`;
        }

        template += ` </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-7">
                        <h2 class="lead"><b>${ usuario.nombre } </b></h2>
                        
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Correo : ${ usuario.email }</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Activar : ${ usuario.activar }</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Rol Usuario: ${ usuario.rol }</li>
                          <li class="small"><span class="fa-li"><i class="fas fa-lg fa-id-card"></i></span> Contraseña #:${ usuario.pass }</li>
                        </ul>
                      </div>
                      <div class="col-5 text-center">
                        <img src="../img/default.png" alt="" class="img-circle img-fluid">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">
                    <div class="text-right">

                   
                    <button class="borrar btn btn-danger ml-1" type="button">
                    <i class="fas fa-window-close mr-1"></i>Eliminar 
                  </button>
                        
                    
                        <button class="editar btn btn-primary ml-1"  type="button"  data-toggle="modal" data-target="#crearusuario">
                          <i class="fas fa-sort-amount-up mr-1"></i>Editar 
                        </button>
                        
                      

                      

                 
                    </div>
                  </div>
                </div>
              </div>
                `;
      } )
      $( '#usuarios' ).html( template );
    } );
  }

  $( document ).on( 'keyup', '#buscar', function ()
  {
    let valor = $( this ).val();
    if ( valor != "" )
    {
      buscar_datos( valor );
    }
    else
    {
      buscar_datos();
    }
  } );

  $( '#form-crear' ).submit( e =>
  {
    let nombre = $( '#nombre' ).val();
    let email = $( '#email' ).val();
    let activar = $( '#activar' ).val();
    let rol = $( '#rol' ).val();
    let pass = $( '#pass' ).val();
    let edit_user = $( '#id_editar_user' ).val();

    if(edit==false){
      funcion = 'crear_usuario';
  }else if(edit==true){
      funcion='editar';
  }
   
    $.post( '../controlador/UsuarioController.php', { nombre, email, activar, rol, pass, edit_user, funcion }, ( response ) =>
    {
      console.log( response );
      if ( response == 'add' )
      {
        $( '#add' ).hide( 'slow' );
        $( '#add' ).show( 1000 );
        $( '#add' ).hide( 2000 );
        $( '#form-crear' ).trigger( 'reset' );
        buscar_datos();
        edit=false;
      }else
      {
        $( '#noadd' ).hide( 'slow' );
        $( '#noadd' ).show( 1000 );
        $( '#noadd' ).hide( 2000 );
        $( '#form-crear' ).trigger( 'reset' );
      }
      if ( response == 'edit' )
      {
        $( '#edit' ).hide( 'slow' );
        $( '#edit' ).show( 1000 );
        $( '#edit' ).hide( 2000 );
        $( '#form-crear' ).trigger( 'reset' );
        buscar_datos();
      }
      
      edit=false;
    } );
    e.preventDefault();
  } );



  $( document ).on( 'click', '.editar', ( e ) =>
  {
    const elemento = $( this )[ 0 ].activeElement.parentElement.parentElement.parentElement.parentElement;
    const nombre = $( elemento ).attr( 'usuarioNombre' );
    const email = $( elemento ).attr( 'usuarioId' );
    const activar = $( elemento ).attr( 'usuarioActivar' );
    const rol = $( elemento ).attr( 'usuarioRol' );




    $( '#nombre' ).val( nombre );
    $( '#email' ).val( email );
    $( '#activar' ).val( activar ).trigger( 'change' );
    $( '#rol' ).val( rol );
    
    $( '#id_editar_user' ).val( nombre );
    edit=true; 
 

  } );

  $( document ).on( 'click', '.borrar', ( e ) =>
  {
    funcion = 'borrar';
    const elemento = $( this )[ 0 ].activeElement.parentElement.parentElement.parentElement.parentElement;
    const id = $( elemento ).attr( 'usuarioNombre' );
    const swalWithBootstrapButtons = Swal.mixin( {
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger mr-1'
      },
      buttonsStyling: false
    } )

    swalWithBootstrapButtons.fire( {
      title: 'Desea eliminar ' + id + '?',
      text: "No podrá revertir esto!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'si, borrar esto!',
      cancelButtonText: 'No, cancelar!',
      reverseButtons: true
    } ).then( ( result ) =>
    {
      if ( result.value )
      {
        $.post( '../controlador/UsuarioController.php', { id, funcion }, ( response ) =>
        {
          console.log( response );
          edit = false;
          if ( response == 'borrado' )
          {
            swalWithBootstrapButtons.fire(
              'Borrado!',
              'El usuario ' + id + ' fue borrado.',
              'success'
            )
            buscar_datos();
          }
          else
          {
            swalWithBootstrapButtons.fire(
              'Cancelado',
              'El usuario ' + id + ' no se pudo borrar',
              'error'
            )
          }
        } )


      } else if ( result.dismiss === Swal.DismissReason.cancel )
      {
        swalWithBootstrapButtons.fire(
          'Cancelado',
          'El usuario ' + id + ' no fue borrado.',
          'error'
        )
      }
    } );

  } );

} )