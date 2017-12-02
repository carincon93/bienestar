$(document).ready(function() {

    $('[data-toggle="tooltip"]').tooltip();

    $(function () {
        $('.tooltip-anadir').tooltip("show");
        $('.tooltip-anadir').find(".tooltip.fade.top").removeClass("in");
    });

    $('body').on('click', '.top-login', function (event) {
        event.preventDefault();
        $('form').find('input[name=email]').focus();
    });

    $modalSolicitud = $('#modalSolicitud');
    var request = null;
    var url = window.location.href.split("/");
    url = url[0] + "//" + url[2] + "/";

    $('.modal').on('shown.bs.modal', function () {
        $(this).find('[autofocus]').focus();
        $('.modal-body').click(function (event) {
            $(this).find('[autofocus]').focus();
        });
    });

    $('body').on('click', 'button[data-target="#modalSolicitud"]', function (event) {
        event.preventDefault();
        $id = $(this).attr('data-id');
        $nombre_aprendiz = $('button[data-target="#modalSolicitud"]').attr('data-nombre');
        $modalSolicitud.find('a[id="aceptarSolicitud"]').attr('href', url + 'admin/' + $id + '/solicitudaceptado');
        // $modalSolicitud.find('.modal-title').text('Nombre: ' + $nombre_aprendiz);
        // $modalSolicitud.find('a[id="cancelarSolicitud"]').attr('href', url + 'admin/' + $id + '/solicitudrechazado');
        $modalSolicitud.find('button[data-id]').attr('data-id', $id);
        $.get('obtener_solicitud', { id: $id }, function (data, textStatus, xhr) {
            $('#mbody-solicitud').html(data);
        });
    });

    $('body').on('click', 'button[id="rechazarSolicitud"]', function (event) {
        event.preventDefault();
        $('input[name="estado"]').val(0);
        setTimeout(function () {
            $('#solicitud').submit();
        }, 500);
    });
    $('body').on('click', 'button[id="aceptarSolicitud"]', function (event) {
        event.preventDefault();
        $('input[name="estado"]').val(1);
        setTimeout(function () {
            $('#solicitud').submit();
        }, 500);
    });

    /**
    * @author Cristian Vasquez
    * @description Evento que encarga de registrar en el historial la entrega del suplemento
    */
    // $('body').on('click', '#entregarSuplemento', function (event) {
    //     $id = $('#formEntrega').find('input[name=aprendiz_id]').val();
    //     $token = $('#formEntrega').find('input[name=_token]').val();
    //     $.post('/registro_historico/store/' + $id, { _token: $token, id: $id }, function (data, textStatus, xhr) {});
    // });


    /**
    * @author Cristian Vasquez
    * @description Evento que encarga de  buscar el aprendiz por el número de documento
    * @return Si se encuentra el aprendiz, la función retorna un htm donde esta el formulario con los datos del aprendiz
    *         Si no lo encuentra arroja mensaje de error
    */
    $('body').on('keyup', '#numero_documento', function (event) {
        event.preventDefault();
        var $numero_documento = $(this).val();
        if ($numero_documento > 0) {
            if (request != null) request.abort();

            request = $.get('/buscar_aprendiz', { numero_documento: $numero_documento }, function (data, textStatus, xhr) {
                if (data) {
                    $('.apprentice').html(data);
                } else {
                    $('.apprentice').text('El aprendiz no existe o su solicitud no ha sido aceptada aun!');
                }
            });
        } else {
            setTimeout(function () {
                // $('#resultado_instructor').children().remove();
            }, 500);
        }
    });
    $('body').on('click', '#buscar_aprendiz', function (event) {
        event.preventDefault();
        var $numero_documento = $('#numero_documento').val();
        if ($numero_documento > 0) {
            if (request != null) request.abort();

            request = $.get('/buscar_aprendiz', { numero_documento: $numero_documento }, function (data, textStatus, xhr) {
                if (data) {
                    $('#apprentice').html(data);
                } else {
                    $('#apprentice').text('El aprendiz no existe o su solicitud no ha sido aceptada aun!');
                }
            });
        }
    });

    // ======================== Truncate solicitudes - historial ========================================
    $('body').on('click', '.form-truncate-aprendiz', function (e) {
        e.preventDefault();
        var $formTruncFic = $(this),
        $modalTrun = $('#confirm-delete');
        $modalTrun.find('.modal-title').text('Eliminar todos los registros');
        $modalTrun.find('.modal-body').text('Va a eliminar todos los registros. ¿Está seguro que los desea eliminar?');
        $modalTrun.find('#btn-delete').text('Eliminar todo');
        $modalTrun.modal({ backdrop: 'static', keyboard: false }).on('click', '#btn-delete', function () {
            setTimeout(function () {
                $formTruncFic.submit();
            }, 500);
        });
    });

    // Eliminar registros - Modal eliminar
    $('.table-full').on('click', '.btn-delete-tbl', function (e) {
        e.preventDefault();
        var $formDel = $(this),
        $nombre_elemento = $formDel.attr('data-nombre');

        $('.modal').find('.modal-title').text('Nombre: ' + $nombre_elemento);
        $('.modal').find('.modal-body').text('Está seguro que desea eliminar este registro?');
        $('#btn-delete').text('Eliminar');
        $('#confirm-delete').modal({ backdrop: 'static', keyboard: false }).on('click', '#btn-delete', function () {
            $formDel.submit();
        });
    });
    $('#modalEntrega').on('hidden.bs.modal', function (e) {
        $(this)
        .find("input,textarea,select")
        .val('')
        .end()
        .find("input[type=checkbox], input[type=radio]")
        .prop("checked", "")
        .end();
    });
    // Búsqueda por fechas
    $('body').on('click', '.enviarfechas', function (event) {
        event.preventDefault();
        $inicio = $('input[name=inicio]').val();
        $fin = $('input[name=fin]').val();

        $('#formReporte').find('input[name=fechaInicio]').val($inicio);
        $('#formReporte').find('input[name=fechaFin]').val($fin);

        if ($inicio != 0 && $fin != 0) $('button[name="button-export-reporte"]').attr('disabled', false);else $('button[name="button-export-reporte"]').attr('disabled', true);

        $.get('datesearch', { inicio: $inicio, fin: $fin }, function (data, textStatus, xhr) {
            $('.history').html(data);
        });
    });

    $('body').on('click', '.reset', function (event) {
        $('input[name=inicio]').val("");
        $('input[name=fin]').val("");
        $(".enviarfechas").click();
    });

    /**
    * @author Cristian Vasquez
    * @description Evento que se encarga de setear la imágen con la inicial del nombre del usuario autenticado
    */
    var name = $('#nameUser').text();
    var $intials = $('#nameUser').text().charAt(0);
    $('#userImage').text($intials);

    /**
    * @author Cristian Vasquez
    * @description Cambiar color de iconos de fechas al dar clic en los input
    */
    $('input[name="inicio"], input[name="fin"]').focus(function () {
        $(this).parent().addClass('focus');
        $(this).css('border-color', '#ff9526');
    });
    $('input[name="inicio"], input[name="fin"]').blur(function () {
        $(this).parent().removeClass('focus');
        $(this).css('border-color', 'inherit');
    });

    setTimeout(function () {
        $(".alert-dismissible").addClass('fadeOutDown');
    }, 2000);
    setTimeout(function () {
        $(".alert-dismissible").css('display', 'none');
    }, 3000);

    $('button[name="button-import"]').attr('disabled', true);
    $('input[name="imported-file"]').change(function () {
        if ($(this).val().length != 0) $('button[name="button-import"]').attr('disabled', false);else $('button[name="button-import"]').attr('disabled', true);
    });

    $(window).on('load', function () {
        $('#modalSession').modal({ backdrop: 'static', keyboard: false });
    });

    $('#login').one('click',(function(event) {
        event.preventDefault();
        $(this).closest('form').submit();
        $(this).prop('disabled',true);
    }));

    $('body').on('click', 'button[data-target="#modalHistorial"]', function (event) {
        event.preventDefault();
        $id = $(this).attr('data-id');
        // $nombre_aprendiz = $('button[data-target="#modalHistorial"]').attr('data-nombre');
        // $('#modalHistorial').find('.modal-title').text('Nombre: ' + $nombre_aprendiz);
        $('#modalHistorial').find('button[data-id]').attr('data-id', $id);
        $.get('obtener_historial', { id: $id }, function (data, textStatus, xhr) {
            $('#mbody-Historial').html(data);
        });
    });

    $('#numero_documento').focus();

});
