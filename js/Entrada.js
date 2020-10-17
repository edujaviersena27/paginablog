$( document ).ready( function ()
{

  var funcion = '';
  var edit=false;
  $( '.select2' ).select2();
  buscar_entrada();

  rellenar_presentaciones();

  function rellenar_presentaciones ()
  {
    funcion = "rellenar_presentaciones";
    $.post( '../controlador/CategoriaController.php', { funcion }, ( response ) =>
    {
      console.log( response );
      const categorias = JSON.parse( response );
      let template = '';
      categorias.forEach( categoria =>
      {
        template += `
                <option value="${ categoria.categoria }">${ categoria.categoria }</option>
                `;
      } );
      $( '#presentacion' ).html( template );
    } );
  }


  $( '#form-crear-entrada' ).submit( e =>
  {
    let titulo = $( '#titulo' ).val();
    let adicional = $( '#adicional' ).val();
    let categoria = $( '#presentacion' ).val();
    let link = $( '#link' ).val();
    let edit_ent = $( '#id_editar_ent' ).val();
  

    if(edit==false){
      funcion='crear';
  }else{
      funcion='editar';
  }
  
    $.post( '../controlador/EntradaController.php', { funcion, titulo, adicional, categoria, link, edit_ent }, ( response ) =>
    {
      console.log( response );
      if ( response == 'add' )
      {
        $( '#add' ).hide( 'slow' );
        $( '#add' ).show( 1000 );
        $( '#add' ).hide( 2000 );
        $( '#form-crear-entrada' ).trigger( 'reset' );
        buscar_entrada();
      }
  
      if ( response == 'noadd' )
      {
        $( '#noadd' ).hide( 'slow' );
        $( '#noadd' ).show( 1000 );
        $( '#noadd' ).hide( 2000 );
        $( '#form-crear-entrada' ).trigger( 'reset' );
      }

      if ( response == 'edit' )
      {
        $( '#edit' ).hide( 'slow' );
        $( '#edit' ).show( 1000 );
        $( '#edit' ).hide( 2000 );
        $( '#form-crear-entrada' ).trigger( 'reset' );
        buscar_entrada();
      }
   
      if ( response == 'noedit' )
      {
        $( '#noedit' ).hide( 'slow' );
        $( '#noedit' ).show( 1000 );
        $( '#noedit' ).hide( 2000 );
        $( '#form-crear-entrada' ).trigger( 'reset' );
      }
      edit==false;
    } );

    e.preventDefault();
  } );

  function buscar_entrada ()
  {
    funcion = "buscar";
    $.post( '../controlador/EntradaController.php', { funcion }, ( response ) =>
    {
      console.log( response );
      const entradas = JSON.parse( response );
      let template = '';
      entradas.forEach( entrada =>
      {
        let rol= `${ entrada.rol }`;
        if((`${ entrada.username }`== `${ entrada.usuario }`) && (`${ entrada.rol }` == '1'))
        {
        template += `
        <div id="cardentrada"class="card" entTitulo="${ entrada.titulo }" entAdicional="${ entrada.adicional }" entCategoria="${ entrada.categoria }" entLink="${ entrada.link }" >
        <div class="card-header">
          <h3 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ entrada.titulo } | ${ entrada.categoria }</font></font> </h3> 

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Colapso">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Eliminar">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
        <div>${ entrada.adicional }</div>
        <br>
        <center>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/${ entrada.link }" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </center>
        </font></font></div>
        <!-- /.card-body -->
        <div class="card-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
        <center>subido por : ${ entrada.username }</center>
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
      }else if(rol == '2'){
        template += `
        <div id="cardentrada"class="card" entTitulo="${ entrada.titulo }" entAdicional="${ entrada.adicional }" entCategoria="${ entrada.categoria }" entLink="${ entrada.link }" >
        <div class="card-header">
          <h3 class="card-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">${ entrada.titulo } | ${ entrada.categoria }</font></font> </h3> 

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Colapso">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Eliminar">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
        <div>${ entrada.adicional }</div>
        <br>
        <center>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/${ entrada.link }" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </center>
        </font></font></div>
        <!-- /.card-body -->
        <div class="card-footer"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">
        <center>subido por : ${ entrada.username }</center>
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
      }

      } );

      $( '#entradas' ).html( template );

    } );


 
  }




  $( document ).on( 'keyup', '#buscar-entrada', function ()
  {
    let valor = $( this ).val();
    if ( valor != "" )
    {
      buscar_entrada( valor );
    }
    else
    {
      buscar_entrada();
    }
  } );


  $( document ).on( 'click', '.editar', ( e ) =>
  {
    const elemento = $( this )[ 0 ].activeElement.parentElement.parentElement.parentElement.parentElement.parentElement;
    const titulo = $( elemento ).attr( 'entTitulo' );
    const adicional = $( elemento ).attr( 'entAdicional' );
    const categoria = $( elemento ).attr( 'entCategoria' );
    const link = $( elemento ).attr( 'entLink' );




    $( '#titulo' ).val( titulo );
    $( '#adicional' ).val( adicional );
    $( '#categoria' ).val( categoria ).trigger( 'change' );
    $( '#link' ).val( link );
    
    $( '#id_editar_ent' ).val( titulo );
    edit=true; 
 

  } );

  $( document ).on( 'click', '.borrar', ( e ) =>
  {
    funcion = 'borrar';
    const elemento = $( this )[ 0 ].activeElement.parentElement.parentElement.parentElement.parentElement.parentElement;
    const titulo = $( elemento ).attr( 'entTitulo' );
    const swalWithBootstrapButtons = Swal.mixin( {
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger mr-1'
      },
      buttonsStyling: false
    } )

    swalWithBootstrapButtons.fire( {
      title: 'Desea eliminar ' + titulo + '?',
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
        $.post( '../controlador/EntradaController.php', { titulo, funcion }, ( response ) =>
        {
          console.log( response );
          edit = false;
          if ( response == 'borrado' )
          {
            swalWithBootstrapButtons.fire(
              'Borrado!',
              'La entrada ' + titulo + ' fue borrada.',
              'success'
            )
            buscar_entrada();
          }
          else
          {
            swalWithBootstrapButtons.fire(
              'Cancelado',
              'La entrada ' + titulo + ' no se pudo borrar',
              'error'
            )
          }
        } )


      } else if ( result.dismiss === Swal.DismissReason.cancel )
      {
        swalWithBootstrapButtons.fire(
          'Cancelado',
          'La entrada ' + titulo + ' no fue borrada.',
          'error'
        )
      }
    } );

  } );

} )
