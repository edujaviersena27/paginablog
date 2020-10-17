$( document ).ready( function ()
{
    var funcion = '';
    $( '.select2' ).select2();


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
            <li><a id="cat" idCat="${ presentacion.categoria }" href="../vista/MenuCategoria.php" class="dropdown-item">
                 <font style="vertical-align: inherit;">
                          <font style="vertical-align: inherit;"><span >${ presentacion.categoria }</span></font>
                  </font>
             </a></li>

             <li class="dropdown-divider"></li>
               
                `;
            } );


            $( '#categoria' ).html( template );
        } );





    }


    $( document ).on( 'click', '#cat', ( e ) =>
    {
        const elemento = $( this )[ 0 ].activeElement;
        const id_cat = $( elemento ).attr( 'idCat' );
        console.log( id_cat );


        funcion = "buscar_entrada";
        $.post( '../controlador/EntradaController.php', { funcion }, ( response ) =>
        {
            console.log( response );
            const entradas = JSON.parse( response );
            let template = '';
            entradas.forEach( entrada =>
            {

                if ( id_cat == `${ entrada.categoria }` )
                {
                    template += `
          <div   class="card" entTitulo="${ entrada.titulo }" entAdicional="${ entrada.adicional }" entCateogria="${ entrada.categoria }" entLink="${ entrada.link }" >
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
          <div class="text-right">
          <center>subido por : ${ entrada.username }</center>
      
        </div>
          </font></font></div>
          <!-- /.card-footer-->
        </div>
                  `;
                }
            } );


            $( '#entradas' ).html( template );
        } );

        e.preventDefault();

    } );







} )