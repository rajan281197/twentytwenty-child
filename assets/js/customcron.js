$(document).ready(function () {
    $("#form_data_info").submit(function (e) {
        
        e.preventDefault();
        var form = jQuery("#form_data_info").serialize();
        var formData = new FormData;
        formData.append('action','insert_post_via_cron');
        formData.append('insert_post_via_cron',form);
        $.ajax({
            type: "POST",
            processData : false,
            contentType: false,
            url: ajaxurl,
            data: formData,
            success: function (result) {
                alert(result.data);
                $('#form_data_info')[0].reset();
            },
            error: function (response) {
                alert("Some Thing is wrong");
            }

        });
    });
});

