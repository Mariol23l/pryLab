$(document).ready(function () {
    var funcion = '';
    var id_usuario = $('#id_usuario').val();
    var edit = false;
    buscar_usuario(id_usuario);
    function buscar_usuario(dato) {
        funcion = 'buscar_usuario';
        $.post('../controlador/UsuarioController.php', { dato, funcion }, (response) => {
            let nombre = '';
            let apellidos = '';
            let edad = '';
            let dni = '';
            let tipo = '';
            let telefono = '';
            let residencia = '';
            let correo = '';
            let sexo = '';
            let adicional = '';
            const usuario = JSON.parse(response);
            nombre += `${usuario.nombre}`;
            apellidos += `${usuario.apellidos}`;
            edad += `${usuario.edad}`;
            dni += `${usuario.dni}`;
            if (usuario.tipo=='Root') {
                tipo += `<h1 class="badge badge-danger">${usuario.tipo}</h1>`;
            }else if (usuario.tipo=='Administrador') {
                tipo += `<h1 class="badge badge-warning">${usuario.tipo}</h1>`;
            } else {
                tipo += `<h1 class="badge badge-info">${usuario.tipo}</h1>`;
            }
            telefono += `${usuario.telefono}`;
            residencia += `${usuario.residencia}`;
            correo += `${usuario.correo}`;
            sexo += `${usuario.sexo}`;
            adicional += `${usuario.adicional}`;
            $('#nombre_us').html(nombre);
            $('#apellidos_us').html(apellidos);
            $('#edad').html(edad);
            $('#dni_us').html(dni);
            $('#us_tipo').html(tipo);
            $('#telefono_us').html(telefono);
            $('#residencia_us').html(residencia);
            $('#correo_us').html(correo);
            $('#sexo_us').html(sexo);
            $('#adicional_us').html(adicional);
            $('#avatar1').attr('src', usuario.avatar);
            $('#avatar2').attr('src', usuario.avatar);
            $('#avatar3').attr('src', usuario.avatar);
            $('#avatar4').attr('src', usuario.avatar);
        })
    }
    //caputrar envento click
    //captura clase .clase
    //capturar id #id
    $(document).on('click', '.edit', (e) => {
        funcion = 'capturar_datos';
        edit = true;
        $.post('../controlador/UsuarioController.php', { funcion, id_usuario }, (response) => {
            const usuario = JSON.parse(response);
            $('#telefono').val(usuario.telefono);
            $('#residencia').val(usuario.residencia);
            $('#correo').val(usuario.correo);
            $('#sexo').val(usuario.sexo);
            $('#adicional').val(usuario.adicional);
        })
    });
    //guarda datos desde un form
    $('#form-usuario').submit(e => {
        let mybutton = document.getElementById("enviar");
        if (edit == true) {
            let telefono = $('#telefono').val();
            let residencia = $('#residencia').val();
            let correo = $('#correo').val();
            let sexo = $('#sexo').val();
            let adicional = $('#adicional').val();
            funcion = 'editar_usuario';
            $.post('../controlador/UsuarioController.php', { id_usuario, funcion, telefono, residencia, correo, sexo, adicional }, (response) => {
                if (response == 'editado') {
                    mybutton.disabled = true;
                    setTimeout(function () {
                        mybutton.disabled = false;
                    }, 2000)
                    $('#editado').hide('slow');
                    $('#editado').show(1000);
                    $('#editado').hide(2000);
                    $('#form-usuario').trigger('reset');
                }
                edit = false;
                buscar_usuario(id_usuario);
            })
        } else {
            mybutton.onclick = function () {
                if (edit == false) {
                    mybutton.disabled = true;
                    setTimeout(function () {
                        mybutton.disabled = false;
                    }, 3000)
                    $('#noeditado').hide('slow');
                    $('#noeditado').show(1000);
                    $('#noeditado').hide(2000);
                    $('#form-usuario').trigger('reset');
                }
            }
        }
        e.preventDefault();
    });
    $('#form-pass').submit(e => {
        let oldpass = $('#oldpass').val();
        let newpass = $('#newpass').val();
        funcion = 'cambiar_contra';
        $.post('../controlador/UsuarioController.php', { id_usuario, funcion, oldpass, newpass }, (response) => {
            if (response == 'update') {
                $('#update').hide('slow');
                $('#update').show(1000);
                $('#update').hide(2000);
                $('#form-pass').trigger('reset');
            } else {
                $('#noupdate').hide('slow');
                $('#noupdate').show(1000);
                $('#noupdate').hide(2000);
                $('#form-pass').trigger('reset');
            }
        })
        e.preventDefault();
    })

    $('#form-foto').submit(e => {
        let formData = new FormData($('#form-foto')[0]);
        $.ajax({
            url: '../controlador/UsuarioController.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
        }).done(function (response) {
            const $json = JSON.parse(response);
            if ($json.alert == 'edit') {
                $('#avatar1').attr('src', $json.ruta);
                $('#edit').hide('slow');
                $('#edit').show(1000);
                $('#edit').hide(2000);
                $('#form-foto').trigger('reset');
                buscar_usuario(id_usuario);  
            } else {
                $('#noedit').hide('slow');
                $('#noedit').show(1000);
                $('#noedit').hide(4000);
                $('#form-foto').trigger('reset');
            }

        });
        e.preventDefault();
    })
})
