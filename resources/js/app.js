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
