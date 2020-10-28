$(document).ready(function() {
    buscar_cat();
    var funcion;
    var edit=false;
    $('#form-crear-categoria').submit(e=>{
        let nombre_categoria=$('#nombre-categoria').val();
        let id_editado=$('#id_editar_cat').val();
        if(edit==false){
            funcion='crear';
        }else{
            funcion='editar';
        }
        
        $.post('../controlador/CategoriaController.php',{nombre_categoria,id_editado,funcion},(response)=>{
            console.log(response);
            if(response=='add'){
                $('#add').hide('slow');
                $('#add').show(1000);
                $('#add').hide(2000);
                $('#form-crear-categoria').trigger('reset');
                buscar_cat();
            }
            if(response=='noadd'){
                $('#noadd').hide('slow');
                $('#noadd').show(1000);
                $('#noadd').hide(2000);
                $('#form-crear-categoria').trigger('reset');
            }
            if(response=='edit'){
                $('#edit').hide('slow');
                $('#edit').show(1000);
                $('#edit').hide(2000);
                $('#form-crear-categoria').trigger('reset');
                buscar_cat();
            }
            if(response=='noedit'){
                $('#noedit').hide('slow');
                $('#noedit').show(1000);
                $('#noedit').hide(2000);
                $('#form-crear-categoria').trigger('reset');
            }
            edit=false;
            });
            e.preventDefault();
        });

        function buscar_cat() {
            funcion='buscar';
            $.post('../controlador/CategoriaController.php',{funcion},(response) => {
                console.log(response);
                const categorias = JSON.parse(response);
                
                let template='';
                categorias.forEach(categoria => {

                    let rol= `${ categoria.rol }`;
                    if((`${ categoria.username }` == `${ categoria.usuario }`) && (`${ categoria.rol }` == '1') ){
                    template+=
                    `<tr catNombre="${categoria.categoria}">
                   
                       
                            <td>
                                <button class="editar-cat btn btn-success" title="Editar categoria" type="button" data-toggle="modal" data-target="#crearcategoria">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="borrar-cat btn btn-danger" title="Eliminar categoria">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                   
                   
                            <td>${categoria.categoria}</td>
                        </tr>
                    `;
                    }else if(rol=='2'){
                        template+=
                        `<tr catNombre="${categoria.categoria}">
                       
                           
                                <td>
                                    <button class="editar-cat btn btn-success" title="Editar categoria" type="button" data-toggle="modal" data-target="#crearcategoria">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="borrar-cat btn btn-danger" title="Eliminar categoria">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                       
                       
                                <td>${categoria.categoria}</td>
                            </tr>
                        `;

                    }
                });
                $('#categorias').html(template);
            })
        }
        $(document).on('keyup','#buscar-categoria',function(){
            let valor=$(this).val();
            if(valor!=""){
                buscar_cat(valor);
            }
            else{
                buscar_cat();
            }
        })

        $(document).on('click','.borrar-cat',(e)=>{
            funcion='borrar';
            const elemento=$(this)[0].activeElement.parentElement.parentElement;
           
            const nombre=$(elemento).attr('catNombre');
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
                icon:'warning',
                showCancelButton: true,
                confirmButtonText: 'si, borrar esto!',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                $.post('../controlador/CategoriaController.php',{nombre,funcion},(response) => {
                    edit=false;
                    console.log(response);
                    if(response=='borrado'){
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'La categoria'+nombre+' fue borrada.',
                            'success'
                        )
                        buscar_cat();
                    }
                    else {
                        swalWithBootstrapButtons.fire(
                            'Cancelado',
                            'La categoria'+nombre+' no se pudo borrar porque está siendo usado en otro producto',
                            'error'
                        )
                        buscar_cat();
                    }
                })
                  
                  
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                  swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'La categoria '+nombre+' no fue borrada.',
                    'error'
                  )
                  buscar_cat();
                }
              });
          
          })

          $(document).on('click','.editar-cat',(e)=>{
            funcion='editar';
            const elemento=$(this)[0].activeElement.parentElement.parentElement;
            
            const nombre=$(elemento).attr('catNombre');
          
            $('#nombre-categoria').val(nombre); 
            
            $( '#id_editar_cat' ).val( nombre );
            edit=true;       
          })
    
});