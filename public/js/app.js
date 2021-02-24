var UserManagment = function() {
    var showErrorMsg = function(form, type, msg) {
        var alert = $('<div class="alert alert-' + type + ' alert-dismissible" role="alert">\
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>\
			<span></span>\
		</div>');

        form.find('.alert').remove();
        alert.prependTo(form);
        //alert.animateClass('fadeIn animated');
        alert.find('span').html(msg);
    }

    var handleSaveUser = function() {
        $('#btn_submit_add_user').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    name: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    document: {
                        required: true,
                        number: true
                    },
                    document_type_id: {
                        required: true,
                        number: true
                    }
                },
                messages: {
                    email: "Este campo es requerido",
                    name: 'Este campo es requerido',
                    address: 'Este campo es requerido',
                    document: 'Número Inválido',
                    document_type_id: 'Este campo es requerido',
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.html('Un momento...').attr('disabled', true);

            form.ajaxSubmit({
                url: form.action,
                success: function(response, status, xhr, $form) {
                    // similate 2s delay
                    btn.html('Registrar Usuario').attr('disabled', false);
                    showErrorMsg(form, 'success', 'Usuario creado correctamente')
                    form[0].reset()
                },
                error: function(response, status, xhr, $form) {
                    // similate 2s delay
                    btn.html('Registrar Usuario').attr('disabled', false)
                    showErrorMsg(form, 'danger', 'Error al crear usuario')
                }
            });
        });
    }
    var handleUpdateUser = function() {
        $('#btn_submit_edit_user').click(function(e) {
            e.preventDefault();
            var btn = $(this);
            var form = $(this).closest('form');

            form.validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    name: {
                        required: true,
                    },
                    address: {
                        required: true,
                    },
                    document: {
                        required: true,
                        number: true
                    },
                    document_type_id: {
                        required: true,
                        number: true
                    }
                },
                messages: {
                    email: "Este campo es requerido",
                    name: 'Este campo es requerido',
                    address: 'Este campo es requerido',
                    document: 'Número Inválido',
                    document_type_id: 'Este campo es requerido',
                }
            });

            if (!form.valid()) {
                return;
            }

            btn.html('Un momento...').attr('disabled', true);


            form.ajaxSubmit({
                url: form.action,
                type: 'PUT',
                success: function(response, status, xhr, $form) {
                    btn.html('Guardar Cambios').attr('disabled', false);
                    showErrorMsg(form, 'success', 'Usuario actualizado correctamente')
                },
                error: function(response, status, xhr, $form) {
                    // similate 2s delay
                    btn.html('Guardar Cambios').attr('disabled', false)
                    showErrorMsg(form, 'danger', 'Error al actualizar información del usuario')
                }
            });
        });
    }
    var handleDeleteUser = function() {
        $(document).on('click', '.btn_submit_delete_user', function(e) {
            e.preventDefault();
            var btn = $(this);

            var bool = confirm("¿Desea eliminar el usuario?")

            if (bool) {
                btn.html('Un momento...').attr('disabled', true);
                $.ajax({
                    url: 'http://127.0.0.1:8000/users/' + btn.data('id'),
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response, status, xhr, $form) {
                        btn.html('Eliminar').attr('disabled', false);
                        location.reload();
                    },
                    error: function(response, status, xhr, $form) {
                        btn.html('Eliminar').attr('disabled', false)
                        alert('Error al actualizar información del usuario')
                    }
                });
            }

        });
    }
    var getUsers = function() {
        $.ajax({
            url: 'http://127.0.0.1:8000/getUsers',
            headers: {
                'api-key': '12345'
            },
            success: function(response) {
                var listaUsuarios = $("#users-list");
                $.each(response, function(index, value) {
                    listaUsuarios.append(
                        '<div class="card shadow border-0 mb-3 bg-white rounded"><div class="card-body"><div class="row">' +
                        '<div class="col-lg-8"><h5>' + value.name + '</h5>' +
                        '<p class="lead mb-0">' + value.address + ' - ' + value.email + '<br> <b>' + value.document_type.code + ':</b> ' + value.document + '</p></div>' +
                        '<div class="col-lg-4 pt-4"><a href="http://127.0.0.1:8000/users/' + value.id + '/edit" class="btn btn-info btn-lg float-right ml-2">Editar</a><button type="button" data-id="' + value.id + '" class="btn btn-danger btn-lg float-right btn_submit_delete_user">Eliminar</button></div></div>' +
                        '</div></div>'
                    );
                });
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }
        });
    }

    return {
        // public functions
        init: function() {
            getUsers();
            handleSaveUser();
            handleUpdateUser();
            handleDeleteUser();
        }
    };
}();

//== Class Initialization
jQuery(document).ready(function() {
    UserManagment.init();
});