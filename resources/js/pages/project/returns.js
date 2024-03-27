(function () {
    'use strict';

    if ($('input:radio[name=distribute]:checked').val() == 1) {
        $('#warehouse').hide();
    } else {
        $('#warehouse').show();
    }

    $('input:radio[name=distribute]').on('click', (e) => {
        let warehouse = $('#warehouse');
        if (e.target.value === '0') {
            $(warehouse).show();
        } else {
            $(warehouse).hide();
        }
    });

    $('#send').on('click', function () {
        if (confirm('Вы действительно хотите отправить на одобрение?')) {
            $('#return-form').attr('action', $('#send').data('route')).submit();
        }
    });

    document.addEventListener('livewire:init', () => {
        let barcode = '';
        let interval;
        document.addEventListener('keydown', function (evt) {
            if (interval)
                clearInterval(interval);
            if (evt.code == 'Enter') {
                if (barcode)
                    Livewire.dispatch('confirm', { barcode: barcode });
                barcode = '';
                return;
            }
            if (evt.key != 'Shift')
                barcode += evt.key;
            interval = setInterval(() => barcode = '', 20);
        });

        Livewire.on('clientSelected', function () {
            $('#query').val('');
        });
    });
})();
