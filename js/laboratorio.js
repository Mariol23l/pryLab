$(document).ready(function () {
    buscar_lab();
    var edit = false;
    var funcion;
    $("#form-crear-laboratorio").submit((e) => {
        let nombre_laboratorio = $("#nombre-laboratorio").val();
        let id_editado = $("#id_editar_lab").val();
        if (edit==false) {
            funcion = 'crear';
        } else {
            funcion='editar'
        }
        
        $.post("../controlador/LaboratorioController.php",{ nombre_laboratorio, id_editado,funcion },(response) => {
                if (response == "add") {
                    $("#add-lab").hide("slow");
                    $("#add-lab").show(1000);
                    $("#add-lab").hide(2000);
                    $("#form-crear-laboratorio").trigger("reset");
                    buscar_lab();
                }   if (response == "noadd"){
                    $("#noadd-lab").hide("slow");
                    $("#noadd-lab").show(1000);
                    $("#noadd-lab").hide(2000);
                    $("#form-crear-laboratorio").trigger("reset");
            }   if (response=='edit') {
                    $("#edit-lab").hide("slow");
                    $("#edit-lab").show(1000);
                    $("#edit-lab").hide(2000);
                    $("#form-crear-laboratorio").trigger("reset");
                    buscar_lab();
            }
            edit = false;
            }
        );
        e.preventDefault();
    });
    function buscar_lab(consulta) {
        funcion = "buscar";
        $.post("../controlador/LaboratorioController.php",{ consulta, funcion },(response) => {
                const laboratorios = JSON.parse(response);
                let template = "";
                laboratorios.forEach((laboratorio) => {
                    template += `
                <tr labId="${laboratorio.id}" labnombre="${laboratorio.nombre}" labavatar="${laboratorio.avatar}" style="text-align:center"><b>   
                <td style="vertical-align: middle">
                        <button class="avatar btn btn-info" title="Cambiar Logo Laboratorio" type="button" data-toggle="modal" data-target="#cambiologo">
                            <i class="far fa-image"></i>
                        </button>
                        <button class="editar btn btn-success" title="Editar Laboratorio  type="button" data-toggle="modal" data-target="#crearlaboratorio"">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <button class="borrar btn btn-danger" title="Borrar Laboratorio">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                    <td >
                            <img src="${laboratorio.avatar}" alt="" class="img-fluid rounded" width="70" height="70">
                        </td>
                    <td style="text-transform:uppercase; vertical-align: middle" ><b> ${laboratorio.nombre}</b></td>
                        
                    
                </tr>
                `;
                });
                $("#laboratorios").html(template);
            }
        );
    }
    $(document).on("keyup", "#buscar-laboratorio", function () {
        let valor = $(this).val();
        if (valor != "") {
            buscar_lab(valor);
        } else {
            buscar_lab();
        }
    });

    $(document).on('click', '.avatar', (e) => {
        funcion = "cambiar_logo";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('labId');
        const nombre = $(elemento).attr('labnombre');
        const avatar = $(elemento).attr('labavatar');
        $('#logoactual').attr('src', avatar);
        $('#nombre_logo').html(nombre);
        $('#funcion').val(funcion);
        $('#id_logo_lab').val(id);
    })

    $('#form-logo').submit(e => {
        let formData = new FormData($('#form-logo')[0]);
        $.ajax({
            url: '../controlador/LaboratorioController.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
        }).done(function (response) {
            const json = JSON.parse(response);
            if (json.alert == 'edit') {
                $('#logoactual').attr('src', json.ruta);
                $("#editlogo").hide("slow");
                $("#editlogo").show(1000);
                $("#editlogo").hide(2000);
                $("#form-logo").trigger("reset");
                buscar_lab();
            } else {
                    $("#noeditlogo").hide("slow");
                    $("#noeditlogo").show(1000);
                    $("#noeditlogo").hide(2000);
                    $("#form-logo").trigger("reset");
            }
        });
        e.preventDefault();
    })

    $(document).on('click', '.borrar', (e) => {
        funcion = "borrar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('labId');
        const nombre = $(elemento).attr('labnombre');
        const avatar = $(elemento).attr('labavatar');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
          })
          
          swalWithBootstrapButtons.fire({
            title: 'Desea eliminar el Laboratorio '+nombre+'?',
            text: "No podras revertir esto!",
              imageUrl: ''+avatar+'',
              imageWidth: 100,
              imageHeight:100,
            showCancelButton: true,
            confirmButtonText: 'Si, borrar esto!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
          }).then((result) => {
              if (result.isConfirmed) {
                  $.post('../controlador/LaboratorioController.php', { id, funcion }, (response) => {
                      edit = false;
                      if (response=='borrado') {
                          swalWithBootstrapButtons.fire(
                              'Borrado!',
                              'El laboratorio ' + nombre + ' ha sido eliminado con exito.',
                              'success'                           
                          )
                          buscar_lab();
                      } else {
                        swalWithBootstrapButtons.fire(
                            'No se pudo borrar!!',
                            'El laboratorio '+nombre+' no fue borrado porque esta siendo usado en un producto',
                            'error'
                          )
                      }
                })
                
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                'Cancelado',
                'El Laboratorio '+nombre+' no fue borrado',
                'error'
                  )
            }
          })
    })

    $(document).on('click', '.editar', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('labId');
        const nombre = $(elemento).attr('labnombre');
        $('#id_editar_lab').val(id);
        $('#nombre-laboratorio').val(nombre);
        edit = true;
    })

});
