
$( document ).ready( function ()
{
    var funcion = '';
    var id_usuario = $( '#id_usuario' ).val();
    var edit = false;
    buscar_usuario( id_usuario );
    function buscar_usuario ( dato )
    {
        funcion = 'buscar_usuario';


        $.post( '../controlador/UsuarioController.php', { dato, funcion }, ( response ) =>
        {

            let nombre = '';
            let correo = '';

            let tipo = '';
            console.log( response );
            const usuarios = JSON.parse( response );

            usuarios.forEach( usuario =>
            {


                nombre = `${ usuario.nombre }`;


                if ( usuario.rol == '2' )
                {
                    tipo = `<h1 class="badge badge-danger">Administrador</h1>`;
                }
                if ( usuario.rol == '1' )
                {
                    tipo = `<h1 class="badge badge-warning">Técnico</h1>`;
                }




                correo = `${ usuario.email }`;
            } );

            $( '#nombre_us' ).html( nombre );
            $( '#us_tipo' ).html( tipo );
            $( '#correo_us' ).html( correo );


        } )
    }
    $( document ).on( 'click', '.edit', ( e ) =>
    {
        funcion = 'capturar_datos';
        edit = true;
        $.post( '../controlador/UsuarioController.php', { funcion, id_usuario }, ( response ) =>
        {
            console.log( response );
            let nombre = '';
            let correo = '';
            const usuarios = JSON.parse( response );

            usuarios.forEach( usuario =>
            {

                nombre = `${ usuario.nombre }`;
                correo = `${ usuario.email }`;

            } );

            $( '#nombre' ).val( nombre );
            $( '#correo' ).val( correo );
        } )
    } );

    $( '#form-usuario' ).submit( e =>
    {
        if ( edit == true )
        {

            let nombre = $( '#nombre' ).val();
            let correo = $( '#correo' ).val();

            funcion = 'editar_usuario';
            $.post( '../controlador/UsuarioController.php', { id_usuario, funcion, nombre, correo }, ( response ) =>
            {
                console.log( response );
                if ( response == 'editado' )
                {
                    $( '#editado' ).hide( 'slow' );
                    $( '#editado' ).show( 1000 );
                    $( '#editado' ).hide( 2000 );
                    $( '#form-usuario' ).trigger( 'reset' );

                }
                edit = false;
                buscar_usuario( id_usuario );

            } )
        }
        else
        {
            $( '#noeditado' ).hide( 'slow' );
            $( '#noeditado' ).show( 1000 );
            $( '#noeditado' ).hide( 2000 );
            $( '#form-usuario' ).trigger( 'reset' );
        }
        e.preventDefault();
    } );

    $( '#form-pass' ).submit( e =>
    {
        let oldpass = $( '#oldpass' ).val();
        let newpass = $( '#newpass' ).val();
        funcion = 'cambiar_contra';
        $.post( '../controlador/UsuarioController.php', { id_usuario, funcion, oldpass, newpass }, ( response ) =>
        {

            if ( response == 'update' )
            {
                $( '#update' ).hide( 'slow' );
                $( '#update' ).show( 1000 );
                $( '#update' ).hide( 2000 );
                $( '#form-pass' ).trigger( 'reset' );
            } else
            {
                $( '#noupdate' ).hide( 'slow' );
                $( '#noupdate' ).show( 1000 );
                $( '#noupdate' ).hide( 2000 );
                $( '#form-pass' ).trigger( 'reset' );
            }
        } )
        e.preventDefault();
    } )



} )
