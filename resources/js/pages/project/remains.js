(function () {
    'use strict';

    $('#option').on('change', function (e) {
        let selected = $(this).children("option:selected")

        $('#from').val(selected.data('from'))
        $('#to').val(selected.data('to'))
    })

    $('#export-btn').on('click', function () {
        $('#export').val(1)

        $('#search-form').submit()
    })

    $('#clear').on('click', function () {
        $('#export').val(0)
        $('#from').val('')
        $('#to').val('')
        $('#option').val('')
        $('#outlet').val('')
    })

    $('#search').on('click', function () {
        $('#export').val(0)
    })
})();
