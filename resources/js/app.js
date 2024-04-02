import './bootstrap';
// Load static files
import.meta.glob(["../images/**"]);

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

if ($('meta[name="csrf-token"]').length > 0) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

$(".show-product").on("click", function () {
    $.ajax({
        url: $(this).attr('data-route'),
        dataType: 'html',
    }).done((res) => {
        $('#body').html(res)
        const el = document.querySelector("#basic-slide-over-preview");
        const slideOver = tailwind.Modal.getInstance(el);

        slideOver.toggle();
    }).fail((err) => {
        $('#body').html('Ошибка при загрузке данных')
        console.log(err);
    });
});

Livewire.on('show-product', function (res) {
    $('#body').html(res);
    const el = document.querySelector("#basic-slide-over-preview");
    const slideOver = tailwind.Modal.getInstance(el);

    slideOver.toggle();
})
