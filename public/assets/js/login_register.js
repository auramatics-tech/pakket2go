
$(document).on('click', '.registeration_type', function () {
    var to_active = $(this).attr('for');
    var type = $(this).attr('data-type');
    $(".registeration_type").removeClass('active');
    $(this).addClass('active');

    $('#' + to_active).show();
    $('#' + type).hide();
})
var phoneInput;

function phone_country_code() {
    const phoneInputField = document.querySelector("#phone");
    phoneInput = window.intlTelInput(phoneInputField, {
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        separateDialCode: true,
        initialCountry: 'NL'
    });

    var input = document.querySelector('#phone');
    input.addEventListener("countrychange", function () {
        var countryData = phoneInput.getSelectedCountryData();
        $('#country_code').val(countryData.dialCode);
    });
}

$(document).on('keyup', '#phone', function () {
    var error = phoneInput.isValidNumber();
    $('.invalid_number').remove();
    if (!error) {
        $(this).after('<span class="text-danger invalid_number">Invalid Phone Number</span>');
    } else {
        $('.invalid_number').remove();
    }
})

phone_country_code()