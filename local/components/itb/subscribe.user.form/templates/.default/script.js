document.addEventListener("DOMContentLoaded", function() {

    const form = document.querySelector('.js-subscibe-user-form');

    if(form){
        form.addEventListener('submit', function(e){
            e.preventDefault();
            const formData = new FormData(this);
            const email = formData.get('EMAIL');
            const botEmail = formData.get('email_confirm')

            BX.ajax.runComponentAction('itb:subscribe.user.form', 'updateSubscribe', {
                mode: 'class',
                data: {
                    EMAIL: email,
                    BOT_EMAIL: botEmail
                }
            }).then(function(response){
                if (response.data.success) {
                    form.classList.add('success');
                }else{
                    const errorMessage = response.errors ? response.errors.join(', ') : 'Произошла ошибка при отправке';
                    alert(errorMessage);
                }
            });

        });
    }

});