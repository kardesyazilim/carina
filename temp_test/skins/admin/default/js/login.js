      $(document).ready(function() {
            $("input, textarea, select").not('.nostyle').uniform();
            $("#loginForm").validate({
                rules: {
                    username: {
                        required: true,
                        minlength: 4
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }  
                },
                messages: {
                    username: {
                        required: "{@USERNAMEERROREMPYT@}",
                        minlength: "{@USERNAMEERROR@}"
                    },
                    password: {
                        required: "{@USERPASSERROREMPYT@}",
                        minlength: "{@USERPASSERROR@}"
                    }
                }   
            });
        });