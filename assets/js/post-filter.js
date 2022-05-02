$(document).ready(function () {
    $("#post_filter_form_wp").submit(function (e) {
        // alert("hello world");
        e.preventDefault();
        var form = jQuery("#post_filter_form_wp").serialize();
        var formData = new FormData;
        formData.append('action','show_post_filter_result_calculation');
        formData.append('show_post_filter_result_calculation',form);
        $.ajax({
            type: "POST",
            processData : false,
            contentType: false,
            url: ajaxurl,
            data: formData,
            success: function (result) {
                alert(result.data);
            },
        });
    });
});

