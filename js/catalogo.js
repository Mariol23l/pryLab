$(document).ready(function () {
    $('#cat-carrito').show();
    buscar_lote();
    mostrar_lotes_riesgo();
    mostrar_fac_vencidas();
    function buscar_lote(consulta) {
        funcion = "buscar";
        $.post('../controlador/LoteController.php', { consulta, funcion }, (response) => {
            const lotes = JSON.parse(response);
            let template = '';
            lotes.forEach(lote => {
                template += `
            <div loteID="${lote.id}"  loteIdp="${lote.idp}" loteNombre="${lote.nombre}" lotePrecio="${lote.precio}"  lotePresentacion="${lote.presentacion}" loteLaboratorio="${lote.laboratorio}" loteStock="${lote.stock}" loteLote="${lote.lote}" loteVencimiento="${lote.vencimiento}"   class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
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
                      <h4 class="lead"><b><i class="fas fa-barcode mr-2"></i>${lote.lote}</b></h4>
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
                    <button class="agregar-carrito btn btn-sm bg-gradient-navy">
                    <i class="fas fa-plus mr-2"></i>Agregar al Carrito
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

    function mostrar_lotes_riesgo() {
        funcion = "buscar";
        $.post('../controlador/LoteController.php', { funcion }, (response) => {
            const lotes = JSON.parse(response);
            let template = '';
            lotes.forEach(lote => {
                if (lote.estado=='warning' || lote.estado=='danger') {
                    template += `
                <tr class="" style="text-align:center;">
                <td><b>${lote.id}</b></td>
                <td><b><h1 class="badge badge-${lote.estado}" style="border-radius:$radius; padding:0.3rem 1rem;font-size: 15px;">${lote.nombre}</h1></b></td>
                <td><b>${lote.stock}</b></td>
                <td><b>${lote.lote}</b></td>
                <td ><b><h1 class="badge badge-${lote.estado}" style="border-radius:$radius; padding:0.3rem 1rem;font-size: 15px;">${lote.vencimiento}</h1></b></td>
                <td><b>${lote.mes}</b></td>
                <td ><b>${lote.dia}</b></td>
                <td><b>${lote.laboratorio}</td>
                <td><b><h1 class="badge badge-${lote.estado}" style="border-radius:$radius; padding:0.3rem 1rem;font-size: 15px;">${lote.proveedor}</h1></b></td>
                <td><b>${lote.presentacion}</b></td>
                </tr>
                `;
                }              
            });
            $('#lot').html(template);
        })
    }
    function mostrar_fac_vencidas() {
        funcion = 'buscar_venta';
        $.post('../controlador/VentaController.php', { funcion }, (response) => {
            console.log(response);
             const ventas = JSON.parse(response);
            
             let template = '';
             ventas.forEach(venta => {
                 if (venta.estado=='warning' || venta.estado=='danger') {
                     template += `
                 <tr class="" style="text-align:center;">
                 <td><b>${venta.id}</b></td>
                 <td><b>${venta.ruc}</b></td>
                 <td><b>${venta.razsocial}</b></td>
                 <td><b><h1 class="badge badge-${venta.estado}" style="border-radius:$radius; padding:0.3rem 1rem; font-size: 15px;">${venta.formapago}</h1></b></td>
                 <td ><b><h1 class="badge badge-${venta.estado}" style="border-radius:$radius; padding:0.3rem 1rem;font-size: 15px;">${venta.total}</h1></b></td>
                 <td><b>${venta.fechaemision}</td>
                 <td ><b><h1 class="badge badge-${venta.estado}" style="border-radius:$radius; padding:0.3rem 1rem;font-size: 15px;">${venta.fechavencimiento}</h1></b></td>
                 <td><b>${venta.vendedor}</b></td>
            
                 </tr>
                 `;
                 }              
             });
             $('#fac').html(template);
         })
     }
    
})