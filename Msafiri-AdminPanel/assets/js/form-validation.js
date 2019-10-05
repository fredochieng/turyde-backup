$('#icon_validate').validate({
    errorElement: 'span',
    errorClass: 'error',
    focusInvalid: false,
    ignore: "",
    rules: {
        formfield1: {
            minlength: 2,
            required: true
        },
        formfield2: {
            required: true,
            email: true
        },
        formfield3: {
            required: true,
        },
        formfield4: {
            required: true,
        },
        formfield5: {           
            required: true,
        },
        formfield6: {
            minlength: 10,
            required: true,
        },
        formfield7: {
            required: true,
        },
        formfield7: {
            required: true,
        },
    },

    invalidHandler: function (event, validator) {
        //display error alert on form submit    
    },

    errorPlacement: function (error, element) { // render error placement for each input type
        var icon = $(element).parent().parent('.form-group').find('i');
        var parent = $(element).parent().parent('.form-group');
        icon.removeClass('fa fa-check').addClass('fa fa-times');
        parent.removeClass('has-success').addClass('has-error');
    },

    highlight: function (element) { // hightlight error inputs
        var parent = $(element).parent().parent('.form-group');
        parent.removeClass('has-success').addClass('has-error');
    },

    unhighlight: function (element) { // revert the change done by hightlight

    },

    success: function (label, element) {
        var icon = $(element).parent().parent('.form-group').find('i');
        var parent = $(element).parent().parent('.form-group');
        icon.removeClass("fa fa-times").addClass('fa fa-check');
        parent.removeClass('has-error').addClass('has-success');
    },

    submitHandler: function (form) {

    }
});