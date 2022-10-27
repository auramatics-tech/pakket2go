$(document).on("click", ".user_type", function () {

    $('.user_type').removeClass("active")
    $(this).addClass("active")
    console.log($(this).attr('data-other'))
    console.log($(this).attr('id'))
    $('#form_' + $(this).attr('data-other')).attr('checked', false)
    $('#form_' + $(this).attr('id')).attr('checked', true)

    $.ajax({
        url: BASEURL + '/load-register-form/' + $(this).attr('id'),
        method: 'get',
        success: function (data) {
            $('#register_form').html(data.form);
            phone_country_code()
            autocompletecn()
            $('input').focus(function () {
                $(this).parents('.form-group').addClass('focused');
            });
        }
    })
})

$(document).on('click', '.form-label', function () {
    $(this).closest('input').focus()
    $(this).closest('.form-group').addClass('focused');
})

$('input').focus(function () {
    $(this).parents('.form-group').addClass('focused');
});


$('input').blur(function () {
    var inputValue = $(this).val();
    if (inputValue == "") {
        $(this).removeClass('filled');
        $(this).parents('.form-group').removeClass('focused');
    } else {
        $(this).addClass('filled');
    }
})

function autocompletecn() {
    $("#kvkcompanyname").autocomplete({

        source: function (request, response) {
            $.ajax({
                url: BASEURL + '/' + "kvkautocomplete",
                data: {
                    searchval: decodeURI(request.term)
                },
                dataType: "json",
                beforeSend: function () {
                    console.log('calling');
                },
                success: function (data) {
                    console.log(data);

                    var resp = $.map(data, function (obj) {
                        return {
                            'label': obj.handelsnaam,
                            'value': obj
                        };
                    });

                    console.log(resp);
                    response(resp);
                },
                error: function (err) {
                    console.log(err);
                    $("#error").text(err.message);
                    $("#error").show();
                    $('#street').val('');
                    $('#kvknumber').val('');
                    $('#city').val('');
                    $('#zipcode').val('');
                    $('#housenumber').val('');
                    $('#houseletter').val('');
                }
            });
        },
        minLength: 4,
        select: function (event, ui) {
            // Set selection
            console.log(ui.item.value);
            $('#kvkcompanyname').val(ui.item.label).parents('.form-group').addClass(
                'focused');; // display the selected text
            $('#street').val(ui.item.value.straatnaam).parents('.form-group').addClass('focused');;
            $('#kvknumber').val(ui.item.value.kvkNummer).parents('.form-group').addClass('focused');;
            $('#city').val(ui.item.value.plaats).parents('.form-group').addClass('focused');

            $.ajax({
                url: BASEURL + '/' + "kvkbasicprofile",
                data: {
                    kvknumberis: ui.item.value.kvkNummer
                },
                dataType: "json",
                beforeSend: function () {
                    console.log('calling curl');
                },
                success: function (data) {
                    let alldata = data[0];
                    console.log(alldata);
                    $('#zipcode').val(alldata[0]['postcode']).parents('.form-group')
                        .addClass('focused');;
                    $('#housenumber').val(alldata[0]['huisnummer']).parents('.form-group')
                        .addClass('focused');;
                    $('#houseletter').val(alldata[0]['huisletter']).parents('.form-group')
                        .addClass('focused');;
                    jQuery(".loadermodal").hide();
                },
                error: function (err) {
                    console.log(err);
                    $("#error").text(err.message);
                    $("#error").show();
                }
            });
            return false;
        }
    });
}


if (user_type)
    $('input').parents('.form-group').addClass('focused');






if (user_type == 'courier')
    autocompletecn()
