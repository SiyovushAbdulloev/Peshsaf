(function () {
    'use strict';

    $('#selected').text($('.products:checked').length)
    $('.products').on('click', function (e) {
        $('#selected').text($('.products:checked').length);
    });

    $('#send').on('click', function () {
        if (confirm('Вы действительно хотите отправить на одобрение?')) {
            $('#receipt-form').attr('action', $('#send').data('route')).submit();
        }
    });

    $('.delete-product').on('click', function (e) {
        if (confirm('Вы действительно хотите удапить товар?')) {
            $.ajax({
                url: $(this).attr('data-route'),
                type: 'DELETE',
                dataType: 'json',
            }).done(() => {
                $(this).closest('tr').remove();

                if ($('#products tbody tr').length === 0) {
                    $('#products tbody').html(
                        '<tr>' +
                        '<td colspan="5" class="px-5 py-3 border-b dark:border-darkmode-300 text-center">No data</td>' +
                        '</tr>'
                    );
                }
            }).fail((err) => {
                console.log(err);
            });
        }
    });

    $('#make-qr').click((e) => $('#send').prop('disabled', !$(e.target).is(':checked')));

    let receiptsTable = $('#receipts-table');
    $('.delete-receipt', receiptsTable).on('click', function (e) {
        if (confirm('Вы действительно хотите удапить приход?')) {
            let form = $('#delete-form');
            form.attr('action', $(this).attr('data-route')).submit();
        }
    });
})();
