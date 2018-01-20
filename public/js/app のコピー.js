$(function() {
    $('.favoriteBtn').on('click',function() {
        $.ajax({
            url: 'api/fav',
            type: "GET",
            dataType: "json",
            data: {
                'user_id':           $(this).data('user-id'),
                'client_project_id': $(this).data('client-project-id')
            },
            context: this,
            success: function() {
                var data = { alertFlashMessage: "通信に成功しました。" }
                ApiFlashMessage(data);
            },
            error: function() {
                var data = { alertFlashMessage: "通信に失敗しました。" }
                ApiFlashMessage(data);
            }
        });
    });
});