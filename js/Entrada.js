$( document ).ready( function ()
{
  var funcion = '';
  var edit = false;
  $( '.select2' ).select2();
  buscar_producto();

  rellenar_presentaciones();

  function rellenar_presentaciones ()
  {
    funcion = "rellenar_presentaciones";
    $.post( '../controlador/CategoriaController.php', { funcion }, ( response ) =>
    {
      console.log( response );
      const presentaciones = JSON.parse( response );
      let template = '';
      presentaciones.forEach( presentacion =>
      {
        template += `
                <option value="${ presentacion.categoria }">${ presentacion.categoria }</option>
                `;
      } );
      $( '#presentacion' ).html( template );
    } );
  }


  $( '#form-crear-entrada' ).submit( e =>
  {
    let titulo = $( '#residencia' ).val();
    let adicional = $( '#adicional' ).val();
    let categoria = $( '#presentacion' ).val();
    let link = $( '#link' ).val();

    if ( edit == true )
    {
      funcion = 'editar';
    } else
    {
      funcion = 'crear';
    }

    $.post( '../controlador/EntradaController.php', { funcion, titulo, adicional, categoria, link }, ( response ) =>
    {
      console.log( response );
      if ( response == 'add' )
      {
        $( '#add' ).hide( 'slow' );
        $( '#add' ).show( 1000 );
        $( '#add' ).hide( 2000 );
        $( '#form-crear-entrada' ).trigger( 'reset' );
        buscar_producto();
      }
      if ( response == 'edit' )
      {
        $( '#edit_prod' ).hide( 'slow' );
        $( '#edit_prod' ).show( 1000 );
        $( '#edit_prod' ).hide( 2000 );
        $( '#form-crear-entrada' ).trigger( 'reset' );
        buscar_producto();
      }
      if ( response == 'noadd' )
      {
        $( '#noadd' ).hide( 'slow' );
        $( '#noadd' ).show( 1000 );
        $( '#noadd' ).hide( 2000 );
        $( '#form-crear-entrada' ).trigger( 'reset' );
      }
      if ( response == 'noedit' )
      {
        $( '#noadd' ).hide( 'slow' );
        $( '#noadd' ).show( 1000 );
        $( '#noadd' ).hide( 2000 );
        $( '#form-crear-entrada' ).trigger( 'reset' );
      }
      edit = false;
    } );

    e.preventDefault();
  } );

  function buscar_producto ()
  {
    funcion = "buscar";
    $.post( '../controlador/EntradaController.php', { funcion }, ( response ) =>
    {
      console.log( response );
      const productos = JSON.parse( response );
      let template = '';
      productos.forEach( producto =>
      {
        template += `
        <div class="card">
        <div class="card-header">
          <h3 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ producto.titulo } | ${ producto.categoria }</font></font> </h3> 

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Colapso">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Eliminar">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
        ${ producto.adicional }
        <br>
        <center>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/${ producto.link }" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </center>
        </font></font></div>
        <!-- /.card-body -->
        <div class="card-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
        <div class="text-right">
        
        <button class="editar btn btn-sm bg-success" type="button" data-toggle="modal" data-target="#crearproducto">
        <i class="fas fa-pencil-alt"></i>
        </button>
   
        <button class="borrar btn btn-sm bg-danger">
          <i class="fas fa-trash-alt"></i>
        </button>
      </div>
        </font></font></div>
        <!-- /.card-footer-->
      </div>
                `;
      } );
      $( '#productos' ).html( template );
    } )
  }


  $( document ).on( 'keyup', '#buscar-producto', function ()
  {
    let valor = $( this ).val();
    if ( valor != "" )
    {
      buscar_producto( valor );
    }
    else
    {
      buscar_producto();
    }
  } );


$( document ).on( 'click', '.avatar', ( e ) =>
{
  funcion = 'cambiar_avatar';
  const elemento = $( this )[ 0 ].activeElement.parentElement.parentElement.parentElement.parentElement;
  const id = $( elemento ).attr( 'prodId' );
  const avatar = $( elemento ).attr( 'prodAvatar' );
  const nombre = $( elemento ).attr( 'prodNombre' );
  $( '#funcion' ).val( funcion );
  $( '#id_logo_prod' ).val( id );
  $( '#avatar' ).val( avatar );
  $( '#logoactual' ).attr( 'src', avatar );
  $( '#nombre_logo' ).html( nombre );
} );

$( document ).on( 'click', '.lote', ( e ) =>
{
  const elemento = $( this )[ 0 ].activeElement.parentElement.parentElement.parentElement.parentElement;
  const id = $( elemento ).attr( 'prodId' );
  const nombre = $( elemento ).attr( 'prodNombre' );

  $( '#id_lote_prod' ).val( id );
  $( '#nombre_producto_lote' ).html( nombre );
} );

$( '#form-logo' ).submit( e =>
{
  let formData = new FormData( $( '#form-logo' )[ 0 ] );
  $.ajax( {
    url: "../controlador/ProductoController.php",
    type: "POST",
    data: formData,
    cache: false,
    processData: false,
    contentType: false
  } ).done( function ( response )
  {
    let json = JSON.parse( response );
    if ( json.alert == 'edit' )
    {
      $( '#logoactual' ).attr( 'src', json.ruta );
      $( '#edit' ).hide( 'slow' );
      $( '#edit' ).show( 1000 );
      $( '#edit' ).hide( 2000 );
      $( '#form-logo' ).trigger( 'reset' );
      buscar_producto();
    } else
    {
      $( '#noedit' ).hide( 'slow' );
      $( '#noedit' ).show( 1000 );
      $( '#noedit' ).hide( 2000 );
      $( '#form-logo' ).trigger( 'reset' );
    }
  } );
  e.preventDefault();
} );


$( document ).on( 'click', '.editar', ( e ) =>
{
  const elemento = $( this )[ 0 ].activeElement.parentElement.parentElement.parentElement.parentElement;
  const id = $( elemento ).attr( 'prodId' );
  const nombre = $( elemento ).attr( 'prodNombre' );
  const concentracion = $( elemento ).attr( 'prodConcentracion' );
  const adicional = $( elemento ).attr( 'prodAdicional' );
  const precio = $( elemento ).attr( 'prodPrecio' );
  const laboratorio = $( elemento ).attr( 'prodLaboratorio' );
  const tipo = $( elemento ).attr( 'prodTipo' );
  const presentacion = $( elemento ).attr( 'prodPresentacion' );

  $( '#id_edit_prod' ).val( id );
  $( '#nombre_producto' ).val( nombre );
  $( '#concentracion' ).val( concentracion );
  $( '#adicional' ).val( adicional );
  $( '#precio' ).val( precio );
  $( '#laboratorio' ).val( laboratorio ).trigger( 'change' );
  $( '#tipo' ).val( tipo ).trigger( 'change' );
  $( '#presentacion' ).val( presentacion ).trigger( 'change' );
  edit = true;
} );

$( document ).on( 'click', '.borrar', ( e ) =>
{
  funcion = 'borrar';
  const elemento = $( this )[ 0 ].activeElement.parentElement.parentElement.parentElement.parentElement;
  const id = $( elemento ).attr( 'prodId' );
  const nombre = $( elemento ).attr( 'prodNombre' );
  const avatar = $( elemento ).attr( 'prodAvatar' );
  const swalWithBootstrapButtons = Swal.mixin( {
    customClass: {
      confirmButton: 'btn btn-success',
      cancelButton: 'btn btn-danger mr-1'
    },
    buttonsStyling: false
  } )

  swalWithBootstrapButtons.fire( {
    title: 'Desea eliminar ' + nombre + '?',
    text: "No podrá revertir esto!",
    imageUrl: '' + avatar + '',
    imageWidth: 100,
    imageHeight: 100,
    showCancelButton: true,
    confirmButtonText: 'si, borrar esto!',
    cancelButtonText: 'No, cancelar!',
    reverseButtons: true
  } ).then( ( result ) =>
  {
    if ( result.value )
    {
      $.post( '../controlador/ProductoController.php', { id, funcion }, ( response ) =>
      {
        edit = false;
        if ( response == 'borrado' )
        {
          swalWithBootstrapButtons.fire(
            'Borrado!',
            'El producto ' + nombre + ' fue borrado.',
            'success'
          )
          buscar_producto();
        }
        else
        {
          swalWithBootstrapButtons.fire(
            'Cancelado',
            'El producto ' + nombre + ' no se pudo borrar porque está siendo usado en otro lote',
            'error'
          )
        }
      } )


    } else if ( result.dismiss === Swal.DismissReason.cancel )
    {
      swalWithBootstrapButtons.fire(
        'Cancelado',
        'El producto ' + nombre + ' no fue borrado.',
        'error'
      )
    }
  } );

} );

$( '#form-crear-lote' ).submit( e =>
{
  let id_producto = $( '#id_lote_prod' ).val();
  let proveedor = $( '#proveedor' ).val();
  let stock = $( '#stock' ).val();
  let vencimiento = $( '#vencimiento' ).val();
  funcion = 'crear';
  $.post( '../controlador/LoteController.php', { funcion, id_producto, proveedor, stock, vencimiento }, ( response ) =>
  {
    $( '#add-lote' ).hide( 'slow' );
    $( '#add-lote' ).show( 1000 );
    $( '#add-lote' ).hide( 2000 );
    $( '#form-crear-lote' ).trigger( 'reset' );
    buscar_producto();
  } );

  e.preventDefault();
} );

} )
