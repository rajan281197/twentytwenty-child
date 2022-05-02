$(document).ready(function () {
    $("#create_push_info").submit(function (e) {
        
        e.preventDefault();
        var form = jQuery("#create_push_info").serialize();
        var formData = new FormData;
        formData.append('action','insert_push_value_via_ajax');
        formData.append('insert_push_value_via_ajax',form);
        $.ajax({
            type: "POST",
            processData : false,
            contentType: false,
            url: ajaxurl,
            data: formData,
            success: function (result) {
                alert(result.data);
                $('<style>#geeks1_space_no_space { color: green; }</style>').appendTo('body');
                $("#geeks1_space_no_space").text("Data Inserted Successfully.");
                $('#create_push_info')[0].reset();
            },
            error: function (response) {
                alert("Some Thing is wrong");
                $('<style>#geeks1_space_no_space { color: red; }</style>').appendTo('body');
                $("#geeks1_space_no_space").text("Some Thing is wrong.");
            }

        });
    });
});

