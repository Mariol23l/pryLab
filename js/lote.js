$(document).ready(function () {
    $('.select2').select2()
    var funcion;
    buscar_lote();

    function buscar_lote(consulta) {
        funcion = "buscar";
        $.post('../controlador/LoteController.php', { consulta, funcion }, (response) => {
            const lotes = JSON.parse(response);
            let template = '';
            lotes.forEach(lote => {
                template += `
            <div loteID="${lote.id}" loteNombre="${lote.nombre}"loteStock="${lote.stock}" loteLote="${lote.lote}" loteVencimiento="${lote.vencimiento}"   class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
            <div class="card bg-${lote.estado} d-flex flex-fill" >
            <div style="text-align: right;"><h6>Codigo:${lote.id}</h6></div>
            <div style="position:absolute; top:0; left:0;"><h6><b>P.Venta : <i class="fa-solid fa-dollar-sign mb-2"></i>${lote.precio}</b></h6></div>

                <div class="card-header border-bottom-0">
                <i class="fas fa-lg fa-cubes mr-1"></i><b>${lote.stock}</b>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>Producto: ${lote.nombre}</b></h2>
                      <h6 class="lead "><b><i class="fas fa-barcode mr-2 "></i>${lote.lote}</b></h6>
                      <ul class="ml-4 mb-0 fa-ul">
                      <li class="small"><span class="fa-li"><i class="fas fa-lg fa-calendar-times"></i></span>Vencimiento: ${lote.vencimiento}</li>
                      <li class="small"><span class="fa-li"><i class="fa-solid fa-mortar-pestle"></i></span>Concentracion: ${lote.concentracion}</li>
                      <li class="small"><span class="fa-li"><i class="fa-solid fa-prescription-bottle-medical"></i></span>Adicional: ${lote.adicional}</li>
                      <li class="small"><span class="fa-li"><i class="fa-solid fa-pills"></i></span>Presentacion: ${lote.presentacion}</li>
                      <li class="small"><span class="fa-li"><i class="fa-solid fa-person-dots-from-line"></i></span>Laboratorio: ${lote.laboratorio}</li>
                      <li class="small"><span class="fa-li"><i class="fa-solid fa-truck"></i></span>Proveedor: ${lote.proveedor}</li>
                      <li class="small"><span class="fa-li"><i class="fa-solid fa-copyright"></i></span>Tipo: ${lote.tipo}</li>
                      <li class="small"><span class="fa-li"><i class="fa-solid fa-calendar-alt"></i></span>Mes: ${lote.mes}</li>
                      <li class="small"><span class="fa-li"><i class="fa-solid fa-calendar-day"></i></span>Dia: ${lote.dia}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="${lote.avatar}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <button class="editar btn btn-sm bg-gradient-navy float-left" type="button" data-toggle="modal" data-target="#editarlote" title="Editar Datos del Lote">
                    <i class="fas fa-pencil-alt mr-2"></i> Editar Lote
                      </button>
                      <button class="borrar btn btn-sm bg-danger" title="Borrar lote">
                      <i class="fas fa-trash-alt" ></i>
                      </button>
                  </div>
                </div>
              </div>
            </div>
                `;

            });
            $('#lotes').html(template);
        });
    }

    $(document).on('keyup', '#buscar-lote', function () {
        let valor = $(this).val();
        if (valor != "") {
            buscar_lote(valor);
        } else {
            buscar_lote();
        }
    });

    $(document).on('click', '.editar', (e) => {
        funcion = "cambiar_avatar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;

        const nombre = $(elemento).attr('loteNombre');
        const id = $(elemento).attr('loteId');
        const stock = $(elemento).attr('loteStock');
        const lotelote = $(elemento).attr('loteLote');
        const lotevencimiento = $(elemento).attr('loteVencimiento');
        
        $('#nombre').val(nombre);
        $('#id_lote_prod').val(id);
        $('#codigo_lote').html(id);
        $('#stock').val(stock);
        $('#cod_lote').val(lotelote);
        $('#ven_lote').val(lotevencimiento);
        buscar_lote();
    });
    $('#form-editar-lote').submit(e => {
        let id = $('#id_lote_prod').val();
        let stocklote = $('#stock').val();
        let codigolote = $('#cod_lote').val();
        let venlote = $('#ven_lote').val();
        funcion = "editar";
        $.post('../controlador/LoteController.php', { id, stocklote, codigolote, venlote, funcion }, (response) => {
            $('#form-editar-lote').trigger('reset');
            $('#editarlote').modal('hide');
            if (response.includes('edit')) {                 
                Swal.fire({                
                    position: 'center',
                    icon: 'success',
                    title: 'Se edito Correcamente el Lote',
                    showConfirmButton: false,
                    timer: 1500
                })
                
            }
            buscar_lote();   
        })
        e.preventDefault();
    })

    $(document).on('click', '.borrar', (e) => {
        funcion = "borrar";
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('loteId');
        const lote=$(elemento).attr('loteLote')

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-2'
            },
            buttonsStyling: false
        })
          
        swalWithBootstrapButtons.fire({
            title: 'Desea eliminar el Lote ' + lote + '?',
            text: "No podras revertir esto!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Si, borrar esto!',
            cancelButtonText: 'No, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controlador/LoteController.php', { id, funcion }, (response) => {
                    edit = false;
                    console.log(response);
                    if (response.includes('borrado')) {
                        swalWithBootstrapButtons.fire(
                            'Borrado!',
                            'El Lote ' + lote + ' ha sido eliminado con exito.',
                            'success'
                        )
                        buscar_lote();
                    } else {
                        swalWithBootstrapButtons.fire(
                            'No se pudo borrar!!',
                            'El Lote' + lote + ' no fue borrado porque esta siendo usado',
                            'error'
                        )
                    }
                })
                
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'El Lote ' + lote + ' no fue borrado',
                    'error'
                )
            }
        })
    })

})