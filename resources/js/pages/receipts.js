(function () {
    "use strict";

    $('.products').on('click', function (e) {
        $('#selected').text($('.products:checked').length);
    })
})();
