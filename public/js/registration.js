

$(document).ready(function () {

    $('#registration').submit(function (e) {
        e.preventDefault();

        var errors = [];
        var username = $('.error-username').html();
        var email = $('#error-email').html();
        var password = $('#password').val();
        var password_confirm = $('#password_confirm').val();

        //verification du pseudo
        if (username !== 'Pseudo validé!' ) {
            errors.push("Pseudo utilisé!");
            $('.error-username').fadeIn().text("Choisissez un pseudo libre")

        }else {
            $('.error-username').fadeOut()
        }

        //verification du pseudo
        if (email !== 'Email validé!' ) {
            errors.push("Email utilisé!");
            $('#error-email').fadeIn().text("Choisissez un email libre")

        }else {
            $('#error-email').fadeOut()
        }

        //verification du mot de passe
        if (password.length < 8 ) {
            errors.push("Probleme de longueur de mot de passe ");
            $('#password').next('.error-message').fadeIn().text("Votre mot de passe doit avoir au moins 8 caractères!")

        }else {
            $('#password').next('.error-message').fadeOut()
        }

        //verification de la conformité du mot de passe
        if (password !== password_confirm) {
            errors.push('Probleme de confirmation de mot de passe ');
            $('#password_confirm').next('.error-message').fadeIn().text("Les deux mots de passe ne sont pas identiques!")
        } else {
            $('#password_confirm').next('.error-message').fadeOut()
        }


        if (errors.length > 0) {

            //Affichage des erreurs
            $('#notification').html( '<p class="alert alert-danger">Veuillez corriger les erreurs!</p>');

        } else {
            $.post(
                'index.php?action=checkInscription',
                $(this).serialize(),
                function (d) {
                    $('#notification').html( '<p class="alert alert-success">'+d+'</p>');

                }
            )
        }
    });

});
