<?php
include_once 'Venta.php';
include_once 'VentaProducto.php';

function getHtml($id_venta){
    $venta= new venta();
    $venta_producto= new ventaProducto();
    $venta->buscar_id($id_venta);
    $venta_producto->buscar_detVenta($id_venta);
    $plantilla='
    <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../img/logo.png" width="100" height="100">
      </div>
      <h1>COMPROBANTE DE PAGO</h1>
      <div id="company" class="clearfix">
        <div id="negocio"><b>DISTRIBUIDORA E IMPORTADORA MERLYN S.A.</b></div>
        <div><b>Direccion Numero ###,</b><br /><b>LIMA M.-LIMA</b></div>
        <div><b>(344) 342234</b></div>
        <div><a href="mailto:company@example.com"><b>company@example.com</b></a></div>
      </div>';
      foreach ($venta->objetos as $objeto) {

        $plantilla.='
    
        <div id="project">
          <div><b><span>Codigo de Venta: </span>'.$objeto->id_venta.'</b></div>
          <div><b><span>Forma de Pago: </span>'.$objeto->formapago.'</b></div>
          <div><b><span>Razon Social: </span>'.$objeto->razsocial.'</b></div>
          <div><b><span>Ruc:</span>'.$objeto->ruc.'</b></div>
          <div><b><span>Fecha y Hora: </span>'.$objeto->fecha.'</b></div>
          <div><b><span>Vendedor:</span>'.$objeto->vendedor.'</b></div>
        </div>';
        }
        $plantilla.='
        </header>
        <main>
          <table>
            <thead>
              <tr>      
                <th class="service">Producto</th>
                <th class="service">Lote</th>
                <th class="service">Vencimiento</th>
                <th class="service">Concentracion</th>
                <th class="service">Laboratorio</th>
                <th class="service">Presentacion</th>
                <th class="service">Cantidad</th>
                <th class="service">PrecioVenta</th>
                <th class="service">Subtotal</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($venta_producto->objetos as $objeto) {
         
                $plantilla.='<tr>
                  .$ob
                  <td class="servic">'.$objeto->nombre.'</td>           
                  <td class="servic">'.$objeto->lote.'</td>
                  <td class="servic">'.$objeto->vencimiento.'</td>
                  <td class="servic">'.$objeto->concentracion.'</td>
                  <td class="servic">'.$objeto->laboratorio.'</td>
                  <td class="servic">'.$objeto->presentacion.'</td>
                  <td class="servic">'.$objeto->cantidad.'</td>
                  <td class="servic">'.$objeto->preventa.'</td>
                  <td class="servic">S/'.$objeto->subtotal.'</td>
                </tr>';
              }
              $calculos= new Venta();
              $calculos->buscar_id($id_venta);
              foreach ($calculos->objetos as $objeto) {
                $igv=$objeto->total*0.18;
                $sub=$objeto->total-$igv;
                
                $plantilla.='
                <tr>
                  <td colspan="8" class="grand total">SUBTOTAL</td>
                  <td class="grand total">S/.'.$sub.'</td>
                </tr>
                <tr>
                  <td colspan="8" class="grand total">IGV(18%)</td>
                  <td class="grand total">S/.'.$igv.'</td>
                </tr>
                <tr>
                  <td colspan="8" class="grand total">TOTAL</td>
                  <td class="grand total">S/.'.$objeto->total.'</td>
                </tr>';
      
              }
             $plantilla.='
              </tbody>
            </table>
            <div id="notices">
              <div>NOTICE:</div>
              <div class="notice">*Presentar este comprobante de pago para cualquier reclamo o devolucion.</div>
              <div class="notice">*El reclamo procedera dentro de las 24 horas de haber hecho la compra.</div>
              <div class="notice">*Si el producto esta dañado o abierto, la devolucion no procedera.</div>
              <div class="notice">*Revise su producto cuando se le entregue.</div>
            </div>
          </main>
          <footer>
            Created by Merlyn
          </footer>
        </body>';
          
          return $plantilla;
}
?>