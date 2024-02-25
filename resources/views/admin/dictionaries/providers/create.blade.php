@extends('layouts/sidebar')

@section('subhead')
    <title>Поставщики</title>
@endsection

@section('subcontent')
    <h2 class="intro-y mt-10 text-lg font-medium">Создание</h2>

    <div class="mt-5 gap-6">
        <div class="intro-y col-span-12 lg:col-span-6">
            <form action="{{ route('admin.dictionaries.providers.store') }}" method="post">
                @csrf

                <div class="intro-y box p-5">
                    @include('admin.dictionaries.providers.partials.form')

                    <div class="mt-5 text-right">
                        <x-base.button
                            as="a"
                            :href="route('admin.dictionaries.providers.index')"
                            class="mr-1 w-24"
                            type="button"
                            variant="outline-secondary"
                        >
                            Отмена
                        </x-base.button>
                        <button type="button" id="store-provider"
                                class="transition duration-200 border shadow-sm inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary w-24">
                            Добавить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        const storeBtn = document.querySelector('#store-provider')

        storeBtn.addEventListener('click', async function () {
            const body = new FormData()
            body.append('organization_name', organizationName.value)
            body.append('full_name', fullname.value)
            body.append('organization_address', address.value)
            body.append('phone', phone.value)
            body.append('email', email.value)
            body.append('organization_info', organizationInfo.value)
            body.append('country_id', country.value)
            body.append('_token', document.head.querySelector('meta[name="csrf-token"]').content)
            files.forEach(file => {
                body.append('files[]', file);
            });

            let response = await fetch('http://localhost/admin/dictionaries/providers', {
                method: 'POST',
                body
            })

            try {
                if (response.ok) {
                    let data = await response.json();
                    if (data?.success) {
                        location.href = 'http://localhost/admin/dictionaries/providers';
                    }
                } else if (response.status === 422) {
                    let {errors} = await response.json();
                    showErrorMessages(errors)
                } else {
                    throw new Error('Network response was not ok');
                }
            } catch (error) {
                console.log('Error:', error);
            }
        })

        function showErrorMessages(errors) {
            const properties = Object.keys(errors)
            if (properties.length > 0) {
                Object.keys(inputErrors).forEach(input => {
                    inputErrors[input].replaceChildren()
                })
                properties.forEach(property => {
                    const errorMessages = errors[property].join(', ')
                    if (inputErrors[property]) {
                        inputErrors[property].innerHTML = errorMessages
                    }
                })
            }
        }
    </script>
@endsection
