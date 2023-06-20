$(document).ready(function () {
    
    $.validator.addMethod("validString", function(value, element) {
        /* allow any non-whitespace characters as the host part */
        /*return this.optional( element ) || /^[a-zA-Z0-9- ]*$/.test( value ); */
        return this.optional( element ) || /^[\u0621-\u064Aa-zA-Z0-9- ]*$/.test( value ); /* allow arabic characters as well */
    }, 'Your input string contains illegal characters.');
    /* check valid strong passsword start */
    $.validator.addMethod("pwdLength", function(value, element) {
        return this.optional( element ) || /^.{8,16}$/.test( value );
    },'Expect a password length between 8 and 16 characters.');
    $.validator.addMethod("pwdUpper", function(value, element) {
        return this.optional( element ) || /[A-Z]+/.test( value );
    }, 'Expect at least one uppercase character.');
    $.validator.addMethod("pwdLower", function(value, element) {
        return this.optional( element ) || /[a-z]+/.test( value );
    }, 'Expect at least one lowercase character.');
    $.validator.addMethod("pwdNumber", function(value, element) {
        return this.optional( element ) || /[0-9]+/.test( value );
    }, 'Expect a number.');
    $.validator.addMethod("pwdSpecial", function(value, element) {
        return this.optional( element ) || /[!@#$%^&()'[\]"?+-/*={}.,;:_]+/.test( value );
    }, 'Expect at least one special character: !@#$%^&()’[]”?+-/*');
    /* check valid strong passsword end */

    $.validator.addMethod('greaterThan', function(value, element) {
        var dateFrom = $("#mfg_date").val();
        var dateTo = $('#expiry_date').val();
        return dateTo >= dateFrom;
    }, 'Expiry Date Should be Greater Than Manufacturing Date.');

    $("#chk_login").validate({
        rules: {
            email: {
                required: true
            },
            password: {
                required: true
            }
        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#add_student_form").validate({
        rules: {
            name: {
                required: true,
                validString:true
            },
            email: {
                required: true,
                email:true
            },
            contact: {
                required: true,
                number: true
            },
            address: {
                required: true
            },
            subject_id: {
                required: true
            },
            is_active: {
                required: true
            }
        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#edit_student_form").validate({
        rules: {
            name: {
                required: true,
                validString:true
            },
            email: {
                required: true,
                email:true
            },
            contact: {
                required: true,
                number: true
            },
            address: {
                required: true
            },
            subject_id: {
                required: true
            },
            is_active: {
                required: true
            }
        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#update_user_form").validate({
        rules: {
            name: {
                required: true,
                validString:true
            },
            email: {
                required: true,
                email:true
            },
            contact_no: {
                required: true,
                number: true
            },
            address: {
                required: true
            }
        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#add_subject_form").validate({
        rules: {
            name: {
                required: true,
                validString:true
            },
            is_active: {
                required: true
            }
        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });

    
    $("#edit_subject_form").validate({
        rules: {
            name: {
                required: true,
                validString:true
            },
            is_active: {
                required: true
            }
        },
        messages: {

        },
        debug: true,
        errorElement: 'span',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error)
            } else {
                error.insertAfter(element);
            }
        }
    });
    
});
