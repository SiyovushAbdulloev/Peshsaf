(function () {
    "use strict";

    $('.products').on('click', function (e) {
        $('#selected').text($('.products:checked').length);
    })

    $('#send').on('click', function () {
        if(confirm('Вы действительно хотите отправить на одобрение?')) {
            $('#send-form')[0].submit();
        }
    })

    $('#delete-product').on('click', function (e) {
        if(confirm('Вы действительно хотите удапмть товар?')) {
            // TODO call delete product route
            let id = $(this).attr('data-id');
            $(this).closest('tr').remove();
        }
    })
})();
