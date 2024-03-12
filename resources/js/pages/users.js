(function () {
    "use strict";

    $('#status-date-picker').on('focus', function (e) {
        $('#status-date').prop('checked', true);
    });

    $('[id=remove-file]').each(function () {
        $(this).on('click', function (e) {
            const id = e.target.getAttribute('data-value')

            $.ajax({
                url: `http://localhost/admin/files/${id}`,
                type: 'DELETE',
                dataType: 'json',
            }).done((result) => {
                if (result === 1) {
                    document.getElementById(id).remove()
                }
            }).fail((one, two, error) => {
                //TODO: Implement showing error messages
                console.log({one, two, error})
            });
        })
    })
})();
