$(document).ready(function () {
    $("#create_user_info").submit(function (e) {
        
        e.preventDefault();
        var user_pass = $("#user_pass").val().length;
        var form = jQuery("#create_user_info").serialize();
        var formData = new FormData;
        formData.append('action','insert_user_via_ajax');
        formData.append('insert_user_via_ajax',form);
        if (user_pass > 10) {
            $.ajax({
                type: "POST",
                processData : false,
                contentType: false,
                url: ajaxurl,
                data: formData,
                success: function (result) {
                    alert(result.data);
                    $('<style>#geeks1_space_no_space { color: green; }</style>').appendTo('body');
                    $("#geeks1_space_no_space").text("User Account Created Successfully.");
                    $('#create_user_info')[0].reset();
                },
                error: function (response) {
                    alert("Some Thing is wrong");
                }
    
            });
        }
        else if(user_pass >= 1 && user_pass <= 10){
            $('<style>#geeks1_space_no_space { color: orange; }</style>').appendTo('body');
            $("#geeks1_space_no_space").text("Password is too weak please add more than 10 letters");

        }
        else if(user_pass == ''){
            $('<style>#geeks1_space_no_space { color: red; }</style>').appendTo('body');
            $("#geeks1_space_no_space").text("Please add the password.");

            // $("#geeks1_space_no_space").text("Password is medium secure please add more than 10 letters");
        }
     


       
        
    });
});

