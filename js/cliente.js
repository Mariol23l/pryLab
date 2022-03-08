$(document).ready(function () {
    var funcion;
    var edit = false;
    buscar_cliente();
    $('#form-crearcli').submit(e => {
        let id = $('#id_edit_cli').val();
        let ruc = $('#ruc_cli').val();
        let razsocial = $('#razsocial_cli').val();
        let contacto = $('#contacto_cli').val();
        let telefono = $('#telefono_cli').val();
        let correo = $('#correo_cli').val();  
        let direccion = $('#direccion_cli').val();  
        if (edit==true) {
            funcion = 'editar';
        } else {
            funcion = 'crear';
        }
        $.post('../controlador/ClienteController.php', { id, ruc, razsocial,contacto, telefono, correo, direccion, funcion }, (response) => {
           if (response=='add') {
                $('#addcli').hide('slow');
                $('#addcli').show(1000);
                $('#addcli').hide(2000);
                $('#form-crearcli').trigger('reset');
               buscar_cliente();
           } else if (response == 'edit') {
                $('#editcli').hide('slow');
                $('#editcli').show(1000);
                $('#editcli').hide(2000);
               $('#form-crearcli').trigger('reset');            
               buscar_cliente();
           } else {
                $('#noaddcli').hide('slow');
                $('#noaddcli').show(1000);
                $('#noaddcli').hide(2000);
                $('#form-crearcli').trigger('reset');
            }
            edit = false;
        });
        e.preventDefault();
    });

    function buscar_cliente(consulta) {
        funcion = 'buscar';
        $.post('../controlador/ClienteController.php', { funcion, consulta }, (response) => {
            const clientes = JSON.parse(response);
            let template = '';
            clientes.forEach(cliente => {
                template += `
                <div cliId="${cliente.id}" cliRuc="${cliente.ruc}" cliRazsocial="${cliente.razsocial}" cliContacto="${cliente.contacto}" cliTelefono="${cliente.telefono}" cliCorreo="${cliente.correo}" cliDireccion="${cliente.direccion}" cliAvatar="${cliente.avatar}" class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
 
              <div class="card bg-light d-flex flex-fill">
                <div class="card-header  border-bottom-0">
                  <h1 class="badge bg-maroon text-navy">Clinica</h1>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>${cliente.ruc}</b></h2>
                      <ul class="ml-4 mb-0 fa-ul">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> RazonSocial: ${cliente.razsocial}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Contacto : ${cliente.contacto}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Telefono : ${cliente.telefono}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> Correo : ${cliente.correo}</li>
                        <li class="small"><span class="fa-li"><i class="fas fa-map-marker-alt"></i></span> Direccion : ${cliente.direccion}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${cliente.avatar}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="avatar btn btn-sm bg-teal mr-1" title="Editar logo" type="button" data-toggle="modal" data-target="#cambiologo">
                      <i class="fas fa-image"></i>
                    </button>
                    <button class="editar btn btn-sm bg-info mr-1" title="Editar cliente" data-toggle="modal" data-target="#crearcliente">
                      <i class="fas fa-pencil"></i>
                    </button>
                    <button class="borrar btn btn-sm bg-maroon mr-1" title="Borra cliente">
                      <i class="fas fa-trash"></i>
                    </button>
          
                    </a>
                  </div>
                </div>
              </div>
            </div>
                `;
            });
            $('#cliente').html(template);
        });
    } 
    $(document).on('keyup', '#buscar_cliente', function () {
        let valor = $(this).val();
        if (valor!='') {
            buscar_cliente(valor);
        } else {
            buscar_cliente();
        }
    });

    $(document).on('click', '.avatar', (e) => {
        funcion = 'cambiar_logo';
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('cliId');
        const razsocial = $(elemento).attr('cliRazsocial');
        const avatar = $(elemento).attr('cliAvatar');

        $('#logoactual').attr('src',avatar);
        $('#nombre_logo').html(razsocial);
        $('#id_edit_cli').val(id);
        $('#funcion').val(funcion);
        $('#avatar').val(avatar);
    });


    $(document).on('click', '.editar', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('cliId');
        const ruc = $(elemento).attr('cliRuc');
        const razsocial = $(elemento).attr('cliRazsocial');
        const contacto = $(elemento).attr('cliContacto');
        const telefono = $(elemento).attr('cliTelefono');
        const correo = $(elemento).attr('cliCorreo');
        const direccion = $(elemento).attr('cliDireccion');
        $('#id_edit_cli').val(id);
        $('#ruc_cli').val(ruc);
        $('#razsocial_cli').val(razsocial);
        $('#contacto_cli').val(contacto);
        $('#telefono_cli').val(telefono);
        $('#correo_cli').val(correo);
        $('#direccion_cli').val(direccion);
        edit = true;
    });


    $('#form-logo').submit(e => {
        let formData = new FormData($('#form-logo')[0]);
        $.ajax({
            url: '../controlador/ClienteController.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function (response) {
            const json = JSON.parse(response);  
            if (json.alert == 'edit') {          
                $('#logoactual').attr('src', json.ruta);
                $('#edit-cli').hide('slow');
                $('#edit-cli').show(1000);
                $('#edit-cli').hide(2000);
                $('#form-logo').trigger('reset');
                buscar_cliente();
            } else {
                $('#noedit-cli').hide('slow');
                $('#noedit-cli').show(1000);
                $('#noedit-cli').hide(2000);
                $('#form-logo').trigger('reset');              
            }
        });
        e.preventDefault();
    });

    $(document).on('click', '.borrar', (e) => {
        funcion = "borrar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('cliId');
        const razsocial = $(elemento).attr('cliRazsocial');
        const avatar = $(elemento).attr('cliAvatar');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
        })
          
        swalWithBootstrapButtons.fire({
            title: 'Desea eliminar a la clinica ' + razsocial + '?',
            text: "No podras revertir esto!",
            imageUrl: '' + avatar + '',
            imageWidth: 100,
            imageHeight: 100,
            showCancelButton: true,
            confirmButtonText: 'Si, borrar esto!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controlador/ClienteController.php', { id, funcion }, (response) => {
                    if (response == 'borrado') {
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'La clinica ' + razsocial + ' ha sido eliminado con exito.',
                            'success'
                        )
                        buscar_cliente();
                    } else {
                        swalWithBootstrapButtons.fire(
                            'No se pudo borrar!!',
                            'La clinica' + razsocial + ' no fue borrado porque esta siendo usada en el registro de ventas',
                            'error'
                        )
                    }
                })
                
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'La clinica ' + razsocial + ' no fue borrado',
                    'error'
                )
            }
        })
    });

});