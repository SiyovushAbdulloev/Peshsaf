(function () {
    'use strict';

    $('.products').on('click', function (e) {
        $('#selected').text($('.products:checked').length);
    });

    $('#send').on('click', function () {
        if (confirm('Вы действительно хотите отправить на одобрение?')) {
            $('#send-form')[0].submit();
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

    let receiptsTable = $('#receipts-table');
    $('.delete-receipt', receiptsTable).on('click', function (e) {
        if (confirm('Вы действительно хотите удапить приход?')) {
            $.ajax({
                url: $(this).attr('data-route'),
                type: 'DELETE',
                dataType: 'json',
            }).done(() => {
                $(this).closest('tr').remove();

                if ($('tbody tr', receiptsTable).length === 0) {
                    $('tbody', receiptsTable).html(
                        '<tr>' +
                        '<td colspan="9" class="px-5 py-3 border-b dark:border-darkmode-300 text-center">No data</td>' +
                        '</tr>'
                    );
                }
            }).fail((err) => {
                console.log(err);
            });
        }
    });
})();
