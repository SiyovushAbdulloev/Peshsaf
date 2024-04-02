(function () {
    'use strict';

    $('#export-btn').on('click', function () {
        $('#export').val(1);

        $('#search-form').submit();

        $('#export').val(0);
    });
})();
