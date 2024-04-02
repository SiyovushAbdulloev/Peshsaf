(function () {
    'use strict';

    let utilizationsTable = $('#utilizations-table');
    $('.delete-utilization', utilizationsTable).on('click', function (e) {
        if (confirm('Вы действительно хотите удапить утилизацию?')) {
            let form = $('#delete-form');
            form.attr('action', $(this).attr('data-route')).submit();
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
                    Livewire.dispatch('search', { barcode: barcode });
                barcode = '';
                return;
            }
            if (evt.key != 'Shift')
                barcode += evt.key;
            interval = setInterval(() => barcode = '', 20);
        });
    });
})();
