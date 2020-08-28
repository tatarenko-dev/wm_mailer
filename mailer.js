$(document).ready(function(){
    /** 
     * Send email from contact forms
     */
    $(function () {
        if ($('.A--form-send-email').length <= 0) return;

        var errorFlag = false;
        var form = $(".A--form-send-email");
        $('.A--form-send-email .btn').on('click', function () {
            var form = $(this).closest('.A--form-send-email');
            form.find('input').removeClass('field-invalid');
            var phone = form.find('input[name="phone"]');
            var phoneNumber = phone.val();
    
            if ( ! validPhone(phoneNumber) ) {
                errorFlag = true;
                phone.addClass('field-invalid');
            } else {
                errorFlag = false;
            }
        })

        form.submit(function(event) {
            event.preventDefault();
            if (!errorFlag) {
                var currentForm = $(this);
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'mailer/mailer.php',
                    data: formData,
                    success: function(response){
                        console.log(response);
                        if (IsJsonString(response)) {
                            var responseObj = JSON.parse(response);
                            if (responseObj.status == 'success') {
                                currentForm.html(`
                                    <h3>Ваша заявка принята!</h3>
                                    <p style="font-size: 16px">Наши менеджеры с Вами свяжуться в ближайшее время!</p>
                                `);
                            }
                        }
                    }
                });
            }
        });

    });
});



function validPhone(phone) {
    var re = /^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/;
    var valid = re.test(phone);
    return valid;
}
function setNoSpamValue(element) {
    var inputCheck = $(element).closest('.A--form-send-email').find('input[name="check"]');
    if (inputCheck.length > 0) {
        inputCheck.val('no_spam');
    }
}

function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}