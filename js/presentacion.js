$(document).ready(function () {
    buscar_pre();
    var edit = false;
    var funcion;
    $('#form-crear-presentacion').submit((e) => {
        let nombre_presentacion = $('#nombre-presentacion').val();
        let id_editado = $('#id_editar_pre').val();
        if (edit==false) {
            funcion = 'crear';
        } else {
            funcion = 'editar';
        }
        
        $.post('../controlador/PresentacionController.php', {nombre_presentacion, id_editado, funcion }, (response) => {
                if (response == 'add') {
                    $('#add-pre').hide('slow');
                    $('#add-pre').show(1000);
                    $('#add-pre').hide(2000);
                    $('#form-crear-presentacion').trigger('reset');
                    buscar_pre();
                }   if (response == 'noadd'){
                    $('#noadd-pre').hide('slow');
                    $('#noadd-pre').show(1000);
                    $('#noadd-pre').hide(2000);
                    $('#form-crear-presentacion').trigger('reset');
            }   if (response=='edit') {
                    $('#edit-pre').hide('slow');
                    $('#edit-pre').show(1000);
                    $('#edit-pre').hide(2000);
                    $('#form-crear-presentacion').trigger('reset');
                    buscar_pre();
            }
            edit = false;
            }
        );
        e.preventDefault();
    });
    function buscar_pre(consulta) {
        funcion = 'buscar';
        $.post('../controlador/PresentacionController.php',{ consulta, funcion },(response) => {
                const presentaciones = JSON.parse(response);
                let template = '';
                presentaciones.forEach(presentacion => {
                    template += `
                <tr preId="${presentacion.id}" prenombre="${presentacion.nombre}" style="text-align:center"><b>   
                <td style="vertical-align: middle">
                        <button class="editar-pre btn btn-success" title="Editar Presentacion"  type="button" data-toggle="modal" data-target="#crearpresentacion">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="borrar-pre btn btn-danger" title="Borrar Presentacion">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                    <td style="text-transform:uppercase; vertical-align: middle" ><b> ${presentacion.nombre}</b></td>                                          
                </tr>
                `;
                });
                $('#presentaciones').html(template);
            }
        );
    }
    $(document).on('keyup', '#buscar-presentacion', function () {
        let valor = $(this).val();
        if (valor != '') {
            buscar_pre(valor);
        } else {
            buscar_pre();
        }
    });

    $(document).on('click', '.borrar-pre', (e) => {
        funcion = "borrar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('preId');
        const nombre = $(elemento).attr('prenombre');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: 'Desea eliminar la Presentacion '+nombre+'?',
            text: "No podras revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, borrar esto!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
          }).then((result) => {
              if (result.isConfirmed) {
                  $.post('../controlador/PresentacionController.php', { id, funcion }, (response) => {
                      edit = false;
                      if (response=='borrado') {
                          swalWithBootstrapButtons.fire(
                              'Borrado!',
                              'La Presentacion ' + nombre + ' ha sido eliminado con exito.',
                              'success'                           
                          )
                          buscar_pre();
                      } else {
                        swalWithBootstrapButtons.fire(
                            'No se pudo borrar!!',
                            'La Presentacion '+nombre+' no fue borrado porque esta siendo usado en un producto',
                            'error'
                          )
                      }
                })
                
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                'Cancelado',
                'La Presentacion '+nombre+' no fue borrado',
                'error'
                  )
            }
          })
    })

    $(document).on('click', '.editar-pre', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('preId');
        const nombre = $(elemento).attr('prenombre');
        $('#id_editar_pre').val(id);
        $('#nombre-presentacion').val(nombre);
        edit = true;
    })

});
