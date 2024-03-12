(function () {
    'use strict';

    let salesTable = $('#sales-table');
    $('.delete-receipt', salesTable).on('click', function (e) {
        if (confirm('Вы действительно хотите удапить продажу?')) {
            $.ajax({
                url: $(this).attr('data-route'),
                type: 'DELETE',
                dataType: 'json',
            }).done(() => {
                $(this).closest('tr').remove();

                if ($('tbody tr', salesTable).length === 0) {
                    $('tbody', salesTable).html(
                        '<tr>' +
                        '<td colspan="7" class="px-5 py-3 border-b dark:border-darkmode-300 text-center">No data</td>' +
                        '</tr>'
                    );
                }
            }).fail((err) => {
                console.log(err);
            });
        }
    });
})();
