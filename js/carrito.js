$(document).ready(function () {
    calcularTotal();
    recuperarls_venta_compra()
    contar_productos();
    recuperarls_venta();
    $(document).on('click', '.agregar-carrito', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement.parentElement.parentElement;
        const id = $(elemento).attr('loteId');
        const nombre = $(elemento).attr('loteNombre');
        const lotelote = $(elemento).attr('loteLote');
        const lotevencimiento = $(elemento).attr('loteVencimiento');
        const laboratorio = $(elemento).attr('loteLaboratorio');
        const precio = $(elemento).attr('lotePrecio');
        const presentacion = $(elemento).attr('lotePresentacion');
        const stock = $(elemento).attr('loteStock');
        const lote = {
            id: id,
            nombre: nombre,
            lote: lotelote,
            vencimiento: lotevencimiento,
            presentacion: presentacion,
            laboratorio: laboratorio,
            stocks: stock,
            cantidad: 1,
            precio: precio
            
        }
        let id_producto;
        let productos;
        productos = recuperarls();
        productos.forEach(prod => {
            if (prod.id === lote.id) {
                id_producto = prod.id;
            }
        });
        if (id_producto === lote.id) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El producto ' + nombre  + ' con el lote '+lotelote +' ya existe',
            })
        } else {
            template = `
        <tr prodId="${lote.id}">
            <td>${lote.id}</td>
            <td>${lote.nombre}</td>
            <td>${lote.lote}</td>
            <td>${lote.vencimiento}</td>
            <td>${lote.precio}</td>
            <td>${lote.laboratorio}</td>
            <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
        </tr>
        `;
            $('#lista_carrito').append(template);
            agregarls(lote);
            let contador;
            contar_productos();
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
              
            Toast.fire({
                icon: 'success',
                title: nombre + ' agregado'
            })
        }
    })

    $(document).on('click', '.borrar-producto', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('prodId')
        elemento.remove(elemento);
        eliminar_producto_ls(id);
        contar_productos();
        calcularTotal();
    })

    $(document).on('click', '#vaciar-carrito', (e) => {
        $('#lista_carrito').empty();
        eliminarls();
        contar_productos();

    })
    $(document).on('click', '#procesar-pedido', (e) => {
        procesar_Pedido()
    })

    $(document).on('click', '#procesar-compra', (e) => {
        procesar_Compra()
    })
    
    function recuperarls() {
        let productos;
        if (localStorage.getItem('productos') === null) {
            productos = [];
        } else {
            productos = JSON.parse(localStorage.getItem('productos'));
        }
        return productos
    }
    function agregarls(lote) {
        let productos;
        productos = recuperarls();
        productos.push(lote);
        localStorage.setItem('productos', JSON.stringify(productos));
    }
    function recuperarls_venta() {
        let productos, id_producto;
        productos = recuperarls();
        funcion = "buscar_id";
        productos.forEach(lote => {
            id_producto = lote.id;
            $.post('../controlador/ProductoController.php', { funcion, id_producto }, (response) => {
                let template_carrito = '';
                let json = JSON.parse(response);
                template_carrito = `
                                        <tr prodId="${json.id}">
                                        <td>${json.id}</td>
                                        <td>${json.nombre}</td>
                                        <td>${json.lote}</td>
                                        <td>${json.vencimiento}</td>
                                        <td>${json.precio}</td>
                                        <td>${json.laboratorio}</td>
                                        <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                                    </tr>
                `;
                $('#lista_carrito').append(template_carrito);
            })
        });
    }
    function eliminar_producto_ls(id) {
        let productos;
        productos = recuperarls();
        productos.forEach(function (lote, indice) {
            if (lote.id === id) {
                productos.splice(indice, 1);
            }
        });
        localStorage.setItem('productos', JSON.stringify(productos));
    }
    function eliminarls() {
        localStorage.clear();
    }

    function contar_productos() {
        let productos;
        let contador = 0;
        productos = recuperarls();
        productos.forEach(lote => {
            contador++;
        });
        $('#contador').html(contador);
    }

    function procesar_Pedido() {
        let productos;
        productos = recuperarls();
        if (productos.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El carrito esta vacio!',
            })
        } else {
            location.href = '../vista/adm_compra.php';
        }
    }

    function recuperarls_venta_compra1() {
        let productos, id_producto;
        productos = recuperarls();
        funcion = "buscar_id";
        productos.forEach(lote => {
            console.log(id_producto);
            $.post('../controlador/ProductoController.php', { funcion, id_producto }, (response) => {
                let template_compra = '';
                let json = JSON.parse(response);
                template_compra = `
                                    <tr prodId="${lote.id}" prodPrecio="${json.precio}">
                                                <td>${json.nombre}</td>
                                                <td>${json.lote}</td>
                                                <td>${json.stock}</td>
                                                <td>${json.vencimiento}</td>
                                                <td>${json.presentacion}</td>
                                                <td>${json.laboratorio}</td>          
                                                <td class="precio">
                                                <input id="prodPre" type="number" min="0" max="10" class="form-control cantidad_producto" value="${lote.precio}">
                                                </td>    
                                                <td>
                                                <input id="prodCantidad" type="number" min="0" max="10" class="form-control cantidad_producto" value="${lote.cantidad}">
                                                </td>
                                                <td class="subtotales">
                                                <h5>${parseFloat(lote.precio * lote.cantidad).toFixed(2)}</h5>
                                                </td>
                                                <td><button class="borrar-producto btn btn-danger"><i class="fas fa-times-circle"></i></button></td>
                                    </tr>
                `;
                $('#lista-compra').append(template_compra);
            })
        });
    }
    async function recuperarls_venta_compra() {
        let productos;
        productos = recuperarls();
        funcion = "traer_productos";

        const response = await fetch('../controlador/ProductoController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'funcion=' + funcion + '&&productos=' + JSON.stringify(productos)
        })
        let resultado = await response.text();
        $('#lista-compra').append(resultado);
    }
    /*
    $(document).on('click', '#actualizar', (e) => {
        let productos, precios;
        precios = document.querySelectorAll('.precio');
        productos = recuperarls();
        productos.forEach(function(lote,indice) {
            lote.precio = precios[indice].textContent;
        });
        localStorage.setItem('productos', JSON.stringify(productos));
        calcularTotal();
    })
    */
    //KEYUP Permite registrar eventos sirve para la tabla ADM_COMPRA

    $('#cpro').keyup((e) => {
        let id, cantidad, producto, productos, montos, precio;
        producto = $(this)[0].activeElement.parentElement.parentElement;
        id = $(producto).attr('prodId');
        // precio = $(producto).attr('prodPrecio');
        precio = producto.querySelector('#prodPre').value;
        cantidad = producto.querySelector('#prodCantidad').value;
        montos = document.querySelectorAll('.subtotales');
        productos = recuperarls();
        productos.forEach(function (prod, indice) {
            if (prod.id === id) {
                prod.cantidad = cantidad;
                prod.precio = precio;
                montos[indice].innerHTML = `<h5>${cantidad * precio}</h5>`
            }
        });
        localStorage.setItem('productos', JSON.stringify(productos));
        calcularTotal();

    })

    function calcularTotal() {
        let productos, subtotal, conigv, total_sin_descuento, pago, vuelto, descuento;
        let total = 0, igv = 0.18;
        productos = recuperarls();
        productos.forEach(producto => {
            let subtotal_producto = Number(producto.precio * producto.cantidad);
            total = total + subtotal_producto;
        });
        pago = $('#pago').val();
        descuento = $('#descuento').val();

        total_sin_descuento = total.toFixed(2);
        conigv = parseFloat(total * igv).toFixed(2);
        subtotal = parseFloat(total - conigv).toFixed(2);
        //total = total - descuento;
        vuelto = pago - total;
        $('#subtotal').html(subtotal);
        $('#con_igv').html(conigv);
        $('#total_sin_descuento').html(total_sin_descuento);
        $('#total').html(total.toFixed(2));
        $('#vuelto').html(vuelto.toFixed(2));
        
    }

    function procesar_Compra() {
        let ruc, razsocial,formapago,combo;
        ruc = $('#ruc_cliente').val();
        razsocial = $('#razsocial_cliente').val();
        combo = document.getElementById("formapago");
        formapago = combo.options[combo.selectedIndex].text;          
        if (recuperarls().length == 0) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No hay productos Seleccione algunos!',
            }).then(function () {
                location.href = '../vista/adm_catalogo.php';
            })
        } else if (ruc == '') {       
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Necesitamos un cliente!',
            })
        } else {
            verificar_Stock().then(error => {
                if (error == 0) {
                    Registrar_cotizacion(ruc, razsocial,formapago);
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Se realizo la compra',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function () {
                        location.href = '../vista/adm_catalogo.php';
                        eliminarls();
                    })
                } else {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Hay conflicto en el Stock de algun Producto',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
        }
    }

    async function verificar_Stock() {
        let productos;
        funcion = 'verificar_stock';
        productos = recuperarls();
        const response = await fetch('../controlador/ProductoController.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'funcion=' + funcion + '&&productos=' + JSON.stringify(productos)
        })
        let error = await response.text();
        return error;
    }


    $(document).on('keypress', '#ruc_cliente', function (e) {
        let valor = $(this).val();
        if (valor != '' && e.which == 13) {
            buscar_cliente(valor);           
        } else {
            $('#razsocial_cliente').val('');
            $('#direccion_cliente').val('');
        }
    });

    function buscar_cliente(consulta) {
        funcion = 'buscar_cliente';
        $.post('../controlador/ClienteController.php', { funcion, consulta }, (response) => {
            const clientes = JSON.parse(response);
            template = '';
            clientes.forEach(cliente => {          
                ($('#razsocial_cliente').val(cliente.razsocial));
                $('#direccion_cliente').val(cliente.direccion);               
            });
            
        });
    }

    function Registrar_cotizacion(ruc, razsocial,formapago) {
        funcion = 'registrar_compra';
        let total = $('#total').get(0).textContent;
        let productos = recuperarls();
        let json = JSON.stringify(productos);
        $.post('../controlador/CompraController.php', { funcion, total, ruc, razsocial, json ,formapago}, (response) => {
            console.log(response);
        })
    }
});