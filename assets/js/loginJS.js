$(document).ready(function(){
    $('#loginBtn').on('click', function () {
        bootbox.dialog({
            title: "Start Your Session",
            message: '<form action="index.html">' +
                '<div class="form-group">' +
                '<div class="input-group">' +
                '<div class="input-group-addon"><i class="fa fa-user"></i></div>' +
                '<input type="text" class="form-control" placeholder="Username">' +
                '</div>' +
                '</div>' +
                '<div class="form-group">' +
                '<div class="input-group">' +
                '<div class="input-group-addon"><i class="fa fa-asterisk"></i></div>' +
                '<input type="password" class="form-control" placeholder="Password">' +
                '</div>' +
                '</div>' +
                '<div class="row">' +
                '<div class="col-xs-8 text-left checkbox">' +
                '</div>' +
                '<div class="col-xs-4">' +
                '<div class="form-group text-right">' +
                '<button class="btn btn-success text-uppercase" type="submit">Sign In</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</form>',
            buttons: {
                success: {
                    label: "Save",
                    className: "btn-purple",
                    callback: function () {
                        var name = $('#name').val();
                        var answer = $("input[name='awesomeness']:checked").val();

                        $.niftyNoty({
                            type: 'purple',
                            icon: 'fa fa-check',
                            message: "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                            container: 'floating',
                            timer: 4000
                        });
                    }
                }
            }
        });

        $(".demo-modal-radio").niftyCheck();
    });

    $('#registerBtn').on('click', function () {
        bootbox.dialog({
            title: "This is a form in a modal.",
            message: 'another',
            buttons: {
                success: {
                    label: "Save",
                    className: "btn-purple",
                    callback: function () {
                        var name = $('#name').val();
                        var answer = $("input[name='awesomeness']:checked").val();

                        $.niftyNoty({
                            type: 'purple',
                            icon: 'fa fa-check',
                            message: "Hello " + name + ".<br> You've chosen <strong>" + answer + "</strong>",
                            container: 'floating',
                            timer: 4000
                        });
                    }
                }
            }
        });

        $(".demo-modal-radio").niftyCheck();
    });
})