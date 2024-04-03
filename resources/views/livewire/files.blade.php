<x-base.table class="mt-5 col-span-12">
    <x-base.table.thead variant="light">
        <x-base.table.tr>
            <x-base.table.th class="whitespace-nowrap">
                Наименование
            </x-base.table.th>
            <x-base.table.th class="whitespace-nowrap text-right">
            </x-base.table.th>
        </x-base.table.tr>
    </x-base.table.thead>
    <x-base.table.tbody>
        @foreach($files as $file)
            <x-base.table.tr wire:key="$file->id">
                <x-base.table.td>{{ $file->original_filename }}</x-base.table.td>
                <x-base.table.td>
                    <x-base.button
                        size="sm"
                        variant="outline-danger"
                        type="button"
                        wire:confirm="Вы действительно хотите удалить файл?"
                        wire:click="delete({{$file->id}})"
                    >
                        <x-base.icon icon="fa-trash" />
                    </x-base.button>
                </x-base.table.td>
            </x-base.table.tr>
        @endforeach
        <x-base.table.tr>
            <x-base.table.td colspan="2">
                <div class="col-span-12">
                    <x-base.form-label for="files">Загрузите документы</x-base.form-label>
                    <x-base.form-upload
                        id="files"
                        name="files"
                        :multiple="true"
                        accept=".doc,.pdf"
                        description="PDF, DOC (макс 1Мб)"
                    />

                    @error('files')
                    <div class="font-italic text-danger italic">
                        {{ $message }}
                    </div>
                    @enderror
                    @if ($errors->has('files.*'))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->get('files.*') as $error)
                                    @foreach($error as $message)
                                        <div class="mt-2 text-danger italic">
                                            {{ $message }}
                                        </div>
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </x-base.table.td>
        </x-base.table.tr>
    </x-base.table.tbody>
</x-base.table>
