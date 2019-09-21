
function checkUsername(){

    var username = $('#username').val();

    if (username.length < 3 || username.length >15) {
        $('#username').next('.error-username').fadeIn().text("Votre pseudo doit avoir entre 3 et 15 caractères!");

    } else {
        var url = 'index.php?action=username&username='+username;
        $.get(
            url,
            function (d) {
                $('#username').next('.error-username').fadeIn().text(d);
                console.log(d);
            }
        );
    }
}

function checkEmail(){

    var email = $('#email').val();

    //verification de l'email
    if (email.length <10) {
        $('#error-email').fadeIn().text("Votre email doit avoir au moins 10 caractères!")

    }else{

        var url = 'index.php?action=email&email='+email;
        $.get(
            url,
            function (d) {
                $('#error-email').fadeIn().text(d);
                console.log(d);
            }
        );
    }
}


function checkLogin(){

    var username = $('#username').val();

    if (username.length < 3 || username.length >15) {
        $('#username').next('.error-username').fadeIn().text("Votre pseudo doit avoir entre 3 et 15 caractères!");

    } else {
        var url = 'index.php?action=login&login='+username;
        $.get(
            url,
            function (d) {
                $('#username').next('.error-username').fadeIn().text(d);
            }
        );
    }
}