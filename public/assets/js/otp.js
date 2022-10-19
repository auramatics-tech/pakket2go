var send_pin = 1;

window.onload = function () {
    render();
    timer();
    if (!otp_sent_at) {
        phoneSendAuth(phone_number)
        update_otp_sent_at();
    }
};
function render() {
    const firebaseConfig = {
        apiKey: "AIzaSyCSuGIysBHM_tBsqk-y1Xm5BEzS4JZyf6A",
        authDomain: "slimpakket.firebaseapp.com",
        projectId: "slimpakket",
        storageBucket: "slimpakket.appspot.com",
        messagingSenderId: "285421403773",
        appId: "1:285421403773:web:3320ef916786fc7f7dbb14"
    };
    firebase.initializeApp(firebaseConfig);
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
        'size': 'invisible',
        'callback': (response) => {
            // reCAPTCHA solved, allow signInWithPhoneNumber.
            phoneSendAuth(phone_number);
        }
    });
    recaptchaVerifier.render();
}

function phoneSendAuth(phone_number) {
    console.log(phone_number, send_pin)
    if (phone_number && send_pin) {
        send_pin = 0;
        firebase.auth().signInWithPhoneNumber('+' + phone_number, window.recaptchaVerifier).then(function (confirmationResult) {
            window.confirmationResult = confirmationResult;
            coderesult = confirmationResult;
            console.log(coderesult);
            return true;
        }).catch(function (error) {
            console.log(error);
            $("#error").text(error.message);
            $("#error").show();
            return false;
        });
    }
}

function codeverify() {
    var otp = '';
    $('.su_otp_inputs').each(function () {
        otp = otp + $(this).val();
    })
    console.log(otp);
    coderesult.confirm(otp).then(function (result) {
        var user = result.user;
        verify_otp()
        window.location.href = BASEURL + '/' + $('meta[name="locale"]').attr('content') + '/home'
    }).catch(function (error) {
        $("#valid_otp").show()
    });
}

$(document).on('click', '.resend', function () {
    phoneSendAuth(phone_number)
    minutesToAdd = 1;
    currentDate = new Date();
    countDownDate = new Date(currentDate.getTime() + minutesToAdd * 60000).getTime();
    update_otp_sent_at()
    timer()
})

function timer() {
    // Update the count down every 1 second
    var x = setInterval(function () {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds=
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        send_pin = 0;
        if (minutes < 10) {
            minutes = '0' + minutes
        }
        if (seconds < 10) {
            seconds = '0' + seconds
        }
        // Output the result in an element with id="demo"
        document.getElementById("su_Join_now_span").innerHTML = '<p class="su_Join_now">Resent PIN in <span class="su_Join_now_span">' + minutes + ":" + seconds + '</span></p>';

        // If the count down is over, write some text 
        if (distance < 0) {
            send_pin = 1;
            clearInterval(x);
            document.getElementById("su_Join_now_span").innerHTML = '<a class="su_Join_now_span resend" href="javascript:void(0);">Resend Code</a>';
        }
    }, 1000);
}

function verify_otp() {
    $.ajax({
        url: BASEURL + '/verify-otp',
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: $('#user_id').val()
        },
        success: function () {

        }
    })
}

function update_otp_sent_at() {
    $.ajax({
        url: BASEURL + '/update-otp',
        method: 'post',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            date: countDownDate,
            id: $('#user_id').val()
        },
        success: function () {

        }
    })
}