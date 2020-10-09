$( document ).ready( function ()
{
  var funcion = '';
  var edit = false;
  $( '.select2' ).select2();
  buscar_producto();


  

  $( '#form-crear-entrada' ).submit( e =>
  {
    let titulo = $( '#residencia' ).val();
    let adicional = $( '#adicional' ).val();
    let categoria = $( '#laboratorio' ).val();
    let link = $( '#sexo' ).val();
  
    if ( edit == true )
    {
      funcion = 'editar';
    } else
    {
      funcion = 'crear';
    }

    $.post( '../controlador/ProductoController.php', { funcion, titulo, adicional, categoria, link}, ( response ) =>
    {
      console.log(response);
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

  function buscar_producto ( consulta )
  {
    funcion = "buscar";
    $.post( '../controlador/ProductoController.php', { consulta, funcion }, ( response ) =>
    {
      const productos = JSON.parse( response );
      let template = '';
      productos.forEach( producto =>
      {
        template += `
                <div prodId="${producto.id }" prodStock="${ producto.stock }" prodNombre="${ producto.nombre }" prodConcentracion="${ producto.concentracion }" prodAdicional="${ producto.adicional }" prodPrecio="${ producto.precio }" prodLaboratorio="${ producto.laboratorio_id }" prodTipo="${ producto.tipo_id }" prodPresentacion="${ producto.presentacion_id }" prodAvatar="${ producto.avatar }" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
               <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                <i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock }
                </font></font></div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${producto.nombre }</b></h2>
                      <h4 class="lead"><b><i class="fas fa-lg fa-dollar-sign mr-1"></i>${producto.precio }</b></h4>
                      
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span>Concentracion: ${producto.concentracion }</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-clipboard-check"></i></span>Adicional: ${producto.adicional }</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-ad"></i></span>Marca: ${producto.laboratorio }</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span>Tipo: ${producto.tipo }</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-book"></i></span>Clasificacion: ${producto.presentacion }</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${producto.avatar }" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="avatar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambiologo">
                      <i class="fas fa-image"></i>
                    </button>
                    <button class="editar btn btn-sm bg-success" type="button" data-toggle="modal" data-target="#crearproducto">
                    <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="lote btn btn-sm bg-primary" type="buttton" data-toggle="modal" data-target="#crearlote">
                      <i class="fas fa-plus"></i>
                    </button>
                    <button class="borrar btn btn-sm bg-danger">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
                `;
      } )
      $( '#productos' ).html( template );
    } );
  }

  function buscar_producto_codigo ( consulta )
  {
    funcion = "buscar_codigo";
    $.post( '../controlador/ProductoController.php', { consulta, funcion }, ( response ) =>
    {
      const productos = JSON.parse( response );
      let template = '';
      productos.forEach( producto =>
      {
        template += `
                <div prodId="${producto.id }" prodStock="${ producto.stock }" prodNombre="${ producto.nombre }" prodConcentracion="${ producto.concentracion }" prodAdicional="${ producto.adicional }" prodPrecio="${ producto.precio }" prodLaboratorio="${ producto.laboratorio_id }" prodTipo="${ producto.tipo_id }" prodPresentacion="${ producto.presentacion_id }" prodAvatar="${ producto.avatar }" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
               <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
                <i class="fas fa-lg fa-cubes mr-1"></i>${producto.stock }
                </font></font></div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${producto.nombre }</b></h2>
                      <h4 class="lead"><b><i class="fas fa-lg fa-dollar-sign mr-1"></i>${producto.precio }</b></h4>
                      
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-mortar-pestle"></i></span>Concentracion: ${producto.concentracion }</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-clipboard-check"></i></span>Adicional: ${producto.adicional }</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-ad"></i></span>Marca: ${producto.laboratorio }</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-copyright"></i></span>Tipo: ${producto.tipo }</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-book"></i></span>Clasificacion: ${producto.presentacion }</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${producto.avatar }" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="avatar btn btn-sm bg-teal" type="button" data-toggle="modal" data-target="#cambiologo">
                      <i class="fas fa-image"></i>
                    </button>
                    <button class="editar btn btn-sm bg-success" type="button" data-toggle="modal" data-target="#crearproducto">
                    <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button class="lote btn btn-sm bg-primary" type="buttton" data-toggle="modal" data-target="#crearlote">
                      <i class="fas fa-plus"></i>
                    </button>
                    <button class="borrar btn btn-sm bg-danger">
                      <i class="fas fa-trash-alt"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
                `;
      } );
      $( '#productos_codigo' ).html( template );
    } );
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

  $( document ).on( 'keyup', '#buscar-producto-codigo', function ()
  {
    let valor = $( this ).val();
    if ( valor != "" )
    {
      buscar_producto_codigo( valor );
    }
    else
    {
      buscar_producto_codigo();
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

  $(document).on('click','.borrar',(e)=>{
    funcion='borrar';
    const elemento=$(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
    const id=$(elemento).attr('prodId');
    const nombre=$(elemento).attr('prodNombre');
    const avatar=$(elemento).attr('prodAvatar');
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger mr-1'
        },
        buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
        title: 'Desea eliminar '+nombre+'?',
        text: "No podrá revertir esto!",
        imageUrl:''+avatar+'',
        imageWidth:100,
        imageHeight:100,
        showCancelButton: true,
        confirmButtonText: 'si, borrar esto!',
        cancelButtonText: 'No, cancelar!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
        $.post('../controlador/ProductoController.php',{id,funcion},(response) => {
            edit=false;
            if(response=='borrado'){
                swalWithBootstrapButtons.fire(
                    'Borrado!',
                    'El producto '+nombre+' fue borrado.',
                    'success'
                )
                buscar_producto();
            }
            else {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'El producto '+nombre+' no se pudo borrar porque está siendo usado en otro lote',
                    'error'
                )
            }
        })
          
          
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          swalWithBootstrapButtons.fire(
            'Cancelado',
            'El producto '+nombre+' no fue borrado.',
            'error'
          )
        }
      });
  
  });

  $('#form-crear-lote').submit(e=>{
      let id_producto=$('#id_lote_prod').val();
      let proveedor=$('#proveedor').val();
      let stock=$('#stock').val();
      let vencimiento=$('#vencimiento').val();
      funcion='crear';
      $.post('../controlador/LoteController.php',{funcion,id_producto,proveedor,stock,vencimiento},(response)=>{
        $( '#add-lote' ).hide( 'slow' );
        $( '#add-lote' ).show( 1000 );
        $( '#add-lote' ).hide( 2000 );
        $( '#form-crear-lote' ).trigger( 'reset' );
        buscar_producto();
      });

      e.preventDefault();
  });

} )
