<div class="grid grid-cols-2 gap-4">
    <div class="w-full">
        <x-base.form-label for="organization_name">Наименование</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="organization_name"
            type="text"
            name="name"
            placeholder="Введите наименование организации"
            value="{{ old('organization_name', $provider->organization_name) }}"
        />
        <h5 id="organization_name_error" class="mt-3 text-lg font-medium leading-none text-danger">

        </h5>
    </div>

    <div class="w-full">
        <x-base.form-label for="full_name">ФИО</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="full_name"
            type="text"
            name="name"
            placeholder="Введите ФИО поставщика"
            value="{{ old('full_name', $provider->full_name) }}"
        />
        <h5 id="full_name_error" class="mt-3 text-lg font-medium leading-none text-danger">

        </h5>
    </div>

    <div class="w-full">
        <x-base.form-label for="country">Страна</x-base.form-label>
        <x-base.form-select
            id="country"
            class="mt-2"
            formSelectSize="sm"
            aria-label=".form-select-sm example"
        >
            @foreach($countries as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
            @endforeach
        </x-base.form-select>
    </div>

    <div class="w-full">
        <x-base.form-label for="organization_address">Адрес</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="organization_address"
            type="text"
            name="name"
            placeholder="Введите адрес организации"
            value="{{ old('organization_address', $provider->organization_address) }}"
        />
        <h5 id="organization_address_error" class="mt-3 text-lg font-medium leading-none text-danger">

        </h5>
    </div>

    <div class="w-full">
        <x-base.form-label for="phone">Телефон</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="phone"
            type="text"
            name="name"
            placeholder="Введите телефон"
            value="{{ old('phone', $provider->phone) }}"
        />
        <h5 id="phone_error" class="mt-3 text-lg font-medium leading-none text-danger">

        </h5>
    </div>

    <div class="w-full">
        <x-base.form-label for="email">Почта</x-base.form-label>
        <x-base.form-input
            class="w-full"
            id="email"
            type="text"
            name="name"
            placeholder="Введите почту"
            value="{{ old('email', $provider->email) }}"
        />
        <h5 id="email_error" class="mt-3 text-lg font-medium leading-none text-danger">

        </h5>
    </div>

    <div class="w-full">
        <x-base.form-label for="organization_info">Общая информация</x-base.form-label>
        <x-base.form-textarea
            class="w-full"
            id="organization_info"
            type="text"
            name="name"
            placeholder="Введите информацию об организации"
            value="{{ old('organization_info', $provider->organization_info) }}"
        />
        <h5 id="organization_info_error" class="mt-3 text-lg font-medium leading-none text-danger">

        </h5>
    </div>

    <div class="flex flex-col">
        <div class="w-full flex gap-4">
            <x-base.form-input
                id="regular-form-5"
                type="text"
                placeholder="Загрузка документа"
                disabled
            />
            <input
                id="files"
                type="file"
                name="name"
                placeholder="Нажмите чтобы выбрать файл"
                multiple="multiple"
                class="w-0 h-0 opacity-0"
                accept=".doc,.docx,.pdf,.txt"
            />
            <label for="files"
                   class="transition duration-200 border shadow-sm justify-center py-2 px-3 rounded-md font-medium focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed !box cursor-pointer !box flex items-center">
                Выбрать
            </label>
        </div>
        <div id="file-list" class="mt-10 flex flex-col gap-6">

        </div>
        <h5 id="files_error" class="mt-3 text-lg font-medium leading-none text-danger">

        </h5>
    </div>
    @if($page === 'edit')
        <div id="backend-data" data-files="{{ $provider->files }}"></div>
    @endif
</div>
<script>
    const uploadInput = document.querySelector('#files')
    const fileList = document.querySelector('#file-list')
    const organizationName = document.querySelector('#organization_name')
    const fullname = document.querySelector('#full_name')
    const address = document.querySelector('#organization_address')
    const phone = document.querySelector('#phone')
    const email = document.querySelector('#email')
    const organizationInfo = document.querySelector('#organization_info')
    const country = document.querySelector('#country')
    const inputErrors = {
        'organization_name': document.querySelector('#organization_name_error'),
        'full_name': document.querySelector('#full_name_error'),
        'organization_address': document.querySelector('#organization_address_error'),
        'phone': document.querySelector('#phone_error'),
        'email': document.querySelector('#email_error'),
        'organization_info': document.querySelector('#organization_info_error'),
        'files': document.querySelector('#files_error'),
    }
    const backendData = document.querySelector('#backend-data')
    console.log(backendData.getAttribute('data-files'))
    let files = []

    uploadInput.addEventListener('change', function (e) {
        files.push(...e.target.files)
        buildFileList()
        e.target.files = null
    })

    function buildFileList() {
        fileList.replaceChildren()

        files.forEach((file, index) => {
            const div = document.createElement('div')
            div.setAttribute('class', 'flex justify-between')
            const p = document.createElement('p')
            const textNode = document.createTextNode(`${index + 1}. ${file.name}`)
            p.appendChild(textNode)
            const button = document.createElement('button')
            button.setAttribute('type', 'button')
            button.setAttribute('class', 'border-2 border-red-950 rounded-lg p-3')
            button.addEventListener('click', function () {
                files = files.filter((f, key) => {
                    return key !== index
                })
                buildFileList()
            })
            const buttonTextNode = document.createTextNode('Delete')
            button.appendChild(buttonTextNode)
            div.appendChild(p)
            div.appendChild(button)
            fileList.appendChild(div)
        })
    }
</script>
