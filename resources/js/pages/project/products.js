(function () {
    "use strict";

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

    $('#show-product').on('click', function () {
        const modal = tailwind.Modal.getOrCreateInstance($('#product-modal'));
        modal.show();
    })

    document.addEventListener('livewire:init', () => {
        Livewire.on('show-modal', (data) => {
            Livewire.dispatch('can-show', data)
        });
        Livewire.on('show-product-again', () => {
            console.log("WOWOWO")
            $('#show-product').on('click', function () {
                const modal = tailwind.Modal.getOrCreateInstance($('#product-modal'));
                modal.show();
            })
        })
    });
})();
