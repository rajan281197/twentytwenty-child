$(document).ready(function () {
    $("#submitform").submit(function (e) {
        
        e.preventDefault();
        var form = jQuery("#submitform").serialize();
        var formData = new FormData;
        formData.append('action','addpost');
        formData.append('addpost',form);
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

