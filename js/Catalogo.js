$(document).ready(function(){

    $('#cat-carrito').show();
    var funcion;
    buscar_entradas();
   

    function buscar_entradas ()
    {
      funcion = "buscar_entrada";
      $.post( '../controlador/EntradaController.php', { funcion }, ( response ) =>
      {
        console.log( response );
        const entradas = JSON.parse( response );
        let template = '';
        entradas.forEach( entrada =>
        {
          template += `
          <div class="card" entTitulo="${entrada.titulo}" entAdicional="${entrada.adicional}" entCateogria="${entrada.categoria}" entLink="${entrada.link}" >
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
          <center>subido por : ${ entrada.usuario }</center>
      
        </div>
          </font></font></div>
          <!-- /.card-footer-->
        </div>
                  `;
        } );
        $( '#entradas' ).html( template );
      } )
    }
  

  
    $( document ).on( 'keyup', '#buscar-entrada', function ()
    {
      let valor = $( this ).val();
      if ( valor != "" )
      {
        buscar_entradas( valor );
      }
      else
      {
        buscar_entradas();
      }
    } );
  

})