(function () {
    'use strict';

    let movementsTable = $('#movements-table');
    $('.delete-movement', movementsTable).on('click', function (e) {
        if (confirm('Вы действительно хотите удапить перемещение?')) {
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
