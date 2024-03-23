<x-base.modal>
    <x-base.dialog.panel class="p-10 text-center">
        <h1>WOW</h1>
        @if($this->product)
            <div class="col-span-12 lg:col-span-4 2xl:col-span-3">
                <div class="box rounded-md p-5">
                    <div class="mb-5 flex items-center border-b border-slate-200/60 pb-5 dark:border-darkmode-400">
                        <div class="truncate text-base font-medium">
                            Детали продукта
                        </div>
                    </div>
                    {{--                    <div class="flex items-center">--}}
                    {{--                        <x-base.icon--}}
                    {{--                            class="mr-1 h-4 w-4 text-slate-500"--}}
                    {{--                            icon="fa-user"--}}
                    {{--                        />--}}
                    {{--                        Отправитель: <span class="ml-2">{{ $receipt->warehouse->name }}</span>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="mt-3 flex items-center">--}}
                    {{--                        <x-base.icon--}}
                    {{--                            class="mr-1 h-4 w-4 text-slate-500"--}}
                    {{--                            icon="fa-phone"--}}
                    {{--                        />--}}
                    {{--                        Дата: <span class="ml-2">{{ $receipt->date }}</span>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="mt-3 flex items-center">--}}
                    {{--                        <x-base.icon--}}
                    {{--                            class="mr-1 h-4 w-4 text-slate-500"--}}
                    {{--                            icon="fa-location-dot"--}}
                    {{--                        />--}}
                    {{--                        Номер накладной: <span class="ml-2">{{ $receipt->number }}</span>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        @else
            <h1>NOT FOUND</h1>
        @endif
    </x-base.dialog.panel>
</x-base.modal>
