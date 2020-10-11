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
            <li><a href="#" class="dropdown-item">
                 <font style="vertical-align: inherit;">
                          <font style="vertical-align: inherit;">${ presentacion.categoria }</font>
                  </font>
             </a></li>

             <li class="dropdown-divider"></li>
               
                `;
            } );
            $( '#categoria' ).html( template );
        } );
    }
} )